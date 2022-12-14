<!DOCTYPE html>
<html lang="en">

<head>
    <title>Price Manager</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="{{ asset('auth/images/icons/favicon.ico') }}" />
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('auth/vendor/bootstrap/css/bootstrap.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('auth/fonts/font-awesome-4.7.0/css/font-awesome.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css"
        href="{{ asset('auth/fonts/iconic/css/material-design-iconic-font.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('auth/vendor/animate/animate.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('auth/vendor/css-hamburgers/hamburgers.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('auth/vendor/animsition/css/animsition.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('auth/vendor/select2/select2.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('auth/vendor/daterangepicker/daterangepicker.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('auth/vendor/util.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('auth/vendor/main.css') }}">
    <!--===============================================================================================-->
    <style>
        .invalid-feedback {
            display: block;
        }
    </style>
</head>

<body>

    <div class="limiter">
        <div class="container-login100" style="background-image: url('{{ asset('auth/images/bg-01.jpg') }}');">
            <div>
                <div class="wrap-login100">
                    <form class="login100-form validate-form" method="POST" action="{{ route('register') }}">
                        @csrf
                        <a href="javascript:void(0)">
                            <span class="login100-form-logo">
                                <i class="fa fa-user"></i>
                            </span>
                        </a>

                        <span class="login100-form-title p-b-34 p-t-27">
                            Register
                        </span>
                        <!-- @if ($errors->any())
                        @foreach ($errors->all() as $error)
<strong class="text-danger">{{ $error }}</strong><br>
@endforeach
                    @endif -->
                        <div class="row">

                            <div class="col-lg-12">
                                <div class="wrap-input100 validate-input" data-validate="Enter username">
                                    <input class="input100" type="text" name="name" placeholder="Username"
                                        value="{{ old('name') }}" autocomplete="off">
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="wrap-input100 validate-input" data-validate="Enter Email">
                                    <input class="input100" type="email" name="email" placeholder="Email"
                                        value="{{ old('email') }}" autocomplete="off">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="wrap-input100 validate-input" data-validate="Enter Phone No">
                                    <input class="input100" type="number" name="phone" placeholder="Phone No"
                                        value="{{ old('phone') }}" autocomplete="off">
                                    @error('phone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="wrap-input100 validate-input" data-validate="Enter password">
                                    <select class="input100" name="type">
                                        <option disabled selected>--Select User Type--</option>
                                        @foreach ($userTypes as $userType)
                                            <option value="{{ $userType->id }}"
                                                {{ old('type') == $userType->id ? 'selected' : '' }}>
                                                {{ $userType->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('type')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="wrap-input100 validate-input" data-validate="Enter password">
                                    <input class="input100" type="password" name="password" placeholder="Password"
                                        autocomplete="off" id="password">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="wrap-input100 validate-input" data-validate="Enter Confirm password">
                                    <input class="input100" type="password" name="password_confirmation"
                                        placeholder="Confirm Password" id="password-confirm">
                                </div>
                            </div>
                        </div>
                        {{-- <div class="contact100-form-checkbox" style="padding-bottom:20px;">
                        <input class="input-checkbox101" type="checkbox">
                        <label class="label-checkbox101">
                            Show Password
                        </label>
                    </div> --}}
                        <div class="contact100-form-checkbox">
                            <input class="input-checkbox100" id="ckb1" type="checkbox"
                                onclick="ShowPassword()">
                            <label class="label-checkbox100" for="ckb1">
                                Show Password
                            </label>
                        </div>
                        <p style="text-align:center; color:#fff;">By clicking Register, you agree to our <a
                                href="{{ url('fterm') }}" style="color: #df7644;">Terms and Condition.</a></p><br>
                        <div class="container-login100-form-btn">
                            <button class="login100-form-btn">
                                Register
                            </button>
                        </div>

                        <div class="text-center" style="color:#fff; font-size: 12px; margin-top:20px;">
                            <span>Already Register?</span>
                            <a href="{{ route('login') }}" style="color:#fff; font-size:16px;">
                                login
                            </a>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <div id="dropDownSelect1"></div>

    <!--===============================================================================================-->
    <script src="{{ asset('auth/vendor/jquery/jquery-3.2.1.min.js') }}"></script>
    <!--===============================================================================================-->
    <script src="{{ asset('auth/vendor/animsition/js/animsition.min.js') }}"></script>
    <!--===============================================================================================-->
    <script src="{{ asset('auth/vendor/bootstrap/js/popper.js') }}"></script>
    <script src="{{ asset('auth/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
    <!--===============================================================================================-->
    <script src="{{ asset('auth/vendor/select2/select2.min.js') }}"></script>
    <!--===============================================================================================-->
    <script src="{{ asset('auth/vendor/daterangepicker/moment.min.js') }}"></script>
    <script src="{{ asset('auth/vendor/daterangepicker/daterangepicker.js') }}"></script>
    <!--===============================================================================================-->
    <script src="{{ asset('auth/vendor/countdowntime/countdowntime.js') }}"></script>
    <!--===============================================================================================-->
    <script src="{{ asset('auth/vendor/main.js') }}"></script>
    <script>
        function ShowPassword() {
            var password = document.getElementById("password");
            var confirm = document.getElementById("password-confirm");
            if (password.type === "password") {
                password.type = "text";
                confirm.type = "text";
            } else {
                password.type = "password";
                confirm.type = "password";
            }
        }
    </script>
</body>

</html>
