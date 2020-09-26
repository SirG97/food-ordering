@section('flutterwave')
    <script src="https://checkout.flutterwave.com/v3.js"></script>
@endsection
@section('extrascript')
    <script src="/js/revieworder.js"></script>
@endsection
@include('includes.head')

<div class="wrapper">
    {{-- Navbar --}}
   @include('includes.nav')
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
                                                <tr v-if="!items.length">
                                                    <td colspan="5">
                                                        <div class="d-flex justify-content-center">
                                                            <i class="fa fa-shopping-cart fa-2x"></i>
                                                            Cart is empty
                                                        </div>
                                                    </td>
                                                </tr>

                                            <tr v-for="item in items">
                                                <th scope="row">@{{ item.name}}</th>
                                                <td>&#8358;@{{ item.unit_price }}</td>
                                                <td>
                                                    <button type="button" class="btn btn-sm theme-bg update-btn" @click="updateQuantity(item.food_id, '-')"><i class="fa fa-minus"></i> </button>
                                                    <span class="font-weight-bold product-price">@{{ item.quantity }}</span>
                                                    <button type="button" class="btn theme-bg update-btn btn-sm"  @click="updateQuantity(item.food_id, '+')"><i class="fa fa-plus"></i> </button>
                                                </td>
                                                <td>&#8358;@{{ item.unit_price * item.quantity }}</td>
                                                <td><span @click="removeItem(item.index)">remove <i class="fa fa-times"></i></span></td>
                                            </tr>
                                            </tbody>
                                        </table>
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
                                            <span id="properties"
                                                  data-customer-email="{{ customer()->email }}"
                                                  data-public-key="{{ \App\Classes\Session::get('public_key') }}"

                                            ></span>
                                            <button type="submit" v-if="authenticated" :disabled="disableCheckoutBtn"  @click.prevent="checkout" class="btn btn-block theme-bg checkout-btn">Place Order</button>
                                            <span v-else>
                                                <a href="/customer/login" class="btn btn-block theme-bg checkout-btn" :disabled="disableCheckoutBtn">Login & Checkout</a>
                                            </span>
                                        </div>

                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


{{--footer--}}
@include('includes.footer')


