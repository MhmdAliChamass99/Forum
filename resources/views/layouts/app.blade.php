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
    <link href="{{ asset('postcss/post.css') }}" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"  rel="stylesheet">
    


       <!-- Scripts -->
       <script
            src="https://code.jquery.com/jquery-3.5.1.js"
            integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="
            crossorigin="anonymous"></script>
       
       <script src="{{ asset('js/main.js') }}" ></script>
    
</head>
<body>
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">    
<div class="navbar navbar-inverse">
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
                                    <li><a href="{{('/groups/myGroups')}}">Joined Groups</a></li>
                                    <li><a href="{{('/groups/adminGroups')}}">Admin Groups</a></li>
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

        <script src="{{ asset('js/app.js') }}" defer></script>

        <div id="app">
            @yield('content')
        </div>
    </div>
</body>
</html>
