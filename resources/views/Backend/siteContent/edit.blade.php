@extends('layouts.master')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <!-- Advanced Validation -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>Site Content</h2>
                        </div>
                        <div class="body">
                            <form id="form_advanced_validation" method="POST"
                                  action="{{route('siteContentUpdate',$siteContent->id)}}"
                                  enctype="multipart/form-data">
                                @csrf

                                @if($siteContent->id== 35 || $siteContent->id== 36 ||$siteContent->id== 37 ||$siteContent->id== 38 ||$siteContent->id== 39 ||$siteContent->id== 40 ||$siteContent->id== 35)
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="file"
                                                   class="form-control {{ $errors->has('image') ? 'has-error' : '' }}"
                                                   name="image" {{$siteContent->content ? '' : 'required'}}>
                                            <label class="form-label">Image <span
                                                        class="text text-danger">*</span></label>
                                            <span class="text-danger">{{ $errors->first('image') }}</span>
                                        </div>
                                    </div>
                                @else
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <textarea style="min-height:150px;"
                                                   class="form-control {{ $errors->has('content') ? 'has-error' : '' }}"
                                                   name="content" required>{{$siteContent->content}}</textarea>
                                            <label class="form-label">Content <span
                                                        class="text text-danger">*</span></label>
                                            <span class="text-danger">{{ $errors->first('content') }}</span>
                                        </div>
                                    </div>
                                @endif
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
