@extends('customer.layout.base')
@section('title', 'Reviews')
@section('icon', 'fa-tachometer-alt')
@section('content')
    <div class="container-fluid">
        <div class="col-md-10 offset-md-1">
        @if(!empty($reviews) && count($reviews) > 0)
            @foreach($reviews as $review)
            <div class="card order-card text-secondary">
                <div class="card-body">
                    <h6 class="text-primary">{{ $review->vendor->biz_name}}</h6>
                        <h6>

                            <div class="containerdiv">
                                <div>
                                    <img src="https://image.ibb.co/jpMUXa/stars_blank.png" alt="img">
                                </div>
                                <div class="cornerimage" style="width:calc({{($review->rating / 5)}} * 100%);">
                                    <img src="https://image.ibb.co/caxgdF/stars_full.png" alt="">
                                </div>
                            </div>
                        </h6>
                        		<br>	
                        
                    <p>{{$review->feedback}}</p>
                    <div class="text-right">{{$review->created_at->DiffForHumans()}}</div>
                </div>
                
            </div>
            @endforeach
        @else
            <tr>
                <td colspan="6">
                    <div class="d-flex justify-content-center flex-column align-items-center">
                        <div class="align-items-center"><i class="fas fa-fw fa-shipping-fast fa-2x"></i></div>
                        <div>You have no Reviews yet</div>
                    </div>
                </td>
            </tr>
        @endif
            

            <div class="card order-card text-secondary">
                <div class="card-body">
                    <h6 class="text-primary">Johnny just come</em> 
                        <i class="fa fa-star text-warning"></i>
                        <i class="fa fa-star text-warning"></i>
                        <i class="fa fa-star text-warning"></i>
                        <i class="fa fa-star text-warning"></i>
                        <i class="fa-stack">
                        <i style="color: #eeeeee;" class="fa-stack-1x fas fa-star"></i>						
                        <i style="color: #ffc107;" class="fa-stack-1x fas fa-star-half"></i>
                        </i>
                    </h6>
                        			
                    <p>I really like how this fits and looks. I have purchased other similar prww</p>
                    <div class="text-right">{{$review->created_at->DiffForHumans()}}</div>
                </div>
                
            </div>
        </div>
    </div>

@endsection()