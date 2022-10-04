{{ $segment1 =Request::segment(1)}}

<section>
    <!-- Left Sidebar -->
    <aside id="leftsidebar" class="sidebar">
        <!-- User Info -->
        <div class="user-info">
            <div class="image">
                <img src="@if(auth()->user()->image_url){{asset(auth()->user()->image_url)}}@else{{asset('/images/user.png')}}@endif" width="48" height="48" alt="User" />
            </div>
            <div class="info-container">
                <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{auth()->user()->name}}</div>
                <div class="email">{{auth()->user()->email}}</div>
                <div class="btn-group user-helper-dropdown">
                    <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                    <ul class="dropdown-menu pull-right">
                        <!-- <li><a href="{{route('userProfile')}}"><i class="material-icons">person</i>Profile</a></li>
                        <li role="separator" class="divider"></li> -->
                        <li><a href="{{route('frontendHome')}}"><i class="material-icons">home</i>Main Page</a></li>
                        <!--<li><a href="javascript:void(0);"><i class="material-icons">group</i>Followers</a></li>-->
                        <!--<li><a href="javascript:void(0);"><i class="material-icons">shopping_cart</i>Sales</a></li>-->
                        <!--<li><a href="javascript:void(0);"><i class="material-icons">favorite</i>Likes</a></li>-->
                        <li role="separator" class="divider"></li>
                        <li><a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"><i class="material-icons">input</i>Sign Out</a></li>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </ul>
                </div>
            </div>
        </div>
        <!-- #User Info -->
        <!-- Menu -->
        @if(auth()->user()->user_type != 2 )
        <div class="menu">
            <ul class="list">
                <li class="header">MAIN NAVIGATION</li>
                <li class="{{$segment1 == 'home' ? 'active' : ''}}">
                    <a href="{{route('home')}}" class="">
                        <i class="material-icons">home</i>
                        <span>Home</span>
                    </a>
                </li>
                <li class="{{$segment1 == 'chat' ? 'active' : ''}}">
                    <a href="{{route('chat')}}" class="">
                        <i class="material-icons">chat</i>
                        <span>Chat</span>
                    </a>
                </li>
                @if(auth()->user()->user_type != 1 && (auth()->user()->expiry_date > now()))
                <li class="{{$segment1 == 'slider-gallery' ? 'active' : ''}}">
                    <a href="{{url('slider-gallery')}}" class="">
                        <i class="material-icons">image</i>
                        <span>Slider Gallery</span>
                    </a>
                </li>
                @endif
                <li class="{{$segment1 == 'user-profile' ? 'active' : ''}}">
                    <a href="{{route('userProfile')}}" class="">
                        <i class="material-icons">person</i>
                        <span>Update Profile</span>
                    </a>
                </li>
                <li class="{{$segment1 == 'update-password' ? 'active' : ''}}">
                    <a href="{{url('update-password')}}" class="">
                        <i class="material-icons">person</i>
                        <span>Update Password</span>
                    </a>
                </li>
                @if(auth()->user()->user_type != 1 && (auth()->user()->expiry_date > now()))
                
                <li style="display:{{(auth()->user()->user_package || auth()->id() == 1 ) ? 'block' : 'none'}}" class="{{Request::is('product/default') || Request::is('product') ? 'active' : ''}}">
                    <a href="javascript:void(0);" class="menu-toggle">

                        <i class="material-icons">view_module</i>
                        <span>Products</span>
                    </a>
                    <ul class="ml-menu">
                        <li class="{{Request::is('product/default') ? 'active' : ''}}">
                            <a href="{{route('defaultProductIndex')}}">Default Product</a>
                        </li>
                        @if(auth()->user()->user_package && (auth()->user()->expiry_date > now()))
                        <li class="{{ Request::is('product') ? 'active' : ''}}">
                            <a href="{{route('indexProduct')}}">Product</a>
                        </li>
                        @endif
                    </ul>
                </li>
                <li class="{{$segment1 == 'discount' ? 'active' : ''}}">
                            <a href="{{route('showuserphone')}}">
                                <i class="material-icons">visibility</i>
                                <span>Views</span>
                            </a>
                        </li>
                @endif
                <!-- @if(auth()->user()->user_type != 1 && (auth()->user()->expiry_date > now()))
                        <li style="display:{{(auth()->user()->user_package || auth()->id() == 1 ) ? 'block' : 'none'}} {{$segment1 == 'home' ? 'active' : ''}}">
                            <a href="{{route('defaultProductIndex')}}" class="">
                                <i class="material-icons">view_module</i>
                                <span>Default Product</span>
                            </a>
                        </li> -->
                <!-- mm -->
                <!--<li style="display:{{(auth()->user()->user_package || auth()->id() == 1 ) ? 'block' : 'none'}}">-->
                <!--    <a href="{{route('indexWebsite')}}">-->

                <!--        <i class="fa fa-get-pocket material-icons">-->
                <!--            <span>Website Images</span></i>-->
                <!--    </a>-->
                <!--</li>-->

                <!--<li style="display:{{(auth()->user()->user_package || auth()->id() == 1 ) ? 'block' : 'none'}}">-->
                <!--    <a href="{{route('indexOffice')}}">-->

                <!--        <i class="fa fa-get-pocket material-icons">-->
                <!--            <span>Office</span></i>-->
                <!--    </a>-->
                <!--</li>-->


                <!-- @endif -->
                <!-- @if(auth()->user()->user_package && (auth()->user()->expiry_date > now()))
                    <li class="{{$segment1 == 'product' ? 'active' : ''}}">
                        <a href="{{route('indexProduct')}}" class="">
                            <i class="material-icons">view_list</i>
                            <span>Product</span>
                        </a>
                    </li>
                    @endif -->

                @if(auth()->id() == 1)
                <li class="{{$segment1 == 'product' ? 'active' : ''}}">
                    <a href="{{route('indexProduct')}}" class="">
                        <i class="material-icons">view_list</i>
                        <span>Admin Product</span>
                    </a>
                </li>
                <li class="{{$segment1 == 'user-product' ? 'active' : ''}}">
                    <a href="{{route('user_product')}}" class="">
                        <i class="material-icons">view_list</i>
                        <span>User Product</span>
                    </a>
                </li>
                <li class="{{$segment1 == 'location' ? 'active' : ''}}">
                    <a href="{{route('indexLocation')}}" class="">
                        <i class="material-icons">place</i>
                        <span>Location</span>
                    </a>
                </li>
                <li class="{{$segment1 == 'customer' ? 'active' : ''}}">
                    <a href="{{route('indexCustomer')}}" class="">
                        <i class="material-icons">wc</i>
                        <span>Customer</span>
                    </a>
                </li>
                <li class="{{$segment1 == 'saleBrick' ? 'active' : ''}}">
                    <a href="{{route('indexSaleBricks')}}" class="">
                        <i class="material-icons">timeline</i>
                        <span>Sale Bricks</span>
                    </a>
                </li>
                <li class="{{$segment1 == 'debit' ? 'active' : ''}}">
                    <a href="{{route('Saleindex')}}" class="">
                        <i class="material-icons">credit_card</i>
                        <span>Debit & Credit</span>
                    </a>
                </li>
                @endif
                <?php

                $discount = App\Discount::where('user_id', auth()->user()->id)->get();

                ?>

                @if(auth()->user()->user_package && (auth()->user()->expiry_date > now()))
                @if(count($discount) > 0)
                <li class="{{$segment1 == 'discount' ? 'active' : ''}}">
                    <a href="{{route('indexDiscount')}}">
                        <i class="material-icons">iso</i>
                        <span>Discount</span>
                    </a>
                </li>
                @endif

                <li class="{{$segment1 == 'video-remarks' || $segment1 == 'image-remarks' ? 'active' : ''}}">
                    <a href="javascript:void(0);" class="menu-toggle">

                        <i class="material-icons">movie</i>
                        <span>Remarks</span>
                    </a>
                    <ul class="ml-menu">
                        <li class="{{$segment1 == 'video-remarks' ? 'active' : ''}}">
                            <a href="{{route('indexVideoRemarks')}}">Video</a>
                        </li>
                        <li class="{{$segment1 == 'image-remarks' ? 'active' : ''}}">
                            <a href="{{route('indexImageRemarks')}}">Image</a>
                        </li>
                    </ul>
                </li>

                @endif

                @if(auth()->id() == 1)
                <li class="{{$segment1 == 'discount' ? 'active' : ''}}">
                            <a href="{{url('checkphone')}}">
                                <i class="material-icons">visibility</i>
                                <span>Phone Views</span>
                            </a>
                        </li>
                <li class="{{$segment1 == 'remarks' ? 'active' : ''}}">
                    <a href="javascript:void(0);" class="menu-toggle">

                        <i class="material-icons">movie</i>
                        <span>Remarks</span>
                    </a>
                    <ul class="ml-menu">
                        <li>
                            <a href="{{route('indexVideoRemarks')}}">User Remark Video</a>
                        </li>
                        <li>
                            <a href="{{route('indexImageRemarks')}}">User Remark Image</a>
                        </li>
                    </ul>
                </li>
                @endif


                @if(auth()->user()->user_type == 1)
                <li class="{{$segment1 == 'user' ? 'active' : ''}}">
                    <a href="javascript:void(0);" class="menu-toggle">

                        <i class="material-icons">people</i>
                        <span>Users</span>
                    </a>
                    <ul class="ml-menu">
                        <li>
                            <a href="{{route('indexUser')}}">User</a>
                        </li>
                        <li>
                            <a href="{{route('indexUserType')}}">User Type</a>
                        </li>
                        <li>
                            <a href="{{route('indexUserRating')}}">User Rating</a>
                        </li>
                        <li>
                            <a href="{{route('indexUserPackage')}}">User Package</a>
                        </li>
                    </ul>
                </li>

                <li class="{{$segment1 == 'package' ? 'active' : ''}}">
                    <a href="javascript:void(0);" class="menu-toggle">

                        <i class="material-icons">layers</i>
                        <span>Packages</span>
                    </a>
                    <ul class="ml-menu">
                        <li>
                            <a href="{{route('indexUserPackage')}}">Packages</a>
                        </li>
                        <li>
                            <a href="{{route('indexPackageHistory')}}">Package History</a>
                        </li>
                    </ul>
                </li>

                <!--<li>-->
                <!--    <a href="{{route('indexInvoice')}}">-->

                <!--        <i class="fa fa-get-pocket material-icons">-->
                <!--            <span>Invoice Detail</span></i>-->
                <!--    </a>-->
                <!--</li>-->

                <li class="{{$segment1 == 'industry' ? 'active' : ''}}">
                    <a href="{{route('indexIndustry')}}">

                        <i class="material-icons">domain</i>
                        <span>Industry</span>
                    </a>
                    {{--<ul class="ml-menu">--}}
                    {{--<li>--}}
                    {{--<a href="pages/tables/industry.html">Add Industry</a>--}}
                    {{--</li>--}}

                    {{--</ul>--}}
                </li>
                {{--<li>--}}
                {{-- <a href="{{route('indexSetting')}}">--}}

                {{-- <i class="fa fa-cogs material-icons">--}}
                {{-- <span>Setting</span></i>--}}
                {{--</a>--}}
                {{--<ul class="ml-menu">--}}
                {{--<li>--}}
                {{--<a href="pages/tables/setting.html">Add Setting</a>--}}
                {{--</li>--}}

                {{--</ul>--}}
                {{--</li>--}}
                {{--<li>--}}
                {{-- <a href="{{route('indexTransactionType')}}">--}}

                {{-- <i class="fa fa-exchange material-icons">--}}
                {{-- <span>Transaction Type</span></i>--}}
                {{-- </a>--}}
                {{--<ul class="ml-menu">--}}
                {{--<li>--}}
                {{--<a href="pages/tables/transaction.html">Transaction Type</a>--}}
                {{--</li>--}}

                {{--</ul>--}}
                {{--</li>--}}
                {{--<li>--}}
                {{-- <a href="{{route('indexOrderMail')}}">--}}

                {{-- <i class="fa fa-archive material-icons">--}}
                {{-- <span>Order Mail</span></i>--}}
                {{-- </a>--}}
                {{--<ul class="ml-menu">--}}
                {{--<li>--}}
                {{--<a href="pages/tables/order_mail.html">Order Mail Type</a>--}}
                {{--</li>--}}

                {{--</ul>--}}
                {{--</li>--}}
                {{--<li>--}}
                {{-- <a href="{{route('indexFeedback')}}">--}}

                {{-- <i class="fa fa-comment-o material-icons">--}}
                {{-- <span>Feed Back</span></i>--}}
                {{-- </a>--}}
                {{--</li>--}}
                <li class="{{$segment1 == 'admin-contact-us' ? 'active' : ''}}">
                    <a href="{{route('indexContactUsAdmin')}}">

                        <i class="material-icons">mail</i>
                        <span>Contact Us</span>
                    </a>
                </li>
                <li class="{{$segment1 == 'term' ? 'active' : ''}}">
                    <a href="{{route('indexterm')}}">

                        <i class="material-icons">report_problem</i>
                        <span>Term & Condition</span>
                    </a>
                </li>
                <li class="{{$segment1 == 'notification' ? 'active' : ''}}">
                    <a href="{{route('indexnotification')}}">

                        <i class="material-icons">info</i>
                        <span>Notifications</span>
                    </a>
                </li>
                <li class="{{$segment1 == 'faq' ? 'active' : ''}}">
                    <a href="{{route('indexfaq')}}">

                        <i class="material-icons">info</i>
                        <span>FAQ</span>
                    </a>
                </li>
                <li class="{{$segment1 == 'brand' ? 'active' : ''}}">
                    <a href="{{route('indexBrand')}}">

                        <i class="material-icons">grade</i>
                        <span>Brand</span>
                    </a>
                    {{--<ul class="ml-menu">--}}
                    {{--<li>--}}
                    {{--<a href="pages/tables/add_brand.html">Add Brand</a>--}}
                    {{--</li>--}}
                    {{--<li>--}}
                    {{--<a href="pages/tables/brand_images.html">Add Brand Images</a>--}}
                    {{--</li>--}}
                    {{--</ul>--}}
                </li>
                <li class="{{$segment1 == 'category' ? 'active' : ''}}">
                    <a href="{{route('indexCategory')}}">

                        <i class="material-icons">grade</i>
                        <span>Categories</span>
                    </a>
                    
                </li>
                <li class="{{$segment1 == 'client-review' ? 'active' : ''}}">
                    <a href="{{route('indexReviews')}}">

                        <i class="material-icons">remove_red_eye</i>
                        <span>Client Reviews</span>
                    </a>
                    {{--<ul class="ml-menu">--}}
                    {{--<li>--}}
                    {{--<a href="pages/tables/add_brand.html">Add Brand</a>--}}
                    {{--</li>--}}
                    {{--<li>--}}
                    {{--<a href="pages/tables/brand_images.html">Add Brand Images</a>--}}
                    {{--</li>--}}
                    {{--</ul>--}}
                </li>
                {{--<li>--}}
                {{-- <a href="{{route('indexSocialMedia')}}">--}}

                {{-- <i class="fa fa-medium material-icons">--}}
                {{-- <span>Social Media</span></i>--}}
                {{-- </a>--}}
                {{--<ul class="ml-menu">--}}
                {{--<li>--}}
                {{--<a href="pages/tables/social_media.html">Add Social Media Type</a>--}}
                {{--</li>--}}
                {{--</ul>--}}
                {{--</li>--}}

                <li class="{{$segment1 == 'discount' ? 'active' : ''}}">
                    <a href="{{route('indexDiscount')}}">

                        <i class="material-icons">iso</i>
                        <span>Discount</span>
                    </a>
                </li>
                <li class="{{$segment1 == 'construction-video' ? 'active' : ''}}">
                    <a href="{{route('indexConstructionVideo')}}">

                        <i class="material-icons">hd</i>
                        <span>Construction Help Video</span>
                    </a>
                    {{--<ul class="ml-menu">--}}
                    {{--<li>--}}
                    {{--<a href="pages/tables/constraction_video.html">Add Video</a>--}}
                    {{--</li>--}}
                    {{--</ul>--}}
                </li>
                <li class="{{$segment1 == 'site-content' ? 'active' : ''}}">
                    <a href="javascript:void(0);" class="menu-toggle">

                        <i class="material-icons">line_style</i>
                        <span>Site Content Change</span>
                    </a>
                    <ul class="ml-menu">
                        <li>
                            <a href="{{route('indexSiteContent')}}">Site Content</a>
                        </li>
                    </ul>
                </li>
                <li class="{{$segment1 == 'cities' ? 'active' : ''}}">
                    <a href="{{route('indexCityPackage')}}">

                        <i class="material-icons">map</i>
                        <span>Cities</span>
                    </a>
                </li>
<li class="{{$segment1 == 'subscribe' ? 'active' : ''}}">
                    <a href="{{url('subscribe')}}" class="">
                        <i class="material-icons">view_list</i>
                        <span>News Letter</span>
                    </a>
                </li>
                @endif

                <li class="{{$segment1 == 'invoice-*' ? 'active' : ''}}">

                    @if(auth()->user()->id == 1)
                    <a href="javascript:void(0);" class="menu-toggle">

                        <i class=" material-icons"> filter_none</i>
                        <span>Your Invoice Detail</span>
                    </a>
                    <ul class="ml-menu">
                        <li>
                            <a href="{{route('indexInvoice')}}">Invoice Detail</a>
                        </li>
                        <li>
                            <a href="{{route('indexInvoiceImage')}}">All Invoice Images</a>
                        </li>
                        @else
                        <li class="{{Request::is('invoice-image') ? 'active' : ''}}">
                            <a href="{{route('indexInvoiceImage')}}"><i class="material-icons">filter_none</i>
                                <span>Uplaod Invoice Image</span></a>
                        </li>
                        @endif



                    </ul>
                </li>
            </ul>
        </div>
        @endif
        <!-- #Menu -->
        <!-- Footer -->
        <div class="legal">
            <div class="copyright">
                &copy; 2016 - {{date('Y')}} <a href="javascript:void(0);">Red Bricks Solution</a>.
            </div>
            <div class="version">
                <b>Version: </b> 1.0.5
            </div>
        </div>
        <!-- #Footer -->
    </aside>
    <!-- #END# Left Sidebar -->
    <!-- Right Sidebar -->
    <aside id="rightsidebar" class="right-sidebar">
        <ul class="nav nav-tabs tab-nav-right" role="tablist">
            <li role="presentation" class="active"><a href="#skins" data-toggle="tab">SKINS</a></li>
            <li role="presentation"><a href="#settings" data-toggle="tab">SETTINGS</a></li>
        </ul>
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane fade in active in active" id="skins">
                <ul class="demo-choose-skin">
                    <li data-theme="red" class="active">
                        <div class="red"></div>
                        <span>Red</span>
                    </li>
                    <li data-theme="pink">
                        <div class="pink"></div>
                        <span>Pink</span>
                    </li>
                    <li data-theme="purple">
                        <div class="purple"></div>
                        <span>Purple</span>
                    </li>
                    <li data-theme="deep-purple">
                        <div class="deep-purple"></div>
                        <span>Deep Purple</span>
                    </li>
                    <li data-theme="indigo">
                        <div class="indigo"></div>
                        <span>Indigo</span>
                    </li>
                    <li data-theme="blue">
                        <div class="blue"></div>
                        <span>Blue</span>
                    </li>
                    <li data-theme="light-blue">
                        <div class="light-blue"></div>
                        <span>Light Blue</span>
                    </li>
                    <li data-theme="cyan">
                        <div class="cyan"></div>
                        <span>Cyan</span>
                    </li>
                    <li data-theme="teal">
                        <div class="teal"></div>
                        <span>Teal</span>
                    </li>
                    <li data-theme="green">
                        <div class="green"></div>
                        <span>Green</span>
                    </li>
                    <li data-theme="light-green">
                        <div class="light-green"></div>
                        <span>Light Green</span>
                    </li>
                    <li data-theme="lime">
                        <div class="lime"></div>
                        <span>Lime</span>
                    </li>
                    <li data-theme="yellow">
                        <div class="yellow"></div>
                        <span>Yellow</span>
                    </li>
                    <li data-theme="amber">
                        <div class="amber"></div>
                        <span>Amber</span>
                    </li>
                    <li data-theme="orange">
                        <div class="orange"></div>
                        <span>Orange</span>
                    </li>
                    <li data-theme="deep-orange">
                        <div class="deep-orange"></div>
                        <span>Deep Orange</span>
                    </li>
                    <li data-theme="brown">
                        <div class="brown"></div>
                        <span>Brown</span>
                    </li>
                    <li data-theme="grey">
                        <div class="grey"></div>
                        <span>Grey</span>
                    </li>
                    <li data-theme="blue-grey">
                        <div class="blue-grey"></div>
                        <span>Blue Grey</span>
                    </li>
                    <li data-theme="black">
                        <div class="black"></div>
                        <span>Black</span>
                    </li>
                </ul>
            </div>
            <div role="tabpanel" class="tab-pane fade" id="settings">
                <div class="demo-settings">
                    <p>GENERAL SETTINGS</p>
                    <ul class="setting-list">
                        <li>
                            <span>Report Panel Usage</span>
                            <div class="switch">
                                <label><input type="checkbox" checked><span class="lever"></span></label>
                            </div>
                        </li>
                        <li>
                            <span>Email Redirect</span>
                            <div class="switch">
                                <label><input type="checkbox"><span class="lever"></span></label>
                            </div>
                        </li>
                    </ul>
                    <p>SYSTEM SETTINGS</p>
                    <ul class="setting-list">
                        <li>
                            <span>Notifications</span>
                            <div class="switch">
                                <label><input type="checkbox" checked><span class="lever"></span></label>
                            </div>
                        </li>
                        <li>
                            <span>Auto Updates</span>
                            <div class="switch">
                                <label><input type="checkbox" checked><span class="lever"></span></label>
                            </div>
                        </li>
                    </ul>
                    <p>ACCOUNT SETTINGS</p>
                    <ul class="setting-list">
                        <li>
                            <span>Offline</span>
                            <div class="switch">
                                <label><input type="checkbox"><span class="lever"></span></label>
                            </div>
                        </li>
                        <li>
                            <span>Location Permission</span>
                            <div class="switch">
                                <label><input type="checkbox" checked><span class="lever"></span></label>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </aside>
    <!-- #END# Right Sidebar -->
</section>