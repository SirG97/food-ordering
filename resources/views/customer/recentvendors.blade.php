@extends('customer.layout.base')
@section('title', 'Recent Vendors')
@section('icon', 'fa-tachometer-alt')
@section('content')
    <div class="container">
        <div class="row mx-1">
        @if(!empty($orders) && count($orders) > 0)
                @foreach($orders as $order)
                    <div class="card mx-3 w-100">
                        <div class="row p-1">
                            <div class="col-md-4">
                                <img src="/{{ $order->vendor->banner == false ? '/img/placeholder-vendor-desktop.svg' : str_replace('\\', '/', $order->vendor->banner)}}" class="w-100">
                            </div>
                            <div class="col-md-8">
                                <div class="card-block px-3">
                                <h4 class="card-title">{{ $order->vendor->biz_name }}</h4>
                                <p class="card-text">{{ $order->vendor->description}}</p>
                                
                                <a href="/restaurant/{{ $order->vendor->vendor_id }}" class="btn btn-primary">Visit</a>
                            </div>
                        </div>
                    </div>
                @endforeach
                
            @else
                <div class="d-flex justify-content-center flex-column align-items-center w-100">
                    <div class="align-items-center"><i class="fas fa-fw fa-shipping-fast fa-2x"></i></div>
                    <div>No Orders yet</div>
                </div>
            @endif

        </div>
    </div>

@endsection()