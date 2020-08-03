@extends('user.layout.access_role')
@section('title', 'Vendor')
@section('icon', 'fa-user-plus')
@section('content')
    <div class="container-fluid">
        <div class="row ">
            <div class="col-md-12">
                <div class="custom-panel card restaurant-banner-border">
                    <!--suppress CssUnknownTarget -->
                    <div class="d-flex justify-content-between restaurant-banner"
                         style="background-image: url('/img/restaurants/banner.png');">

                    </div>
                    <div class="order-details-container cool-border-top">
                        <div class="vendor-details d-flex flex-column py-1 pt-3">
                            <div class="vendor-name px-2 px-sm-3">
                                Tasty Pot
                            </div>
                            <div class="vendor-subtitle px-2 px-sm-3">
                                Fries, breakfast, Burger, Drinks
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>

{{--        Create food type and add food--}}
            <div class="row">
                <div class="col-md-12">
                    @include('includes.message')
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="custom-panel card py-sm-3 py-2 px-2 px-sm-3">
                        <form action="/foodcategory/create" method="POST" >
                            <div class="d-flex flex-column">
                                <i class="fas fa-fw fa-utensils fa-3x align-self-center icon-color"></i>
                                <h6 class="text-center">Add new food category</h6>
                                <div class="input-group my-3">
                                    <input type="hidden" id="token" name="token" value="{{\App\Classes\CSRFToken::_token()}}">
                                    <input type="hidden" id="vendor_id" name="vendor_id" value="IW98KEPR2N">

                                    <input type="text" class="form-control" placeholder="Eg. Rice, Salad" name="name">
                                    <div class="input-group-append" >
                                        <button class="btn btn-primary" type="submit" style="z-index: 1">Create</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="custom-panel card py-sm-3 py-2 px-2 px-sm-3">
                        <div class="d-flex flex-column">
                            <i class="fas fa-fw fa-pizza-slice fa-3x align-self-center icon-color"></i>
                            <h6 class="text-center">Add a food</h6>
                            <form class="mt-3" action="/food/create" method="POST" enctype="multipart/form-data">
                                <input type="hidden" id="token" name="token" value="{{\App\Classes\CSRFToken::_token()}}">
                                <input type="hidden" id="vendor_id" name="vendor_id" value="IW98KEPR2N">
                                <div class="form-row">
                                    <div class="col-md-12 mb-3">
                                        <select class="custom-select" name="food_category" id="food_category" required>
                                            @if(!empty($category) && count($category) > 0)
                                                @foreach($category as $c)
                                                    <option value={{$c->food_category_id}}> {{$c->food_category_name}}</option>
                                                @endforeach
                                            @else
                                                <option value="" disabled selected>Create a Food category first</option>
                                            @endif
                                        </select>
                                    </div>

                                </div>
                                <div class="form-row">
                                    <div class="col-md-7 mb-3">
                                        <input type="text" class="form-control" id="name" name="name" placeholder="Fried Rice with egg sauce">
                                    </div>
                                    <div class="col-md-5 mb-3">
                                        <input type="text" class="form-control" id="unit_price" name="unit_price" placeholder="Unit Price">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <input type="text" class="form-control" id="description" name="description" placeholder="Short description about the food">
                                </div>

                                <div class="form-group">
                                    <div class="custom-file">
                                        <input type="file" id="food-img" name="food_img" class="custom-file-input" id="customFile" required>
                                        <label class="custom-file-label" for="customFile">Choose file</label>
                                    </div>
                                </div>

                                <button class="btn btn-primary float-right" type="submit" >Create</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="custom-panel card py-2">
                        <div class="font-weight-bold text-secondary mb-1 py-3 px-3">
                            Vendor foods
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover ">
                                <thead class="trx-bg-head text-secondary py-3 px-3">
                                <tr>
                                    <th scope="col">Image</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Category</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Actions</th>
                                </tr>
                                </thead>
                                <tbody class="table-style">

                                @if(!empty($category) && count($category) > 0)
                                    @foreach($category as $c)
                                        @foreach($c->food as $food)
                                            <tr class="align-middle">
                                                <td scope="row"><img src="/{{$food['image']}}" alt="Food image" style="width:100px"></td>
                                                <td >{{ $food['name'] }}</td>
                                                <td>{{ $c['category_name'] }}</td>
                                                <td>{{ $food['unit_price'] }}</td>
                                                <td>{{ $food['description'] }}</td>
                                                <td class="table-action d-flex flex-nowrap">
                                                    <i class="fas fa-fw fa-edit text-primary"
                                                       data-toggle="modal"
                                                       data-target="#editModal"
                                                       title="Edit route details"
                                                       data-food_id="{{ $food['food_id'] }}"
                                                       data-name="{{ $food['name'] }}"
                                                       data-category_id="{{ $food['category_id'] }}"
                                                       data-unit_price="{{ $food['unit_price'] }}"
                                                       data-description="{{ $food['description'] }}"
                                                    ></i> &nbsp; &nbsp;
                                                    <i class="fas fa-fw fa-trash text-danger"
                                                       title="Delete customer details"
                                                       data-toggle="modal"
                                                       data-target="#deleteModal"
                                                       data-food_id="{{ $food['food_id'] }}"></i>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endforeach
                                    {{-- Edit Modal--}}
                                    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Edit route</h5>
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
                                                                <input type="hidden" id="route_id"  value="" required>
                                                                <input type="hidden" id="district_id"  value="" required>
                                                                <input type="hidden" id="token" name="token" value="{{\App\Classes\CSRFToken::_token()}}">
                                                                <div class="col-md-6 mb-3">
                                                                    <label for="district">District</label>
                                                                    <select class="custom-select" name="district" id="district" required>
                                                                        -
                                                                        @if(!empty($districts) && count($districts) > 0)
                                                                            @foreach($districts as $district)
                                                                                <option value={{$district->name}}> {{$district->name}}</option>
                                                                            @endforeach
                                                                        @endif
                                                                    </select>

                                                                </div>
                                                                <div class="col-md-6 mb-3">
                                                                    <label for="surname">Route name</label>
                                                                    <input type="text" class="form-control" id="name" name="name" value="" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <button type="button" class="btn btn-primary" id="editBtn">Save</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Delete Modal--}}
                                    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Delete route</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form id="routeDeleteForm" action="" method="POST">
                                                        <div class="col-md-12">
                                                            Delete route?
                                                            <input type="hidden" id="token" name="token" value="{{\App\Classes\CSRFToken::_token()}}">
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <button type="button" class="btn btn-danger" id="deleteRouteBtn">Delete</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <tr>
                                        <td colspan="7">
                                            <div class="d-flex justify-content-center">No routes created</div>
                                        </td>
                                    </tr>
                                @endif
                                </tbody>
                            </table>
                        </div>
                        <div class="panel-footer py-1 mt-0 mr-3 d-flex justify-content-end">
                            {!! $links !!}
                        </div>

                    </div>
                </div>

            </div>

    </div>
@endsection()

