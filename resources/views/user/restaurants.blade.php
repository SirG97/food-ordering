@include('includes.head')

<div class="wrapper">
{{--    Navigation bar--}}
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

                <ul class="navbar-nav mr-3">
                    @if(isAuthenticated())
                        <div class="dropdown">
                            <button class="auth-btn btn auth btn-sm  dropdown-toggle " type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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
                            <a class="auth-btn btn auth btn-sm" href="/customer/login">Login</a>
                        </li>
                        <li class="nav-item px-3 ">
                            <a class="auth-btn btn auth btn-sm" href="/customer/signup">Signup</a>
                        </li>
                    @endif
                </ul>
            </div>
        </nav>
    </div>

{{--    Title of the page --}}

    <div class="page-title d-flex justify-content-center">
        <h3 class="r-p-heading">Find restaurant close to you</h3>
    </div>

{{--   Filter container  --}}
    <div class="filter-container d-flex justify-content-center">
        <section class="hero-search" style="">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-10 search-input"  style="">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <select class="custom-select form-control form-control-lg" id="inputGroupSelect01">
                                        <option selected>Select city</option>
                                        <option value="1">Port-Harcourt</option>
                                        <option value="2">Owerri</option>
                                        <option value="3">Enugu</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input type="email" class="form-control form-control-lg" value="" id="area" name="area" placeholder="Your Area">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-lg" value="" id="meal" name="meal" placeholder="Filter">
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-2 theme-bg search-btn">
                        <div class="d-flex justify-content-center">
                            <div class="align-items-center">
                                <a href="#" class="btn theme-bg" id="m-srch-btn">Search</a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>
    </div>

{{--  All restaurants  --}}
    <div class="all-restaurants">
        <div class="all-restaurants-header d-flex p-2 mx-1 mx-sm-3 mx-md-5">
            <h4 class="r-p-heading">All restaurant</h4>
        </div>
        <div class="all-restaurants-content">
            <div class="container-fluid">
                <div class="row">
                    @foreach($vendors as $vendor)
                        <div class="col-md-6 col-xl-3">
                            <div class="card featured-card" style="">
                                <img class="card-img-top" src="{{$vendor['banner']}}" alt="Card image cap" style="height: 216px">
                                <div class="card-body">
                                    <h6 class="card-title">{{$vendor['biz_name']}}</h6>
                                    <div class="meta d-flex flex-row align-items-center">
                                        <div class="justify-content-center">
                                            <div class="rating-badge badge-secondary px-2 mr-2">
                                                4.0
                                            </div>
                                        </div>
                                        <div class="justify-content-center">
                                            <div class="containerdiv d-inline-block mr-2">
                                                <div>
                                                    <img src="/img/stars_blank.png" alt="img">
                                                </div>
                                                <div class="cornerimage" style="width:calc(100%);">
                                                    <img src="/img/stars_full.png" alt="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="justify-content-center">
                                            <div class="total-order mr-1 btn-outline-secondary">400 Orders</div>
                                        </div>
                                    </div>
                                    <p class="card-text">{{$vendor['description']}}</p>
                                    <a href="/restaurant/{{$vendor['vendor_id']}}" class="btn btn-block theme-bg view-more">View more</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>


</div>

@include('includes.footer')



