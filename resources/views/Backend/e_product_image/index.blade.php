@extends('layouts.master')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <!-- Exportable Table -->
            <div class="row clearfix">
                @if (Session('success'))
                    <div class="alert alert-info alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                aria-hidden="true">×</span></button>
                        <strong>Success:</strong>&nbsp; {{ Session('success') }}
                    </div>
                @endif
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                <i class="fa fa-tasks"></i><span>Add Product Image</span>
                            </h2>
                        </div>
                        <div class="body">
                            <form id="form_advanced_validation" method="POST" action="{{route('e_product_imageStore')}}" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="product_id" value="{{$id}}">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="file" class="form-control {{ $errors->has('image') ? 'has-error' : '' }}" name="image" required>
                                        <span class="text-danger">{{ $errors->first('image') }}</span>
                                    </div>
                                </div>
                                
                                <button class="btn btn-primary waves-effect" type="submit">SUBMIT</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                <i class="fa fa-tasks"></i><span> Product Images</span>
                                <a href="{{url('e-product')}}" class="btn btn-primary">Back to Products</a>
                            </h2>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Image</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($product_image as $index => $item)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td><img src="{{ asset($item->image ?? '') }}" style="width: 100px; height:100px;" alt=""></td>
                                                <td>
                                                    {{-- <a href="{{ route('e_productEdit', $product->id) }}"
                                                        class="btn btn-warning"
                                                        style="font-weight:bold; width:75px; margin-right:5px; margin-bottom:5px;"><span
                                                            class="fa fa-edit"> Edit</span></a> --}}
                                                    <a href="{{ route('e_product_imageDelete', $item->id) }}" class="btn btn-danger" style="font-weight:bold;margin-bottom:5px;"><span class="fa fa-remove"> Delete</span></a>
                                                </td>
                                            </tr>
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
                success: function(response) {
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