@extends('layouts.loginandsignup')

@section('content')
<link href="{{asset('css/login.css')}}" rel="stylesheet" />

<section  style="background-color: black;height: 80%;">
            <div class="container">
                <div class="text-center">
                    <br><br><br>
                    <h1 class="section-heading text-uppercase" style="color: white;"><strong>Log in</strong></h1> 
                    <br><br>
                </div>
                <form method="POST" class="login100-form validate-form p-b-33 p-t-5" action="{{ route('login') }}">
                        @csrf
                    <div class="row align-items-stretch mb-5">
                        <div class="col-md-12">
                            <div class="form-group">
                                <input class="form-control" id="email" type="email" name="email" placeholder="Email"style="height:50px;" required="required" data-validation-required-message="Please enter your email address." />
                                <p class="help-block text-danger"></p>
                            </div>
                            <br>
                            <div class="form-group">
                                <input class="form-control" id="password" type="password" name="password" placeholder="Password"style="height:50px;" required="required" data-validation-required-message="Please enter your password" />
                                <p class="help-block text-danger"></p>
                            </div>
                           
                        </div>
                        
                    </div>
                    </div>
                    
                              
                                <div class="text-center">
                                    <a class="btn btn-link"style="font-size:1.5rem;" href="{{ route('register') }}">
                                        New user? click here to register
                                        @if (Route::has('password.request'))
                                        <a class="btn btn-link"style="font-size:1.5rem;" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                    @endif
                                    </a>
                                </div>
                                <br>
                            
                    <div class="text-center">
                        <div id="success"></div>
                        <button class="btn btn-primary btn-xl text-uppercase js-scroll-trigger" id="sendMessageButton" type="submit" style="padding: 2.0rem 3.5rem; font-size: 2.125rem;font-weight: 700;">Log in</button>
                    </div>
                   
                </form>
            </div>
        </section>
        <!-- Footer-->
        <footer class="footer py-4" style="height: 12%;background-color:white;">
            <div class="container">
                <div class="row align-items-center">
                    <br><br>
                    <div class="text-center">©Antonine Forum</div>
                    <div class="col-lg-4 my-3 my-lg-0">
                        
                    </div>
                    <div class="col-lg-4 text-lg-right">
                        
                    </div>
                </div>
            </div>
        </footer>
        
        <!-- Bootstrap core JS-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Third party plugin JS-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
        <!-- Contact form JS-->
        <script src="assets/mail/jqBootstrapValidation.js"></script>
        <script src="assets/mail/contact_me.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
        @endsection