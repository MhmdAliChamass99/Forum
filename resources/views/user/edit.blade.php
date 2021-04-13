@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<div class="container">
    <div class="row justify-content-center">
        <div class="Register_Form col-md-8" style="margin-top:5%;">
            <div class="card">
                <div class="card-header "   style="text-align: center;">{{ __('user profile') }}</div>

                <div class="card-body">
	
	<div class="profile">	
        @if($user->thumbnail==null)
        @if($user->gender== 'male')<img src="{{ URL::asset('/Images/facebook-default-no-profile-pic.jpg') }}" class="pic">
        @else<img src="{{ URL::asset('/Images/facebook-default-no-profile-pic-girl.jpg') }}" class="pic">
        @endif
        @else <img src="{{ URL::asset('/Images/'.$user->thumbnail) }}" class="pic">
        @endif
	
        <div style="text-align: center;">
           
            
           
     <br>
     <form action="/update" method="post">
     @csrf
        <label for="uname"><b>Username</b></label>
            <input type="text" value="{{ $user->name }}" name="name" required><br>
            <label for="uname"><b>firstName</b></label>
            <input type="text" value="{{ $user->firstName }}" name="firstName" required>
            <br>
            <label for="uname"><b>Lastname</b></label>
            <input type="text" value="{{ $user->lastName }}" name="lastName" required>
            <br>
            
            <label for="gender">Gender:</label>
            <br><br>
            <input type="radio" id="male" name="gender" value="male" {{ ($user->gender == 'male') ? "checked" : "" }}>
            <label for="male">Male</label>
            <input type="radio" id="female" name="gender" value="female" {{ ($user->gender == 'female') ? "checked" : "" }}> 
            <label for="female">Female</label>
            <input type="radio" id="other" name="gender" value="other" {{ ($user->gender == 'other') ? "checked" : "" }}>
            <label for="other">Other</label>
            <br><br>


            <label for="email"><b>Email: {{ $user->email }}</b></label>
            
<br>

       
            <button type="submit">Save</button>
</form>
       

	</div>	</div>	</div>	</div>	</div>	</div>
       
           
          
@endsection
