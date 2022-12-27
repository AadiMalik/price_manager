<?php $segment1 = Request::segment(1) ?>
<div class="nav-bar">
    <div class="container-fluid">
        <nav class="navbar navbar-expand-lg bg-dark navbar-dark">
            <a href="#" class="navbar-brand" style="color:#aa9166; margin-left:15px;">Price Manager</a>
            <button type="button" style="border-color:#aa9166; background:#aa9166; margin-right:15px;" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                <div class="navbar-nav mr-auto">
                    <div class="logo" style="margin-right:20px;">
                        <a href="{{route('frontendHome')}}">
                            <h1>Price Manager</h1>
                            <!-- <img src="img/logo.jpg" alt="Logo"> -->
                        </a>
                    </div>
                    <a href="{{route('frontendHome')}}" style="font-weight: bold;" class="nav-item nav-link {{$segment1 == 'fhome' ? 'active' : ''}}">Home</a>
                    <a href="{{route('frontendBrand')}}" style="font-weight: bold;" class="nav-item nav-link {{$segment1 == 'fbrand' ? 'active' : ''}}">Brand</a>
                    <a href="{{route('frontendConstruction')}}" style="font-weight: bold;" class="nav-item nav-link {{$segment1 == 'construction' ? 'active' : ''}}">Construction</a>
                    <a href="{{url('products')}}" style="font-weight: bold;" class="nav-item nav-link {{$segment1 == 'products' ? 'active' : ''}}">Products</a>
                    <a href="{{route('frontendRemarks')}}" style="font-weight: bold;" class="nav-item nav-link {{$segment1 == 'remarks' ? 'active' : ''}}">Remarks</a>
                    {{-- <div class="dropdown">
                    <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-item nav-link dropdown-toggle {{$segment1 == 'fpackage' ? 'active' : ''}}">Packages
                    </a>
                        <div class="dropdown-menu" style="margin: 0px;">
                            <a class="dropdown-item" href="{{route('frontendPackage')}}">For Member</a>
                            <a class="dropdown-item" href="{{url('f_package')}}">For Feature</a>
                          </div>
                        </div> --}}
                    <a href="{{route('frontendContact')}}" style="font-weight: bold;" class="nav-item nav-link {{$segment1 == 'contact-us' ? 'active' : ''}}">Contact Us</a>
                    <a href="{{route('frontendAbout')}}" style="font-weight: bold;" class="nav-item nav-link {{$segment1 == 'about' ? 'active' : ''}}">About</a>
                </div>
                <div class="ml-auto">
                    @if(auth()->check())
                    
                    <div class="dropdown show">
                      <a class="btn" href="#" data-toggle="dropdown" aria-expanded="true">
                        <span class="fa fa-user"></span> {{auth()->user()->name}} <i class="fa fa-caret-down" aria-hidden="true"></i>
                      </a>
                    
                      <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                        @if(auth()->user()->status != 2)
                        <a class="dropdown-item" href="{{route('home')}}">Admin Panel</a>
                        @endif
                        <a class="dropdown-item" href="{{url('cart')}}">Cart</a>
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">-->
                                    @csrf
                                </form>
                      </div>
                    </div>
                    
                        <!--<div class="btn-group user-helper-dropdown">-->
                        <!--    <i class="fas fa-home" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"></i>-->
                        <!--    <ul class="dropdown-menu pull-right">-->
                        <!--        <li role="separator" class="divider"></li>-->
                        <!--        <li><a href="{{route('home')}}"><i class="fas fa-home"></i>Dashboard</a></li>-->
                        <!--        <li role="separator" class="divider"></li>-->
                        <!--        <li><a href="{{ route('logout') }}"-->
                        <!--               onclick="event.preventDefault();-->
                        <!--                             document.getElementById('logout-form').submit();"><i-->
                        <!--                        class="fas fa-home"></i>Sign Out</a></li>-->

                        <!--        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">-->
                        <!--            @csrf-->
                        <!--        </form>-->
                            </ul>
                        </div>
                        @else
                        <a class="btn" href="{{route('login')}}"><b>Login</b></a>
@endif
                </div>
            </div>
        </nav>
    </div>
</div>