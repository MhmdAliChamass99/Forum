@extends('layouts.app')

@section('content')
<script src="http://code.jquery.com/jquery-3.3.1.min.js"
               integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
               crossorigin="anonymous">
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">
<head>
<meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<style>
.container {
  padding: 2rem 0rem;
}

h4 {
  margin: 2rem 0rem 1rem;
}


}
</style>
<div class="container"><div class="row"><div class="col-12">
<input class="form-control col-12" type="text" placeholder="Search" aria-label="Search" id="searchbar"><br>
</div></div></div>
<?php
$z=0;
for($i=0;$i<sizeof($courses[0]);$i++){
echo '<div class="container">
<div class="row">
  <div class="col-12">';
echo '<table class="table table-bordered">';
echo '<tr ><th colspan=2 class="yey">'.$courses[0][$i].'</th></tr>';
$teach=explode('#',$courses[1][$i]);
$yes=0;
for($j=0;$j<sizeof($teach)-1;$j++)
{
    echo '<tr><td>'.$teach[$j].'</td>';
    $yes=0;
    for($k=0;$k<sizeof($coursesLiked);$k++)
    {
        if($coursesLiked[$k]->instructor==$teach[$j] && $coursesLiked[$k]->coursename==$courses[0][$i]){
        $yes=1;
        break;
        }
        else
        {
        $yes=0;
        }
    
    
    }
    if($yes==1)
    {
        echo '<td style="width:5%"><button type="button" id="classbtn" class="btn btn-success active" ><i class="fa fa-thumbs-up "></i></button><p></p></td></tr>';
    }
    if($yes==0)
    {
        echo '<td style="width:5%"><button type="button" id="classbtn" class="btn btn-primary" ><i class="fa fa-thumbs-up"></i></button><p></p></td></tr>';
          
    }
    
    
}
echo '</table>';
echo'</div></div></div>';
}
?>
<script>
  
  $(document).ready(function() {
    $("#searchbar").keyup(function(e) {
        var search=$(this).val();
        var names=$('.container').find('table');
        if (search.length > 0) {
        names.stop().hide(); 
        $(".container").find("table:contains(" + search + ")").stop().show();
    } else {
        names.stop().show();
    }   

    });


    
    $('.container').on('click', '#classbtn', function (e) { 
     e.preventDefault();
    var coursename=$(this).closest('table').find('th').eq($(this).index()).text();
    var teachername=  $(this).closest('tr').find('td').eq(0).text();
    var userid=<?php echo Auth::user()->id?>;
    if($(this).hasClass('active'))
    {
      $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
     
        $.ajax({
           type:'POST',
           url:"{{ route('removeLikes.post') }}",
           data:{coursename:coursename,teachername:teachername,userid:userid},
        });
        $(this).removeClass('btn btn-success active').addClass('btn btn-primary');
    }
    else
    {
      $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
        
        $.ajax({
           type:'POST',
           url:"{{ route('addToLikes.post') }}",
           data:{coursename:coursename,teachername:teachername,userid:userid},
        });
    
       
        
    $(this).removeClass('btn btn-primary').addClass('btn btn-success active');
    }
    });
  });
  </script>
@stop