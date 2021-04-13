@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<div  class="col-2" id="mySidenav" style="height: 100%;
  width: 200px;
  position: fixed;
  z-index: 3;
  top: 5%;
  left: 0;
  background-color: #111;
  overflow-x: hidden;
  padding-top: 20px;">

  <h1 style="color:white;">Friends</h1>
  

  @if(!$user->friends()->count())
            <p>No Friends</p>
        @else
        @foreach($user->friends() as $u)
            <form action="{{'/profile/'.$u->id}}" method="get">
            @csrf
        <button type="submit" class="btn btn-primary btn-xl text-uppercase js-scroll-trigger" style="width:100%;">{{$u->name}}</button>
        
        
    </form><br>
        @endforeach
        @endif

</div>

<div class="container">

    <div class="row justify-content-center">
        <div class="Register_Form col-md-8" style="margin-top:5%;">
            <div class="card">
                <div class="card-header " style="text-align: center;">{{ __('user profile') }}</div>

                <div class="card-body">
                
	<div class="profile">
    @if(Auth::user()->hasFriendRequestPending($user))
    <p style="color:red;z-index:10;">waiting to accept your friend request</p> 
    @endif
        @if($user->thumbnail==null)
        @if($user->gender== 'male')<img src="{{ URL::asset('/Images/facebook-default-no-profile-pic.jpg') }}" class="pic">
        @elseif($user->gender== 'female')<img src="{{ URL::asset('/Images/facebook-default-no-profile-pic-girl.jpg') }}" class="pic">
        @else<img src="{{ URL::asset('/Images/Other.png') }}" class="pic">
        @endif
        @else <img src="{{ URL::asset('/Images/'.$user->thumbnail) }}" class="pic">
        @endif
		<form action='/upload'enctype="multipart/form-data" method="post" >
        @csrf
     
            <input type="file" name="image" id="fileToUpload" required>
            
            <button type="submit"> upload/change profile</button>
        </form>
        <div style="text-align: center;">
            <h3 class="name">{{$user->name}}{{" "}}<a href="{{ url('/editUser') }}" ><span class="glyphicon glyphicon-pencil"></span></a><form action="{{'/delete'}}" method="post">@csrf<button class="glyphicon glyphicon-trash" style="color:red"></button></a></h3>
            
            <br>
            <p class="titles">{{$user->firstName}}{{" "}}{{$user->lastName}}</p>
            <p class="titles">Email: {{$user->email}}</p>
            <p class="titles">Gender: {{$user->gender}}</p>
            @if($user->role ==2)
            <p class="titles"> Student at Antonine University</p>
            @elseif($user->role ==1)
            <p class="titles"> Teacher at Antonine University</p>
            @else
            <p class="titles"> Admin</p>
            @endif
            
            
        </div>
	</div>
	</div>	</div>	</div>	</div>	</div>	</div>

@endsection
