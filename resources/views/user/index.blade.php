@include('includes\head')

<div>
    <nav class="navbar navbar-expand-lg navbar-light navbar-transparent fixed-top main-menu custom">
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
<div class="hero d-flex justify-content-center">
    <section class="hero-search align-self-center p-2 px-sm-3 px-md-5">
        <div class="container-fluid">
            <div class="row">
                <div class="input-group py-3">
                    <select class="custom-select form-control form-control-lg" id="inputGroupSelect01">
                        <option selected>Choose...</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>
                    <select class="custom-select form-control form-control-lg" id="inputGroupSelect01">
                        <option selected>Choose...</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>
                    <div class="input-group-append">
                        <button class="btn btn-danger px-2" type="button">Search</button>
                    </div>
                </div>
            </div>
        </div>

    </section>
</div>
<section class="who">
    <div class="whotext-container text-black-50">
        <div class="do-you text-center font-weight-bold">Do you know who we are?</div>
        <div>Updel Services is a courier company borne out of the need to bridge the growing gap between the need for fast, flexible supply of delivery service and available options. Led by an experienced leadership team and a versatile operational group, we are here to serve as a premier partner to every business that believes that Customer service is important to their business growth.</div>
    </div>
</section>


<!-- start of core services-->
<div class="what">
    <div class="what-header">
        <h3>How</h3>
    </div>
    <div class="what-widget">
        <div class="container">
            <div class="row">

                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <div class="widget-item">
                        <div class="circle-icon">
                            <i class="fa fa-map-marked"></i>
                        </div>
                        <h6>Collection Request</h6>
                        <p>Parcels are picked up on customer's request and held till further instructions. Charges may apply.</p>

                    </div>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <div class="widget-item">
                        <div class="circle-icon">
                            <i class="fa fa-hamburger"></i>
                        </div>
                        <h6>Combo Request</h6>
                        <p>This is a unique service type where customer request for collection and delivery to address of choice.</p>

                    </div>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <div class="widget-item">
                        <div class="circle-icon">
                            <i class="fa fa-shipping-fast"></i>
                        </div>
                        <h6>Swap Request</h6>
                        <p>This service type is an exchange. A customer requests for a replacement of items already purchased.</p>

                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<!-- End core services -->


@include('includes\footer')

