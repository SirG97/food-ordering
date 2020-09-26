@extends('customer.layout.base')
@section('title', 'Orders')
@section('icon', 'fa-tachometer-alt')
@section('content')
    <div class="container">
        <div class="row">
            <div class="offset-md-2"></div>
            <div class="col-md-8">
                <div class="table-responsive">
                    <table class="table mt-4 order-t-header ">
                        <thead>
                        <tr>
                            <th scope="col">Vendor</th>
                            <th scope="col">Rating</th>
                            <th scope="col">Comment</th>
                            <th scope="col">Time</th>
                        </tr>
                        </thead>
                        <tbody class="order-body">
                            @if(!empty($reviews) && count($reviews) > 0)
                                @foreach($reviews as $review)
                                    <tr class="my-3">
                                        <td>{{ $review->vendor->biz_name}}</td>
                                        <td> <div class="justify-content-center">
                                                <div class="containerdiv d-inline-block mr-2">
                                                    <div>
                                                        <img src="/img/stars_blank.png" alt="img">
                                                    </div>
                                                    <div class="cornerimage" style="width:calc(100%);">
                                                        <img src="/img/stars_full.png" alt="">
                                                    </div>
                                                </div>
                                            </div></td>
                                        <td>{{$review->feedback}}</td>
                                        <td>{{$review->created_at->DiffForHumans()}}</td>
                                    </tr>

                                @endforeach
                            @else
                                <tr>
                                    <td colspan="4">
                                        <div class="d-flex justify-content-center flex-column align-items-center">
                                            <div class="align-items-center"><i class="fas fa-fw fa-comment fa-2x"></i></div>
                                            <div>You have no Reviews yet</div>
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
   

@endsection()