@extends('layouts.master')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <!-- Advanced Validation -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>Add Construction Video</h2>
                        </div>
                        <div class="body">
                            <form id="form_advanced_validation" method="POST" action="{{route('constructionVideoUpdate',$constructionVideo->id)}}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" value="{{$constructionVideo->video_name}}" class="form-control {{ $errors->has('video_name') ? 'has-error' : '' }}" name="video_name" required>
                                        <label class="form-label">Video Name <span class="text text-danger">*</span></label>
                                        <span class="text-danger">{{ $errors->first('video_name') }}</span>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <select name="category" class="form-control" id="">
                                            <option disabled selected>--Select Category--</option>
                                            @foreach ($category as $item)
                                            <option value="{{$item->id}}" {{($item->id==$constructionVideo->category_id)?'selected':''}}>{{$item->name??''}}</option>
                                            @endforeach
                                        </select>
                                        <label class="form-label">Category <span class="text text-danger">*</span></label>
                                        <span class="text-danger">{{ $errors->first('category') }}</span>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" value="{{$constructionVideo->description}}" class="form-control {{ $errors->has('description') ? 'has-error' : '' }}" name="description" required>
                                        <label class="form-label">Video Description <span class="text text-danger">*</span></label>
                                        <span class="text-danger">{{ $errors->first('description') }}</span>
                                    </div>
                                </div>

                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="url" value="{{$constructionVideo->video_url}}" class="form-control {{ $errors->has('video_url') ? 'has-error' : '' }}" name="video_url" required>
                                        <label class="form-label">Video URL <span class="text text-danger">*</span></label>
                                        <span class="text-danger">{{ $errors->first('video_url') }}</span>
                                    </div>
                                </div>

                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="number" value="{{$constructionVideo->order_by}}" class="form-control {{ $errors->has('order_by') ? 'has-error' : '' }}" name="order_by" required>
                                        <label class="form-label">Order By<span class="text text-danger">*</span></label>
                                        <span class="text-danger">{{ $errors->first('order_by') }}</span>
                                    </div>
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
