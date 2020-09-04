
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
    <script src="https://checkout.flutterwave.com/v3.js"></script>
    <!-- <script src="https://api.ravepay.co/flwv3-pug/getpaidx/api/flwpbf-inline.js"></script> -->
    <script src="/js/vue.js"></script>
    <script src="https://unpkg.com/vue-ravepayment/dist/rave.min.js"></script>
    <script src="/js/axios.min.js"></script>
    <script src="/js/script.js"></script>
    <script src="/js/revieworder.js"></script>
    <script src="/js/payment.js"></script>

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
                    <a class="nav-link btn btn-danger btn-sm" href="/authenticate">Login/Signup</a>
                </li>
            </ul>
        </div>
    </nav>
</div>


{{--<div class="order-timeline d-flex justify-content-center">--}}
{{--    <ul class="order-steps d-flex justify-content-center">--}}
{{--        <li><span class="order-steps-box"><i class="fa fa-check"></i></span></li>--}}
{{--        <li><span class="order-steps-box"><i class="fa fa-check"></i></span></li>--}}
{{--        <li><span class="order-steps-box"><i class="fa fa-check"></i></span></li>--}}
{{--    </ul>--}}
{{--</div>--}}
<div class="container" id="root" style="margin-top: 80px;" data-token="{{$token}}">

    <div class="row">
        <div class="col-md-12">
            @include('includes.message')
        </div>
    </div>
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
                            <th scope="col">Image</th>
                            <th scope="col">Name</th>
                            <th scope="col">Amount</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Action</th>
                        </tr>
                        </thead>
                        <tbody class="table-style">
                            <tr v-if="!items.length">
                                <td colspan="5">
                                    <div class="d-flex justify-content-center">
                                        <i class="fa fa-shopping-cart fa-2x"></i>
                                        Cart is empty
                                    </div>
                                </td>
                            </tr>
                            <tr v-for="item in items">
                                <td><img :src="item.image" alt="" style="border-radius: 50%; height: 50px"> </td>
                                <td>@{{ item.name}}</td>
                                <td>@{{ item.unit_price }}</td>
                                <td> <button type="button" class="btn btn-outline-danger btn-sm p-0 px-1" @click="updateQuantity(item.food_id, '-')"><i class="fa fa-minus"></i> </button>
                                    <span class="font-weight-bold product-price">@{{ item.quantity }}</span>
                                    <button type="button" class="btn btn-outline-success btn-sm p-0 px-1"  @click="updateQuantity(item.food_id, '+')"><i class="fa fa-plus"></i> </button></td>
                                <td><span @click="removeItem(item.index)">remove <i class="fa fa-times"></i></span></td>

                            </tr>


                            <div class="text-center">
                                <i v-show="cartLoading" class="fa fa-spinner fa-spin" style="font-size: 3rem; padding-bottom: 3rem; position:absolute;
                   top:50%; bottom: 50%" ></i>
                            </div>

                        </tbody>
                    </table>
                </div>
                <div class="row mx-1">
                    <div class="col-md-12 ">
                        <div class="form-group">
                            <label for="address">Address</label>
                            <select class="form-control" id="address">
                                <option>No 10 Obanye Street Onitsha</option>
                            </select>
                        </div>
                    </div>
                

                </div>
                <div class="row">
                    <div class="col-md-6">

                    </div>
                    <div class="col-md-6">
                        <div class="m-3 cart-font">
                            <div class="d-flex justify-content-between">
                                <div >Subtotal</div>
                                <div id="subtotal">@{{ cartTotal }}</div>
                            </div>
                            <div class="d-flex justify-content-between">
                                <div >Delivery fee</div>
                                <div id="delivery">@{{ delivery_fee }}</div>
                            </div>
                            <div class="d-flex justify-content-between">
                                <div class="font-weight-bold">Grand total</div>
                                <div id="grand" class="font-weight-bold">@{{ grandTotal }}</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mx-1">
                    <span id="properties"
                            data-customer-email="{{ user()->email }}"
                            data-public-key="{{ \App\Classes\Session::get('public_key') }}"

                            >
                    </span>
                    <div class="col-md-12">
                        <!-- <form method="POST" action="/pay">
                            <input type="hidden" name="token" value="{{\App\Classes\CSRFToken::_token()}}">
                            <button type="submit"  id="checkout" class="btn btn-success btn-block">Checkout</button>
                        </form> -->
                        <button type="submit" :disabled="disableCheckoutBtn"  @click.prevent="checkout" class="btn btn-success btn-block">Checkout</button>
                    </div>
                    
                </div>
                
            </div>
        </div>
        <div class="col-md-12">
            
        </div>

    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="custom-panel py-2">
                
            </div>
        </div>
    </div>
</div>

{{--footer--}}
<section id="footer-container">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
                <h5>About Updel </h5>
                <p>UPdel Services is a courier company borne out of the need to bridge
                    the growing gap between the need for fast,
                    flexible supply of delivery service and available options.</p>
            </div>
            <div class="col-md-3 d-flex flex-column">
                <h5>Our Services</h5>
                <p>Breakfast</p>
                <p>Dinner</p>
                <p>Lunch</p>
                <p>Parties</p>
            </div>
            <div class="col-md-3 d-flex flex-column">
                <h5>Sub Services</h5>
                <p>Premium Services</p>
                <p>Precise Delivery Services</p>
                <p>Same Day Delivery</p>
                <p>Two Day Delivery</p>
                <p><a href="/services">See more ...</a></p>
            </div>
            <div class="col-md-3">
                <h5>Contact us</h5>
                <p><i class="fa fa-map-marker-alt"></i> Nationwide</p>
                <div class="d-inline-flex mb-2 justify-content-between">
                    <div class="align-self-start"><i class="fa fa-envelope"></i></div> &nbsp;
                    <div>info@updelservices.com <br>updelservices@gmail.com</div>
                </div>
                <p><i class="fa fa-phone"></i> +2347040463183</p>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-10 col-md-12 col-sm-12">
                <div class="footer-social">
                    <ul>
                        <li><a href="#"><i class="fab fa-linkedin"></i></a></li>
                        <li><a href="#"><i class="fab fa-facebook"></i></a></li>
                        <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                    </ul>
                </div>
                <div class="footer-nav text-center">
                    <ul>
                        <li><a href="" class="footer-lin">Home</a></li>
                        <li><a href="" class="footer-lin">About</a></li>
                        <li><a href="" class="footer-lin">Services</a></li>
                        <li><a href="" class="footer-lin">FAQ</a></li>
                        <li><a href="" class="footer-lin">Contact us</a></li>
                    </ul>
                </div>
                <div class="copyright text-center">
                    <p>Copyright © 2019 All Rights Reserved</p>
                </div>
            </div>
        </div>
    </div>
</section>

</body>
</html>


