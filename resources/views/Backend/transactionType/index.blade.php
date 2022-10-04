@extends('layouts.master')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <!-- Exportable Table -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        
                        <div class="header">
                            <h2>
                                <i class="fa fa-eye"></i><span> Phone Views</span>
                            </h2>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Company Name</th>
                                        <th>Company ID</th>
                                        <th>User Name</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($phoneview as  $item)
                                    <tr>
                                        <td>{{$item->id}}</td>
                                        <td>{{$item->userdetail->name}}</td>
                                        <td>{{$item->user_detail_id}}</td>
                                        <td>{{$item->user->name}}</td>
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

