
@extends('layouts.app')

@section('content')


	<div class="contact1">
		<div class="container-contact1">
			<div class="contact1-pic js-tilt" data-tilt>
				<img src="/Images/Post.png" alt="IMG">
			</div>

			<form action='/Posts/{{$posts->id}}' method="POST" class="contact1-form validate-form">
            @csrf
     {{ method_field('PUT') }} 
				<span class="contact1-form-title">
					Create Your Post
				</span>


				<div class="wrap-input1 validate-input" data-validate = "Message is required">
					<textarea class="input1" name="message" placeholder="Message" value="{{$posts->Status}}">{{$posts->Status}}</textarea>
					<span class="shadow-input1"></span>
				</div>
		
				<div class="container-contact1-form-btn">
					<button type="submit" class="contact1-form-btn">
						<span>
							Update Post
							<i class="fa fa-long-arrow-right" aria-hidden="true"></i>
						</span>
					</button>
				</div>
			</form>
		</div>
	</div>



@endsection
