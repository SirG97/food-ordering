
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gfood::vendors</title>
    <link rel="favicon" href="/favicon.ico">
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/all.css">
    <link rel="stylesheet" href="/css/fontawesome-all.css">
    <link rel="stylesheet" href="/css/Chart.min.css">
    <link rel="stylesheet" href="/css/style.css">

    <script src="/js/jquery-3.2.1.min.js"></script>
    <script src="/js/bootstrap.bundle.min.js"></script>
    <script src="/js/moment.min.js"></script>
    <script src="/js/script.js"></script>

</head>
<body>
<div>
    <nav class="navbar navbar-expand-lg navbar-dark bg-white fixed-top main-menu custom">
        <a class="navbar-brand" href="#"><i class="fas fa-hamburger"></i>GFoods</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse " id="navbarNavDropdown">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active px-3">
                    <a class="nav-link" href="/">Home</a>
                </li>

                <li class="nav-item px-3">
                    <a class="nav-link" href="/cart">vendors</a>
                </li>

                <li class="nav-item px-3">
                    <a class="nav-link" href="/cart"><i class="fa fa-shopping-cart"></i>Cart</a>
                </li>
                <li class="nav-item px-3 ">
                    <a class="nav-link btn btn-danger btn-sm" href="/authenticate">Login/Signup</a>
                </li>
            </ul>
        </div>
    </nav>
</div>


{{--<div class="order-timeline d-flex justify-content-center">--}}
{{--    <ul class="order-steps d-flex justify-content-center">--}}
{{--        <li><span class="order-steps-box"><i class="fa fa-check"></i></span></li>--}}
{{--        <li><span class="order-steps-box"><i class="fa fa-check"></i></span></li>--}}
{{--        <li><span class="order-steps-box"><i class="fa fa-check"></i></span></li>--}}
{{--    </ul>--}}
{{--</div>--}}
<div class="container-fluid">

    <div class="row">
        <div class="col-md-12">
            @include('includes.message')
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

{{--footer--}}
<section id="footer-container">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
                <h5>About Updel </h5>
                <p>UPdel Services is a courier company borne out of the need to bridge
                    the growing gap between the need for fast,
                    flexible supply of delivery service and available options.</p>
            </div>
            <div class="col-md-3 d-flex flex-column">
                <h5>Our Services</h5>
                <p>Delivery Request</p>
                <p>Collection Request</p>
                <p>Combo Request</p>
                <p>Swap Request</p>
            </div>
            <div class="col-md-3 d-flex flex-column">
                <h5>Sub Services</h5>
                <p>Premium Services</p>
                <p>Precise Delivery Services</p>
                <p>Same Day Delivery</p>
                <p>Two Day Delivery</p>
                <p><a href="/services">See more ...</a></p>
            </div>
            <div class="col-md-3">
                <h5>Contact us</h5>
                <p><i class="fa fa-map-marker-alt"></i> Nationwide</p>
                <div class="d-inline-flex mb-2 justify-content-between">
                    <div class="align-self-start"><i class="fa fa-envelope"></i></div> &nbsp;
                    <div>info@updelservices.com <br>updelservices@gmail.com</div>
                </div>
                <p><i class="fa fa-phone"></i> +2347040463183</p>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-10 col-md-12 col-sm-12">
                <div class="footer-social">
                    <ul>
                        <li><a href="#"><i class="fab fa-linkedin"></i></a></li>
                        <li><a href="#"><i class="fab fa-facebook"></i></a></li>
                        <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                    </ul>
                </div>
                <div class="footer-nav text-center">
                    <ul>
                        <li><a href="" class="footer-lin">Home</a></li>
                        <li><a href="" class="footer-lin">About</a></li>
                        <li><a href="" class="footer-lin">Services</a></li>
                        <li><a href="" class="footer-lin">FAQ</a></li>
                        <li><a href="" class="footer-lin">Contact us</a></li>
                    </ul>
                </div>
                <div class="copyright text-center">
                    <p>Copyright © 2019 All Rights Reserved</p>
                </div>
            </div>
        </div>
    </div>
</section>

</body>
</html>


