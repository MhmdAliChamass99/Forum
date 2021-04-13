@extends('layouts.app')

@section('content')



	<div class="contact1">
		<div class="container-contact1">
			<div class="contact1-pic js-tilt" data-tilt>
				<img src="/Images/Post.png" alt="IMG">
			</div>

			<form action="/Posts" method="POST" class="contact1-form validate-form">
			@csrf
			<input type="hidden"  name ="group_id" value="{{$id}}">
				<span class="contact1-form-title">
					Create Your Post
				</span>


				<div class="wrap-input1 validate-input" data-validate = "Message is required">
					<textarea class="input1" name="message" placeholder="Message"></textarea>
					<span class="shadow-input1"></span>
				</div>
		
				<div class="container-contact1-form-btn">
					<button type="submit" class="contact1-form-btn">
						<span>
							Create Post
							<i class="fa fa-long-arrow-right" aria-hidden="true"></i>
						</span>
					</button>
				</div>
			</form>
		</div>
	</div>

	@endsection
