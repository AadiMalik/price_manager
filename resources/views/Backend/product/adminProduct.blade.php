@extends('layouts.master')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <!-- Exportable Table -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        @if(Session('success'))
                            <div class="alert alert-info alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                            aria-hidden="true">×</span></button>
                                <strong>Success:</strong>&nbsp; {{ Session('success') }} </div>

                        @endif
                        <div class="header">
                            <h2>
                                <i class="fa fa-tasks"></i><span> Deafult Products</span>
                            </h2>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Price</th>
                                        <th>Old Price</th>
                                        <th>Quality</th>
                                        <th>Category</th>
                                        <th>Size</th>
                                        <th>Image</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($adminProducts as $index => $product)
                                        @php
                                            $getUserId = str_contains($product->paid_users_id,auth()->user()->id);
                                        @endphp
                                        @if($getUserId)

                                        @else
                                        <tr>
                                            <td>{{$index+1}}</td>
                                            <td>{{$product->name}}</td>
                                            <td>{{$product->price}}</td>
                                            <td>{{$product->pre_price}}</td>
                                            <td>{{$product->quality}}</td>
                                            <td>{{$product->category_name->name??''}}</td>
                                            <td>{{$product->size}}</td>
                                            <td><img class="img-thumbnail img-responsive" height="50" width="150"
                                                     src="{{asset($product->image_url)}}"></td>
                                            <td><a href="{{route('addAdminProduct',$product->id)}}"
                                                   class="btn btn-warning"
                                                   style="font-weight:bold; width:100%; margin-right:5px; margin-bottom:5px;"><span
                                                            class="fa fa-edit"> Add product</span></a>
                                                {{--<a href="javascript:void(0)" onclick="deleteProduct({{$product->id}})" class="btn btn-danger" style="font-weight:bold;margin-bottom:5px;"><span class="fa fa-remove"> Delete</span></a>--}}
                                            </td>
                                        </tr>
                                        @endif
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Exportable Table -->
        </div>
    </section>
@endsection


@section('after-script')

    <script>
        function deleteProduct(product) {
            $.ajax({
                type: 'get',
                url: 'product/' + product + '/delete',
                success: function (response) {
                    if (response.status == 1) {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: response.message,
                            showConfirmButton: false,
                            timer: 1500
                        })
                        setTimeout('window.location.reload()', 1500);
                    }
                    console.log(response);
                }
            });
        }
    </script>


@endsection