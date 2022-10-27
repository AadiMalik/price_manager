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
                                <i class="fa fa-tasks"></i><span> Comments</span>
                            </h2>
                            {{-- <ul class="header-dropdown m-r--5"> --}}
                            {{-- <a href="{{route('industryCreate')}}" class="btn btn-primary fa fa-plus"> Add Industry</a> --}}
                            {{-- </ul> --}}
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                    <thead>
                                        <tr>
                                            <th>User Name</th>
                                            <th>Product Name</th>
                                            <th>Rate</th>
                                            <th>Comment</th>
                                            <th>Status</th>
                                            <th>Change</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($comment as $index => $item)
                                            <tr>
                                                <td>{{ $item->user_name->name ?? '' }}</td>
                                                <td>{{ $item->product_name->name ?? '' }}</td>
                                                <td>{{ $item->rate ?? '' }}</td>
                                                <td>{{ $item->description ?? '' }}</td>
                                                <td>
                                                    @if ($item->status == 0)
                                                        Active
                                                    @else
                                                        Block
                                                    @endif
                                                </td>
                                                <td>
                                                    <input type="hidden" id="v_id" value="{{ $item->id }}">
                                                    <select id="status-dropdown" class="form-control">
                                                        <option disabled selected>--Change status--</option>
                                                        <option value="1">Block</option>
                                                        <option value="0">Active</option>
                                                    </select>
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
    <script type="text/javascript">
        $('#status-dropdown').on('change', function() {
            var status = this.value;
            var id = document.getElementById("v_id").value;
            $.ajax({
                url: "{{ url('comment-change-status') }}",
                type: "GET",
                data: {
                    id: id,
                    status: status,
                    _token: '{{ csrf_token() }}'
                },
                dataType: 'json',
                success: function(result) {
                    window.location.reload();
                }
            });
        });
    </script>
@endsection
