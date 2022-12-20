@extends('layouts.frontend')

@section('content')
    {{-- <div class="page-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <h2 style="color:#fff;">{{$siteContents[0]->where('id',12)->first()->content}}</h2>
                </div>

            </div>
        </div>
    </div> --}}
    <div class="container" style="margin-top:30px;">
        <div class="section-header">
            <h2>Image Remarks</h2>
        </div>
    </div>
    <div class="about">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-11">

                    <div class="row">

                        @foreach($remarksImages as $index => $remarksImage)
                        <div class="col-lg-3 col-md-4 col-sm-6" style="margin-top:5px;">
                            <a data-toggle="modal" data-target="#packageDetail{{$index+1}}" href="javascript:void(0)">
                                <img class="img-thumbnail" src="{{asset($remarksImage->image_url)}}" style="width:100%; height:300px;"/>
                            </a>
                        </div>
                        
                        
                        <div class="modal fade modal-fullscreen" id="packageDetail{{$index+1}}" style="padding-right:90px;"  tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" style="width:100%; padding:17px;">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">{{$remarksImage->name}}</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <img class="img-thumbnail" style="width:100%; height:600px;"
                                                         src="{{asset($remarksImage->image_url)}}"/>
                                                </div>
                                        
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <br>
                    <div class="row" style="margin-left: 0px;">
                    
                    @if(count($remarksImages) > 0)
                        {{$remarksImages->links()}}
                    @endif
                    </div>
                </div>
                
            </div>
            
        </div>
        <div class="container" style="margin-top:30px;">
            <div class="section-header">
                <h2>Video Remarks</h2>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-11">
                    <div class="row">
                        @foreach($remarksVideos as $remarksVideo)

                        <div class="col-lg-4 col-md-4 col-sm-6">
                            <iframe class="img-thumbnail" style="height:300px; width:100%;" src="{{$remarksVideo->video_url}}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen=""></iframe>
                            <h6 class="caption">{{$remarksVideo->description}}</h6>
                        </div>
                        @endforeach

                    </div>
                    <br>
                    <div class="row" style="margin-left: 0px;">
                        @if(count($remarksVideos) > 0)
                        {{$remarksVideos->links()}}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

