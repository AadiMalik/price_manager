@extends('layouts.master')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <!-- Advanced Validation -->
            <div class="row clearfix">
                <div class="col-lg-3"></div>
                <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>Create Customer</h2>
                        </div>
                        <div class="body">
                            <form id="form_advanced_validation" method="POST" action="{{route('CustomerStore')}}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" value="{{old('code')}}" class="form-control {{ $errors->has('code') ? 'has-error' : '' }}" name="code" required>
                                        <label class="form-label">Customer Code <span class="text text-danger">*</span></label>
                                        <span class="text-danger">{{ $errors->first('code') }}</span>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" value="{{old('name')}}" class="form-control {{ $errors->has('name') ? 'has-error' : '' }}" name="name" required>
                                        <label class="form-label">Customer Name <span class="text text-danger">*</span></label>
                                        <span class="text-danger">{{ $errors->first('name') }}</span>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" value="{{old('phone')}}" class="form-control {{ $errors->has('phone') ? 'has-error' : '' }}" name="phone" required>
                                        <label class="form-label">Contact No <span class="text text-danger">*</span></label>
                                        <span class="text-danger">{{ $errors->first('phone') }}</span>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <select class="form-control" name="location" required>
                                            <option value="">-- Select Customer Location--</option>
                                            @foreach($location as $item)
                                            <option value="{{$item->id}}">{{$item->location}}</option>
                                                @endforeach
                                        </select>
                                        <span class="text-danger">{{ $errors->first('location') }}</span>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="number" value="{{old('jamma')}}" min="0" class="form-control {{ $errors->has('jamma') ? 'has-error' : '' }}" name="jamma" required>
                                        <label class="form-label">Jamma <span class="text text-danger">*</span></label>
                                        <span class="text-danger">{{ $errors->first('jamma') }}</span>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <textarea type="text" class="form-control {{ $errors->has('description') ? 'has-error' : '' }}" name="description" required>{{old('description')}}</textarea>
                                        <label class="form-label">Description <span class="text text-danger">*</span></label>
                                        <span class="text-danger">{{ $errors->first('description') }}</span>
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
