@include('includes.head')
<div class="wrapper">
    {{-- Navbar --}}
    <div>
        <nav class="navbar navbar-expand-lg navbar-light navbar-transparent custom">
            <a class="navbar-brand" href="#"><i class="fas fa-hamburger"></i>GFoods</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse " id="navbarNavDropdown">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active px-3">
                        <a class="nav-link" href="#">Resaturants</a>
                    </li>

                    <li class="nav-item px-3">
                        <a class="nav-link" href="#">Become a Vendor</a>
                    </li>

                    <li class="nav-item px-3">
                        <a class="nav-link" href="#">Contact</a>
                    </li>
                    <!-- <li> -->

                    <!-- </li> -->

                </ul>

                <ul class="navbar-nav mr-3">
                    @if(isAuthenticated())
                        <div class="dropdown">
                            <button class="auth-btn btn auth btn-sm  dropdown-toggle " type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{ customer()->firstname }}
                            </button>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="/customer/orders">Recent orders</a>
                                <a class="dropdown-item" href="/customer">Profile</a>
                                <a class="dropdown-item" href="/customer/logout">Logout</a>
                            </div>
                        </div>
                    @else
                        <li class="nav-item px-3 ">
                            <a class="auth-btn btn auth btn-sm" href="/customer/login">Login</a>
                        </li>
                        <li class="nav-item px-3 ">
                            <a class="auth-btn btn auth btn-sm" href="/customer/signup">Signup</a>
                        </li>
                    @endif
                </ul>
            </div>
        </nav>
    </div>
    <div class="container" id="root" style="margin-top: 20px;" data-token="{{$token}}">
        <div class="review-breadcrumb">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item"><a href="/restaurants">Restaurant</a></li>
                    <li class="breadcrumb-item"><a href="/restaurant/">Johnny</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Checkout</li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-md-12">
                @include('includes.message')
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="revieworder-card">
                    <div class="card">
                        <h5 class="card-header">Payment Summary</h5>
                        <div class="card-body">
                            <div class="voucher-wrapper">
                                <div class="voucher">
                                    <form class="form-inline">
                                        <label class="sr-only" for="inlineFormInputName2">Name</label>
                                        <input type="text" class="form-control  mb-2 mr-sm-2" id="inlineFormInputName2" placeholder="Voucher Code">

                                        <button type="submit" class="btn mb-2 voucher-btn theme-bg">Submit</button>
                                    </form>
                                </div>
                            </div>
                            <div class=" d-flex justify-content-end flex-column">
                                <div class="row">
                                    <div class="offset-md-8"></div>
                                    <div class="col-md-4">
                                        <div class="review-cart p-3 drop-shadow">
                                            <div class="subtotal-container d-flex justify-content-between">
                                                <div class="total-title">Subtotal</div>
                                                {{--                                                        @{{ cartTotal }}--}}
                                                <div id="subtotal">200</div>
                                            </div>
                                            <div class="del-container d-flex justify-content-between">
                                                <div class="total-title">Delivery fee</div>
                                                <div id="delivery">500</div>
                                            </div>
                                            <div class="grand-container d-flex justify-content-between">
                                                <div class="total-title grand-title font-weight-bold">Grand total</div>
                                                <div id="grand" class="font-weight-bold total-value">@{{ cartTotal }}</div>
                                            </div>
                                            <button class="btn btn-block theme-bg checkout-btn">Place Order</button>
                                        </div>

                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="revieworder-card">
                    <div class="card">
                        <h5 class="card-header">Delivery address</h5>
                        <div class="card-body">
                            <div class="review-address">
                                Johnny Wills | No 16 Shilla Ekond Street, Off Portharcourt Rood | +2348569708544
                            </div>
                        </div>
                    </div>
                </div>
                <div class="revieworder-card">
                    <div class="card">
                        <h5 class="card-header">Delivery Time</h5>
                        <div class="card-body">
                            <div class="review-delivery-time">
                                <div class="">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1">
                                        <label class="form-check-label" for="inlineRadio1">Now</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
                                        <label class="form-check-label" for="inlineRadio2">Pre-order</label>
                                    </div>
                                </div>
                                <div class="pre-order">
                                    <span>Please check the time for the pre-order option. Endeavour to Order an hour before the time.</span>
                                    <form>
                                        <div class="form-row align-items-center">
                                            <div class="col-sm-3 my-1">
                                                <input type="date" class="form-control" id="inlineFormInputName" placeholder="Date">
                                            </div>
                                            <div class="col-sm-3 my-1">
                                                <input type="time" class="form-control" id="inlineFormInputName" placeholder="Time">

                                            </div>

                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="revieworder-card">
                    <div class="card">
                        <h5 class="card-header">Order Summary</h5>
                        <div class="card-body">
                            <div class=" d-flex justify-content-end flex-column">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="o-sum-title ">
                                            <h6 class="pl-3">Amala Shitta</h6>
                                        </div>

                                    </div>
                                    <div class="col-md-12 order-items">
                                        <table class="table table-borderless">
                                            <thead>
                                            <tr>
                                                <th scope="col">item(s)</th>
                                                <th scope="col">Price</th>
                                                <th scope="col">Qty</th>
                                                <th scope="col">Total</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                <tr >

                                                <th scope="row">Ewedu and Gbegiri</th>
                                                <td>$300</td>
                                                <td>
                                                    <button type="button" class="btn btn-sm theme-bg update-btn" @click="updateQuantity(item.food_id, '-')"><i class="fa fa-minus"></i> </button>
                                                    <span class="font-weight-bold product-price">3</span>
                                                    <button type="button" class="btn theme-bg update-btn btn-sm"  @click="updateQuantity(item.food_id, '+')"><i class="fa fa-plus"></i> </button>
                                                </td>
                                                <td>$12000</td>
                                                <td><span @click="removeItem()">remove <i class="fa fa-times"></i></span></td>

                                            </tr>
                                                <tr >

                                                <th scope="row">Ewedu and Gbegiri</th>
                                                <td>$300</td>
                                                <td>
                                                    <button type="button" class="btn btn-sm theme-bg update-btn" @click="updateQuantity(item.food_id, '-')"><i class="fa fa-minus"></i> </button>
                                                    <span class="font-weight-bold product-price">3</span>
                                                    <button type="button" class="btn theme-bg update-btn btn-sm"  @click="updateQuantity(item.food_id, '+')"><i class="fa fa-plus"></i> </button>
                                                </td>
                                                <td>$12000</td>
                                                <td><span @click="removeItem()">remove <i class="fa fa-times"></i></span></td>

                                            </tr>
                                                <tr >

                                                    <th scope="row">Ewedu and Gbegiri</th>
                                                    <td>$300</td>
                                                    <td>
                                                        <button type="button" class="btn btn-sm theme-bg update-btn" @click="updateQuantity(item.food_id, '-')"><i class="fa fa-minus"></i> </button>
                                                        <span class="font-weight-bold product-price">3</span>
                                                        <button type="button" class="btn theme-bg update-btn btn-sm"  @click="updateQuantity(item.food_id, '+')"><i class="fa fa-plus"></i> </button>
                                                    </td>
                                                    <td>$12000</td>
                                                    <td><span @click="removeItem()">remove <i class="fa fa-times"></i></span></td>

                                                </tr>
                                                <tr >

                                                    <th scope="row">Ewedu and Gbegiri</th>
                                                    <td>$300</td>
                                                    <td>
                                                        <button type="button" class="btn btn-sm theme-bg update-btn" @click="updateQuantity(item.food_id, '-')"><i class="fa fa-minus"></i> </button>
                                                        <span class="font-weight-bold product-price">3</span>
                                                        <button type="button" class="btn theme-bg update-btn btn-sm"  @click="updateQuantity(item.food_id, '+')"><i class="fa fa-plus"></i> </button>
                                                    </td>
                                                    <td>$12000</td>
                                                    <td><span @click="removeItem()">remove <i class="fa fa-times"></i></span></td>

                                                </tr>
                                                <tr>
                                                    <th scope="row" colspan="3">Total</th>
                                                    <td>$2300</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

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
                          data-customer-email="{{ customer()->email }}"
                          data-public-key="{{ \App\Classes\Session::get('public_key') }}"

                    >
                    </span>
                        <div class="col-md-12">
                            <!-- <a href="/revieworder" v-if="authenticated" class="btn btn-block btn-danger text-uppercase" :disabled="disableCheckoutBtn">checkout</a> -->
                            <button type="submit" v-if="authenticated" :disabled="disableCheckoutBtn"  @click.prevent="checkout" class="btn btn-success btn-block">Checkout</button>
                            <span v-else>
                            <a href="/customer/login" class="btn btn-block btn-success text-uppercase" :disabled="disableCheckoutBtn">Login & Checkout</a>
                        </span>

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
</div>


{{--footer--}}
@include('includes.footer')


