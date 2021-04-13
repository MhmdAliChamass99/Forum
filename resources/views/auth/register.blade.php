@extends('layouts.loginandsignup')

@section('content')

<link href="{{asset('css/login.css')}}" rel="stylesheet" />

<section  style="background-color: black;height: 80%;">
            <div class="container">
                <div class="text-center">
                    <br><br><br>
                    <h1 class="section-heading text-uppercase" style="color: white;"><strong>Register</strong></h1> 
                    <br><br>
                </div>
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="form-row">
                            <div class="col-md-6">
                               
                                    <div class="form-group">
                                        <input class="form-control" id="FirstName" type="FirstName" name="FirstName" placeholder="FirstName"style="height:50px;" required="required" data-validation-required-message="Please enter your first name." />
                                        <p class="help-block text-danger"></p>
                                        @error('FirstName')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                            </div>
                            <div class="col-md-6">
                                
                                    <div class="form-group">
                                        <input class="form-control" id="LastName" type="LastName" name="LastName" placeholder="LastName"style="height:50px;" required="required" data-validation-required-message="Please enter your Last name." />
                                        <p class="help-block text-danger"></p>
                                        @error('LastName')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                        </div>    


                        <div class="col-md-12 mx-auto">
                        
                               
                                    <div class="form-group">
                                        <input class="form-control" id="name" type="name" name="name" placeholder="Username"style="height:50px;" required="required" data-validation-required-message="Please enter your Username." />
                                        <p class="help-block text-danger"></p>
                                        @error('name')
                                            <span class="invalid-feedback" role="alert" style="color: red;font-size:2rem;">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        
                                    </div>
                        </div>


                        <div class="form-group">
                            <div class="text-center">
                            <label class="form-check form-check-inline" style="color: white;font-size:2rem;">
                                Gender{{"   :"}}
                            </label>  
                            <label class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="gender" value="male" required>
                            <span class="section-heading" style="color: white;font-size:2rem;"> Male </span>
                            </label>
                            <label class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="gender" value="female">
                            <span class="form-check-label" style="color: white;font-size:2rem;"> Female</span>
                            </label>
                            <label class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="gender" value="other">
                            <span class="form-check-label" style="color: white;font-size:2rem;"> Other</span>
                            </label>
                            </div>
                        </div>
                        @error('gender')
                                <span class="invalid-feedback" role="alert" style="color: red;font-size:2rem;">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                        
                        <div class="col-md-12 mx-auto">
                        
                               
                        <div class="form-group">
                            <input class="form-control" id="email" type="email" name="email" placeholder="Email"style="height:50px;" required="required" data-validation-required-message="Please enter your Email." />
                            <p class="help-block text-danger"></p>
                            @error('email')
                                <span class="invalid-feedback" role="alert" style="color: red;font-size:2rem;">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                                </div>                   

                        <div class="col-md-12 mx-auto">
                        
                               
                        <div class="form-group">
                            <input class="form-control" id="password" type="password" name="password" placeholder="Password"style="height:50px;" required="required" data-validation-required-message="Please enter your password." />
                            <p class="help-block text-danger"></p>
                            @error('password')
                                <span class="invalid-feedback" role="alert" style="color: red;font-size:2rem;">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                                </div> 

                        <div class="col-md-12 mx-auto">
                        
                               
                        <div class="form-group">
                            <input class="form-control" id="password-confirm" type="password" name="password_confirmation" placeholder="Confirm Password"style="height:50px;"  data-validation-required-message="Please enter your password." />
                            <p class="help-block text-danger"></p>
                            @error('password')
                                <span class="invalid-feedback" role="alert" style="color: red;font-size:2rem;">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                                </div> 
                        <br>
                        <div class="text-center">
                                    <button class="btn btn-primary btn-xl text-uppercase js-scroll-trigger" type="submit" style="padding: 2.0rem 3.5rem; font-size: 2.125rem;font-weight: 700;">
                                        Register
                                    </button>
                                </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</section>
<footer class="footer py-4" style="height: 12%;background-color:white;">
            <div class="container">
                <div class="row align-items-center"><br><br>
                    <div class="text-center">©Antonine Forum</div>
                    <div class="col-lg-4 my-3 my-lg-0">
                        
                    </div>
                    <div class="col-lg-4 text-lg-right">
                        
                    </div>
                </div>
            </div>
        </footer>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Third party plugin JS-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
        <script src="{{asset('js/jqBootstrapValidation.js')}}"></script>
        <script src="{{asset('js/contact_me.js')}}"></script>
@endsection
