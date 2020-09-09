
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
    <script src="/js/vue.js"></script>
    <script src="/js/axios.min.js"></script>
    <script src="/js/script.js"></script>
    <script src="/js/revieworder.js"></script>
    

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
                    <a class="nav-link" href="/restaurants">Vendors</a>
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
                        <a class="dropdown-item" href="/logout">Logout</a>
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


{{--<div class="order-timeline d-flex justify-content-center">--}}
{{--    <ul class="order-steps d-flex justify-content-center">--}}
{{--        <li><span class="order-steps-box"><i class="fa fa-check"></i></span></li>--}}
{{--        <li><span class="order-steps-box"><i class="fa fa-check"></i></span></li>--}}
{{--        <li><span class="order-steps-box"><i class="fa fa-check"></i></span></li>--}}
{{--    </ul>--}}
{{--</div>--}}
<div class="container" id="root" style="margin-top: 80px;" data-token="{{$token}}">

    <div class="row">
        <div class="col-md-12">
            @include('includes.message')
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="custom-panel card py-2">
                <div class="font-weight-bold text-secondary mb-1 py-3 px-3">
                   Order confirmation
                </div>  
            </div>
        </div>
        <div class="col-md-12">
            
        </div>

    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="custom-panel py-2">
                
            </div>
        </div>
    </div>
</div>

{{--footer--}}
<section id="footer-container">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4">
                <h5>About Gfoods </h5>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Mollitia, maxime. Eveniet consequatur voluptatem, molestiae excepturi dolor maiores ullam placeat esse veritatis, autem sapiente libero aut vero sequi aliquid, soluta quisquam.</p>
            </div>
            <div class="col-md-4 d-flex flex-column">
                <h5>Our Services</h5>
                <p>Breakfast</p>
                <p>Dinner</p>
                <p>Lunch</p>
                <p>Parties</p>
            </div>
           <?php  include ''?>
            <div class="col-md-4">
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

