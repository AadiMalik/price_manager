@extends('layouts.master')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <!-- Advanced Validation -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>Edit Blog</h2>
                        </div>
                        <div class="body">
                            <form id="form_advanced_validation" method="POST" action="{{route('admin-blog.update',$blog->id)}}" enctype="multipart/form-data">
                                @csrf
                                @method('put')
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" value="{{$blog->title??''}}" class="form-control {{ $errors->has('title') ? 'has-error' : '' }}" name="title" required>
                                        <label class="form-label">Title <span class="text text-danger">*</span></label>
                                        <span class="text-danger">{{ $errors->first('title') }}</span>
                                    </div>
                                </div>
                                @if($blog->image!=null)
                                <div class="form-group form-float">
                                    <label class="form-label">Old Image</label>
                                    <div class="form-line">
                                        <img src="{{asset($blog->image)}}" style="height:100px; width:100px;" alt="">
                                    </div>
                                </div>
                                @endif
                                <div class="form-group form-float">
                                    <label class="form-label">New Image</label>
                                    <div class="form-line">
                                        <input type="file" class="form-control " name="image">
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <textarea type="text" id="editor1" class="form-control editor1 {{ $errors->has('description') ? 'has-error' : '' }}" name="description" required>{!!$blog->description??''!!}</textarea>
                                        <label class="form-label">Description <span class="text text-danger">*</span></label>
                                        <span class="text-danger">{{ $errors->first('description') }}</span>

                                    </div>
                                    {{--<div class="help-info">YYYY-MM-DD format</div>--}}
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
@section('after-script')
    <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('editor1');
    </script>
@endsection
