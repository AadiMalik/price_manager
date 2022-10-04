
    <div class="service">
        <div class="container">
            <div class="section-header">
                <h2 style="color:#fff;">Supplier & Manufacturer</h2>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row justify-content-center">
                        <div class="col-lg-11">
                            <div class="row" id="userSearch">

                            </div>
                            <div class="row" id="userData">
                                @foreach($users as $user)

                                    @if($user->products->where('price','>', 0)->count() > 0)
                                        <div class="col-lg-3 col-md-6 col-sm-12">
                                            <a href="{{route('frontendUserPackageDetail',$user)}}">
                                                <div class="service-item">
                                                    <div class="service-icon item">
                                                        <span class="notify-badge">{{$user->city->name}}</span>
                                                        <img src="{{$user->products->count() == 0 ? asset('asset/img/portfolio-1.jpg') :asset($user->image_url)}}"/>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                        <span class="badge"
                                                              style="background:#aa9166; color:#000; float:left; margin-left:15px; font-size:14px; border-radius:0px; margin-top:23px;">{{$user->userType ? $user->userType->name : 'Importer'}}</span><br>
                                                            <div class="star-hidden"
                                                                 style="float:right; margin-right:10px; font-size:14px;">
                                                                @switch($user->reviews->avg('rating'))
                                                                    @case(0.5)
                                                                    <span class="fa fa-star-half-alt"
                                                                          style="color:#aa9166;"></span>
                                                                @break
                                                                    @case(1)
                                                                    <span class="fa fa-star" style="color:#aa9166;"></span>
                                                                    @break
                                                                    @case(1.5)
                                                                    <span class="fa fa-star" style="color:#aa9166;"></span>
                                                                    <span class="fa fa-star-half-alt"
                                                                          style="color:#aa9166;"></span>
                                                                    @break
                                                                    @case(2)
                                                                    <span class="fa fa-star" style="color:#aa9166;"></span>
                                                                    <span class="fa fa-star" style="color:#aa9166;"></span>
                                                                    @break
                                                                    @case(2.5)
                                                                    <span class="fa fa-star" style="color:#aa9166;"></span>
                                                                    <span class="fa fa-star" style="color:#aa9166;"></span>
                                                                    <span class="fa fa-star-half-alt"
                                                                          style="color:#aa9166;"></span>
                                                                    @break
                                                                    @case(3)
                                                                    <span class="fa fa-star" style="color:#aa9166;"></span>
                                                                    <span class="fa fa-star" style="color:#aa9166;"></span>
                                                                    <span class="fa fa-star" style="color:#aa9166;"></span>
                                                                    @break
                                                                    @case(3.5)
                                                                    <span class="fa fa-star" style="color:#aa9166;"></span>
                                                                    <span class="fa fa-star" style="color:#aa9166;"></span>
                                                                    <span class="fa fa-star" style="color:#aa9166;"></span>
                                                                    <span class="fa fa-star-half-alt"
                                                                          style="color:#aa9166;"></span>
                                                                    @break
                                                                    @case(4)
                                                                    <span class="fa fa-star" style="color:#aa9166;"></span>
                                                                    <span class="fa fa-star" style="color:#aa9166;"></span>
                                                                    <span class="fa fa-star" style="color:#aa9166;"></span>
                                                                    <span class="fa fa-star" style="color:#aa9166;"></span>
                                                                    @break
                                                                    @case(4.5)
                                                                    <span class="fa fa-star" style="color:#aa9166;"></span>
                                                                    <span class="fa fa-star" style="color:#aa9166;"></span>
                                                                    <span class="fa fa-star" style="color:#aa9166;"></span>
                                                                    <span class="fa fa-star" style="color:#aa9166;"></span>
                                                                    <span class="fa fa-star-half-alt"
                                                                          style="color:#aa9166;"></span>
                                                                    @break
                                                                    @case(5)
                                                                    <span class="fa fa-star" style="color:#aa9166;"></span>
                                                                    <span class="fa fa-star" style="color:#aa9166;"></span>
                                                                    <span class="fa fa-star" style="color:#aa9166;"></span>
                                                                    <span class="fa fa-star" style="color:#aa9166;"></span>
                                                                    <span class="fa fa-star" style="color:#aa9166;"></span>
                                                                    @break
                                                                    @default
                                                                    <span class="fa fa-star"
                                                                          style="color:#aa9166;"></span>
                                                                    @break
                                                                @endswitch
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <h3 style="height: 45px; width: 100%; overflow: hidden;">{{$user->name}}</h3>
                                                    <span class="fa fa-map-marker-alt"
                                                          style=" float:left; margin-left:15px;"><b> {{$user->city->name}}</b></span><br/>
                                                    <div class="row" style="margin:0px;">
                                                        <div class="col-md-12 col-sm-12" style="padding:0px;">
                                                            <table class="table table-bordered"
                                                                   style="line-height:15px; margin:0px; font-size:14px;">
                                                                <thead style="background:#aa9166; color:#000;">
                                                                <tr>
                                                                    <th scope="col" style="width:30px;">Sr</th>
                                                                    <th scope="col" style="text-align:left;">Name</th>
                                                                    <th scope="col" style="text-align:left;">Quality
                                                                    </th>
                                                                    <th scope="col" style="text-align:left;">Price</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody style="color:#aa9166;">
                                                                @if($user->products->count() != 0)
                                                                    @php
                                                                        $products = $user->products->where('price','>',0);
                                                                    @endphp
                                                                    @foreach($products as $index => $product)
                                                                        @if($index < 3 )

                                                                            {{--@else--}}
                                                                            <tr>
                                                                                <td scope="col"
                                                                                    style="text-align:left;">{{$index+1}}</td>
                                                                                <td scope="col"
                                                                                    style="text-align:left; font-size:14px; overflow:hidden !important;">
                                                                                    <span>{{$user->name}}</span></td>
                                                                                <td scope="col"
                                                                                    style="text-align:left; font-size:14px; overflow:hidden !important;">{{$product->quality}}</td>
                                                                                <td scope="col"
                                                                                    style="text-align:right;">{{$product->price}}</td>
                                                                            </tr>
                                                                @endif
                                                                @endforeach

                                                                @endif

                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>

                                            </a>
                                        </div>

                                    @endif
                                @endforeach

                            </div>
                        </div>

                    </div>

                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-2 col-lg-offset-5">
                                {{ $users->links() }}
                                {{--<a class="btn" href="">Load More</a>--}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
