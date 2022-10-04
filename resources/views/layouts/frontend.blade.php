<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @include('frontendPartials.style')
    @yield('style')
    <style>
        .page-link {
                position: relative;
                display: block;
                padding: .5rem .75rem;
                margin-left: -1px;
                line-height: 1.25;
                color: #da5c22 !important;
                background-color: #fff  !important;
                border: 1px solid #dee2e6;
            }
            .page-item.active .page-link {
                z-index: 3;
                color: #fff  !important;
                background-color: #da5c22  !important;
                border-color: #da5c22  !important;
            }
.alert.alert-server {
  margin-bottom: 0;
  border-radius: 0;
}
    </style>
    
</head>

<body>
 @if(auth()->check())
 @if(auth()->user()->status == 2)
<div class="alert alert-danger alert-server" role="alert">
  <button type="button" class="close" data-dismiss="alert">×</button>
  <strong>Your Account is Blocked. Please contact us by click on this link  <a href="{{url('/contact-us')}}">contact us</a> for more details</strong>
</div>
@endif
@endif
<div>

    <!-- Nav Bar Start -->
@include('frontendPartials.header')
    <!-- Nav Bar End -->


    @yield('content')


    <!-- Newsletter Start -->
    <!--@include('frontendPartials.newsletter')-->
    <!-- Newsletter End -->


    <!-- Footer Start -->
    @include('frontendPartials.footer')
    <!-- Footer End -->
    <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>
</div>

<!-- JavaScript Libraries -->
@include('frontendPartials.js')
<script>
    $(document).ready(function(){
        var alerted = localStorage.getItem('alerted') || '';
    if (alerted != 'yes') {
        @foreach($notification as $item)
    $.showNotification({
            body: "@if($item->image!=null) <div class='row'><div class='col-md-12'><img src='{{asset($item->image)}}' style='width:100%; height:200px;'></div></div>@endif @if($item->heading!=null) <div class='row'><div class='col-md-12'><h4 style='margin-top:10px;'>{{$item->heading}}</h4></div></div>@endif @if($item->description!=null) <div class='row'><div class='col-md-12'><p>{{$item->description}}</p></div></div>@endif", type: "danger"
        });
        @endforeach
    }
    localStorage.setItem('alerted','yes');
});
</script>
@yield('after-script')


</body>
</html>
