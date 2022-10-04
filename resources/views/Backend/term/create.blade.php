@extends('layouts.master')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <!-- Advanced Validation -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>Create Term & Condition</h2>
                        </div>
                        <div class="body">
                            <form id="form_advanced_validation" method="POST" action="{{route('termStore')}}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" value="{{old('heading')}}" class="form-control {{ $errors->has('heading') ? 'has-error' : '' }}" name="heading" required>
                                        <label class="form-label">Heading <span class="text text-danger">*</span></label>
                                        <span class="text-danger">{{ $errors->first('heading') }}</span>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <textarea type="text"  class="form-control {{ $errors->has('description') ? 'has-error' : '' }}" style="min-height:60px;" name="description" required>{{old('description')}}</textarea>
                                        <label class="form-label">Discription <span class="text text-danger">*</span></label>
                                        <span class="text-danger">{{ $errors->first('description') }}</span>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <textarea type="text"  class="form-control" style="min-height:60px;" name="urdu" required>{{old('urdu')}}</textarea>
                                        <label class="form-label">اردو></label>
                                        <span class="text-danger">{{ $errors->first('urdu') }}</span>
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
