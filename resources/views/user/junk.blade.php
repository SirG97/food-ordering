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

<div class="cart-container">
    <section class="curved">
        <div class="desktop-cart-header text-white p-3">
            <p class="text-small text-uppercase help-text">Order from</p>
            <div class="cart-res-name mt-0 mb-1">{{$vendor->biz_name}}</div>
            <p class="text-small text-uppercase help-text">Delivery time</p>
            <div class="cart-res-name mt-0">30min - 85min max</div>
        </div>
    </section>

    <div class="my-3 mx-2 pb-3">
        <div class="cart-item-container">
            <div class="cart-item my-1 py-2" v-for="item in items">
                <div class="cart-product-info d-flex justify-content-between mb-1">
                    <div class="">@{{ item.name }}</div>
                    <div class="">@{{ item.total }}</div>
                </div>
                <div class="d-flex justify-content-between">
                    <span @click="removeItem(item.index)">remove <i class="fa fa-times"></i></span>
                    <div class="d-flex ">
                        <button type="button" class="btn btn-outline-danger btn-sm p-0 px-1" @click="updateQuantity(item.food_id, '-')"><i class="fa fa-minus"></i> </button>
                        <span class="font-weight-bold product-price">@{{ item.unit_price }}</span>
                        <button type="button" class="btn btn-outline-danger btn-sm p-0 px-1"  @click="updateQuantity(item.food_id, '+')"><i class="fa fa-plus"></i> </button>
                    </div>
                </div>
            </div>

        </div>
        <div class="total-container">
            <div class="subtotal-container d-flex justify-content-between">
                <div >Subtotal</div>
                <div id="subtotal">@{{ cartTotal }}</div>
            </div>
            <div class="del-container d-flex justify-content-between">
                <div >Delivery fee</div>
                <div id="delivery">{{$vendor->min_delivery}}</div>
            </div>
            <div class="del-container d-flex justify-content-between">
                <div class="font-weight-bold">Grand total</div>
                <div id="grand" class="font-weight-bold">@{{ cartTotal }}</div>
            </div>
        </div>

        <a href="/revieworder" v-if="authenticated" class="btn btn-block btn-danger text-uppercase" :disabled="true">checkout</a>
        <span v-else>
            <a href="/customer/login" class="btn btn-block btn-danger text-uppercase" >checkout</a>
        </span>


        <div class="text-center">
            <i v-show="cartLoading" class="fa fa-spinner fa-spin" style="font-size: 3rem; padding-bottom: 3rem; position:absolute;
                   top:50%; bottom: 50%" ></i>
        </div>
    </div>
</div>








<div class="product-container" id="root" data-id="{{$vendor->vendor_id}}" data-token="{{$token}}">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="restaurant-tabs">
                    <ul class="nav nav-pills d-flex justify-content-start justify-content-sm-around r-tab">
                        <li class="nav-item drop-shadow">
                            <a class="nav-link active" href="#">Menu</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Reviews</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Info</a>
                        </li>

                    </ul>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3">
                <div class="categories mx-0 mb-3 pt-2 pb-0">
                    <div class="category-header font-weight-bold">
                        Categories
                    </div>
                    <ul class="list-group list-group-flush d-flex flex-row flex-lg-column">
                        <li class="list-group-item active">Soup</li>
                        <li class="list-group-item">Rice</li>
                        <li class="list-group-item">Drinks</li>
                        <li class="list-group-item">Swallow</li>
                        <li class="list-group-item">Fries</li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-6 drop-shadow">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card featured-card" style="">
                            <img class="card-img-top" src="/img/Tortellini.png" alt="Card image cap" style="height: 216px">
                            <div class="card-body">
                                <h6 class="card-title">KFC Chicken</h6>
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
                                <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. A, animi consectetur adipisicing elit</p>
                                <a href="/restaurants" class="btn btn-block theme-bg view-more">View more</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card featured-card" style="">
                            <img class="card-img-top" src="/img/Tortellini.png" alt="Card image cap" style="height: 216px">
                            <div class="card-body">
                                <h6 class="card-title">KFC Chicken</h6>
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
                                <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. A, animi consectetur adipisicing elit</p>
                                <a href="/restaurants" class="btn btn-block theme-bg view-more">View more</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card featured-card" style="">
                            <img class="card-img-top" src="/img/Tortellini.png" alt="Card image cap" style="height: 216px">
                            <div class="card-body">
                                <h6 class="card-title">KFC Chicken</h6>
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
                                <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. A, animi consectetur adipisicing elit</p>
                                <a href="/restaurants" class="btn btn-block theme-bg view-more">View more</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card featured-card" style="">
                            <img class="card-img-top" src="/img/Tortellini.png" alt="Card image cap" style="height: 216px">
                            <div class="card-body">
                                <h6 class="card-title">KFC Chicken</h6>
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
                                <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. A, animi consectetur adipisicing elit</p>
                                <a href="/restaurants" class="btn btn-block theme-bg view-more">View more</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Cart--}}
            <div class="col-lg-3 drop-shadow px-2">
                <div class="card r-cart ">
                    <div class="card-header r-cart-header">
                        Your Cart
                    </div>
                    <div class="card-body d-flex justify-content-center">
                        <div class="align-items-center d-flex justify-content-center flex-column mx-auto py-3">
                            <img src="/img/vector.png" alt="">
                            <p>There are no items in your cart</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="alert alert-success" id="toast" role="alert">

</div>




<script src="/js/jquery-3.2.1.min.js"></script>
<script src="/js/bootstrap.bundle.min.js"></script>
<script src="https://checkout.flutterwave.com/v3.js"></script>
<!-- <script src="https://api.ravepay.co/flwv3-pug/getpaidx/api/flwpbf-inline.js"></script> -->
<script src="/js/vue.js"></script>
<script src="https://unpkg.com/vue-ravepayment/dist/rave.min.js"></script>
<script src="/js/axios.min.js"></script>
<script src="/js/script.js"></script>
<script src="/js/revieworder.js"></script>

border: 1px solid #FF922C;























<div class="container">
    <div class="row">
        <div class="md-offset-3"></div>
        <div class="col-md-6">
            <form method="POST" action="storepost.php">
                <div class="form-group">
                    <label for="ptitle">Title</label>
                    <input type="text" class="form-control" id="ptitle" placeholder="Example input">
                </div>
                <div class="form-group">
                    <label for="pauthor">Author</label>
                    <input type="text" class="form-control" id="pauthor" placeholder="Author">
                </div>

                <div class="form-group">
                    <label for="post-t">Bodyd</label>
                    <textarea name="" id="post-t" class="form-control" cols="30" rows="10"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>


















