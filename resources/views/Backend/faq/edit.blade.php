@extends('layouts.master')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <!-- Advanced Validation -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>Edit FAQ</h2>
                        </div>
                        <div class="body">
                            <form id="form_advanced_validation" method="POST" action="{{route('faqUpdate',$faq->id)}}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" value="{{$faq->heading}}" class="form-control {{ $errors->has('heading') ? 'has-error' : '' }}" name="heading" required>
                                        <label class="form-label">Quation <span class="text text-danger">*</span></label>
                                        <span class="text-danger">{{ $errors->first('heading') }}</span>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <textarea  class="form-control {{ $errors->has('description') ? 'has-error' : '' }}" name="description" required>{{$faq->description}}</textarea>
                                        <label class="form-label">Answer <span class="text text-danger">*</span></label>
                                        <span class="text-danger">{{ $errors->first('description') }}</span>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <textarea type="text" value="" class="form-control" style="min-height:60px;" name="urdu">{{$faq->urdu}}</textarea>
                                        <label class="form-label">جواب</label>
                                        <span class="text-danger">{{ $errors->first('urdu') }}</span>
                                    </div>
                                </div>
                                <button class="btn btn-primary waves-effect" type="submit">UPDATE</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Advanced Validation -->
        </div>
    </section>

@endsection
