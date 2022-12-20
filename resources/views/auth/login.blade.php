<!DOCTYPE html>
<html lang="en">
<head>
    <title>Price Manager</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="{{asset('auth/images/icons/favicon.ico')}}"/>
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('auth/vendor/bootstrap/css/bootstrap.min.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('auth/fonts/font-awesome-4.7.0/css/font-awesome.min.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('auth/fonts/iconic/css/material-design-iconic-font.min.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('auth/vendor/animate/animate.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('auth/vendor/css-hamburgers/hamburgers.min.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('auth/vendor/animsition/css/animsition.min.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('auth/vendor/select2/select2.min.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('auth/vendor/daterangepicker/daterangepicker.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('auth/vendor/util.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('auth/vendor/main.css')}}">
    <!--===============================================================================================-->
</head>
<body>

<div class="limiter">
    <div class="container-login100" style="background-image: url('{{asset('auth/images/bg-01.jpg')}}');">
        <div class="wrap-login100-login">
            <form class="login100-form validate-form" method="POST" action="{{ route('login') }}">
                @csrf
                <a href="javascript:void(0)">
						<span class="login100-form-logo">
							<i class="fa fa-user"></i>
						</span>
                    </a>

                <span class="login100-form-title p-b-34 p-t-27">
						Login
					</span>

                <div class="wrap-input100">
                    <input class="input100" type="text" name="email" value="{{ old('email') }}" style="color: #FFF;" required placeholder="Enter Email or Phone" autocomplete="off">
                   <!-- <span class="focus-input100" data-placeholder=""></span> -->
                    @error('email')
                    <span class="focus-input100" data-placeholder="" style="position: inherit;color: #FFFFF0;"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>
                <div class="wrap-input100 validate-input" data-validate="Enter password">
                    <input class="input100" type="password" name="password" placeholder="Password" style="color: #FFF;"  autocomplete="off">
                    <!-- <span class="far fa-eye show-password-eyes show-password"></span> -->
                    @error('password')
                    <span class="focus-input100" data-placeholder="" style="position: inherit; color: #FFFFF0;"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>
                <div class="contact100-form-checkbox">
                    <input class="input-checkbox100" id="ckb1" type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label class="label-checkbox100" for="ckb1">
                        Remember me
                    </label>
                </div>

                <div class="container-login100-form-btn">
                    <button class="login100-form-btn">
                        Login
                    </button>
                </div>
                <div class="text-center" style="color:#fff; font-size: 12px; margin-top:20px;">
                    <a  href="{{url('password/reset')}}" style="color:#fff; font-size:16px;">
                        <span>Forgot password</span>
                    </a><br>
                    <span>If New?</span>
                    <a  href="{{route('register')}}" style="color:#fff; font-size:16px;">
                        Register
                    </a>

                </div>
            </form>
        </div>
    </div>
</div>


<div id="dropDownSelect1"></div>

<!--===============================================================================================-->
<script src="{{asset('auth/vendor/jquery/jquery-3.2.1.min.js')}}"></script>
<!--===============================================================================================-->
<script src="{{asset('auth/vendor/animsition/js/animsition.min.js')}}"></script>
<!--===============================================================================================-->
<script src="{{asset('auth/vendor/bootstrap/js/popper.js')}}"></script>
<script src="{{asset('auth/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
<!--===============================================================================================-->
<script src="{{asset('auth/vendor/select2/select2.min.js')}}"></script>
<!--===============================================================================================-->
<script src="{{asset('auth/vendor/daterangepicker/moment.min.js')}}"></script>
<script src="{{asset('auth/vendor/daterangepicker/daterangepicker.js')}}"></script>
<!--===============================================================================================-->
<script src="{{asset('auth/vendor/countdowntime/countdowntime.js')}}"></script>
<!--===============================================================================================-->
<script src="{{asset('auth/vendor/main.js')}}"></script>

</body>
</html>

{{--@if (Route::has('password.request'))--}}
    {{--<a class="btn btn-link" href="{{ route('password.request') }}">--}}
        {{--{{ __('Forgot Your Password?') }}--}}
    {{--</a>--}}
{{--@endif--}}
