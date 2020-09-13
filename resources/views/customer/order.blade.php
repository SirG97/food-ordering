@extends('customer.layout.base')
@section('title', 'Orders')
@section('icon', 'fa-tachometer-alt')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="custom-panel card py-2" >
                <div class="font-weight-bold text-secondary mb-1 py-3 px-3">
                    Order details
                </div>
                <div class="row cool-border-top ">
                    <div class="col-md-12">
                        <div class="d-flex flex-column p-3 contribution-overview">
                            <div class="d-flex justify-content-between">
                                <div class=""><h6>Order ID</h6></div>
                                <div class=""><h6>#{{ $order->order_id }}</h6></div>
                            </div>
                            <div class="d-flex justify-content-between">
                                <div class=""><h6>Restaurant Name</h6></div>
                                <div class=""><h6>{{ $order->vendor->biz_name }}</h6></div>
                            </div>
                            
                        </div>
                    </div>
                    <div class="col-md-12">
                        @if(!empty($order->orderItem) && count($order->orderItem) > 0)
                            <div class="table-responsive">
                                <table class="table table-hover ">
                                    <thead class="trx-bg-head text-secondary py-3 px-3">
                                    <tr>
                                        <th scope="col">Name</th>
                                        <th scope="col">Amount</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">Total</th>
                                        
                                    </tr>
                                    </thead>
                                    <tbody class="table-style">
                                        @foreach($order->orderItem as $item)
                                            <tr>
                                                <td scope="row">{{ $item->food->name }}</td>
                                                <td>&#8358;{{ $item['unit_price'] }}</td>
                                                <td>{{ $item['quantity'] }}</td>
                                                <td >&#8358;{{ $item['total'] }}</td>
                                                
                                            </tr>
                                        @endforeach
                                        <tr>
                                            <td class="font-weight-bold">Total</td>
                                            <td></td>
                                            <td></td>
                                            <td class="font-weight-bold">&#8358;{{ $order->total }}</td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold">Delivery fee</td>
                                            <td></td>
                                            <td></td>
                                            <td class="font-weight-bold">&#8358;{{$order->delivery_fee}}</td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold">Grand total</td>
                                            <td></td>
                                            <td></td>
                                            <td class="font-weight-bold">&#8358;{{ $order->grand_total }}</td>
                                        </tr>
                                    </tbody>
                                </table>

                                @else
                                    <div class="d-flex justify-content-center">No cotributions yet</div>
                                @endif

                            </div>
                        </div>
                    </div>
                    <div class="panel-footer py-1 mt-0 mr-3 d-flex justify-content-end">
                        <a href="#" class="btn btn-primary btn-sm px-3" data-toggle="modal" data-target="#exampleModalCenter">Review Restaurant</a>
                    </div>
                </div>
                
            </div>
        </div>
    </div>


<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Review</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="">
            <i class="fa fa-star" data-index="0"></i>
            <i class="fa fa-star" data-index="1"></i>
            <i class="fa fa-star" data-index="2"></i>
            <i class="fa fa-star" data-index="3"></i>
            <i class="fa fa-star" data-index="4"></i>
            <span id="star-text"></span>
        </div>
        <div class="form-group">
            <label for="exampleFormControlTextarea1">Feedback</label>
            <textarea class="form-control" id="rating_feedback" rows="3"></textarea>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="save-review">Save review</button>
      </div>
    </div>
  </div>
</div>
@endsection()