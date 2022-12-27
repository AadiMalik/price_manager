@extends('layouts.frontend')

@section('content')

    {{-- <div class="page-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <h2 style="color:#fff;">{{$siteContents[0]->where('id',11)->first()->content}}</h2>
                </div>

            </div>
        </div>
    </div> --}}

    <div class="about">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-11">
                    <div class="row">
                        <div class="col-md-3">
                            <ul class="list-group">
                                <li class="list-group-item active" aria-current="true">Categories</li>
                                @foreach ($category as $item)
                                <li class="list-group-item"><a href="{{url('construction-category/'.$item->id)}}">{{$item->name??''}}</a></li>
                                    
                                @endforeach
                              </ul>
                        </div>
                        <div class="col-md-9">
                            <div class="row">
                                @foreach($constructionVideos as $constructionVideo)
                                <div class="col-lg-4" style="margin-bottom:10px;">
                                    <iframe class="img-thumbnail" style="height:300px; width:100%;" src="{{$constructionVideo->video_url}}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen=""></iframe>
                                    <h6 class="caption">{{$constructionVideo->video_name}} </h6>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>


@endsection

