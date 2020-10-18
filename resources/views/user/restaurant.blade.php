@section('extrascript')
    <script src="/js/cart.js"></script>
@endsection
@include('includes.head')

<div class="wrapper" id="vid" data-id="{{$vendor->vendor_id}}">
    {{-- Navbar --}}
    @include('includes.nav')

    {{--    Banner starts--}}
    <div class="banner restaurant-main-banner d-flex justify-content-center" style="background-image: url('/{{$vendor->banner == false ? '/img/placeholder-vendor-desktop.svg' :str_replace("\\", "/", $vendor->banner)}}'); width: 100vw">
        <div class="banner-header align-self-end">
            <div class="container">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item"><a href="/restaurants">Vendors</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{$vendor->biz_name}}</li>
                    </ol>
                </nav>
                <h3>{{$vendor->biz_name}}</h3>
                <div class="more-info d-inline-flex">
                <span>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star-half-alt"></i>
                    <i class="far fa-star-o"></i>
                </span>
                    <span class="seperator">Min. Order - &#8358;{{$vendor->min_order}}</span>
                    <span class="seperator">Min. Delivery fee - &#8358;{{$vendor->min_delivery}}</span>
                </div>
            </div>
        </div>
    </div>
    {{--banner ends--}}


    {{--product listing--}}

    <div class="product-container" id="root" data-id="{{$vendor->vendor_id}}" data-token="{{$token}}">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <div class="restaurant-tabs">
                        <ul class="nav nav-pills d-flex justify-content-start justify-content-sm-around r-tab">
                            <li class="nav-item drop-shadow">
                                <a class="nav-link active" id="menu-tab" data-toggle="tab" href="#menu" role="tab" aria-controls="menu" aria-selected="true">Menu</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="review-tab" data-toggle="tab" href="#review" role="tab" aria-controls="review" aria-selected="true">Reviews</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="info-tab" data-toggle="tab" href="#info" role="tab" aria-controls="info" aria-selected="true">Info</a>
                            </li>

                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-2">
                    <div class="categories mx-0 mb-3 pt-2 pb-0">
                        <div class="category-header font-weight-bold">
                            Categories
                        </div>
                        <ul class="list-group list-group-flush d-flex flex-row flex-lg-column">
                            @if(!empty($vendor->foodCategories) && count($vendor->foodCategories) > 0)
                                @foreach($vendor->foodCategories as $c)
                                <li class="list-group-item">
                                    <a class="" href="#{{$c->category_name}}">{{$c->category_name}}</a>
                                </li>
                                @endforeach
                            @endif
                        </ul>
                    </div>
                </div>
                <div class="col-lg-10 ">
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active drop-shadow" id="menu" role="tabpanel" aria-labelledby="menu-tab">
                                    <div class="row" v-cloak v-for="menu in menus">
                                        <div class="col-md-6" v-if="menu.food.length !== 0" v-for="food in menu.food">
                                            <div class="">
                                                <div class=" my-2" >
                                                    <div class="card featured-card" style="">
                                                        <img class="card-img-top" :src="'/' + food.image" alt="food.name + 'picture'" style="height: 216px">
                                                        <div class="card-body">
                                                            <h6 class="card-title">@{{ food.name }}</h6>
                                                            <div class="meta d-flex flex-row align-items-center">
                                                                <div class="justify-content-center">
                                                                    <div class="rating-badge badge-secondary px-2 mr-2">
                                                                        4.0
                                                                    </div>
                                                                </div>
                                                                <div class="justify-content-center">
                                                                    <div class="containerdiv d-inline-block mr-2">
                                                                        <div>
                                                                            <img src="/img/stars_blank.png" alt="img">
                                                                        </div>
                                                                        <div class="cornerimage" style="width:calc(100%);">
                                                                            <img src="/img/stars_full.png" alt="">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="justify-content-center">
                                                                    <div class="total-order mr-1 btn-outline-secondary">400 Orders</div>
                                                                </div>
                                                            </div>
                                                            <p class="card-text">@{{ food.description }}</p>
                                                            <div class="d-flex justify-content-between">
                                                                <div class="price d-flex flex-row justify-content-around align-items-center">
                                                                    <div class="main-price">&#8358;@{{ food.unit_price }}</div> &nbsp; &nbsp;
                                                                    <div class="sales-price" style="text-decoration: line-through;"></div>
                                                                </div>
                                                                <div class="add-to-cart">
                                                                    <span class="btn theme-bg add-to-cart" @click.prevent="addToCart(food.food_id)">Add to Cart</span>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="review" role="tabpanel" aria-labelledby="review-tab">
                                   <div class="row">
                                       <div class="col-md-12">
                                           <div class="review-container">
                                                <h3>Customer Reviews({{count($reviews)}})</h3>
                                               <div class="list-group list-group-flush mt-3">
                                                   @if(!empty($reviews) && count($reviews) > 0)
                                                       @foreach($reviews as $review)
                                                           <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
                                                               <div class="d-flex w-100 justify-content-between">
                                                                   <div class="name-rating d-flex flex-row">
                                                                       <h6 class="mb-1">{{$review->customer['firstname']}} {{$review->customer['surname']}}</h6>
                                                                       <div class="containerdiv d-inline-block ml-2">
                                                                           <div>
                                                                               <img src="/img/stars_blank.png" alt="img">
                                                                           </div>
                                                                           <div class="cornerimage" style="width:{{($review->rating * 100)/5 }}%;">
                                                                               <img src="/img/stars_full.png" alt="">
                                                                           </div>
                                                                       </div>
                                                                   </div>

                                                                   <small>{{$review->created_at->DiffForHumans()}}</small>
                                                               </div>
                                                               <p class="mb-1">{{$review->feedback}}</p>

                                                           </a>
                                                       @endforeach
                                                   @else
                                                       <a href="#" class="list-group-item list-group-item-action flex-column align-items-center">
                                                           <div class="d-flex justify-content-center flex-column align-items-center">
                                                               <div class="align-items-center"><i class="fas fa-fw fa-shipping-fast fa-2x"></i></div>
                                                               <div>You have no Reviews yet</div>
                                                           </div>
                                                       </a>
                                                   @endif
                                               </div>
                                           </div>
                                       </div>
                                   </div>
                                </div>
                                <div class="tab-pane fade" id="info" role="tabpanel" aria-labelledby="info-tab">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="info-container">
                                                <h3>{{$vendor->biz_name}}</h3>
                                                <ul class="list-group list-group-flush mt-3">
                                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                                        Minimum order amount
                                                        <span class="">&#8358;{{$vendor->min_order}}</span>
                                                    </li>
                                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                                        Delivery hours
                                                        <span class="">{{ date("g:i a", strtotime($vendor->opening_time))}} to {{date("g:i a", strtotime($vendor->closing_time))}}</span>
                                                    </li>

                                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                                        Ratings
                                                        <span class=""> <div class="containerdiv d-inline-block ml-2">
                                                                           <div>
                                                                               <img src="/img/stars_blank.png" alt="img">
                                                                           </div>
                                                                           <div class="cornerimage" style="width:{{($rating * 100)/5 }}%;">
                                                                               <img src="/img/stars_full.png" alt="">
                                                                           </div>
                                                                       </div>({{$rating}})</span>
                                                    </li>

                                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                                        Cuisines
                                                        <span class="">{{$vendor->tags}}</span>
                                                    </li>

                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="col-lg-4">
                            <div class="row">
                                <div class="col-lg-12 drop-shadow px-2">
                                    <div class="card r-cart ">
                                        <div class="card-header r-cart-header">
                                            Your Cart
                                        </div>
                                        <div class="card-body d-flex justify-content-center">
                                            <div class="align-items-center d-flex justify-content-center flex-column mx-auto py-3" v-if="items.length == 0">
                                                <img src="/img/vector.png" alt="">
                                                <p>There are no items in your cart</p>
                                            </div>
                                            <div class="d-flex py-3 w-100 flex-column" v-else>
                                                <div class="item-c">
                                                    <div class="d-flex justify-content-between item" v-for="item in items">
                                                        <div class="d-flex align-items-center justify-content-start">
                                                            <div class="d-flex align-items-center">
                                                                <button type="button" class="btn btn-sm theme-bg update-btn" @click="updateQuantity(item.food_id, '-')"><i class="fa fa-minus"></i> </button>
                                                                &nbsp;
                                                                <span class="font-weight-bold product-price">@{{ item.quantity }}</span>
                                                                &nbsp;
                                                                <button type="button" class="btn btn-sm theme-bg update-btn"  @click="updateQuantity(item.food_id, '+')"><i class="fa fa-plus"></i> </button>
                                                            </div>
                                                            <div class="mx-1 d-flex align-items-center">@{{ item.name }}</div>
                                                        </div>
                                                        <div class="mr-1 d-flex align-items-center justify-content-end">
                                                            <div class="">&#8358;@{{ item.unit_price }}</div>&nbsp;&nbsp;
                                                            <span class="d-flex align-items-center" @click="removeItem(item.index)"><i class="fa fa-inverse fa-minus-circle remove"></i></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="subtotal-container d-flex justify-content-between">
                                                    <div class="total-title">Subtotal</div>
{{--                                                        @{{ cartTotal }}--}}
                                                    <div id="subtotal">&#8358;@{{ cartTotal }}</div>
                                                </div>
                                                <div class="del-container d-flex justify-content-between">
                                                    <div class="total-title">Delivery fee</div>
                                                    <div id="delivery">&#8358;@{{ delivery_fee }}</div>
                                                </div>
                                                <div class="grand-container d-flex justify-content-between">
                                                    <div class="total-title grand-title font-weight-bold">Grand total</div>
                                                    <div id="grand" class="font-weight-bold total-value">&#8358;@{{ grandTotal }}</div>
                                                </div>
                                                <a href="/revieworder/{{$vendor->vendor_id}}" :disabled="true" v-if="authenticated" class="btn btn-block theme-bg checkout-btn">Proceed to Checkout</a>
                                                <span v-else>
                                                    <a href="/customer/login" class="btn btn-block theme-bg checkout-btn">Login & Checkout</a>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                {{-- Cart--}}

            </div>
        </div>
    </div>
    <div class="alert alert-success" id="toast" role="alert">

    </div>
</div>
@include('includes.footer')


