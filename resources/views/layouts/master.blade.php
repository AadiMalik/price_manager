<!DOCTYPE html>
<html>


<!-- Mirrored from gurayyarar.github.io/AdminBSBMaterialDesign/ by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 10 Mar 2021 11:02:26 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @include('partials.style')
    <style>
            label{
                font-weight: normal;
                color: #aaa;
                cursor: text;
                -moz-transition: 0.2s;
                -o-transition: 0.2s;
                -webkit-transition: 0.2s;
                transition: 0.2s;
            }
            
    </style>
</head>

<body class="theme-red">
<!-- Page Loader -->
<div class="page-loader-wrapper">
    <!--<div class="loader">-->
    <!--    <div class="preloader">-->
    <!--        <div class="spinner-layer pl-red">-->
    <!--            <div class="circle-clipper left">-->
    <!--                <div class="circle"></div>-->
    <!--            </div>-->
    <!--            <div class="circle-clipper right">-->
    <!--                <div class="circle"></div>-->
    <!--            </div>-->
    <!--        </div>-->
    <!--    </div>-->
    <!--    <p>Please wait...</p>-->
    <!--</div>-->
</div>
<!-- #END# Page Loader -->
@include('partials.header')


@include('partials.sidebar')
<!--Side bar -->
@yield('content')
@include('partials.js')

@yield('after-script')
<script>
     $(".alert").delay(5000).slideUp(300);
</script>
</body>
</html>
