@extends('layouts.master')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <!-- Advanced Validation -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>Image Remarks</h2>
                        </div>
                        <div class="body">
                            <form id="form_advanced_validation" method="POST" action="{{route('imageRemarksUpdate',$imageRemarks->id)}}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" value="{{$imageRemarks->name}}" class="form-control {{ $errors->has('name') ? 'has-error' : '' }}" name="name" required>
                                        <label class="form-label">Remarks Image Name <span class="text text-danger">*</span></label>
                                        <span class="text-danger">{{ $errors->first('name') }}</span>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control {{ $errors->has('description') ? 'has-error' : '' }}" value="{{$imageRemarks->description}}" name="description" >
                                        <label class="form-label">Add Description <span class="text text-danger">*</span></label>
                                        <span class="text-danger">{{ $errors->first('description') }}</span>
                                    </div>
                                </div>

                                <div class="form-group form-float">
                                    
                                <label class="form-label">Image <span class="text-danger">*</span></label>
                                    <div class="form-line">
                                        <input type="file" class="form-control {{ $errors->has('image') ? 'has-error' : '' }}" name="image">
                                        <span class="text-danger">{{ $errors->first('image') }}</span>

                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <img class="img-responsive" style="height:300px;width:300px;" src="{{asset($imageRemarks->image_url)}}">
                                </div>
                                <button class="btn btn-primary waves-effect" type="submit">SUBMIT</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Advanced Validation -->
        </div>
    </section>

@endsection
