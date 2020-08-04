@extends('user.layout.access_role')
@section('title', 'Vendors')
@section('icon', 'fa-users')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 offset-md-6">
                <div class="searchbox mt-0 mr-0">
                    <div class="form-group has-search">
                        <span class="fa fa-search form-control-feedback"></span>
                        <input type="text" class="form-control" id="search" placeholder="Search vendors" style="border:0;">
                    </div>
                    <div class="search-result">
                        <ul class="list-group list-group-flush" id="search-result-list">

                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                @include('includes.message')
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="custom-panel card py-2">
                    <div class="font-weight-bold text-secondary mb-1 py-3 px-3">
                        Vendors
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover ">
                            <thead class="trx-bg-head text-secondary py-3 px-3">
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Phone</th>
                                <th scope="col">Address</th>
                                <th scope="col">City</th>
                                <th scope="col">Actions</th>
                            </tr>
                            </thead>
                            <tbody class="table-style">

                            @if(!empty($vendors) && count($vendors) > 0)
                                @foreach($vendors as $vendor)<tr>

                                    <td>{{ $vendor['biz_name'] }}</td>
                                    <td>{{ $vendor['email'] }}</td>
                                    <td>{{ $vendor['phone'] }}</td>
                                    <td>{{ $vendor['biz_address'] }}</td>
                                    <td>{{ $vendor['city'] }}</td>
                                    <td class="table-action d-flex flex-nowrap">
                                        <a href="/vendor/{{ $vendor['vendor_id'] }}">
                                            <i class="fas fa-fw fa-eye text-success" title="View vendor details"></i>
                                        </a> &nbsp; &nbsp;
                                        <a href="/vendor/{{ $vendor['vendor_id'] }}/edit">
                                            <i class="fas fa-fw fa-edit text-primary"></i>
                                        </a>&nbsp; &nbsp;
                                        <i class="fas fa-fw fa-trash text-danger"
                                           title="Delete vendor details"
                                           data-toggle="modal"
                                           data-target="#deletevendorModal"
                                           data-vendor_id="{{ $vendor['vendor_id'] }}"></i>
                                    </td>

                                </tr>
                                @endforeach
                                {{-- Edit Modal--}}
                                <div class="modal fade bd-example-modal-lg" id="editvendorModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Edit vendor</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div id="msg" class="d-flex">
                                                </div>
                                                <form>
                                                    <div class="col-md-12">
                                                        <div class="form-row">
                                                            <input type="hidden" name="token" value="{{\App\Classes\CSRFToken::_token()}}">
                                                            <input type="hidden" name="vendor_id" id="vendor_id" value="">
                                                            <div class="col-md-2 mb-3">
                                                                <label for="title">Title</label>
                                                                <select name="title" id="title" class="custom-select">
                                                                    <option value="{{ \App\Classes\Request::old('post', 'title') }}">
                                                                        {{ \App\Classes\Request::old('post', 'title') ? : "Title"}}
                                                                    </option>
                                                                    <option value="Mr">Mr</option>
                                                                    <option value="Mrs">Mrs</option>
                                                                    <option value="Miss">Miss</option>
                                                                    <option value="Master">Master</option>
                                                                </select>
                                                            </div>
                                                            <div class="col-md-4 mb-3">
                                                                <label for="name">Name</label>
                                                                <input type="text" class="form-control" id="name" name="name" value="" required>
                                                            </div>
                                                            <div class="col-md-3 mb-3">
                                                                <label for="marital_status">Marital Status</label>
                                                                <select id="marital_status" name="marital_status" class="custom-select">
                                                                    <option value="{{ \App\Classes\Request::old('post', 'marital_status') }}">
                                                                        {{ \App\Classes\Request::old('post', 'marital_status') ? : "Marital Status"}}
                                                                    </option>
                                                                    <option value="single">Single</option>
                                                                    <option value="married">Married</option>
                                                                    <option value="divorced">Divorced</option>
                                                                    <option value="widowed">Widowed</option>
                                                                </select>
                                                            </div>
                                                            <div class="col-md-3 mb-3">
                                                                <label for="dob">Date of Birth</label>
                                                                <input type="date" class="form-control" name="dob" id="dob" required>
                                                            </div>
                                                        </div>
                                                        <div class="form-row">
                                                            <div class="col-md-4 mb-3">
                                                                <label for="occupation">Occupation</label>
                                                                <input type="text" class="form-control" name="occupation" id="occupation" required>

                                                            </div>
                                                            <div class="col-md-3 mb-3">
                                                                <label for="email">Email</label>
                                                                <input type="text" class="form-control"  name="email" id="email" required>

                                                            </div>
                                                            <div class="col-md-3 mb-3">
                                                                <label for="phone">Phone</label>
                                                                <input type="text" class="form-control"  name="phone" id="phone" required>

                                                            </div>

                                                            <div class="col-md-2 mb-3">
                                                                <label for="sex">Sex</label>
                                                                <select name="sex" id="sex" class="custom-select">
                                                                    <option value="{{ \App\Classes\Request::old('post', 'sex') }}">
                                                                        {{ \App\Classes\Request::old('post', 'sex') ? : "Sex"}}
                                                                    </option>
                                                                    <option value="Male">Male</option>
                                                                    <option value="Female">Female</option>
                                                                </select>
                                                            </div>

                                                        </div>
                                                        <div class="form-row">
                                                            <div class="col-md-7 mb-3">
                                                                <label for="address">Address</label>
                                                                <input type="text" name="address" value="" id="address" class="form-control">
                                                            </div>

                                                            <div class="col-md-5 mb-3">
                                                                <label for="office">Shop/store office</label>
                                                                <input type="text" class="form-control"  name="office" id="office" required>
                                                            </div>
                                                        </div>
                                                        <div class="form-row">
                                                            <div class="col-md-3 mb-3">
                                                                <label for="saving_period">Savings Period</label>
                                                                <input type="text" name="saving_period" value="" id="saving_period" class="form-control">
                                                            </div>
                                                            <div class="col-md-3 mb-3">
                                                                <label for="amount">Daily savings</label>
                                                                <div class="input-group mb-3">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text">&#8358</span>
                                                                    </div>
                                                                    <input type="text" name="amount" value="500" id="amount"  class="form-control" aria-label="Amount (to the nearest dollar)">
                                                                    <div class="input-group-append">
                                                                        <span class="input-group-text">.00</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 mb-3">
                                                                <label for="purpose">Purpose</label>
                                                                <input type="text" name="purpose" value="" id="purpose" class="form-control">
                                                            </div>
                                                        </div>
                                                        <h5>Next of kin</h5>
                                                        <div class="form-row">
                                                            <div class="col-md-4 mb-3">
                                                                <label for="kin_name">Name</label>
                                                                <input type="text" class="form-control" id="kin_name" name="kin_name" value="" required>
                                                            </div>
                                                            <div class="col-md-2 mb-3">
                                                                <label for="kin_address">Address</label>
                                                                <input type="text" class="form-control" id="kin_address" name="kin_address" required>
                                                            </div>
                                                            <div class="col-md-3 mb-3">
                                                                <label for="kin_phone">Phone</label>
                                                                <input type="text" class="form-control" id="kin_phone" name="kin_phone" required>
                                                            </div>
                                                            <div class="col-md-3 mb-3">
                                                                <label for="kin_relationship">Relationship</label>
                                                                <select name="kin_relationship" id="kin_relationship" class="custom-select">
                                                                    <option value="{{ \App\Classes\Request::old('post', 'kin_relationship') }}">
                                                                        {{ \App\Classes\Request::old('post', 'kin_relationship') ? : ""}}
                                                                    </option>
                                                                    <option value="spouse">Spouse</option>
                                                                    <option value="father">Father</option>
                                                                    <option value="mother">Mother</option>
                                                                    <option value="uncle">Uncle</option>
                                                                    <option value="aunt">Aunt</option>
                                                                    <option value="son">Son</option>
                                                                    <option value="daughter">Daughter</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="button" class="btn btn-primary" id="editvendorBtn">Save</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- Delete Modal--}}
                                <div class="modal fade" id="deletevendorModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Delete vendor</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form id="vendorDeleteForm" action="" method="POST">
                                                    <div class="col-md-12">
                                                        Delete vendor?
                                                        <input type="hidden" id="token" name="token" value="{{\App\Classes\CSRFToken::_token()}}">
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="button" class="btn btn-danger" id="deletevendorBtn">Delete</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <tr>
                                    <td colspan="7">
                                        <div class="d-flex justify-content-center">No vendors yet</div>
                                    </td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="panel-footer py-1 mt-0 mr-3 d-flex justify-content-end">
                        {{--                        {!! $links !!}--}}
                    </div>

                </div>
            </div>

        </div>
    </div>
@endsection()
