<div>
    <nav class="navbar navbar-expand-lg navbar-light navbar-transparent custom">
        <a class="navbar-brand" href="/"><i class="fas fa-hamburger"></i>GFoods</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse " id="navbarNavDropdown">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active px-3 mx-auto">
                    <a class="nav-link" href="/restaurants">Resaturants</a>
                </li>

                <li class="nav-item px-3 mx-auto">
                    <a class="nav-link" href="#">Become a Vendor</a>
                </li>

                <li class="nav-item px-3 mx-auto">
                    <a class="nav-link" href="#">Contact</a>
                </li>
                <!-- <li> -->

                <!-- </li> -->

            </ul>

            <ul class="navbar-nav mr-3">
                @if(isAuthenticated())
                    <div class="dropdown mx-auto">
                        <button class="auth-btn btn auth btn-sm  dropdown-toggle " type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{ customer()->firstname }}
                        </button>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="/customer/orders">Recent orders</a>
                            <a class="dropdown-item" href="/customer/account">Profile</a>
                            <a class="dropdown-item" href="/customer/logout">Logout</a>
                        </div>
                    </div>
                @else
                    <li class="nav-item px-3 mb-1 mb-lg-0 mx-auto">
                        <a class="auth-btn btn auth btn-sm" href="/customer/login">Login</a>
                    </li>
                    <li class="nav-item px-3 mb-1 mb-1 mb-lg-0 mx-auto">
                        <a class="auth-btn btn auth btn-sm" href="/customer/register">Signup</a>
                    </li>
                @endif
            </ul>
        </div>
    </nav>
</div>