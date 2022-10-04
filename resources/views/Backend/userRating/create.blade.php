@extends('layouts.master')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <!-- Advanced Validation -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>User Type</h2>
                        </div>
                        <div class="body">
                            <form id="form_advanced_validation" method="POST" action="{{route('userRatingStore')}}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" value="{{old('rating_name')}}" class="form-control {{ $errors->has('rating_name') ? 'has-error' : '' }}" name="rating_name" required>
                                        <label class="form-label">Rating Name <span class="text text-danger">*</span></label>
                                        <span class="text-danger">{{ $errors->first('rating_name') }}</span>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" value="{{old('display_rating_name')}}" class="form-control {{ $errors->has('display_rating_name') ? 'has-error' : '' }}" name="display_rating_name" required>
                                        <label class="form-label">Display Rating Name <span class="text text-danger">*</span></label>
                                        <span class="text-danger">{{ $errors->first('display_rating_name') }}</span>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" value="{{old('description')}}" class="form-control {{ $errors->has('description') ? 'has-error' : '' }}" name="description" required>
                                        <label class="form-label">Description<span class="text text-danger">*</span></label>
                                        <span class="text-danger">{{ $errors->first('description') }}</span>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="number" value="{{old('order_number')}}" class="form-control {{ $errors->has('order_number') ? 'has-error' : '' }}" name="order_number" required>
                                            <label class="form-label">Display by Order<span class="text text-danger">*</span></label>
                                        <span class="text-danger">{{ $errors->first('order_number') }}</span>
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
