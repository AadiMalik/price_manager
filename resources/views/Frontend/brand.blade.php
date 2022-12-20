@extends('layouts.frontend')

@section('content')

    {{-- <div class="page-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <h2 style="color:#fff;">{{$siteContents[0]->where('id',8)->first()->content}}</h2>
                </div>

            </div>
        </div>
    </div> --}}

    <div class="about">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-11">
                    <div class="row">
                        @foreach($users as $user)
                                @if($user->products->where('price','>', 0)->count() > 0 && $user->brand_id)
                        <div class="col-lg-3 col-md-4 col-sm-6" style="margin-top:5px;">
                            <div class="img-thumbnail" style="text-align:center;">
                                <a href="{{route('frontendUserPackageDetail',$user->id)}}">
                                    <img src="{{asset($user->image_url)}}" title="{{$user->image_title}}" alt="Lights" style="width:100%; height:300px;">
                                    <div class="caption">
                                        <b>{{$user->name}}</b>
                                    </div>
                                </a>
                            </div>
                        </div>
                        @endif
                        @endforeach

                    </div>

                </div>
            </div>
        </div>
    </div>


@endsection
