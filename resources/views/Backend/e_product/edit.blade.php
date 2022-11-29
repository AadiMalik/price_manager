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
                            <form id="form_advanced_validation" method="POST" action="{{route('e_productUpdate',$product->id)}}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" value="{{$product->name}}" class="form-control {{ $errors->has('name') ? 'has-error' : '' }}" name="name" required>
                                        <label class="form-label">Product Name <span class="text text-danger">*</span></label>
                                        <span class="text-danger">{{ $errors->first('name') }}</span>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <select name="category" class="form-control" required>
                                            @foreach($category as $item)
                                            <option value="{{$item->id}}" @if($product->category_id== $item->id) selected @endif>{{$item->name}}</option>
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
                                            <option value="{{$item->id}}" @if($product->brand_id== $item->id) selected @endif>{{$item->name}}</option>
                                            @endforeach
                                        </select>
                                        <label class="form-label">Product Brand <span class="text text-danger">*</span></label>
                                        <span class="text-danger">{{ $errors->first('brand') }}</span>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="number" class="form-control {{ $errors->has('price') ? 'has-error' : '' }}" value="{{$product->price}}" name="price" required>
                                        <label class="form-label">Price <span class="text text-danger">*</span></label>
                                        <span class="text-danger">{{ $errors->first('price') }}</span>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="number" min="0" class="form-control" value="{{$product->old_price??'0'}}" name="old_price" >
                                        <label class="form-label">Old Price</label>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control {{ $errors->has('description') ? 'has-error' : '' }}" value="{{  $product->description}}" name="description" required>
                                        <label class="form-label">Description <span class="text text-danger">*</span></label>
                                        <span class="text-danger">{{ $errors->first('description') }}</span>

                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <img class="img-responsive" style="height:100px;width:100px;" src="{{asset($product->image1)}}">
                                    </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="file" class="form-control" name="image1">
                                    </div>
                                </div>
                                @if($product->image2!=null)
                                <div class="form-group form-float">
                                    <img class="img-responsive" style="height:100px;width:100px;" src="{{asset($product->image2)}}">
                                    </div>
                                    @endif
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="file" class="form-control" name="image2">

                                    </div>
                                </div>
                                @if($product->image3!=null)
                                <div class="form-group form-float">
                                    <img class="img-responsive" style="height:100px;width:100px;" src="{{asset($product->image3)}}">
                                    </div>
                                    @endif
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
