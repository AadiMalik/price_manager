@extends('layouts.master')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <!-- Exportable Table -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        @if (Session('success'))
                            <div class="alert alert-info alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                        aria-hidden="true">×</span></button>
                                <strong>Success:</strong>&nbsp; {{ Session('success') }}
                            </div>
                        @endif
                        <div class="header">
                            <h2>
                                <i class="fa fa-tasks"></i><span> Currier</span>
                            </h2>
                            <ul class="header-dropdown m-r--5">
                                <a href="{{ route('currier.create') }}" class="btn btn-primary fa fa-plus"> Add Currier</a>
                            </ul>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Phone</th>
                                            <th>Email</th>
                                            <th>Address</th>
                                            <th>Descritpion</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($currier as $index => $item)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $item->name ?? '' }}</td>
                                                <td>{{ $item->phone ?? 'NA' }}</td>
                                                <td>{{ $item->email ?? 'NA' }}</td>
                                                <td>{{ $item->address ?? 'NA' }}</td>
                                                <td>{{ $item->description ?? 'NA' }}</td>
                                                <td>
                                                    <a href="{{ route('currier.edit', $item->id) }}" class="btn btn-warning"
                                                        style="font-weight:bold; width:75px; margin-right:5px; margin-bottom:5px;"><span
                                                            class="fa fa-edit"> Edit</span></a>
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
@endsection
