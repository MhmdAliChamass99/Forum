@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<div class="container">

    <div class="row justify-content-center">
        <div class="Register_Form col-md-8" style="margin-top:5%;">
            <div class="card">
                <div class="card-header " style="text-align: center;">{{ __('user profile') }}</div>

                <div class="card-body">
	
	<div class="profile">
        @if($user->thumbnail==null)
        @if($user->gender== 'male')<img src="{{ URL::asset('/Images/facebook-default-no-profile-pic.jpg') }}" class="pic">
        @elseif($user->gender== 'female')<img src="{{ URL::asset('/Images/facebook-default-no-profile-pic-girl.jpg') }}" class="pic">
        @else<img src="{{ URL::asset('/Images/Other.png') }}" class="pic">
        @endif
        @else <img src="{{ URL::asset('/Images/'.$user->thumbnail) }}" class="pic">
        @endif
		
        <div style="text-align: center;">
            <h3 class="name">{{$user->name}}{{" "}}</h3>
            
            <br>
            <p class="titles">{{$user->firstName}}{{" "}}{{$user->lastName}}</p>
            <p class="titles">Email: {{$user->email}}</p>
            <p class="titles">Gender: {{$user->gender}}</p>
            @if($user->role ==2)
            <p class="titles"> Student at Antonine University</p>
            @elseif($user->role ==1)
            <p class="titles"> Teacher at Antonine University</p>
            @else
            <p class="titles"> Admin/p>
            @endif

            @if(Auth::user()->id!=$user->id)
            @if(Auth::user()->hasFriendRequestPending($user))
            <p style="color:red;z-index:10;">waiting to accept your friend request</p> 
            @elseif (Auth::user()->hasFriendRequestRecieved($user))
            <form action="{{'/accept/'.$user->id}}">
                <button>Accept friend request</button> 
            </form>
            <form action="{{'/decline/'.$user->id}}">
                <button>decline friend request</button> 
            </form>
            @elseif (Auth::user()->isFriendWith($user))
            <p>You are friends</p>
            <form action="{{'/unfriend/'.$user->id}}" >
            <button style="background-color:red;" type="submit"> Unfriend</button>
            </form>
            @else       
            <form action="{{'/add/'.$user->id}}">
                <button>Add as Friend</button> 
            </form>
            @endif
            @else
            <p>this is your profile</p>
            @endif
        </div>
	</div>
	</div>	</div>	</div>	</div>	</div>	</div>

@endsection
