@include('includes.head')

<div>
    <nav class="navbar navbar-expand-lg navbar-light navbar-transparent custom">
        <a class="navbar-brand" href="#"><i class="fas fa-hamburger"></i>GFoods</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse " id="navbarNavDropdown">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active px-3">
                    <a class="nav-link" href="#">Resaturants</a>
                </li>

                <li class="nav-item px-3">
                    <a class="nav-link" href="#">Become a Vendor</a>
                </li>

                <li class="nav-item px-3">
                    <a class="nav-link" href="#">Contact</a>
                </li>
                <!-- <li> -->

                <!-- </li> -->
               
            </ul>

            <ul class="navbar-nav">
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
                        <a class="auth-btn btn auth btn-sm" href="/customer/login">Login/Signup</a>
                    </li>
                @endif
            </ul>
        </div>
    </nav>
</div>
<div class="hero d-flex justify-content-start">
    <div class="arc">
        <img src="img/food2.png" alt="">
        <img src="img/foodimg.png" alt="">
    </div>
    <div class="hero-text d-flex align-items-center justify-content-start">
        <div class="d-flex flex-column">
            <h3>Eat fresh and healthy food</h3>
            <p>Get Delicious, healthy meal Prepared by best resturants and delivered to your doorstep. We also deliver fresh foods. What are you waiting for, place your order now!</p>
            <a class="btn color-bg action-btn">Order now</a>
        </div>
    </div>
</div>

<script>
    // $(document).ready(() => {
    //     $('nav, .nav-item').toggleClass('nav-scrolled scroll-item', window.pageYOffset > 60);
    //     $(window).scroll(() => {
    //         $('nav, .nav-item').toggleClass('nav-scrolled scroll-item', $(this).scrollTop() > 60)
    //     });
    // });
</script>
@include('includes.footer')
