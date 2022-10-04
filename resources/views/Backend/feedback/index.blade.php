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
                                <i class="fa fa-tasks"></i><span> Feed Back</span>
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
                                        <th>Email</th>
                                        <th>User Name</th>
                                        <th>Phone #</th>
                                        <th>Message</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    {{--@foreach($orderMails as $index => $orderMail)--}}
                                    {{--<tr>--}}
                                        {{--<td>{{$index+1}}</td>--}}
                                        {{--<td>{{$orderMail->email}}</td>--}}
                                        {{--<td>{{$orderMail->user_name}}</td>--}}
                                        {{--<td>{{$orderMail->host}}</td>--}}
                                        {{--<td>{{$orderMail->port}}</td>--}}

                                        {{--<td><a href="{{route('orderMailEdit',$orderMail->id)}}" class="btn btn-warning" style="font-weight:bold; width:75px; margin-right:5px; margin-bottom:5px;"><span class="fa fa-edit"> Edit</span></a>
                                        <!--<a href="javascript:void(0)" onclick="deleteOrderMail({{$orderMail->id}})" class="btn btn-danger" style="font-weight:bold;margin-bottom:5px;"><span class="fa fa-remove"> Delete</span></a>-->
                                        </td>--}}
                                    {{--</tr>--}}
                                    {{--@endforeach--}}
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