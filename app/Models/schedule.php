<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class schedule extends Model
{
    use HasFactory;

function GetSortedArrayByCourse($names,$teachers)
{
    $schedule=new schedule;
    for ($i = 0;$i < sizeof($names);$i++)
{
    $SortedArrayByCourse = $schedule->where("coursename","LIKE","%".$names[$i]."%")->
    where("instructor","LIKE","%".$teachers[$i]."%")->get();
    
    
    for ($k = 0;$k <sizeof($SortedArrayByCourse) ;$k++)
    {   

 

        $array[$i][$k]=($SortedArrayByCourse[$k]->time)."#".($SortedArrayByCourse[$k]->coursename)."#".($SortedArrayByCourse[$k]->instructor)." Sectionid:".($SortedArrayByCourse[$k]->classid)."%%%".($SortedArrayByCourse[$k]->counter)."%%%";
    }
    
}
return $array;
}
    

    public function checkData($courseid)
    {
        $schedule=new schedule;
        $course=$schedule->where('classid','=',$courseid)->get()->count();
        return $course;
    }

    public function insertData($name,$courseid,$date1,$teacher)
    {
        $schedule=new schedule;
        $course=$this->checkData($courseid);
        if($course==0){
        $data=array('coursename'=>$name,"classid"=>$courseid,"time"=>$date1,"instructor"=>$teacher);
        $schedule->insert($data);
        }
    }

    public function getDistinctCourses(){
        $schedule=new schedule;
        $courses=$schedule->distinct()->get('coursename');
        return $courses;
    }

    public function getTeachers($course){
        $schedule=new schedule;
        $teachers=$schedule->where('coursename','LIKE','%'.$course.'%')->distinct()->get('instructor');
        return $teachers;
    }

    public function getCoursesForLikes()
    {
        $schedule=new schedule;
        $courses=$schedule->distinct()->get('coursename');
        $arr=array();
        $teach=array();
        $i=0;
        foreach($courses as $course)
        {
            $arr[$i]=$course->coursename;
            $teachers=$schedule->where('coursename','LIKE','%'.$course->coursename.'%')->distinct()->get('instructor');
            $k=0;
            $teachersz="";
            foreach ($teachers as $teacher)
            {
                
                $teachersz=$teachersz.$teacher->instructor."#";
                
            }
            $teach[$i]=$teachersz;
            $i++;
        }
        
        return [$arr, $teach];
        
        
    }

    public function incrementLikes($coursename,$instructor)
    {
        $schedule=new schedule;
        $schedule->timestamps = false;
        $schedule->where('coursename','LIKE','%'.$coursename.'%')->where('instructor','LIKE','%'.$instructor.'%')->increment('counter');
    }

    public function getCounter()
    {
        $schedule=new schedule;
        $counter=$schedule->groupBy('coursename','instructor')->get('counter');
        return $counter;

    }

    public function decrementLikes($coursename,$instructor)
    {
        $schedule=new schedule;
        $schedule->timestamps = false;
        $schedule->where('coursename','LIKE','%'.$coursename.'%')->where('instructor','LIKE','%'.$instructor.'%')->decrement('counter');
    }

    





}
