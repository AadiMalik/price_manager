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
                                <i class="fa fa-tasks"></i><span> Orders</span>
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
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Address</th>
                                            <th>QTY</th>
                                            <th>Tax</th>
                                            <th>Sub Total</th>
                                            <th>Total</th>
                                            <th>Method</th>
                                            <th>Currier</th>
                                            <th>Status</th>
                                            @if (Auth()->user()->id == 1)
                                                <th>Change</th>
                                            @endif
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($order as $index => $item)
                                            <tr>
                                                <td>{{ $item->name ?? '' }}</td>
                                                <td>{{ $item->email ?? '' }}</td>
                                                <td>{{ $item->phone1 ?? '' }},{{ $item->phone2 ?? '' }},{{ $item->phone3 ?? '' }}
                                                </td>
                                                <td>{{ $item->address ?? '' }},{{ $item->city_name->name ?? '' }}
                                                </td>
                                                <td>{{ $item->qty ?? '0' }}</td>
                                                <td>{{ $item->tax ?? '0' }}</td>
                                                <td>{{ $item->sub_total ?? '0' }}</td>
                                                <td>{{ $item->total ?? '0' }}</td>
                                                <td>{{ $item->payment_method ?? '' }}</td>
                                                <td>{{ $item->currier_name->name ?? 'N/A' }}</td>
                                                <td>{{ $item->status ?? '' }}</td>
                                                @if (Auth()->user()->id == 1)
                                                    <td>
                                                        <input type="hidden" id="v_id" value="{{ $item->id }}">
                                                        <select id="status-dropdown" class="form-control">
                                                            <option value="Pending">Pending</option>
                                                            <option value="Processing">Processing</option>
                                                            <option value="Packing">Packing</option>
                                                            <option value="On the Way">On the Way</option>
                                                            <option value="Delivered">Delivered</option>
                                                            <option value="Cancel">Cancel</option>
                                                        </select>
                                                    </td>
                                                @endif
                                                <td>
                                                    <button type="button" class="btn btn-info" data-toggle="modal"
                                                        data-target="#Order{{ $item->id }}"
                                                        style="font-weight:bold; width:75px; margin-right:5px; margin-bottom:5px;"><span
                                                            class="fa fa-eye"> Show</span></button>
                                                        @if(Auth()->user()->id==1)
                                                            <button type="button" class="btn btn-info" data-toggle="modal"
                                                        data-target="#Currier{{ $item->id }}"
                                                        style="font-weight:bold; width:75px; margin-right:5px; margin-bottom:5px;"><span
                                                            class="fa fa-eye"> Currier</span></button>
                                                            @endif
                                                    {{-- <a href="javascript:void(0)" class="btn btn-warning"
                                                        onclick="statusChange(1,{{ $item->id }})"
                                                        style="font-weight:bold; width:75px; margin-right:5px; margin-bottom:5px;"><span
                                                            class="fa fa-check"> Paid</span></a> --}}
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
    @foreach ($order as $item)
        <!-- Modal -->
        <div class="modal fade" id="Order{{ $item->id }}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document" style="padding-left:17px;">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Order Detail
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <th>Product Name</th>
                                <th>Product Price</th>
                                <th>QTY</th>
                                <th>Total</th>
                            </thead>
                            <tbody>

                                @foreach ($order_detail->where('order_id', $item->id) as $item1)
                                    <tr>
                                        <td>{{ $item1->product_name->name ?? '' }}</td>
                                        <td>{{ $item1->price ?? '' }}</td>
                                        <td>{{ $item1->qty ?? '' }}</td>
                                        <td>{{ $item1->total ?? '' }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="Currier{{ $item->id }}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document" style="padding-left:17px; width:50%;">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Add Currier
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('order.currier') }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <input type="hidden" name="id" value="{{$item->id}}">
                                    <select name="currier_id" class="form-control" id="" required>
                                        <option disabled selected>--Select--</option>
                                        @foreach ($currier as $item)
                                            <option value="{{ $item->id }}">{{ $item->name ?? '' }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
@endsection


@section('after-script')
    <script type="text/javascript">
        $('#status-dropdown').on('change', function() {
            var status = this.value;
            var id = document.getElementById("v_id").value;
            $.ajax({
                url: "{{ url('change-status') }}",
                type: "GET",
                data: {
                    id: id,
                    change: status,
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
