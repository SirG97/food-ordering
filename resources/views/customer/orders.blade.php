@extends('customer.layout.base')
@section('title', 'Orders')
@section('icon', 'fa-tachometer-alt')
@section('content')
    <div class="container-fluid">

        <div class="row">
            <div class="col-md-12">
                <div class="custom-panel card py-2">
                    <div class="font-weight-bold text-secondary mb-1 py-3 px-3">
                        Orders
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover ">
                            <thead class="trx-bg-head text-secondary py-3 px-3">
                            <tr>
                                <th scope="col">Status</th>
                                <th scope="col">Order ID</th>
                                <th scope="col">Restaurant</th>
                                <th scope="col">Amount</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody class="table-style">
                                @if(!empty($orders) && count($orders) > 0)
                                    @foreach($orders as $order)<tr>
                                        <td scope="row">
                                            @if($order['status'] === 'delivered')
                                                <span class="badge badge-success">
                                                    <i class="fas fa-fw fa-check-circle"></i>
                                                    delivered
                                                </span>
                                            @elseif($order['status'] === 'ongoing')
                                            <span class="badge badge-info">
                                                <i class="fas fa-fw fa-shipping-fast text-info"></i>

                                                Ongoing
                                                </span>
                                            @elseif($order['status'] === 'paid')
                                               <span class="badge badge-primary"> <i class="fas fa-fw fa-check"></i> Paid</span>
                                            @elseif($order['status'] === 'uncompleted')
                                                <span class="badge badge-danger">
                                                <i class="fas fa-fw fa-times-circle"></i>
                                                </span>
                                            @endif
                                        </td>
                                        <td>#{{ $order['order_id'] }}</td>
                                        <td>{{ $order->vendor->biz_name}}</td>
                                        <td>{{ $order['grand_total'] }}</td>
                                        <td class="table-action d-flex flex-nowrap">
                                            <a href="/order/{{ $order['order_id'] }}" ><i class="fas fa-fw fa-eye text-success" title="View order details"></i></a> &nbsp; &nbsp;
                                         </i> &nbsp; &nbsp;
            
                                        </td>

                                    </tr>
                                    @endforeach
                                    
                                @else
                                    <tr>
                                        <td colspan="6">
                                            <div class="d-flex justify-content-center flex-column align-items-center">
                                                <div class="align-items-center"><i class="fas fa-fw fa-shipping-fast fa-2x"></i></div>
                                                <div>No Orders yet</div>
                                            </div>
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                    

                </div>
            </div>

        </div>
    </div>

@endsection()