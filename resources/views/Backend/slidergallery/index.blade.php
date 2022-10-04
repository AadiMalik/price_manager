@extends('layouts.master')

@section('content')
<style>
    .roundss{
        box-shadow: 0 2px 5px 0 rgba(0,0,0,.25),0 3px 10px 0 rgba(0,0,0,.2)!important;
        border-radius: .25rem!important;
        height:250px;width:250px;
    }
    .badges{
        display: inline-block;
        min-width: 10px;
        padding: 3px 7px;
        font-weight: bold;
        line-height: 1;
        color: #fff;
        text-align: center;
        white-space: nowrap;
        vertical-align: middle;
        background-color: #df2626;
        position: absolute;
    }
</style>
    <section class="content">
        <div class="container-fluid">
            <!-- Advanced Validation -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>Slider Gallery</h2>
                        </div>
                        <div class="body">
                            <div class="row">
                                <div class="col-md-12">
                                    @if(Session::has("status"))
                                    @if(session('status') == 'success')
                                    <div class="alert alert-success">
                                        {{ session()->get('message') }}
                                    </div>
                                    @endif
                                    @if(session('status') == 'failure')
                                    <div class="alert alert-danger">
                                        {{ session()->get('message') }}
                                    </div>
                                    @endif
                                    @endif
                                    <form method="POST" action="{{url('slider-gallery')}}" enctype="multipart/form-data">
                                        @csrf
                                        
                                        <div class="form-group form-float">
                                        <label class="form-label">Gallery Images <span class="text-primary">(Select only jpg,png,jpeg images)</span></label>
                                            <div class="form-line">
                                                <input type="file" class="form-control {{ $errors->has('images') ? 'has-error' : '' }}" name="images"  required>
                                                
                                                <span class="text-danger">{{ $errors->first('images') }}</span>
                                            </div>
                                        </div>
                                        <button class="btn btn-primary waves-effect" type="submit">Upload</button>
                                    </form>
                                </div>
                                <div class="col-md-12">
                                    <div class="row">
                                        @foreach($user_images as $image)
                                        <div class="col-md-3">
                                        <form action="{{url('slider-gallery-delete',$image->id)}}" method="post">
                                        @csrf
                                        <button class="btn btn-sm btn-danger badges" type="submit">
                                            <span class="material-icons">
                                                close
                                            </span>
                                        </button>
                                        </form>   
                                            <img src="{{asset($image->image_url)}}" class="roundss">
                                        </div>
                                        @endforeach
                                    </div>
                                    <div>
                                    {{$user_images->links()}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Advanced Validation -->
        </div>
    </section>

@endsection
