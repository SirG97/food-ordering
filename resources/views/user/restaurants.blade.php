<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gfood::vendors</title>
    <link rel="favicon" href="/favicon.ico">
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/all.css">
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
            <ul class="navbar-nav black-nav ml-auto">
                <li class="nav-item active px-3">
                    <a class="nav-link" href="/">Home</a>
                </li>


                <li class="nav-item px-3">
                    <a class="nav-link" href="/cart"><i class="fa fa-shopping-cart"></i>Cart</a>
                </li>
                @if(isAuthenticated())
                <div class="dropdown">
                    <button class="btn btn-danger dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{ customer()->firstname }}
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="/customer/orders">Recent orders</a>
                        <a class="dropdown-item" href="/customer">Profile</a>
                        <a class="dropdown-item" href="/customer/logout">Logout</a>
                    </div>
                    </div>
                @else
                    <li class="nav-item px-3 ">
                        <a class="nav-link btn btn-danger btn-sm" href="/customer/login">Login/Signup</a>
                    </li>
                @endif
                
            </ul>
        </div>
    </nav>
</div>

<div class="filter d-flex justify-content-center">
    <section class="filter-search align-self-start p-2 px-sm-2 px-md-2">
        <div class="container-fluid">
            <div class="row d-flex justify-content-between">
                <div class="col-md-6">
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
                <div class="col-md-6 py-3">
                    <form class="form-inline">
                        <label class="sr-only" for="search">Search</label>
                        <input type="text" class="form-control form-control-lg mb-2 mr-sm-2" id="search" placeholder="search">

                        <label class="sr-only" for="filter">Filter</label>
                            <input type="text" class="form-control form-control-lg mb-2 mr-sm-2" id="filter" placeholder="filter">
                    </form>
                </div>
            </div>
        </div>

    </section>
</div>

<section class="featured">
    <div class="featured-container text-black-50">
        <div class="do-you font-weight-normal">Vendors</div>
        <div class="container-fluid">
            <div class="row">
                @foreach($vendors as $vendor)
                    <div class="col-md-6 col-xl-3">
                        <a href="/restaurant/{{$vendor['vendor_id']}}">
                            <div class="card featured-card" style="">
                            <img class="card-img-top" src="{{$vendor['banner']}}" alt="Card image cap" style="height: 180px">
                            <div class="card-body px-1 py-2">
                                <h6 class="card-title">{{$vendor['biz_name']}}</h6>
                                <p class="card-text"> {{$vendor['description']}}</p>
                            </div>
                        </div>
                        </a>
                    </div>
                @endforeach

            </div>

        </div>
    </div>
</section>


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
<script>
    // $(document).ready(() => {
    //     $('nav, .nav-item').toggleClass('nav-scrolled scroll-item', window.pageYOffset > 60);
    //     $(window).scroll(() => {
    //         $('nav, .nav-item').toggleClass('nav-scrolled scroll-item', $(this).scrollTop() > 60)
    //     });
    // });
</script>
</body>
</html>


