@extends('customer.layout.base')
@section('title', 'Dashboard')
@section('icon', 'fa-tachometer-alt')
@section('content')
    <div class="container-fluid">

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
                                <th scope="col">Status</th>
                                <th scope="col">Order ID</th>
                                <th scope="col">Parcel name</th>
                                <th scope="col">Owner</th>
                                <th scope="col">Request Type</th>
                                <th scope="col">Phone</th>
                                <th scope="col">Actions</th>
                            </tr>
                            </thead>
                            <tbody class="table-style">
                            <tr>
                                <td colspan="7">
                                    <div class="d-flex justify-content-center flex-column align-items-center">
                                        <div class="align-items-center"><i class="fas fa-fw fa-shipping-fast fa-2x"></i></div>
                                        <div>No Orders yet</div>
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="panel-footer py-1 mt-0 mr-3 d-flex justify-content-end">
                        <a href="/orders" class="btn btn-primary btn-sm px-3">View more</a>
                    </div>

                </div>
            </div>

        </div>
    </div>

@endsection()