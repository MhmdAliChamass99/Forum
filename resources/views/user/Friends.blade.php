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
  @if(!$friends->count())
            <p style="color:white;">No Friends</p>
        @else
        @foreach($friends as $u)
            <form action="{{'/profile/'.$u->id}}" method="get">
            @csrf
        <button type="submit" class="btn btn-primary btn-xl text-uppercase js-scroll-trigger" style="width:100%;">{{$u->name}}</button>
        
        
    </form><br>
        @endforeach
        @endif
</div>
<div class="container">
    <h1>Friend Requests</h1>
   
    @if(!$requests->count())
        <p >No Friend requests</p>
    @else
    @foreach($requests as $user)
    @include('user/userblock');
    @endforeach
    @endif
</div>
@endsection
