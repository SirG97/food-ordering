@include('includes.head')

<div class="wrapper" id="root">
    @include('includes.nav')

    {{--Hero section--}}
    <div class="hero d-flex justify-content-center">
        <div class="hero-text d-flex align-items-center justify-content-center">
            <div class="d-flex flex-column hero-inner-text text-center ">
                <h3 class="text-white">Eat fresh and healthy food</h3>
                <p class="text-white">Get Delicious, healthy meal Prepared by best resturants and delivered to your doorstep. We also deliver fresh foods. What are you waiting for, place your order now!</p>

            </div>
        </div>


    </div>

    {{--Search Bar section--}}
    <div class="d-flex justify-content-center hero-search-container mx-2">
        <section class="hero-search" style="">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-10 search-input"  style="">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <select class="custom-select form-control form-control-lg" id="inputGroupSelect01">
                                        <option selected>Select city</option>
                                        <option value="1">Port-Harcourt</option>
                                        <option value="2">Owerri</option>
                                        <option value="3">Enugu</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input type="email" class="form-control form-control-lg" value="" id="area" name="area" placeholder="Your Area">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-lg" value="" id="meal" name="meal" placeholder="Your Meal">
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-2 theme-bg search-btn d-flex justify-content-center">
                        <div class="d-flex justify-content-center align-items-center py-2">
                            <div class="align-items-center theme-bg">
                                <a href="/restaurant" class="theme-bg" id="m-srch-btn">PLACE ORDER</a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>
    </div>

    {{--How it works section--}}
    <section class="how-it-works d-flex justify-content-center flex-column">
        <div class="how-it-works-header justify-content-center d-flex">
            <h3>How it Works</h3>
        </div>
        <div class="how-it-works-content">
            <div class="row">
                <div class="col-md-4">
                    <div class="how-widget">
                        <div class="how-widget-img">
                            <img src="img/plate.png" alt="">
                        </div>
                        <div class="how-widget-text">
                            <h4>Pick Meals</h4>
                            <p>Choose any meal from your favourite resturants or any resturants close to you</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="how-widget">
                        <div class="how-widget-img">
                            <img src="img/card.png" alt="">
                        </div>
                        <div class="how-widget-text">
                            <h4>Make Payment</h4>
                            <p>Choose any meal from your favourite resturants or any resturants close to you</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="how-widget">
                        <div class="how-widget-img">
                            <img src="img/deliver.png" alt="">
                        </div>
                        <div class="how-widget-text">
                            <h4>Fast Delivery</h4>
                            <p>Choose any meal from your favourite resturants or any resturants close to you</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{--How it works section ends--}}

    {{--Metrics--}}

    <section class="metrics d-flex">
        <div class="container">
            <div class="row">
                <div class="col-md-4 d-flex justify-content-center">
                    <div class="metric-item align-items-center text-center">
                        <div class="metric-number">3000+</div>
                        <div class="metric-title">Dishes Delivered</div>
                    </div>
                </div>
                <div class="col-md-4 d-flex justify-content-center">
                    <div class="metric-item align-items-center text-center">
                        <div class="metric-number">500</div>
                        <div class="metric-title">Enthusiastic Customers</div>
                    </div>
                </div>
                <div class="col-md-4 d-flex justify-content-center">
                    <div class="metric-item align-items-center text-center">
                        <div class="metric-number">10</div>
                        <div class="metric-title">Energetic Vendors</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{--Metrics ends here--}}
    {{--Browse restaurant section--}}

    <section class="restaurant d-flex justify-content-center flex-column">
        <div class="restaurant-header justify-content-center d-flex">
            <h3>Browse through restaurants & menus</h3>
        </div>
        <div class="restaurant-content">
            <div class="row">
                @foreach($vendors as $vendor)
                    <div class="col-md-3 mb-3">
                        <div class="card featured-card" style="">
                            <img class="card-img-top" src="{{$vendor['banner']}}" alt="Card image cap" style="height: 160px">
                            <div class="card-body">
                                <h6 class="card-title">{{$vendor['biz_name']}}</h6>
{{--                                <div class="meta d-flex flex-row align-items-center">--}}
{{--                                    <div class="justify-content-center">--}}
{{--                                        <div class="rating-badge badge-secondary px-2 mr-2">--}}
{{--                                            4.0--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="justify-content-center">--}}
{{--                                        <div class="containerdiv d-inline-block mr-2">--}}
{{--                                            <div>--}}
{{--                                                <img src="/img/stars_blank.png" alt="img">--}}
{{--                                            </div>--}}
{{--                                            <div class="cornerimage" style="width:calc(100%);">--}}
{{--                                                <img src="/img/stars_full.png" alt="">--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="justify-content-center">--}}
{{--                                        <div class="total-order mr-1 btn-outline-secondary">400 Orders</div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
                                <p class="card-text">{{$vendor['description']}}</p>
                                <a href="/restaurant/{{$vendor['vendor_id']}}" class="btn btn-block theme-bg view-more">View more</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="more-btn d-flex justify-content-center">
            <a href="/restaurants" class="btn btn-outline-light px-2 align-items-center btn-block">View all restaurant</a>
        </div>
    </section>

</div>

@include('includes.footer')

