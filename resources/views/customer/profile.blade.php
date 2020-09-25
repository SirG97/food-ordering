@extends('customer.layout.base')
@section('title', 'Account details')
@section('icon', 'fa-tachometer-alt')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="offset-md-2"></div>
            <div class="col-md-7">
                <div class="p-details my-4 p-3">
                    <div class="p-details-header">
                        <h5>Personal Details</h5>
                    </div>
                    <div class="p-details-content">
                        <form action="#" method="POST" id="form" class="p-details-form">

                            <input type="hidden" name="token" value="{{\App\Classes\CSRFToken::_token()}}">
                            <div class="form-row mb-2">
                                <div class="col">
                                    <label for="firstname" class="">First name</label>
                                    <input type="text" class="form-control" placeholder="First name" value="" id="firstname" name="firstname">
                                </div>
                                <div class="col">
                                    <label for="surname" class="">Last</label>
                                    <input type="text" class="form-control" placeholder="Last name" value="" id="surname" name="surname">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="email" class="">Email</label>
                                <input type="email" class="form-control form-control-lg" placeholder="Enter password" value="" id="email" name="email">
                            </div>
                            <div class="form-group">
                                <label for="phone" class="">Phone Number</label>
                                <input type="tel" class="form-control form-control-lg" placeholder="Enter password" value="" id="phone" name="phone">
                            </div>


                        </form>
                    </div>
                </div>
                <div class="p-details my-5 p-3">
                    <div class="p-details-header">
                        <h5>Contact Details</h5>
                    </div>
                    <div class="p-details-content">
                        <form action="#" method="POST" id="form" class="p-details-form">
                            <div class="form-group">
                                <label for="address" class="">Address</label>
                                <input type="text" class="form-control form-control-lg" placeholder="Address" value="" id="address" name="address">
                            </div>
                            <div class="form-row mb-2">
                                <div class="col">
                                    <label for="state" class="">State</label>
                                    <input type="text" class="form-control" placeholder="State" value="" id="state" name="state">
                                </div>
                                <div class="col">
                                    <label for="surname" class="">Landmark</label>
                                    <input type="text" class="form-control" placeholder="Landmark" value="" id="landmark" name="landmark">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="p-details my-2 p-3">
                    <button class="btn btn-block theme-bg btn-lg text-white save">Save</button>
                </div>
            </div>
        </div>
    </div>

@endsection()