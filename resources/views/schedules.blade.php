<?php
for($i=0;$i<sizeof($courses);$i++)
{
    $courseok[$i]=$courses[$i]->coursename;
}
$i=0;
?>
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <style>
 
    body,html{
        height:100%;
    }
     .bg
         {
         /* background-image: url('Images/background-image.jpg');  */
        background-color:#004DFF;
        height: 100vh;
        width: 100vw;
        top: 0;
        left: 0;
        bottom: 0;
        right: 0;
        z-index:-10;
        background-repeat: no-repeat;
        position: absolute;
        background-position:center;
        background-size:cover;
          
         }
         
.pic
{
    width: 124px;
			height: 124px;
			display: flex;
			margin-left: auto;
			margin-right: auto;
			margin-bottom: 1.5em;
			border-radius: 100%;
			box-shadow: $shadow;
}

		.name {
			color: #2D354A;
			font-size: 2em;
			font-weight: 300;
			text-align: center;
		}
		
		.titles {
			color: #7C8097;
			font-size: 1em;
			font-weight: 300;
			text-align: center;
			padding-top: .5em;
			padding-bottom: .7em;
			letter-spacing: 1.5px;
			/* text-transform: uppercase; */
		}
		
		.description {
			color: #080911;
			font-size: 14px;
			font-weight: 300;
			text-align: center;
			margin-bottom: 1.3em;
		}
	
  */

#login-dp{
    min-width: 250px;
    padding: 14px 14px 0;
    overflow:hidden;
    background-color:rgba(255,255,255,.8);
}
#login-dp .help-block{
    font-size:12px    
}
#login-dp .bottom{
    background-color:rgba(255,255,255,.8);
    border-top:1px solid #ddd;
    clear:both;
    padding:14px;
}
#login-dp .social-buttons{
    margin:12px 0    
}
#login-dp .social-buttons a{
    width: 49%;
}
#login-dp .form-group {
    margin-bottom: 10px;
}
.btn-fb{
    color: #fff;
    background-color:#3b5998;
}
.btn-fb:hover{
    color: #fff;
    background-color:#496ebc 
}
.btn-tw{
    color: #fff;
    background-color:#55acee;
}
.btn-tw:hover{
    color: #fff;
    background-color:#59b5fa;
}
@media(max-width:768px){
    #login-dp{
        background-color: inherit;
        color: #fff;
    }
    #login-dp .bottom{
        background-color: inherit;
        border-top:0 none;
    }
    
}

    </style>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Home') }}</title>

     <!-- Fonts -->
    <!-- <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet"> -->

    <!-- Styles -->
    <link href="{{ asset('css/app2.css') }}" rel="stylesheet">
    


       <!-- Scripts -->
       <script
            src="https://code.jquery.com/jquery-3.5.1.js"
            integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="
            crossorigin="anonymous"></script>
       
       <script src="{{ asset('js/main.js') }}" ></script>
       
</head>
<body>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">    
<div class="navbar navbar-inverse" >
        <div class="container-fluid">
          
                <div style="width:100%;">

                    <div class="navbar-header">
                        <button class="navbar-toggle" data-target="#mobile_menu" data-toggle="collapse"><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
                        <a href="{{ url('/home') }}" class="navbar-brand">UA</a>
                    </div>

                    <div class="navbar-collapse collapse" id="mobile_menu">
                        <ul class="nav navbar-nav">
                            <li ><a href="{{ url('/home') }}">Home</a></li>   
                            @guest
                            @if (Route::has('login'))
                                
                            @endif
                            
                            @if (Route::has('register'))
                               
                            @endif
                        @else
                            <li><a href="#" class="dropdown-toggle" data-toggle="dropdown">Groups<span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="{{('/group/create')}}">Create Group</a></li>
                                    <li><a href="{{'/group'}}">All Groups</a></li>
                                    <li><a href="{{('/groups/myGroups')}}">My Groups</a></li>
                                    <li><a href="{{'/PendingRequest'}}">Pending Requests</a></li>
                                </ul>
                            </li>
                            @if(!Auth::user()->friendRequests()->count())
                            <li><a href="{{route('user.Friends')}}">Friends</a></li>
                            @else
                            <li><a href="{{route('user.Friends')}}" style="color:red;">Friends({{Auth::user()->friendRequests()->count()}})</a></li>                           
                            @endif
                            <li><a href="/chat">Live Chat</a></li>
                            <li><a href="/userLike">Courses</a></li>
                            <li><a href="/schedules">Schedule</a></li>
                            @if(Auth::user()->role==1)    
                           <li><a href="/adminUploadFile">Insert Courses</a></li>
                           @endif  
                        </ul>
                        <ul class="nav navbar-nav">
                            <li>
                                <form action="{{route('search.results')}}" class="navbar-form">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <input type="search" name="query" placeholder="Search Anything Here..." class="form-control">
                                            <span class="input-group-addon"><button class="glyphicon glyphicon-search" type="submit"></button></span>
                                        </div>
                                    </div>
                                </form>
                            </li>
                        </ul>
                        @endguest
                        <ul class="nav navbar-nav navbar-right" >

                            <!-- <li><a href="#"><span class="glyphicon glyphicon-user"></span> Profile</a></li>
                            <li><a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-log-in"></span> Login / Sign Up <span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="#">Login</a></li>
                                    <li><a href="#">Sign Up</a></li> -->
                                    @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif
                            
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                        <li class="nav-item">
                                    <a class="nav-link" href="{{ url('/profile') }}">Profile</a>
                                </li>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                    
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                                </ul>
                            </li>
                        </ul>
                    </div>
                
            </div>
        </div>
    </div>
    </div>
    </div>
<head>
  <meta charset="utf-8">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.js"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.css" rel="stylesheet"/>



<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<meta charset="UTF-8">
 
 
<style>
.mySlides {display:none;}
</style>
  
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.4/jspdf.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.13/jspdf.plugin.autotable.min.js"></script>

<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
  
$(document).ready(function() {
    var max_fields      = 10; //maximum input boxes allowed
    var wrapper         = $(".input_fields_wrap"); //Fields wrapper
    var add_button      = $(".add_field_button"); //Add button ID
    
    var x = 1; //initlal text box count
    var availableAttributes = <?php echo json_encode($courseok);?>;

    
    
    
    $(add_button).click(function(e){ //on add input button click
        e.preventDefault();
        if(x < max_fields){ //max input box allowed
            x++; //text box increment
            $(wrapper).append('<div><input required type="text" name="mytext[]" class="mytext"/><button class="add_teacher" type="button">Select Teacher</button><button class="remove_field" type="button">Remove</button><select name="teachers[]" class="teachers" style="display:none"><option value="">None</option></select></div>'); 
            
            $(wrapper).find('input[type=text]:last').autocomplete({
                source: availableAttributes
                
            });	
            //add input box
        }
    });
    
    $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
        e.preventDefault(); $(this).parent('div').remove(); x--;
    })
    
    $("input[name^='mytext']").autocomplete({
		source: availableAttributes
    
	});

    $(".dropbtn2").click(function(){
        if ($(".dropdown2").is(':visible')) {
      $(".dropdown2").hide(1000);
    } else {
      $(".dropdown2").show(1000);
    }
    
  });

  $(".checkbox-menu").on("change", "input[type='checkbox']", function() {
   $(this).closest("li").toggleClass("active", this.checked);
});

$(document).on('click', '.allow-focus', function (e) {
  e.stopPropagation();
});


$('form').submit(function(e) {
  $('.mytext').each(function() {
           var course =  $(this).val();
           if($.inArray(course,availableAttributes)==-1)
           {
           
             alert('Please choose correct class name')
            e.preventDefault();
           }
           
         });
});

$(wrapper).on("click",".add_teacher", function(e){
  var ok='';
        var course=$(this).parent("div").children('.mytext').val();
        var n=this;
        $(n).parent("div").children('.teachers').remove();
        if($.inArray(course,availableAttributes)==-1)
           {
           
             alert('Please choose correct class name')
            
           }
           else
           {

           $.get('getTeacher/','val='+course,function(data)
           {
             var teachers=data;
            
             
             for(var i=0;i<teachers.length;i++)
             
             ok=ok+'<option value="'+teachers[i].instructor+'">'+teachers[i].instructor+'</option>'
            // $(wrapper).children('div').children('.add_teacher').replaceWith('<select name="teachers[]" class="teachers"><option value="">None</option>'+ok); 
            $(n).replaceWith('<select name="teachers[]" class="teachers" id="teachers"><option value="">None</option>'+ok); 
            $(n).parent("div").children('.mytext').attr('readonly', 'readonly');
           });
           
           }
           
        
           });
        
           $("table").on("click", "#prints", function () {
            
             var source=$(this).closest('table')[0];
             
$( ".lastrow").hide();
$( ".lastrow2").hide();
const doc = new jsPDF('p','pt','a4');

doc.text(50, 50, "Your Schedule");
doc.text(50,100, "Email: "+"<?php echo Auth::user()->email ?>");

doc.autoTable({ html: source,
  useCss: true,startY: 110,
});
$(".lastrow").show();
$(".lastrow2").show();

        doc.save('schedule.pdf');
 
        });

       
  
  
  
    
});
</script>
</head>
<style>
body {font-family: Arial, Helvetica, sans-serif;}
* {box-sizing: border-box;}

input[type=text], select, textarea {
  width: 70%;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
  margin-top: 6px;
  margin-bottom: 16px;
  resize: vertical;
}

.add_field_button, .add_teacher, .dropbtn2, .btn, .submitt ,.remove_field,.SendEvents,#prints,.ChosePref{
  background-color: #4CAF50;
  color: white;
  padding: 12px 20px;
  border: none;
  margin-bottom:10px; 
  margin-left:5px;
  border-radius: 4px;
  cursor: pointer;
}




.submitt:hover {
  background-color: #45a049;
  
}

.container {
  border-radius: 5px;
  background-color: #f2f2f2;
  padding: 20px;
  
    width: 70%;
    margin: 0 auto;


}

.submitt{
  
  position:relative;

}



.checkbox-menu li label {
    display: block;
    padding: 3px 10px;
    clear: both;
    font-weight: normal;
    line-height: 1.42857143;
    color: #333;
    white-space: nowrap;
    margin:0;
    transition: background-color .4s ease;
}
.checkbox-menu li input {
    margin: 0px 5px;
    top: 2px;
    position: relative;
}

.checkbox-menu li.active label {
    background-color: #cbcbff;
    font-weight:bold;
}

.checkbox-menu li label:hover,
.checkbox-menu li label:focus {
    background-color: #f5f5f5;
}

.checkbox-menu li.active label:hover,
.checkbox-menu li.active label:focus {
    background-color: #b8b8ff;
}


input[type=checkbox] {
         position: relative;
	       cursor: pointer;
    }
    input[type=checkbox]:before {
         content: "";
         display: block;
         position: absolute;
         width: 15px;
         height: 15px;
         top: 0;
         left: 0;
         background-color:#e9e9e9;
}
input[type=checkbox]:checked:before {
         content: "";
         display: block;
         position: absolute;
         width: 15px;
         height: 15px;
         top: 0;
         left: 0;
         background-color:#1E80EF;
}
    input[type=checkbox]:checked:after {
         content: "";
         display: block;
         width: 5px;
         height: 10px;
         border: solid white;
         border-width: 0 2px 2px 0;
         -webkit-transform: rotate(45deg);
         -ms-transform: rotate(45deg);
         transform: rotate(45deg);
         position: absolute;
         top: 1px;
         left: 5px;
}

.teachers{
  width: 15%;
  margin-left:5px;
}

.dropdown-ctnr{
  position: relative;
}




/*CSS FOR THE TABLE AND CAROUSEL*/




@import url(https://fonts.googleapis.com/css?family=Open+Sans:300,400);

.darkblue {
  background: #719EB8;

}
.blue {
  background: #3498db;

}
.whitepink {
  background: #FB9393;
}


.darkgreen {
  background: #425b5e;
}
.darkred {
  background: #900036;
}
.color1 {
  background: #D8BFCC;
}
.color2 {
  background: #859de4;
}
.color3 {
  background: #564a6f;
}
.color4 {
  background: #403737;
}
.color5 {
  background: #43301d;
}
.purple {
  background: #9b59b6;
}

.navy {
  background: #34495e;
}

.green {
  background: #2ecc71;
}

.red {
  background: #e74c3c;
}

.orange {
  background: #f39c12;
}

.cs335, .cs426, .md303, .md352, .md313, .cs240 {
  font-weight: 300;
  cursor: pointer;
}

body {
  background: white;
  padding: 20px;
}

*, *:before, *:after {
  margin: 0;
  padding: 0;
  border: 0;
  outline: 0;
  -moz-box-sizing: border-box;
  -webkit-box-sizing: border-box;
  box-sizing: border-box;
}

table {
  font-family: 'Open Sans', Helvetica;
  color: #efefef;
}
table tr:nth-child(2n) {
  background: #eff0f1;
}
table tr:nth-child(2n+3) {
  background: #fff;
}
table th, table td {
  padding: 1em;
  width: 10em;
}

.days, .time {
  background: #34495e;
  text-transform: uppercase;
  font-size: 0.6em;
  text-align: center;
}

.time {
  width: 3em !important;
}

/* Add this attribute to the element that needs a tooltip */
[data-tooltip] {
  position: relative;
  z-index: 2;
  cursor: pointer;
}

/* Hide the tooltip content by default */
[data-tooltip]:before,
[data-tooltip]:after {
  visibility: hidden;
  filter: progid:DXImageTransform.Microsoft.Alpha(Opacity=0);
  opacity: 0;
  pointer-events: none;
  -moz-transition: ease 0.5s all;
  -o-transition: ease 0.5s all;
  -webkit-transition: ease 0.5s all;
  transition: ease 0.5s all;
}

/* Position tooltip above the element */
[data-tooltip]:before {
  position: absolute;
  bottom: 110%;
  left: 50%;
  margin-bottom: 5px;
  margin-left: -80px;
  padding: 7px;
  width: 160px;
  -moz-border-radius: 6px;
  -webkit-border-radius: 6px;
  border-radius: 6px;
  background-color: black;
  color: #fff;
  content: attr(data-tooltip);
  text-align: center;
  font-size: 14px;
  line-height: 1.2;
}

/* Triangle hack to make tooltip look like a speech bubble */
[data-tooltip]:after {
  position: absolute;
  bottom: 110%;
  left: 50%;
  margin-left: -5px;
  width: 0;
  border-top: 5px solid black;
  border-right: 5px solid transparent;
  border-left: 5px solid transparent;
  content: " ";
  font-size: 0;
  line-height: 0;
}

/* Show tooltip content on hover */
[data-tooltip]:hover:before,
[data-tooltip]:hover:after {
  visibility: visible;
  bottom: 90%;
  filter: progid:DXImageTransform.Microsoft.Alpha(enabled=false);
  opacity: 1;
}





.navbar{
  right:2%;
  top:-20px;
      width:105%;
    }

</style>

<body>
<div class="container">
<form method="POST" action="/schedules">
@csrf
<table>
<div class="input_fields_wrap">
    <button class="add_field_button" type="button">Add Class</button>
    <div><input required type="text" name="mytext[]" class="mytext"/><button class="add_teacher" type="button" name=teachers[] value="">Select Teacher</button><button class="remove_field" type="button">Remove</button><select name="teachers[]" class="teachers" style="display:none"><option value="">None</option></select></div>
</div>
<div>
<button type="button" class="dropbtn2">Advanced Options</button>
</div>
<div class="dropdown2" style="display:none;">
<label>Choose Preferred Days Off:</label>

<label class="checkbox-inline no_indent"><input type="Checkbox" name="day[]" value=0 >Mo</label>
<label class="checkbox-inline no_indent"><input type="Checkbox" name="day[]" value=1 >Tu</label>
<label class="checkbox-inline no_indent"><input type="Checkbox" name="day[]" value=2 >We</label>
<label class="checkbox-inline no_indent"><input type="Checkbox" name="day[]" value=3 >Th</label>
<label class="checkbox-inline no_indent"><input type="Checkbox" name="day[]" value=4 >Fr</label>
<label class="checkbox-inline no_indent"><input type="Checkbox" name="day[]" value=5 >Sa</label>
</br>
<div class="dropdown-ctnr">
<button class="btn btn-default dropdown-toggle" type="button" 
          id="dropdownMenu12" data-toggle="dropdown" 
          aria-haspopup="true" aria-expanded="true">
    Select Preferred Time:
    <span class="caret"></span>
  </button>
  <ul class="dropdown-menu checkbox-menu allow-focus" aria-labelledby="dropdownMenu12">
  
    <li >
      <label>
        <input type="checkbox" name="time[]" value=0>8:30 - 9:45
      </label>
    </li>
    
    <li >
      <label>
        <input type="checkbox" name="time[]" value=1>10:00 - 11:15
      </label>
    </li>
    
    <li >
      <label>
        <input type="checkbox" name="time[]"value=2>11:30 - 12:45
      </label>
    </li>

    <li >
      <label>
        <input type="checkbox" name="time[]" value=3>1:00 - 2:15
      </label>
    </li>

    <li >
      <label>
        <input type="checkbox" name="time[]" value=4>3:30 - 4:45
      </label>
    </li>

    <li >
      <label>
        <input type="checkbox" name="time[]" value=5>5:00 - 6:15
      </label>
    </li>

    <li >
      <label>
        <input type="checkbox" name="time[]" value=6>6:30 - 7:45
      </label>
    </li>
    
  </ul>

  
</div>
</div>



<tr>
                    <td>
                            <button type="submit" class="submitt">Submit</button>
                            
                    </td>
                </tr>

                </table>
</form>
</div>
</br></br>
<?php
$allschedules=array();
 if (isset($allschedule)) {
$allschedules=$allschedule;

if(sizeof($allschedule)==0)
{
  echo '<img src="/Images/2459468.png" style="  display: block;
  margin-left: auto;
  margin-right: auto;
  width: 50%;" alt="Close modal" />';
}
else{

$colors=array("cs335 blue","cs426 purple","md352 green","cs240 orange","md303 navy","md313 red","md352 darkblue","cs335 darkgreen","cs335 whitepink",
"cs335 darkred","cs335 color2","cs335 color3","cs335 color4","cs335 color5");
echo "<div class='tab w3-content w3-display-container'>
</br>
<button class='ChosePref'  onclick='slidein()'>Go To Most Prefered Schedule</button>

";
$coo=0;
foreach($allschedule as $sched)
{
  $newAr=array();
  foreach($sched as $sc)
  {
      foreach($sc as $el)
      {
        $newA= preg_replace('/([A-Z][a-z]\s[0-9]+[:][0-9]+[AMPM]{2,}\s[-]\s[0-9]+[:][0-9]+[APM]{2,})/', "", $el);

        if(in_array($newA,$newAr)==False && $newA!="0")
          array_push($newAr,$newA);
         
      }

  }
  

  echo" 
  </br>
    <table border='0' class='mySlides' cellpadding='0' cellspacing='0'  style='width:100%'>
      <tr class='days'>
        <th></th>
        <th>Monday</th>
        <th>Tuesday</th>
        <th>Wednesday</th>
        <th>Thursday</th>
        <th>Friday</th>
      </tr>
  
      "     ;
        
 
      $co=0;
    
     foreach($sched as $sc)
     {
         if($co==0)
         {
            echo "<tr>";
            echo "<td class='time'>8:30 -9:45</td>";
         }
         if($co==1)
         {
            echo "<tr>";
            echo "<td class='time'>10:00-11:15</td>";
         }
         if($co==2)
         {
            echo "<tr>";
            echo "<td class='time'>11:30-12:45</td>";
         }
         if($co==3)
         {
            echo "<tr>";
            echo "<td class='time'>1:00-2:15</td>";
         }
         if($co==4)
         {
            echo "<tr>";
            echo "<td class='time'>3.30-4:45</td>";
         }
         if($co==5)
         {
            echo "<tr>";
            echo "<td class='time'>5.00-6:15</td>";
         }

         if($co==6)
         {
     

            echo "<tr>";
            echo "<td class='time'>6.30-7:45</td>";
         }



         $key=0;
         foreach($sc as $s)
         {
          $nn= preg_replace('/([A-Z][a-z]\s[0-9]+[:][0-9]+[AMPM]{2,}\s[-]\s[0-9]+[:][0-9]+[APM]{2,})/', "", $s);

            $key=array_search($nn,$newAr);
            preg_match("/(?<=#).*?(?=#)/", $s, $nameOfCourse);

           
            if($s!="0")
            {
              $k=str_replace("#".$nameOfCourse[0]."#","",$s);
              $k=str_replace("#", "", $k);
           
           $patt = "/(?<=%%%)(.*)(?=%%%)/";
            preg_match($patt, $k,$counter);
            $k=str_replace("%%%".$counter[0]."%%%", "\nLikes:".$counter[0]."\n", $k);
             echo "<td class='".$colors[$key]."' data-tooltip='".$k."'>".$nameOfCourse[0]."</td>";
            }
             else 
            echo "<td></td>";
         }
 
        echo "</tr>";
         $co++;
            }
          
              
        $coo++;
        echo" <tr class='lastrow'>
        <td class='time'>Save Options</td>
        <td></td>
        <td><button  type='button' id='prints'>Save AS PDF</button></td>
        <td></td>
        <td><button class='SendEvents'  id='$coo' >Send As Events</button></td>
        <td></td>
        <tr class='lastrow2'>
        <td ></td>
        <td></td>
        <td></td>
        <td><h3 style='color:red'>".$coo."/".sizeof($allschedule)."</h3></td>
        <td></td>
        <td></td>
       
      </tr>";
    }

  
    echo "   <button style='left:-5%' id='next' class='w3-button w3-black w3-display-left' onclick='plusDivs(-1)'>&#10094;</button>
    <button style='right:4%' class='w3-button w3-black w3-display-right' onclick='plusDivs(1)'>&#10095;</button>
    </table>
    </div></br></br></br></br>
   
    
    "
    
    ;

  
  }
}
?>

 
<script>


var Likesdindex=0;
var slideIndex = 1;
showDivs(slideIndex);

function plusDivs(n) {

  
  showDivs(slideIndex += n);

}
function slidein()
{
  
<?php

if(!isset($likeIndex))
{
  $likeIndex=null;
}
$js_array = json_encode($likeIndex);
echo "var javascript_array = ". $js_array . ";\n";
?>
if(Likesdindex==javascript_array.length)
Likesdindex=0;

var vv=javascript_array[Likesdindex]+1-slideIndex;
plusDivs(vv);
Likesdindex++;


}
function showDivs(n) {

  var i;
  var x = document.getElementsByClassName("mySlides");
  if (n > x.length) {slideIndex = 1}
  if (n < 1) {slideIndex = x.length}
  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none";  
  }
  x[slideIndex-1].style.display = "block";  
}
</script>

<script type="text/javascript">
   
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
   
    $(".SendEvents").click(function(e){
    //  $(".alert-warning").show();
        e.preventDefault();
        var ids = $(this).attr("id"); 
        var schedpost='<?php echo json_encode($allschedules) ?>';
        $.ajax({
           type:'POST',
           url:"{{ route('ajaxRequest.post') }}",
           data:{ids:ids,schedpost:schedpost},
           success:function(data){
        //    $(".alert-warning").hide();
         //   $(".alert-success").show();
             alert(data.success);
           }
        });
  
    });
</script>
   
 
</body>
</html>

