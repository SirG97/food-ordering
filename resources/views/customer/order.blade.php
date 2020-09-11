@extends('customer.layout.base')
@section('title', 'Orders')
@section('icon', 'fa-tachometer-alt')
@section('content')
    <div class="container-fluid">

        <div class="row">
        <div class="custom-panel card py-2" >
                    <div class="font-weight-bold text-secondary mb-1 py-3 px-3">
                        Customer contributions
                    </div>
                    <div class="row cool-border-top ">
                        <div class="col-md-12">
                            <div class="d-flex flex-column p-3 contribution-overview">
                                <div class="d-flex justify-content-between">
                                    <div class=""><h6>Total Contribution</h6></div>
                                    <div class=""><h6>&#8358;9</h6></div>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <div class=""><h6>Total Withdrawal</h6></div>
                                    <div class=""><h6>&#8358;9</h6></div>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <div class=""><h6>Balance</h6></div>
                                    <div class=""><h6>&#8358;9</h6></div>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <div class=""><h6>Loan</h6></div>
                                    <div class=""><h6>&#8358;8</h6></div>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <div class=""><h6>Service Charge</h6></div>
                                    <div class=""><h6>&#8358;0</h6></div>
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
                                                <td scope="row">{{ $item['name'] }}</td>
                                                <td>{{ $item['request_type'] }}</td>
                                                <td>{{ $item['savings_type'] }}</td>
                                                <td>{{ $item['firstname'] }}</td>
                                                
                                            </tr>
                                        @endforeach

                                        </tbody>
                                    </table>

                                    @else
                                        <div class="table-responsive">
                                            <table class="table table-hover ">
                                                <thead class="trx-bg-head text-secondary py-3 px-3">
                                                <tr>
                                                    <th scope="col">Pin</th>
                                                    <th scope="col">Amount</th>
                                                    <th scope="col">Daily Amount</th>
                                                    <th scope="col">Balance</th>
                                                    <th scope="col">Date</th>
                                                </tr>
                                                </thead>
                                                <tbody class="table-style">
                                                <tr>
                                                    <td colspan="5">
                                                        <div class="d-flex justify-content-center">No cotributions yet</div>
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>
                                            @endif

                                        </div>
                                </div>
                        </div>
                    </div>
                </div>

        </div>
    </div>

@endsection()