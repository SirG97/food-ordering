@extends('user.layout.base')
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
                                           data-target="#deleteVendorModal"
                                           data-vendor_id="{{ $vendor['vendor_id'] }}"></i>
                                    </td>

                                </tr>
                                @endforeach


                                {{-- Delete Modal--}}
                                <div class="modal fade" id="deleteVendorModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
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
                                                <button type="button" class="btn btn-danger" id="deleteVendorBtn">Delete</button>
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
