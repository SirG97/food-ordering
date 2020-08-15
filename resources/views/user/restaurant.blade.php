
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gfood::vendors</title>
    <link rel="favicon" href="/favicon.ico">
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/all.css">
    <link rel="stylesheet" href="/css/fontawesome-all.css">
    <link rel="stylesheet" href="/css/Chart.min.css">
    <link rel="stylesheet" href="/css/style.css">

    <script src="/js/jquery-3.2.1.min.js"></script>
    <script src="/js/bootstrap.bundle.min.js"></script>
    <script src="/js/moment.min.js"></script>
    <script src="/js/vue.js"></script>
    <script src="/js/axios.min.js"></script>
    <script src="/js/script.js"></script>
    <script src="/js/cart.js"></script>

</head>
<body>
<div>
    <nav class="navbar navbar-expand-lg navbar-dark bg-white fixed-top main-menu custom">
        <a class="navbar-brand" href="#"><i class="fas fa-hamburger"></i>GFoods</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse " id="navbarNavDropdown">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active px-3">
                    <a class="nav-link" href="/">Home</a>
                </li>

                <li class="nav-item px-3">
                    <a class="nav-link" href="/cart">vendors</a>
                </li>

                <li class="nav-item px-3">
                    <a class="nav-link" href="/cart"><i class="fa fa-shopping-cart"></i>Cart</a>
                </li>
                <li class="nav-item px-3 ">
                    <a class="nav-link btn btn-danger btn-sm" href="/login">Login/Signup</a>
                </li>
            </ul>
        </div>
    </nav>
</div>
<div class="banner restaurant-main-banner d-flex justify-content-center" style="background-image: url('/{{$vendor->banner == false ? '/img/placeholder-vendor-desktop.svg' :str_replace("\\", "/", $vendor->banner)}}'); width: 100vw">
    <div class="banner-header align-self-end">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item"><a href="/vendors">Vendors</a></li>
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
                <span class="seperator">Delivery time - </span>
                <span class="seperator">More info</span>
            </div>
        </div>
    </div>
</div>
{{--banner ends--}}

{{--product navigation--}}
<div class="restaurant-nav my-1">
    <div class="container">
        <nav class="d-inline-flex flex-nowrap">
            @if(!empty($vendor->foodCategories) && count($vendor->foodCategories) > 0)
                @foreach($vendor->foodCategories as $c)
                    <a class="" href="#{{$c->category_name}}">{{$c->category_name}}</a>
                @endforeach
            @endif
        </nav>
    </div>

</div>
{{--product navigation ends--}}

{{--product listing--}}

<div class="product-container" id="root" data-id="{{$vendor->vendor_id}}">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div v-cloak v-for="menu in menus">
                    <div v-if="menu.food.length !== 0">
                        <nav class="nav nav-tabs customer-nav mr-2" id="myTab" role="tablist">
                            <a aria-controls="general" aria-selected="true" class="nav-link active" data-toggle="tab" href="'#' + menu.category_name"
                               id="general-tab" role="tab">@{{menu.category_name}}</a>
                        </nav>
                        <div class="product-group">
    {{--                            @foreach($c->food as $food)--}}
                                    <div class="product-card py-1" v-for="food in menu.food" style="">
                                        <div class="container-fluid">
                                            <div class="row">

                                                <div class="col-4 col-sm-2 p-img-outer px-1 px-sm-2">
                                                    <div class="card-img-container py-1">
                                                        <img class="card-img align-self-center" :src="'/' + food.image" alt="food.name + 'picture'">
                                                    </div>
                                                </div>
                                                <div class="col-8 col-sm-10 border-danger p-card-outer pl-1 pl-sm-2">
                                                    <div class="product-description p-0 d-flex flex-column justify-content-between">
                                                        <h5 class="card-title mb-0">@{{ food.name }}</h5>
                                                        <p class="card-text">@{{ food.description }}</p>
                                                        <div class="d-flex justify-content-end">
                                                            <span class="font-weight-bold product-price">@{{ food.unit_price }}</span>
                                                            <button type="button" class="btn btn-outline-danger btn-sm p-0 px-1" @click.prevent="addToCart(food.food_id)"><i class="fa fa-plus"></i> </button>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
    {{--                            @endforeach--}}
                            </div>
                    </div>

                </div>
                <div class="text-center">
                    <i v-show="loading" class="fa fa-spinner fa-spin" style="font-size: 3rem; padding-bottom: 3rem; position:fixed;
                   top:50%; bottom: 50%" ></i>
                </div>
            </div>
{{--            Cart--}}
            <div class="col-md-4">
                <div class="cart-container">
                    <section class="curved">
                        <div class="desktop-cart-header text-white p-3">
                            <p class="text-small text-uppercase help-text">Order from</p>
                            <div class="cart-res-name mt-0 mb-1">Johnny Brooka</div>
                            <p class="text-small text-uppercase help-text">Delivery time</p>
                            <div class="cart-res-name mt-0">30min - 85min max</div>
                        </div>
                    </section>

                    <div class="my-3 mx-2 pb-3">
                        <div class="cart-item-container">
                            <div class="cart-item my-1 py-2">
                                <div class="cart-product-info d-flex justify-content-between mb-1">
                                    <div class="">Burger Fries</div>
                                    <div class="">#9000</div>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <span>remove <i class="fa fa-times"></i></span>
                                    <div class="d-flex ">
                                        <button type="button" class="btn btn-outline-danger btn-sm p-0 px-1"><i class="fa fa-minus"></i> </button>
                                        <span class="font-weight-bold product-price">#1250</span>
                                        <button type="button" class="btn btn-outline-danger btn-sm p-0 px-1"><i class="fa fa-plus"></i> </button>
                                    </div>
                                </div>
                            </div>
                            <div class="cart-item my-1 py-2">
                                <div class="cart-product-info d-flex justify-content-between mb-1">
                                    <div class="">Burger Fries</div>
                                    <div class="">#9000</div>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <span>remove <i class="fa fa-close"></i></span>
                                    <div class="d-flex ">
                                        <button type="button" class="btn btn-outline-danger btn-sm p-0 px-1"><i class="fa fa-minus"></i> </button>
                                        <span class="font-weight-bold product-price">#1250</span>
                                        <button type="button" class="btn btn-outline-danger btn-sm p-0 px-1"><i class="fa fa-plus"></i> </button>
                                    </div>
                                </div>
                            </div>
                            <div class="cart-item my-1 py-2">
                                <div class="cart-product-info d-flex justify-content-between mb-1">
                                    <div class="">Burger Fries</div>
                                    <div class="">#9000</div>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <span>remove <i class="fa fa-close"></i></span>
                                    <div class="d-flex ">
                                        <button type="button" class="btn btn-outline-danger btn-sm p-0 px-1"><i class="fa fa-minus"></i> </button>
                                        <span class="font-weight-bold product-price">#1250</span>
                                        <button type="button" class="btn btn-outline-danger btn-sm p-0 px-1"><i class="fa fa-plus"></i> </button>
                                    </div>
                                </div>
                            </div>
                            <div class="cart-item my-1 py-2">
                                <div class="cart-product-info d-flex justify-content-between mb-1">
                                    <div class="">Burger Fries</div>
                                    <div class="">#9000</div>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <span>remove <i class="fa fa-close"></i></span>
                                    <div class="d-flex ">
                                        <button type="button" class="btn btn-outline-danger btn-sm p-0 px-1"><i class="fa fa-minus"></i> </button>
                                        <span class="font-weight-bold product-price">#1250</span>
                                        <button type="button" class="btn btn-outline-danger btn-sm p-0 px-1"><i class="fa fa-plus"></i> </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="total-container">
                            <div class="subtotal-container d-flex justify-content-between">
                                <div >Subtotal</div>
                                <div id="subtotal">#5000</div>
                            </div>
                            <div class="del-container d-flex justify-content-between">
                                <div >Delivery fee</div>
                                <div id="delivery">#600</div>
                            </div>
                            <div class="del-container d-flex justify-content-between">
                                <div class="font-weight-bold">Grand total</div>
                                <div id="grand" class="font-weight-bold">#5600</div>
                            </div>
                        </div>
                        <button class="btn btn-block btn-danger text-uppercase">checkout</button>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">

    </script>

</body>
</html>


