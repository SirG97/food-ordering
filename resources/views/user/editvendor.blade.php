@extends('user.layout.access_role')
@section('title', 'Edit Vendor')
@section('icon', 'fa-user-plus')
@section('content')
    <div class="container-fluid">
        <div class="row ">
            <div class="col-md-12">
                <div class="custom-panel card py-2">
                    <div class="font-weight-bold text-secondary mb-1 py-3 px-3">
                        Update Vendor
                    </div>
                    <form action="/vendor/{{$vendor->vendor_id}}/update" method="POST">
                        <div class="container">
                            <div class="row cool-border trx-bg-head py-3">
                                <div class="col-md-8 offset-md-2">
                                    @include('includes.message')
                                    <h6 class="text-primary">Personal information</h6>
                                    <div class="form-row">
                                        <input type="hidden" name="token" value="{{\App\Classes\CSRFToken::_token()}}">
                                        <input type="hidden" name="vendor_id" value="{{$vendor->vendor_id}}">
                                        <div class="col-md-4 mb-3">
                                            <label for="firstname">First name</label>
                                            <input type="text" class="form-control" id="firstname" name="firstname" value="{{$vendor->firstname}}" required>

                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label for="lastname">Lastname</label>
                                            <input type="text" class="form-control" id="lastname" name="lastname" value="{{$vendor->lastname}}" required>

                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label for="email">Email</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="inputGroupPrepend3">@</span>
                                                </div>
                                                <input type="email" class="form-control" name="email" id="email" value="{{$vendor->email}}" aria-describedby="inputGroupPrepend3" required>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-5 mb-3">
                                            <label for="phone">Phone number</label>
                                            <input type="text" class="form-control" value="{{$vendor->phone}}"  name="phone" id="phone" required>

                                        </div>
                                        <div class="col-md-7 mb-3">
                                            <label for="state">Address</label>
                                            <input type="text" class="form-control" value="{{$vendor->address}}"  name="address" id="address" required>
                                        </div>
                                    </div>
                                    <h6 class="text-primary">Business information</h6>
                                    <div class="form-row">
                                        <div class="col-md-6 mb-3">
                                            <label for="biz_name">Business name</label>
                                            <input type="text" class="form-control" value="{{$vendor->biz_name}}" id="biz_name" name="biz_name" value="" required>

                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="subtitle">Subtitle</label>
                                            <input type="text" class="form-control" id="subtitle" name="subtitle" value="{{$vendor->subtitle}}" required>

                                        </div>

                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-12 mb-3">
                                            <label for="description">Description</label>
                                            <input type="text" class="form-control" value="{{$vendor->description}}" name="description" id="description">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-3 mb-3">
                                            <label for="city">City</label>
                                            <input type="text" class="form-control" value="{{$vendor->city}}"  name="city" id="city" required>

                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="state">State</label>
                                            <input type="text" class="form-control" value="{{$vendor->state}}" name="state" id="state" required>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="biz_address">Address</label>
                                            <input type="text" class="form-control" value="{{$vendor->biz_address}}" name="biz_address" id="biz_address" required>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-6 mb-3">
                                            <label for="tags">Tags</label>
                                            <div class="dropdown bootstrap-select show-tick form-control">

                                                <select multiple name="tags[]" class="selectpicker form-control form-control-style" id="tags" data-container="body" data-live-search="true" title="Select a number" data-hide-disabled="true" data-actions-box="true" data-virtual-scroll="true" tabindex="-2">
                                                    <option value="Breakfast" {{in_array('Breakfast', explode(',', $vendor->tags)) ? 'selected': ''}}>Breakfast</option>
                                                    <option value="Lunch" {{in_array('Lunch', explode(',', $vendor->tags)) ? 'selected': ''}}>Lunch</option>
                                                    <option value="Dinner" {{in_array('Dinner', explode(',', $vendor->tags)) ? 'selected': ''}}>Dinner</option>
                                                    <option value="Salad" {{in_array('Salad', explode(',', $vendor->tags)) ? 'selected': ''}}>Salad</option>
                                                    <option value="African" {{in_array('African', explode(',', $vendor->tags)) ? 'selected': ''}}>African</option>
                                                    <option value="Local" {{in_array('Local', explode(',', $vendor->tags)) ? 'selected': ''}}>Local</option>
                                                    <option value="Fries" {{in_array('Fries', explode(',', $vendor->tags)) ? 'selected': ''}}>Fries</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="mobile">Mobile 1</label>
                                            <input type="text" value="{{$vendor->mobile}}" class="form-control"  name="mobile" id="mobile" required>
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="alt_mobile">Mobile 2</label>
                                            <input type="text" value="{{$vendor->alt_mobile}}" class="form-control"  name="alt_mobile" id="alt_mobile">
                                        </div>

                                    </div>
                                    <h6 class="text-primary">Availability and delivery hours</h6>
                                    <div class="form-row">
                                        <div class="col-md-4 mb-3">
                                            <label for="opening_time">Opening time</label>
                                            <input type="time" class="form-control" value="{{$vendor->opening_time}}"  name="opening_time" id="opening_time" required>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label for="closing_time">Closing time</label>
                                            <input type="time" class="form-control" value="{{$vendor->closing_time}}"  name="closing_time" id="closing_time" required>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label for="sat_opening">Saturday opening</label>
                                            <input type="time" class="form-control" value="{{$vendor->sat_opening}}" name="sat_opening" id="sat_opening">
                                        </div>

                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-4 mb-3">
                                            <label for="sat_close">Saturday closing</label>
                                            <input type="time" class="form-control" value="{{$vendor->sat_closing}}" name="sat_closing" id="sat_closing">
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label for="sun_opening">Sunday opening</label>
                                            <input type="time" class="form-control" value="{{$vendor->sun_opening}}" name="sun_opening" id="sun_opening">
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label for="sun_close">Sunday closing</label>
                                            <input type="time" class="form-control" value="{{$vendor->sun_closing}}" name="sun_closing" id="sun_closing">
                                        </div>
                                    </div>
                                    <h6 class="text-primary">Minimum order and delivery</h6>
                                    <div class="form-row">
                                        <div class="col-md-4 mb-3">
                                            <label for="min_order">Minimum order</label>

                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="inputGroupPrepend3">&#8358</span>
                                                </div>
                                                <input type="text" class="form-control" value="{{$vendor->min_order}}" name="min_order" id="min_order">

                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label for="min_delivery">Minimum delivery</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="inputGroupPrepend3">&#8358</span>
                                                </div>
                                                <input type="text" class="form-control" value="{{$vendor->min_delivery}}" name="min_delivery" id="min_delivery">

                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label for="container_fee">Container fee</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="inputGroupPrepend3">&#8358</span>
                                                </div>
                                                <input type="text" class="form-control" value="{{$vendor->container_fee}}" name="container_fee" id="container_fee">

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel-footer py-2 mt-2 mr-3 d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary btn-sm px-3">Update</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection()


