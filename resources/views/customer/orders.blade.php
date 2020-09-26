@extends('customer.layout.base')
@section('title', 'Orders')
@section('icon', 'fa-tachometer-alt')
@section('content')
    <h5 class="px-2 py-3">Your Orders</h5>
    <div class="table-responsive">
        <table class="table mt-3 order-t-header ">
            <thead>
            <tr>
                <th scope="col">Order ID</th>
                <th scope="col">Status</th>
                <th scope="col">Vendor</th>
                <th scope="col">Amount</th>
                <th scope="col">Date</th>
            </tr>
            </thead>
            <tbody class="order-body">
                @if(!empty($orders) && count($orders) > 0)
                    @foreach($orders as $order)
                        <tr>
                            <td scope="row">#{{ $order['order_id'] }}</td>
                            <td >
                                @if($order['status'] === 'delivered')
                                    <span class="badge badge-success">
                                        <i class="fas fa-fw fa-check-circle"></i>Delivered
                                    </span>
                                @elseif($order['status'] === 'ongoing')
                                    <span class="badge badge-info">
                                        <i class="fas fa-fw fa-shipping-fast text-info"></i>Ongoing
                                    </span>
                                @elseif($order['status'] === 'paid')
                                    <span class="badge badge-primary"> <i class="fas fa-fw fa-check"></i> Paid</span>
                                @elseif($order['status'] === 'cancelled')
                                    <span class="badge badge-danger">
                                        <i class="fas fa-fw fa-times-circle"></i>Cancelled
                                    </span>
                                @endif
                            </td>

                            <td>{{ $order->vendor->biz_name}}</td>
                            <td>{{ $order['grand_total'] }}</td>
                            <td>{{$order['created_at']->DiffForHumans()}}</td>
        {{--                    <td class="table-action d-flex flex-nowrap">--}}
        {{--                        <a href="/order/{{ $order['order_id'] }}" ><i class="fas fa-fw fa-eye text-success" title="View order details"></i></a> &nbsp; &nbsp;--}}
        {{--                        </i> &nbsp; &nbsp;--}}

        {{--                    </td>--}}
                        </tr>
                    @endforeach

                @else
                    <tr>
                        <td colspan="5">
                            <div class="d-flex justify-content-center flex-column align-items-center">
                                <div class="align-items-center"><i class="fas fa-fw fa-shipping-fast fa-2x"></i></div>
                                <div>No orders yet</div>
                            </div>
                        </td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>

@endsection()