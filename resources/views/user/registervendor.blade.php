@extends('user.layout.access_role')
@section('title', 'Register Vendor')
@section('icon', 'fa-user-plus')
@section('content')
    <div class="container-fluid">
        <div class="row ">
            <div class="col-md-12">
                <div class="custom-panel card py-2">
                    <div class="font-weight-bold text-secondary mb-1 py-3 px-3">
                        Vendor personal information
                    </div>
                    <form action="/customer" method="POST">
                        <div class="container">
                            <div class="row cool-border trx-bg-head py-3">
                                <div class="col-md-8 offset-md-2">
                                    @include('includes.message')
                                    <h6 class="text-primary">Personal information</h6>
                                    <div class="form-row">
                                        <input type="hidden" name="token" value="{{\App\Classes\CSRFToken::_token()}}">
                                        <div class="col-md-4 mb-3">
                                            <label for="firstname">First name</label>
                                            <input type="text" class="form-control" id="firstname" name="firstname" value="" required>

                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label for="surname">Surname</label>
                                            <input type="text" class="form-control" id="surname" name="surname" value="" required>

                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label for="email">Email</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="inputGroupPrepend3">@</span>
                                                </div>
                                                <input type="email" class="form-control" name="email" id="email" aria-describedby="inputGroupPrepend3" required>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-5 mb-3">
                                            <label for="phone">Phone number</label>
                                            <input type="text" class="form-control"  name="phone" id="phone" required>

                                        </div>
                                        <div class="col-md-7 mb-3">
                                            <label for="state">Address</label>
                                            <input type="text" class="form-control"  name="address" id="address" required>
                                        </div>
                                    </div>
                                    <h6 class="text-primary">Business information</h6>
                                    <div class="form-row">
                                        <div class="col-md-6 mb-3">
                                            <label for="biz_name">Business name</label>
                                            <input type="text" class="form-control" id="biz_name" name="biz_name" value="" required>

                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="subtitle">Subtitle</label>
                                            <input type="text" class="form-control" id="subtitle" name="subtitle" value="" required>

                                        </div>

                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-12 mb-3">
                                            <label for="description">Description</label>
                                            <input type="text" class="form-control" name="description" id="description" aria-describedby="inputGroupPrepend3" required>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-3 mb-3">
                                            <label for="city">City</label>
                                            <input type="text" class="form-control"  name="city" id="city" required>

                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="state">State</label>
                                            <input type="text" class="form-control"  name="state" id="state" required>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="address">Address</label>
                                            <input type="text" class="form-control"  name="address" id="address" required>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-6 mb-3">
                                            <label for="tags">Tags</label>
                                            <div class="dropdown bootstrap-select show-tick form-control">
                                                <select multiple="" class="selectpicker form-control form-control-style" id="number-multiple" data-container="body" data-live-search="true" title="Select a number" data-hide-disabled="true" data-actions-box="true" data-virtual-scroll="true" tabindex="-2">
                                                    <option value="Breakfast">Breakfast</option>
                                                    <option value="Lunch">Lunch</option>
                                                    <option value="Dinner">Dinner</option>
                                                    <option value="Salad">Salad</option>
                                                    <option value="African">African</option>
                                                    <option value="Local">Local</option>
                                                    <option value="Fries">Fries</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="alt_phone">Mobile 1</label>
                                            <input type="text" class="form-control"  name="city" id="city" required>
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="alt_phone">Mobile 2</label>
                                            <input type="text" class="form-control"  name="state" id="state">
                                        </div>

                                    </div>
                                    <h6 class="text-primary">Availability and delivery hours</h6>
                                </div>
                            </div>
                        </div>
                        <div class="panel-footer py-2 mt-2 mr-3 d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary btn-sm px-3">Save</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection()

