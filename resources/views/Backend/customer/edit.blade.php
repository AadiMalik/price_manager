@extends('layouts.master')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <!-- Advanced Validation -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>Edit Customer</h2>
                        </div>
                        <div class="body">
                            <form id="form_advanced_validation" method="POST" action="{{route('CustomerUpdate',$customer->id)}}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" value="{{$customer->code}}" disabled class="form-control" name="code" required>
                                        <label class="form-label">Customer Code <span class="text text-danger">*</span></label>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" value="{{$customer->name}}" class="form-control {{ $errors->has('name') ? 'has-error' : '' }}" name="name" required>
                                        <label class="form-label">Customer Name <span class="text text-danger">*</span></label>
                                        <span class="text-danger">{{ $errors->first('name') }}</span>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" value="{{$customer->phone}}" class="form-control {{ $errors->has('phone') ? 'has-error' : '' }}" name="phone" required>
                                        <label class="form-label">Contact No <span class="text text-danger">*</span></label>
                                        <span class="text-danger">{{ $errors->first('phone') }}</span>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <select class="form-control" name="location" required>
                                            <option value="">-- Select Customer Location--</option>
                                            @foreach($location as $item)
                                            <option value="{{$item->id}}" @if($customer->location_id==$item->id) selected @endif>{{$item->location}}</option>
                                                @endforeach
                                        </select>
                                        <span class="text-danger">{{ $errors->first('location') }}</span>
                                    </div>
                                </div>
                                <b>Jamma <span class="text text-danger">(Choose only one)</span></b>
                                        <div class="form-group form-float" style="margin-top:15px;">
                                <div class="row">
                                    <div class="col-lg-6">
                                            <div class="form-line">
                                                <input type="number" min="0" class="form-control {{ $errors->has('plus') ? 'has-error' : '' }}" name="plus">
                                                <label class="form-label">Plus <span class="text text-danger">*</span></label>
                                                <span class="text-danger">{{ $errors->first('plus') }}</span>
                                            </div>
                                    </div>
                                    <div class="col-lg-6">
                                            <div class="form-line">
                                                <input type="number" min="0" class="form-control {{ $errors->has('subtract') ? 'has-error' : '' }}" name="subtract">
                                                <label class="form-label">Subtract <span class="text text-danger">*</span></label>
                                                <span class="text-danger">{{ $errors->first('subtract') }}</span>
                                            </div>
                                    </div>
                                </div>
                                        </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <textarea type="text" class="form-control {{ $errors->has('description') ? 'has-error' : '' }}" name="description" required>{{$customer->description}}</textarea>
                                        <label class="form-label">Description <span class="text text-danger">*</span></label>
                                        <span class="text-danger">{{ $errors->first('description') }}</span>
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
