<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\schedule;
use File;
use Auth;
use Log;
class ScheduleController extends Controller
{
    public function GetData(Request $request)
    {
        $schedule=new schedule;
        

        $courses=$request->input('mytext');
        $offDays=$request->input("day");
        $preferedTimes=$request->input("time");

        if($offDays==NULL)
        $offDays=array();
        if($preferedTimes==NULL)
        $preferedTimes=array();



        $teachers=$request->input("teachers");
        $array=$schedule->GetSortedArrayByCourse($courses,$teachers);
        $allschedule=self::CombinationWithComparison($array,$offDays,$preferedTimes);
        $indexLike=array();
        if($allschedule)
        $indexLike=self::sortSchedulesOnLikes($allschedule);
        $courses=$schedule->getDistinctCourses();
        for($i=0;$i<sizeof($courses);$i++)
        {
            //$clean = str_replace("\\u00a0", "",$courses[$i]->coursename);
            $courses[$i]->coursename = str_replace( chr( 194 ) . chr( 160 ), '', $courses[$i]->coursename );
        }
       // return view('schedules',['allschedule'=>$allschedule],['courses'=>$courses]);
        return view('schedules')->with('allschedule',$allschedule)->with('likeIndex',$indexLike)->with('courses',$courses);


    }

    public function CreateAllPossibleSchedules($SortedArrayByCourse)
    {
        $model=new schedule;
        $AllSched=$CombinationWithComparison($SortedArrayByCourse);

    }

    public function UploadFile(Request $request)
    {
       
        $x=0;
        $course=array();
        $i=-1;
        $files=$request->file("file");
        $destinationPath = 'uploads';
        $files->move($destinationPath,$files->getClientOriginalName());
        $handle = fopen("uploads/".$files->getClientOriginalName(), "r");
        if ($handle) {
        while (($line = fgets($handle)) !== false) {
            $my_string=strip_tags($line);
            $my_string = html_entity_decode($my_string);
            $my_string=str_replace("&nbsp;","",$my_string);
            $my_string=str_replace("\n","",$my_string);
            $my_string=str_replace("\r","",$my_string);
            if(!str_contains($my_string,"Class")&&!str_contains($my_string,"Section")&&!str_contains($my_string,"Days & Times")&&!str_contains($my_string,"Room")&&
       !str_contains($my_string,"Instructor")&&
       !str_contains($my_string,"Meeting Dates")&&
       !str_contains($my_string,"Status")){
     if(preg_match_all("/([A-Z]{4} {1,}[0-9]{3})/",$my_string)==1){
          $i=$i+1;
          
       $course[$i]=$my_string;
                
            }
            if(preg_match_all("/(^[0-9]{4})/",$my_string)==1){
                if(strlen($my_string)==4){
                $j=0;
                $course[$i]=$course[$i]." # ".$my_string;
                }
            }
            if(preg_match_all("/([A-Z][a-z]{1,2} [0-9]{1,2}:[0-9])/",$my_string)==1){
                $j=$j+1;
                if($j<3){
                    
                    if(preg_match_all("/([A-Z][a-z][A-Z][a-z] [0-9]{1,2}:[0-9])/",$my_string))
                    {
                        $j=$j+1;
                        $sub=substr($my_string,0,2);
                        $sub2=substr($my_string,2,2);
                        $ok=explode(" ",$my_string);
                        $time1=$sub." ".$ok[1]." - ".$ok[3];
                        $time2=$sub2." ".$ok[1]." - ".$ok[3];
                        $course[$i]=$course[$i]." # ".$time1." # ".$time2;
                    }
                    else{
                        
                    $course[$i]=$course[$i]." # ".$my_string;
                    //echo $course[$i]."</br>";
                    
                    }
                }
                
            }
            if(str_contains($my_string,'Online class')||str_contains($my_string,'Baabda-GrandeSalle')||str_contains($my_string,'TBA')||str_contains($my_string,'Baabda-SalleCours')||str_contains($my_string,'Ascenseur')||str_contains($my_string,'Baabda-LabInfo')||str_contains($my_string,'Baabda-LabElec')||str_contains($my_string,'Mejdlaya-SalleCours'))
            {
                $x=$x+1;
                
                
            }
            
            if($x>=1&&(str_contains($my_string,'Online class')==false&&str_contains($my_string,'Baabda-GrandeSalle')==false&&str_contains($my_string,'TBA')==false&&str_contains($my_string,'Baabda-SalleCours')==false)&&str_contains($my_string,'Ascenseur')==false&&str_contains($my_string,'Baabda-LabInfo')==false&&str_contains($my_string,'Baabda-LabElec')==false&&str_contains($my_string,'Mejdlaya-SalleCours')==false)
            {
                if(preg_match_all("/(^[ A-Za-z]+)/",$my_string)==1){
                $x=0;
                $course[$i]=$course[$i]." # ".$my_string;
                }
                
            }}
        
        }
        
        
        fclose($handle);

        for($j=0;$j<sizeof($course);$j++)
    {
        $p=0;
        $b=0;
        $u=explode(" # ",$course[$j]);
        $date1="";
        for($z=0;$z<sizeof($u);$z++)
        {
            
                $schedule=new schedule;
                if(preg_match_all("/([A-Z]{4} {1,}[0-9]{3})/",$u[$z])==1){
                    $name=$u[$z];
                }
                if(preg_match_all("/([A-Z][a-z] [0-9]{1,2}:[0-9])/",$u[$z])){
                    if($date1!=="")
                    $date1=$date1." ".$u[$z];
                    else
                    $date1=$u[$z];
                    
                }
                elseif(preg_match_all("/(^[0-9]{4})/",$u[$z])==1){
                    $courseid=$u[$z];
                }
                elseif(preg_match_all("/(^[a-zA-Z -]+)/",$u[$z])==1){
                    $teacher=$u[$z];
            $schedule->insertData($name,$courseid,$date1,$teacher);
            $date1="";
            File::delete('uploads/'.$files->getClientOriginalName());
                }
            }
        }
    }
    return View('adminUploadFile');
}

public function openPage(){
    $schedule = new schedule;
    $courses=$schedule->getDistinctCourses();
    for($i=0;$i<sizeof($courses);$i++)
        {
            //$clean = str_replace("\\u00a0", "",$courses[$i]->coursename);
            $courses[$i]->coursename = str_replace( chr( 194 ) . chr( 160 ), '', $courses[$i]->coursename );
        }

    return view('schedules',['courses'=>$courses]);
}


function CombinationWithComparison($SortedArrayByCourse,$offDay,$preferedTimesIndex)
{
 
    $schedule=array();
     $schedules=array();
     $preferedTimeCounts=array();
     for($i=0;$i<7;$i++)
     {
         for($j=0;$j<5;$j++)
         {
             $schedule[$i][$j]="0";
         }
     }
     $counters=0;
     $n = sizeof($SortedArrayByCourse);
 
     $indices = array();

     // initialize with first element's index
     for ($i = 0;$i < $n;$i++) $indices[$i] = 0;
     while (true)
     {
         $time = array();
         $conflict=0;
         for ($i = 0;$i < $n;$i++)
         {
 

             $newone=$SortedArrayByCourse[$i][$indices[$i]];
             
             preg_match_all('/([A-Z][a-z]\s[0-9]+[:][0-9]+[AMPM]{2,}\s[-]\s[0-9]+[:][0-9]+[APM]{2,})/',$newone,$newTime);  
             
             $coursename= preg_replace('/([A-Z][a-z]\s[0-9]+[:][0-9]+[AMPM]{2,}\s[-]\s[0-9]+[:][0-9]+[APM]{2,})/', "", $newone);
 
             if(sizeof($newTime[0])>1)
             {  
      
                $insert1= str_split(self::whichTime($newTime[0][0]));
                $insert2=str_split(self::whichTime($newTime[0][1]));


                       if($schedule[$insert1[0]][$insert1[1]]=="0" && self::offDays($insert1[1],$offDay))
                       { 
                           $schedule[$insert1[0]][$insert1[1]]=$coursename." (".$newTime[0][0]." )";
                           
                       }else{
                           $conflict=1;
                       break;
                       }
                           
                       
                       if( $schedule[$insert2[0]][$insert2[1]]=="0" && self::offDays($insert2[1],$offDay))
                       {
                           
                           $schedule[$insert2[0]][$insert2[1]]=$coursename." (".$newTime[0][1]." )";
                           
                       }else{
                           $conflict=1;
                       break;
                       }

 
 
             }
             else if(sizeof($newTime[0])==1)
             {
   
                $insert3= str_split(self::whichTime($newTime[0][0]));
                if( $schedule[$insert3[0]][$insert3[1]]=="0" && self::offDays($insert3[1],$offDay))
                {
                    
                    $schedule[$insert3[0]][$insert3[1]]=$coursename." (".$newTime[0][0]." )";
                }else{
                    $conflict=1;
                break;
                }
                 
             }
             
         }
 
    
         $prefCount=0;
     if($conflict==0)
     {   
       $prefCount=self::prefferedTime($schedule,$preferedTimesIndex);
       array_push($preferedTimeCounts,$prefCount);
        array_push($schedules,$schedule);
     
    }


     $sch="";
    
         for($i=0;$i<7;$i++)
         {
             for($j=0;$j<5;$j++)
             {
                 $schedule[$i][$j]="0";
             }
         }
 
          $counters++;

         $next = $n - 1;
         while ($next >= 0 && ($indices[$next] + 1 >= sizeof($SortedArrayByCourse[$next]))) $next--;

         if ($next < 0){

       
            $sortedSched=self::sortSchedulesAscedingPrefTime($schedules,$preferedTimeCounts);
            return $sortedSched;
        
        
        }
 

         $indices[$next]++;
 
         for ($i = $next + 1;$i < $n;$i++) $indices[$i] = 0;
     }

}
function sortSchedulesOnLikes($schedules)
{
    $counters=array();
    $index=0;
    do{$counters=array();
        foreach($schedules as $key=>$schedule)
        {   
        $ArrayOfSectionCounter=array();
            for($i=0;$i<7;$i++)
            {
                for($j=0;$j<5;$j++)
                {

                    if(!$schedule[$i][$j]=="0")
                    {
                        $pattern = "/(?<=%%%)(.*)(?=%%%)/";
                        preg_match($pattern, $schedule[$i][$j],$counter);
                        $patterns = "/(?<=Sectionid:).{4}/";
                        preg_match($patterns, $schedule[$i][$j],$sectionid);
                        
                        array_push($ArrayOfSectionCounter,$counter[0]);
                        
                    }   
                }
            }
            
            sort($ArrayOfSectionCounter);
            $keys = array_keys($ArrayOfSectionCounter);
            $counters[$key]=$ArrayOfSectionCounter;

        }
        $keyss=array();
        foreach($counters as $key=>$value)
        {
        array_push($keyss,$key);
        }
        //Log::info(array_column($counters,$index));
        $arrr=array_column($counters,$index);
        $arrcolumn=array_combine($keyss,$arrr);
      $maxes=array_keys($arrcolumn, max($arrcolumn));
     
      Log::info($counters);
    
      Log::info($maxes);
    for($k=0;$k<sizeof($counters);$k++)
        {
            if(!in_array($k,$maxes))
            {
                unset($schedules[$k]);
            }
        }
        $index++;
        

    }while(sizeof($maxes)>1 && $index!=sizeof($ArrayOfSectionCounter));


    //Log::info($maxes);
    return $maxes;
}

function offDays($indexs,$offDays)
{

if(in_array($indexs,$offDays))
return 0;
else
return 1; 


}
function prefferedTime($schedule,$arrOfTimes)
{ $count=0;
    foreach($arrOfTimes as $time)
    {
        
            for($j=0;$j<5;$j++)
            {
                if($schedule[$time][$j]!="0")
                    $count++;
            }

    }
    return $count;
}
function sortSchedulesAscedingPrefTime($schedules,$preferedTimeCounts)
{

    $counter=0; 
    $sortedSchedules=array();
    while($counter<sizeof($preferedTimeCounts))
    {
   $maxIndex = array_keys($preferedTimeCounts, max($preferedTimeCounts));
 
   array_push($sortedSchedules,$schedules[$maxIndex[0]]);
   $preferedTimeCounts[$maxIndex[0]]=-1;

    $counter++;   
 }
return $sortedSchedules;
}


function whichTime($timesday)
    {
        $times=substr($timesday,3,17);
    
        $result="";
        if($times=="8:30AM - 9:45AM")
        {
            $result= "0";
        }
        else if($times=="10:00AM - 11:15AM")
        {
            $result= "1";
        }else if($times=="11:30AM - 12:45PM")
        {
            $result= "2";
        }else if($times=="1:00PM - 2:15PM")
        {
            $result= "3";
            
        }else if($times=="3:30PM - 4:45PM")
        {
            $result= "4";
        
        }else if($times=="5:00PM - 6:15PM")
        {
            $result= "5";
        }else if($times=="6:30PM - 7:45PM")
        {
            $result= "6";
        }
        $day=substr($timesday,0,2);
        $days="";
        if($day=="Mo")
        {
            $days="0";
        }
        else if($day=="Tu")
        {
            $days="1";
        }else if($day=="We")
        {
            $days="2";
        }else if($day=="Th")
        {
            $days="3";
        }else if($day=="Fr")
        {
            $days="4";
        }
            
            return $result.$days;
    }


    public function getTeacher()
    {
        
        if(request()->ajax()){
                $schedule=new schedule;
                $teacher=$schedule->getTeachers($_GET['val']);
                return $teacher;
           }
    }





    public function view()
    {
        return view('schedules');
    }
   
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    
  



  public function send_http_request(Request $request)
    {

       $validatedData = $request->validate([
        'ids' => 'required',
        'schedpost' => 'required'
      ]);

      $idss= $request->ids;
      $scd = $request->schedpost;
      Log::info($idss);
      Log::info($scd);
      $arra = json_decode($scd);
      $variable=self::sendEmail($arra[$idss-1]);

      if($variable=="true")
      return response()->json(['success'=>'Success']);
      else
      return response()->json(['success'=>'Fail']);
    }
    public function sendEmail($scd)
    {
        $res="true";
    foreach( $scd as  $elem) 
    {
        foreach($elem as $el)
        {
        if($el!="0")
        {
            
            preg_match_all('/([A-Z][a-z]\s[0-9]+[:][0-9]+[AMPM]{2,}\s[-]\s[0-9]+[:][0-9]+[APM]{2,})/',$el,$newTime);  

           $pieces = explode("-", $newTime[0][0]);

           $days = array("Tu","Mo","We","Th","Fr");
           $firstTime = str_replace($days, "", $pieces[0]);
           $secondTime = str_replace($days, "", $pieces[1]);
           $el=str_replace("#", "", $el);
           $el=str_replace("%", "", $el);

        $from_name = "Mohammad Al Farfour";        
        $from_address = "antonineforumm@outlook.com";        
        $to_name = Auth::user()->name;        
        $to_address = Auth::user()->email;          
        $startTime = date("m/d/Y")." ".$firstTime;  
        $endTime = date("m/d/Y",strtotime("+2 months"))." ".$secondTime;    
        $subject = $el;   
        $description = $el;    
        $location = "Antonine University";	
        $domain = 'yourdomain.com';
        
        //Create Email Headers
        $mime_boundary = "----Meeting Booking----".MD5(TIME());

        $headers = "From: ".$from_name." <".$from_address.">\n";
        $headers .= "Reply-To: ".$from_name." <".$from_address.">\n";
        $headers .= "MIME-Version: 1.0\n";
        $headers .= "Content-Type: multipart/alternative; boundary=\"$mime_boundary\"\n";
        $headers .= "Content-class: urn:content-classes:calendarmessage\n";
        
        //Create Email Body (HTML)
        $message = "--$mime_boundary\r\n";
        $message .= "Content-Type: text/html; charset=UTF-8\n";
        $message .= "Content-Transfer-Encoding: 8bit\n\n";
        $message .= "<html>\n";
        $message .= "<body>\n";
        
        $message .= "Dear ".$to_name." You can find the lecture attached to this email \n".$el;
        
        $message .= "</body>\n";
        $message .= "</html>\n";
        $message .= "--$mime_boundary\r\n";

        //Event setting
        $ical1 = 'BEGIN:VCALENDAR' . "\r\n" .
        'PRODID:-//Microsoft Corporation//Outlook 10.0 MIMEDIR//EN' . "\r\n" .
        'VERSION:2.0' . "\r\n" .
        'METHOD:REQUEST' . "\r\n" .
        'BEGIN:VTIMEZONE' . "\r\n" .
        'TZID:Eastern Time' . "\r\n" .
        'BEGIN:STANDARD' . "\r\n" .
        'DTSTART:20091101T020000' . "\r\n" .
        'RRULE:FREQ=YEARLY;INTERVAL=1;BYDAY=1SU;BYMONTH=11' . "\r\n" .
        'TZOFFSETFROM:-0400' . "\r\n" .
        'TZOFFSETTO:-0500' . "\r\n" .
        'TZNAME:EST' . "\r\n" .
        'END:STANDARD' . "\r\n" .
        'BEGIN:DAYLIGHT' . "\r\n" .
        'DTSTART:20090301T020000' . "\r\n" .
        'RRULE:FREQ=YEARLY;INTERVAL=1;BYDAY=2SU;BYMONTH=3' . "\r\n" .
        'TZOFFSETFROM:-0500' . "\r\n" .
        'TZOFFSETTO:-0400' . "\r\n" .
        'TZNAME:EDST' . "\r\n" .
        'END:DAYLIGHT' . "\r\n" .
        'END:VTIMEZONE' . "\r\n" .	
        'BEGIN:VEVENT' . "\r\n" .
        'ORGANIZER;CN="'.$from_name.'":MAILTO:'.$from_address. "\r\n" .
        'ATTENDEE;CN="'.$to_name.'";ROLE=REQ-PARTICIPANT;RSVP=TRUE:MAILTO:'.$to_address. "\r\n" .
        'LAST-MODIFIED:' . date("Ymd\TGis") . "\r\n" .
        'UID:'.date("Ymd\TGis", strtotime($startTime)).rand()."@".$domain."\r\n" .
        'DTSTAMP:'.date("Ymd\TGis"). "\r\n" .
        'DTSTART;TZID="Pacific Daylight":'.date("Ymd\THis", strtotime($startTime)). "\r\n" .
        'DTEND;TZID="Pacific Daylight":'.date("Ymd\THis", strtotime($endTime)). "\r\n" .
        'TRANSP:OPAQUE'. "\r\n" .
        'SEQUENCE:1'. "\r\n" .
        'SUMMARY:' . $subject . "\r\n" .
        'LOCATION:' . $location . "\r\n" .
        'CLASS:PUBLIC'. "\r\n" .
        'PRIORITY:5'. "\r\n" .
        'BEGIN:VALARM' . "\r\n" .
        'TRIGGER:-PT15M' . "\r\n" .
        'ACTION:DISPLAY' . "\r\n" .
        'DESCRIPTION:Reminder' . "\r\n" .
        'END:VALARM' . "\r\n" .
        'END:VEVENT'. "\r\n" .
        'END:VCALENDAR'. "\r\n";
        $ical2 = 'BEGIN:VCALENDAR' . "\r\n" .
        'PRODID:-//Microsoft Corporation//Outlook 10.0 MIMEDIR//EN' . "\r\n" .
        'VERSION:2.0' . "\r\n" .
        'METHOD:REQUEST' . "\r\n" .
        'BEGIN:VTIMEZONE' . "\r\n" .
        'TZID:Eastern Time' . "\r\n" .
        'BEGIN:STANDARD' . "\r\n" .
        'DTSTART:20091101T020000' . "\r\n" .
        'RRULE:FREQ=YEARLY;INTERVAL=1;BYDAY=1SU;BYMONTH=11' . "\r\n" .
        'TZOFFSETFROM:-0400' . "\r\n" .
        'TZOFFSETTO:-0500' . "\r\n" .
        'TZNAME:EST' . "\r\n" .
        'END:STANDARD' . "\r\n" .
        'BEGIN:DAYLIGHT' . "\r\n" .
        'DTSTART:20090301T020000' . "\r\n" .
        'RRULE:FREQ=YEARLY;INTERVAL=1;BYDAY=2SU;BYMONTH=3' . "\r\n" .
        'TZOFFSETFROM:-0500' . "\r\n" .
        'TZOFFSETTO:-0400' . "\r\n" .
        'TZNAME:EDST' . "\r\n" .
        'END:DAYLIGHT' . "\r\n" .
        'END:VTIMEZONE' . "\r\n" .	
        'BEGIN:VEVENT' . "\r\n" .
        'ORGANIZER;CN="'.$from_name.'":MAILTO:'.$from_address. "\r\n" .
        'ATTENDEE;CN="'.$to_name.'";ROLE=REQ-PARTICIPANT;RSVP=TRUE:MAILTO:'.$to_address. "\r\n" .
        'LAST-MODIFIED:' . date("Ymd\TGis") . "\r\n" .
        'UID:'.date("Ymd\TGis", strtotime($startTime)).rand()."@".$domain."\r\n" .
        'DTSTAMP:'.date("Ymd\TGis"). "\r\n" .
        'DTSTART;TZID="Pacific Daylight":'.date("Ymd\THis", strtotime($startTime)). "\r\n" .
        'DTEND;TZID="Pacific Daylight":'.date("Ymd\THis", strtotime($endTime)). "\r\n" .
        'TRANSP:OPAQUE'. "\r\n" .
        'SEQUENCE:1'. "\r\n" .
        'SUMMARY:' . $subject . "\r\n" .
        'LOCATION:' . $location . "\r\n" .
        'CLASS:PUBLIC'. "\r\n" .
        'PRIORITY:5'. "\r\n" .
        'BEGIN:VALARM' . "\r\n" .
        'TRIGGER:-PT15M' . "\r\n" .
        'ACTION:DISPLAY' . "\r\n" .
        'DESCRIPTION:Reminder' . "\r\n" .
        'END:VALARM' . "\r\n" .
        'END:VEVENT'. "\r\n" .
        'END:VCALENDAR'. "\r\n";
        $ical = 'BEGIN:VCALENDAR' . "\r\n" .
        'PRODID:-//Microsoft Corporation//Outlook 10.0 MIMEDIR//EN' . "\r\n" .
        'VERSION:2.0' . "\r\n" .
        'METHOD:REQUEST' . "\r\n" .
        'BEGIN:VTIMEZONE' . "\r\n" .
        'TZID:Eastern Time' . "\r\n" .
        'BEGIN:STANDARD' . "\r\n" .
        'DTSTART:20091101T020000' . "\r\n" .
        'RRULE:FREQ=YEARLY;INTERVAL=1;BYDAY=1SU;BYMONTH=11' . "\r\n" .
        'TZOFFSETFROM:-0400' . "\r\n" .
        'TZOFFSETTO:-0500' . "\r\n" .
        'TZNAME:EST' . "\r\n" .
        'END:STANDARD' . "\r\n" .
        'BEGIN:DAYLIGHT' . "\r\n" .
        'DTSTART:20090301T020000' . "\r\n" .
        'RRULE:FREQ=YEARLY;INTERVAL=1;BYDAY=2SU;BYMONTH=3' . "\r\n" .
        'TZOFFSETFROM:-0500' . "\r\n" .
        'TZOFFSETTO:-0400' . "\r\n" .
        'TZNAME:EDST' . "\r\n" .
        'END:DAYLIGHT' . "\r\n" .
        'END:VTIMEZONE' . "\r\n" .	
        'BEGIN:VEVENT' . "\r\n" .
        'ORGANIZER;CN="'.$from_name.'":MAILTO:'.$from_address. "\r\n" .
        'ATTENDEE;CN="'.$to_name.'";ROLE=REQ-PARTICIPANT;RSVP=TRUE:MAILTO:'.$to_address. "\r\n" .
        'LAST-MODIFIED:' . date("Ymd\TGis") . "\r\n" .
        'UID:'.date("Ymd\TGis", strtotime($startTime)).rand()."@".$domain."\r\n" .
        'DTSTAMP:'.date("Ymd\TGis"). "\r\n" .
        'DTSTART;TZID="Pacific Daylight":'.date("Ymd\THis", strtotime($startTime)). "\r\n" .
        'DTEND;TZID="Pacific Daylight":'.date("Ymd\THis", strtotime($endTime)). "\r\n" .
        'TRANSP:OPAQUE'. "\r\n" .
        'SEQUENCE:1'. "\r\n" .
        'SUMMARY:' . $subject . "\r\n" .
        'LOCATION:' . $location . "\r\n" .
        'CLASS:PUBLIC'. "\r\n" .
        'PRIORITY:5'. "\r\n" .
        'BEGIN:VALARM' . "\r\n" .
        'TRIGGER:-PT15M' . "\r\n" .
        'ACTION:DISPLAY' . "\r\n" .
        'DESCRIPTION:Reminder' . "\r\n" .
        'END:VALARM' . "\r\n" .
        'END:VEVENT'. "\r\n" .
        'END:VCALENDAR'. "\r\n";
        $message .= 'Content-Type: text/calendar;name="meeting.ics";method=REQUEST'."\n";
        $message .= "Content-Transfer-Encoding: 8bit\n\n";
        $message .= $ical;
        $message .= $ical1;
        $message .= $ical2;

        if(!mail($to_address, $subject, $message, $headers))
        {
            $res="false";
        }
        Log::info($res);

        }
        }

    }   
    return $res;
}




}
