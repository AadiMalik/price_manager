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
                                <i class="fa fa-tasks"></i><span> Client Review</span>
                            </h2>
                            <ul class="header-dropdown m-r--5">
                                <a href="{{route('ReviewsCreate')}}" class="btn btn-primary fa fa-plus"> Add
                                    Review</a>
                            </ul>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                    <thead>
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th >Name</th>
                                        <th>Description</th>
                                        <th>Image</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($reviews as $index => $imageRemark)
                                        <tr>
                                            <td>{{$index+1}}</td>
                                            <td>{{$imageRemark->name}}</td>
                                            <td>{{$imageRemark->description}}</td>
                                            <td><img width="100" class="img-responsive"
                                                     src="{{asset($imageRemark->image_url)}}">
                                            </td>
                                            <td class="d-flex justify-content-center"><a href="{{route('ReviewsEdit',$imageRemark->id)}}"
                                                   class="btn btn-warning"
                                                   style="font-weight:bold; width:75px; margin-right:5px; margin-bottom:5px;"><span
                                                            class="fa fa-edit"> Edit</span></a>
                                                            {{--<a href="javascript:void(0)" onclick="deleteImageRemarks({{$imageRemark->id}})" class="btn btn-danger" style="font-weight:bold;margin-bottom:5px;"><span class="fa fa-remove"> Delete</span></a>--}}
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
        function deleteImageRemarks(imageRemarks) {
            $.ajax({
                type: 'get',
                url: 'client-review/' + imageRemarks + '/delete',
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