@extends('layouts.master')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <!-- Advanced Validation -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>Product</h2>
                        </div>
                        <div class="body">
                            <form id="form_advanced_validation" method="POST" action="{{route('productStore')}}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" value="{{old('name')}}" class="form-control {{ $errors->has('name') ? 'has-error' : '' }}" name="name" required>
                                        <label class="form-label">Product Name <span class="text text-danger">*</span></label>
                                        <span class="text-danger">{{ $errors->first('name') }}</span>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <select name="category" class="form-control" required>
                                            @foreach($category as $item)
                                            <option value="{{$item->id}}">{{$item->name}}</option>
                                            @endforeach
                                        </select>
                                        <label class="form-label">Product Category <span class="text text-danger">*</span></label>
                                        <span class="text-danger">{{ $errors->first('category') }}</span>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="number" min="0" class="form-control {{ $errors->has('price') ? 'has-error' : '' }}" value="{{old('price')}}" name="price" >
                                        <label class="form-label">Price <span class="text text-danger">*</span></label>
                                        <span class="text-danger">{{ $errors->first('price') }}</span>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="number" min="0" class="form-control {{ $errors->has('price') ? 'has-error' : '' }}" value="{{old('oldprice')}}" name="oldprice" >
                                        <label class="form-label">Old Price</label>
                                        <span class="text-danger">{{ $errors->first('oldprice') }}</span>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control {{ $errors->has('quality') ? 'has-error' : '' }}" value="{{old('quality')}}" name="quality" required>
                                        <label class="form-label">Quality <span class="text text-danger">*</span></label>
                                        <span class="text-danger">{{ $errors->first('quality') }}</span>

                                    </div>
                                    {{--<div class="help-info">Starts with http://, https://, ftp:// etc</div>--}}
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control {{ $errors->has('size') ? 'has-error' : '' }}" value="{{old('size')}}" name="size" required>
                                        <label class="form-label">Size <span class="text text-danger">*</span></label>
                                        <span class="text-danger">{{ $errors->first('size') }}</span>

                                    </div>
                                    {{--<div class="help-info">YYYY-MM-DD format</div>--}}
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control {{ $errors->has('description') ? 'has-error' : '' }}" value="{{  old('description')}}" name="description" required>
                                        <label class="form-label">Description <span class="text text-danger">*</span></label>
                                        <span class="text-danger">{{ $errors->first('description') }}</span>

                                    </div>
                                    {{--<div class="help-info">Numbers only</div>--}}
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">

                                        <input type="file" class="form-control {{ $errors->has('image') ? 'has-error' : '' }}" name="image">

                                        <span class="text-danger">{{ $errors->first('image') }}</span>

                                    </div>
                                    {{--<div class="help-info">Ex: 1234-5678-9012-3456</div>--}}
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
