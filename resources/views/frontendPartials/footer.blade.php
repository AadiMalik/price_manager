<div class="footer">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="row">
                    <div class="col-md-6 col-lg-12">
                        <div class="row">
                            <div class="col-md-6 col-lg-4">
                                <div class="footer-link">
                                    <h2>Services Areas</h2>
                                    <a href="javascript:void(0)">Construction Help</a>
                                    <a href="javascript:void(0)">Approach to Reliable Manufecturer</a>
                                    <a href="javascript:void(0)">Approach to Reliable Supplier</a>
                                    <a href="javascript:void(0)">Easy to Communication</a>
                                    <a href="javascript:void(0)">Rating Quality</a>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4">
                                <div class="footer-link">
                                    <h2>Useful Pages</h2>
                                    <a href="{{route('frontendAbout')}}">About Us</a>
                                    <a href="{{route('frontendBrand')}}">Brands</a>
                                    <a href="{{route('frontendConstruction')}}">Construction</a>
                                    <a href="{{route('frontendRemarks')}}">Remarks</a>
                                    <a href="{{route('frontendContact')}}">Contact Us</a>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4">
                                <div class="footer-contact">
                                    <h2>{{$siteContents[0]->where('id',30)->first()->content}}</h2>
                                    <p><i class="fa fa-map-marker-alt"></i>{{$siteContents[0]->where('id',31)->first()->content}}</p>
                                    <p><i class="fa fa-phone-alt"></i>{{$siteContents[0]->where('id',32)->first()->content}}</p>
                                    <p><i class="fa fa-envelope"></i>{{$siteContents[0]->where('id',33)->first()->content}}</p>
                                    <div class="footer-social">
                                        <a href="{{$siteContents[0]->where('id',44)->first()->content}}" target="_blank"><i class="fab fa-twitter"></i></a>
                                        <a href="{{$siteContents[0]->where('id',43)->first()->content}}" target="_blank"><i class="fab fa-facebook-f"></i></a>
                                        <a href="{{$siteContents[0]->where('id',45)->first()->content}}" target="_blank"><i class="fab fa-youtube"></i></a>
                                        <a href="{{$siteContents[0]->where('id',46)->first()->content}}" target="_blank"><i class="fab fa-instagram"></i></a>
                                        <a href="{{$siteContents[0]->where('id',47)->first()->content}}" target="_blank"><i class="fab fa-linkedin-in"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="footer-menu" style="width:100%;">
                        <div class="f-menu">
                            <a href="{{route('fterm')}}">Terms & Condition</a>
                            <a href="{{route('fterm')}}">Privacy policy</a>
                            <a href="{{route('help')}}">Help</a>
                            <a href="{{route('help')}}">FQAs</a>
                        </div>
                    </div>
                    <div class="copyright">
                        <div class="row">
                            <div class="col-md-12" style="text-align:center;">
                                <p>&copy; <a href="#">Red Bricks Solutions</a>, All Right Reserved.</p>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
