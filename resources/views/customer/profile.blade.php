@extends('customer.layout.base')
@section('title', 'Account details')
@section('icon', 'fa-tachometer-alt')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="offset-md-2"></div>
            <div class="col-md-7">

                <form action="/customer/edit" method="POST">
                    @include('includes.message')
                    <div class="p-details my-4 p-3">

                        <div class="p-details-header">
                            <h5>Personal Details</h5>
                        </div>
                        <div class="p-details-content">
                            <div id="form" class="p-details-form">

                                <input type="hidden" name="token" value="{{\App\Classes\CSRFToken::_token()}}">
                                <input type="hidden" name="customer_id" value="{{$customer->customer_id}}">
                                <div class="form-row mb-2">
                                    <div class="col">
                                        <label for="firstname" class="">First name</label>
                                        <input type="text" class="form-control" placeholder="First name" value="{{$customer->firstname}}" id="firstname" name="firstname">
                                    </div>
                                    <div class="col">
                                        <label for="surname" class="">Last</label>
                                        <input type="text" class="form-control" placeholder="Last name" value="{{$customer->surname}}" id="surname" name="surname">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="email" class="">Email</label>
                                    <input type="email" class="form-control form-control-lg" placeholder="Email" value="{{$customer->email}}" id="email" name="email" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="phone" class="">Phone Number</label>
                                    <input type="tel" class="form-control form-control-lg" placeholder="Phone" value="{{$customer->phone}}" id="phone" name="phone">
                                </div>


                            </div>
                        </div>
                    </div>
                    <div class="p-details my-5 p-3">
                        <div class="p-details-header">
                            <h5>Contact Details</h5>
                        </div>
                        <div class="p-details-content">
                            <div id="form" class="p-details-form">
                                <div class="form-group">
                                    <label for="address" class="">Address</label>
                                    <input type="text" class="form-control form-control-lg" placeholder="Address" value="{{ $address !== null ? $address->address : ''}}" id="address" name="address">
                                </div>
                                <div class="form-row mb-2">
                                    <div class="col">
                                        <label for="town" class="">Town</label>
                                        <input type="text" class="form-control" placeholder="Town" value="{{ $address !== null ? $address->town : ''}}" id="town" name="town">
                                    </div>
                                    <div class="col">
                                        <label for="area" class="">Area</label>
                                        <input type="text" class="form-control" placeholder="Area" value="{{ $address !== null ? $address->area : ''}}" id="area" name="area">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="p-details my-2 p-3">
                        <button type="submit" class="btn btn-block theme-bg btn-lg text-white save">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection()