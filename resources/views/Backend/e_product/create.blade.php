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
                            <form id="form_advanced_validation" method="POST" action="{{route('e_productStore')}}" enctype="multipart/form-data">
                                @csrf
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
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
                                        <select name="brand" class="form-control" required>
                                            @foreach($brand as $item)
                                            <option value="{{$item->id}}">{{$item->name}}</option>
                                            @endforeach
                                        </select>
                                        <label class="form-label">Product Brand <span class="text text-danger">*</span></label>
                                        <span class="text-danger">{{ $errors->first('brand') }}</span>
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
                                        <input type="number" min="0" class="form-control" value="{{old('old_price')}}" name="old_price" >
                                        <label class="form-label">Old Price</label>
                                    </div>
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

                                        <input type="file" class="form-control {{ $errors->has('image1') ? 'has-error' : '' }}" name="image1" required>
                                        
                                        <span class="text-danger">{{ $errors->first('image1') }}</span>

                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">

                                        <input type="file" class="form-control" name="image2">

                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">

                                        <input type="file" class="form-control" name="image3">

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
