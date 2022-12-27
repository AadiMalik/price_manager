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
                                <i class="fa fa-tasks"></i><span> Construction Video</span>
                            </h2>
                            <ul class="header-dropdown m-r--5">
                                <a href="{{route('constructionVideoCreate')}}" class="btn btn-primary fa fa-plus"> Add Construction Video</a>
                            </ul>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Video Name</th>
                                        <th>Category</th>
                                        <th>Description</th>
                                        <th>Order By</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($constructionVideos as $index => $constructionVideo)
                                    <tr>
                                        <td>{{$index+1}}</td>
                                        <td>{{$constructionVideo->video_name}}</td>
                                        <td>{{$constructionVideo->category_name->name??''}}</td>
                                        <td>{{$constructionVideo->description}}</td>
                                        <td>{{$constructionVideo->order_by}}</td>

                                        <td><a href="{{route('constructionVideoEdit',$constructionVideo->id)}}" class="btn btn-warning" style="font-weight:bold; width:75px; margin-right:5px; margin-bottom:5px;"><span class="fa fa-edit"> Edit</span></a>
                                        {{--<a href="javascript:void(0)" onclick="deleteConstructionVideo({{$constructionVideo->id}})" class="btn btn-danger" style="font-weight:bold;margin-bottom:5px;"><span class="fa fa-remove"> Delete</span></a>--}}
                                        </td>
                                        
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
        function deleteConstructionVideo(constructionVideo) {
            $.ajax({
                type:'get',
                url:'construction-video/'+constructionVideo+'/delete',
                success:function(response) {
                    if (response.status == 1) {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: response.message,
                            showConfirmButton: false,
                            timer: 1500
                        })
                        setTimeout('window.location.reload()',1500);
                    }
                    console.log(response);
                }
            });
        }
    </script>


    @endsection