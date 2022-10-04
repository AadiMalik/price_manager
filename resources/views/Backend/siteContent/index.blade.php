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
                                <i class="fa fa-tasks"></i><span> Site Content</span>
                            </h2>
                            {{--<ul class="header-dropdown m-r--5">--}}
                                {{--<a href="{{route('orderMailCreate')}}" class="btn btn-primary fa fa-plus"> Add Order Mail</a>--}}
                            {{--</ul>--}}
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Page</th>
                                        <th>Heading Name</th>
                                        <th>Content</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($siteContents as $index => $siteContent)
                                    <tr>
                                        <td>{{$index+1}}</td>
                                        <td>{{$siteContent->page}}</td>
                                        <td>{{$siteContent->heading_name}}</td>
                                        <td>
                                        @if($siteContent->id==35||$siteContent->id==37||$siteContent->id==38||$siteContent->id==39||$siteContent->id==40)
                                        <img src="{{asset($siteContent->content)}}" style="width:200px; height:200px;">
                                        @else
                                        {{$siteContent->content}}
                                        @endif
                                        </td>

                                        <td><a href="{{route('siteContentEdit',$siteContent->id)}}" class="btn btn-warning" style="font-weight:bold; width:75px; margin-right:5px; margin-bottom:5px;"><span class="fa fa-edit"> Edit</span></a></td>
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
        function deleteOrderMail(orderMail) {
            $.ajax({
                type:'get',
                url:'order-mail/'+orderMail+'/delete',
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