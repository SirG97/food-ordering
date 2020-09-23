@include('includes.head')
<div class="wrapper">
    {{-- Navbar --}}
    <div>
        <nav class="navbar navbar-expand-lg navbar-light custom">
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

    <div class="inner-wrapper">
        <nav class="drop-shadow sidebar">
            <ul class="sidebar-nav d-flex justify-content-around justify-content-sm-center flex-row flex-sm-column align-items-center">
                <li class="sidebar-item">
                    <a href="/profile" class="profile active">
                        <svg class="svg-i" width="26" height="25" viewBox="0 0 26 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M20.5833 20.9652C20.5833 21.5745 20.0645 22.069 19.4226 22.069C18.7807 22.069 18.2619 21.5745 18.2619 20.9652C18.2619 17.922 15.6584 15.4462 12.4583 15.4462C9.25825 15.4462 6.65476 17.922 6.65476 20.9652C6.65476 21.5745 6.13593 22.069 5.49405 22.069C4.85218 22.069 4.33334 21.5745 4.33334 20.9652C4.33334 16.7046 7.97914 13.2386 12.4583 13.2386C16.9375 13.2386 20.5833 16.7046 20.5833 20.9652ZM12.4583 4.40828C13.7386 4.40828 14.7798 5.39838 14.7798 6.61587C14.7798 7.83336 13.7386 8.82346 12.4583 8.82346C11.1781 8.82346 10.1369 7.83336 10.1369 6.61587C10.1369 5.39838 11.1781 4.40828 12.4583 4.40828ZM12.4583 11.0311C15.0189 11.0311 17.1012 9.05084 17.1012 6.61587C17.1012 4.18089 15.0189 2.20068 12.4583 2.20068C9.8978 2.20068 7.81548 4.18089 7.81548 6.61587C7.81548 9.05084 9.8978 11.0311 12.4583 11.0311Z" fill="#A5ADBB"/>
                        </svg>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="/orders" class="orders">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M11.0361 7.06269L11.3466 7.45465L11.3465 7.45468L11.3464 7.45475L11.3462 7.45496L11.3453 7.45565L11.3422 7.45808L11.3307 7.46716L11.2866 7.50164C11.248 7.53171 11.1912 7.5757 11.1175 7.63215C10.97 7.74505 10.7547 7.90786 10.4812 8.10894L10.4704 8.1169L10.4591 8.12426C10.3482 8.19701 10.2254 8.29663 10.0749 8.42645C10.0296 8.46556 9.98074 8.50826 9.9294 8.55316C9.82012 8.64875 9.69944 8.7543 9.57655 8.85641L9.56926 8.86247L9.56174 8.86825C9.40888 8.98576 9.2545 9.13498 9.07945 9.31551C9.02597 9.37066 8.9692 9.43021 8.91007 9.49223C8.78557 9.62283 8.65062 9.7644 8.51397 9.8989M11.0361 7.06269L8.16279 9.54299M11.0361 7.06269L11.3466 7.45463L11.0473 6.91512L11.9821 6.80636L11.195 6.06934C10.9628 5.85191 10.8197 5.54752 10.8197 5.20974C10.8197 4.55816 11.348 4.03027 11.9998 4.03027C12.6503 4.03027 13.1773 4.55724 13.1786 5.20809C13.1785 5.54637 13.0352 5.85112 12.804 6.06888L12.022 6.80534L13.089 6.92952C17.8925 7.48855 21.6534 11.7164 21.6534 16.8786C21.6534 16.9967 21.6512 17.1145 21.647 17.2319C17.701 17.2318 14.4362 17.2307 11.0845 17.2294C9.35977 17.2288 7.61209 17.2282 5.73679 17.2277C5.74617 17.1467 5.75677 17.0669 5.76934 16.9877L5.77241 16.9683L5.77396 16.9488C5.82985 16.2411 5.96315 15.5495 6.10499 14.8436C6.19859 14.5046 6.28434 14.1649 6.36183 13.8272M11.0361 7.06269L10.986 6.92226L10.986 6.92226L11.0361 7.06269ZM11.0361 7.06269L6.36183 13.8272M8.51397 9.8989C8.51382 9.89905 8.51366 9.8992 8.51351 9.89936L8.16279 9.54299M8.51397 9.8989C8.5141 9.89877 8.51423 9.89864 8.51436 9.89851L8.16279 9.54299M8.51397 9.8989C8.44206 9.97008 8.37205 10.057 8.28868 10.168C8.2696 10.1934 8.24915 10.2211 8.22763 10.2501C8.16318 10.3371 8.08911 10.4371 8.01317 10.5301M8.16279 9.54299C8.037 9.66738 7.92918 9.81293 7.81954 9.96095C7.75616 10.0465 7.69217 10.1329 7.62375 10.2165M8.01317 10.5301C8.01393 10.5292 8.01468 10.5282 8.01543 10.5273L7.62375 10.2165M8.01317 10.5301C7.97574 10.5773 7.93061 10.6345 7.88455 10.6929C7.84047 10.7487 7.79555 10.8056 7.75574 10.8559M8.01317 10.5301C8.01234 10.5311 8.0115 10.5322 8.01067 10.5332L7.62375 10.2165M7.62375 10.2165L7.75574 10.8559M7.75574 10.8559C7.76114 10.847 7.76653 10.8381 7.77191 10.8293L7.34468 10.5695L7.73626 10.8804C7.74259 10.8724 7.7491 10.8642 7.75574 10.8559ZM7.75574 10.8559C7.6815 10.9779 7.60592 11.1021 7.52828 11.2281L7.52288 11.2368L7.51711 11.2454C7.21303 11.6962 6.97871 12.2283 6.7158 12.8253C6.70607 12.8474 6.6963 12.8696 6.68648 12.8919M7.75574 10.8559L7.10261 10.9658C6.77259 11.455 6.52153 12.0255 6.26485 12.6087C6.25005 12.6423 6.23524 12.676 6.22039 12.7097M6.68648 12.8919C6.68878 12.8852 6.69108 12.8785 6.69338 12.8718L6.22039 12.7097M6.68648 12.8919C6.60984 13.1153 6.53095 13.3417 6.45175 13.5689C6.42179 13.6549 6.39178 13.741 6.36183 13.8272M6.68648 12.8919C6.68363 12.8984 6.68078 12.9048 6.67792 12.9113L6.22039 12.7097M6.22039 12.7097L6.36183 13.8272M2.34705 16.8801C2.34705 12.3712 5.2144 8.57531 9.14204 7.31408C9.01488 7.38212 8.88657 7.45358 8.75806 7.52514C8.73612 7.53736 8.71417 7.54958 8.69222 7.56179C8.27277 7.76741 7.86102 8.0764 7.46404 8.3743C7.40016 8.42224 7.33665 8.46989 7.27356 8.51678C7.12382 8.62565 6.99075 8.7477 6.87311 8.86037C6.82975 8.90191 6.7898 8.94082 6.75137 8.97827C6.67761 9.05012 6.60942 9.11655 6.53324 9.18575L6.52586 9.19245L6.51875 9.19945C6.48388 9.23376 6.44863 9.26839 6.41311 9.30329C6.32972 9.38521 6.24481 9.46863 6.15975 9.55289L6.1373 9.57513L6.11783 9.60002C6.01527 9.7311 5.91118 9.86281 5.80375 9.99827C5.31418 10.5767 4.91352 11.2546 4.56272 11.9576L4.55612 11.9708L4.5503 11.9844C4.49012 12.1253 4.43027 12.2662 4.37027 12.4074C4.27902 12.6221 4.18742 12.8377 4.09374 13.0556L4.08427 13.0777L4.07695 13.1005C3.95656 13.4761 3.83908 13.8603 3.72846 14.2516L3.72479 14.2646L3.72182 14.2777C3.54861 15.0465 3.37146 15.8611 3.2883 16.6824C3.26525 16.8663 3.24827 17.0492 3.23442 17.229L2.35256 17.229C2.34889 17.1134 2.34705 16.9971 2.34705 16.8801Z" stroke="#A5ADBB"/>
                            <path d="M24 18.353H0V20.4705H24V18.353Z" fill="#A5ADBB"/>
                        </svg>


                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="/notifications" class="notifications">
                        <svg width="24" height="23" viewBox="0 0 24 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M18 7.33598C18 5.87676 17.3679 4.47731 16.2426 3.44548C15.1174 2.41366 13.5913 1.83398 12 1.83398C10.4087 1.83398 8.88258 2.41366 7.75736 3.44548C6.63214 4.47731 6 5.87676 6 7.33598C6 13.755 3 15.589 3 15.589H21C21 15.589 18 13.755 18 7.33598Z" stroke="#A5ADBB" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M13.73 19.2568C13.5542 19.5348 13.3018 19.7655 12.9982 19.9258C12.6946 20.0862 12.3504 20.1706 12 20.1706C11.6496 20.1706 11.3054 20.0862 11.0018 19.9258C10.6982 19.7655 10.4458 19.5348 10.27 19.2568" stroke="#A5ADBB" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="/reviews" class="reviews">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g clip-path="url(#clip0)">
                                <path d="M23.4913 15.5018C23.4349 15.4485 23.3653 15.4111 23.2897 15.3935L19.1618 14.4497L18.6585 13.6241L22.965 8.67315C23.1312 8.4974 23.1234 8.22021 22.9476 8.05403C22.8912 8.00073 22.8216 7.96335 22.7461 7.94573L15.7866 6.33486L12.1042 0.218555C11.9844 0.0100224 11.7182 -0.0618379 11.5097 0.0579711C11.4429 0.0963553 11.3875 0.151792 11.3491 0.218555L7.66925 6.33486L0.709751 7.94573C0.475356 7.99947 0.328929 8.23311 0.382667 8.46751C0.39865 8.53704 0.431434 8.60166 0.478187 8.65553L5.1598 14.052L4.54314 21.1725C4.52118 21.412 4.69749 21.624 4.93698 21.6459C5.00872 21.6525 5.08096 21.6412 5.14722 21.613L11.7266 18.8217L12.2451 19.0432L12.4666 19.2949L12.1017 23.5058C12.0797 23.7453 12.256 23.9572 12.4955 23.9792C12.5673 23.9858 12.6395 23.9745 12.7058 23.9463L16.6096 22.3153L20.4631 23.9488C20.6768 24.0622 20.9419 23.981 21.0553 23.7673C21.0947 23.6933 21.1119 23.6095 21.105 23.5259L20.74 19.2949L23.5087 16.1209C23.6749 15.9452 23.6671 15.668 23.4913 15.5018ZM5.47694 20.5257L6.0483 13.9463C6.05975 13.8164 6.01268 13.6881 5.91993 13.5965L1.61335 8.63545L8.04679 7.14539C8.16912 7.11789 8.2737 7.03905 8.33373 6.92893L11.7266 1.28582L15.1321 6.94403C15.1931 7.04616 15.2931 7.1189 15.409 7.14539L21.8425 8.63545L18.1928 12.8388L16.9872 10.8252C16.8674 10.6167 16.6012 10.5448 16.3927 10.6647C16.3258 10.703 16.2705 10.7585 16.2321 10.8252L14.0574 14.4497L9.94209 15.4011C9.7077 15.4549 9.56127 15.6885 9.61501 15.9229C9.63093 15.9924 9.66378 16.0571 9.71053 16.1109L11.3717 18.0238L5.47694 20.5257ZM19.9623 18.8796C19.8849 18.9684 19.8468 19.0845 19.8565 19.2018L20.1762 22.8741L16.7757 21.4293C16.6679 21.384 16.5463 21.384 16.4385 21.4293L13.0456 22.8666L13.3652 19.1968C13.3767 19.0668 13.3296 18.9386 13.2368 18.8469L10.8432 16.0782L14.4324 15.2677C14.5547 15.2402 14.6593 15.1614 14.7194 15.0513L16.6096 11.9101L18.5074 15.0664C18.5695 15.1696 18.6715 15.2425 18.7893 15.2677L22.3786 16.0983L19.9623 18.8796Z" fill="#A5ADBB" stroke="#A5ADBB"/>
                            </g>
                            <defs>
                                <clipPath id="clip0">
                                    <rect width="24" height="24" fill="white"/>
                                </clipPath>
                            </defs>
                        </svg>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="/logout" class="logout">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M15 3H19C19.5304 3 20.0391 3.21071 20.4142 3.58579C20.7893 3.96086 21 4.46957 21 5V19C21 19.5304 20.7893 20.0391 20.4142 20.4142C20.0391 20.7893 19.5304 21 19 21H15" stroke="#A5ADBB" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M10 17L15 12L10 7" stroke="#A5ADBB" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M15 12H3" stroke="#A5ADBB" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>

                    </a>
                </li>
            </ul>
        </nav>
        <main>
            <div class="container ">
                <div class="row">
                    <div class="offset-md-2"></div>
                    <div class="col-md-7">
                        <div class="p-details my-4 p-3">
                            <div class="p-details-header">
                                <h5>Personal Details</h5>
                            </div>
                            <div class="p-details-content">
                                <form action="#" method="POST" id="form" class="p-details-form">

                                    <input type="hidden" name="token" value="{{\App\Classes\CSRFToken::_token()}}">
                                    <div class="form-row mb-2">
                                        <div class="col">
                                            <label for="firstname" class="">First name</label>
                                            <input type="text" class="form-control" placeholder="First name" value="" id="firstname" name="firstname">
                                        </div>
                                        <div class="col">
                                            <label for="surname" class="">Last</label>
                                            <input type="text" class="form-control" placeholder="Last name" value="" id="surname" name="surname">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="email" class="">Email</label>
                                        <input type="email" class="form-control form-control-lg" placeholder="Enter password" value="" id="email" name="email">
                                    </div>
                                    <div class="form-group">
                                        <label for="phone" class="">Phone Number</label>
                                        <input type="tel" class="form-control form-control-lg" placeholder="Enter password" value="" id="phone" name="phone">
                                    </div>


                                </form>
                            </div>
                        </div>
                        <div class="p-details my-5 p-3">
                            <div class="p-details-header">
                                <h5>Contact Details</h5>
                            </div>
                            <div class="p-details-content">
                                <form action="#" method="POST" id="form" class="p-details-form">
                                    <div class="form-group">
                                        <label for="address" class="">Address</label>
                                        <input type="text" class="form-control form-control-lg" placeholder="Address" value="" id="address" name="address">
                                    </div>
                                    <div class="form-row mb-2">
                                        <div class="col">
                                            <label for="state" class="">State</label>
                                            <input type="text" class="form-control" placeholder="State" value="" id="state" name="state">
                                        </div>
                                        <div class="col">
                                            <label for="surname" class="">Landmark</label>
                                            <input type="text" class="form-control" placeholder="Landmark" value="" id="landmark" name="landmark">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="p-details my-2 p-3">
                           <button class="btn btn-block theme-bg btn-lg text-white save">Save</button>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>
<script>
    $(document).ready(() => {
        $('.sidebar').toggleClass('sidebar-top', window.pageYOffset > 60);
        $(window).scroll(() => {
            $('.sidebar').toggleClass('sidebar-top', $(this).scrollTop() > 60)
        });
    });
</script>


</body>
</html>
