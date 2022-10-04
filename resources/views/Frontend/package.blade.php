@extends('layouts.frontend')

@section('content')

    <div class="page-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <h2 style="color:#fff;">{{$siteContents[0]->where('id',13)->first()->content}}  </h2>
                </div>

            </div>
        </div>
    </div>

    <div class="about">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    {{--<div class="row" style="width: 96%; align-items: center;">
                        <div class="col-md-12">
                            <div class="alert alert-info">
                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                            </div>
                        </div>
                    </div>--}}
                    <div class="row">
                        @foreach($packages as $package)
                            <div class="col-lg-4 col-md-6 col-sm-12">

                                <div class="opening">

                                    <div class="flip-me">


                                        <div class="front">
                                            <div class="price-table">
                                                <section class="head">
                                                    <h1><span class="bold">{{$package->name}}</span></h1>
                                                    <i class="fa fa-barcode"></i>
                                                </section>
                                                <section class="price">
                                                    <h2>
                                                        <span class="dollar">PKR. </span>{{number_format($package->price)}}<span
                                                                class="year">/{{$package->validity_day}} Days</span>
                                                    </h2>
                                                </section>
                                                <section class="contents">
                                                    @php
                                                        $features = unserialize($package->feature);
                                                    @endphp
                                                    <ul>
                                                        <li><p>{{ $features[0] ?? ''}}</p></li>
                                                        <li><p>{{ $features[1] ?? ''}}</p></li>
                                                        <li><p>{{ $features[2] ?? ''}}</p></li>
                                                        <li>A {{$package->validity_day}} Days worth of new releases</li>
                                                    </ul>
                                                </section>
                                                <a href="{{route('buyPackage',$package->id)}}" class="submit">Become a Member</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                            </div>

                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection

