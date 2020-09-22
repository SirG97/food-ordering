<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/fontawesome-all.css">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/nstyle.css">
    <link rel="stylesheet" href="/webfonts/Poppins-Regular.ttf">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@700&display=swap" rel="stylesheet">
</head>
<body style="">
    <div class="container-fluid">
        <div class="row no-gutter full-height">
            <!-- The image half -->
            <div class="col-md-6 d-none d-md-flex bg-image"></div>


            <!-- The content half -->
            <div class="col-md-6 login">
                <div class="content-part">
                    <div class="signup-text d-flex justify-content-end pt-3 mb-3">
                        <p>Become a vendor ? <span class="theme-color">Click here</span></p>
                    </div>
                    <div class="d-flex justify-content-center ">

                        <!-- Demo content-->
                        <div class="container">
                            <div class="row mx-1 mx-sm-2 mx-md-4">

                                <div class="col-md-8 col-lg-9  mx-auto">
                                    <div class="login-header mb-4">
                                        <h5 class="display-5 text-left login-header">Sign in</h5>
                                    </div>
                                    <div class="login-text">
                                        <p>For the purpose of industry regulation, your details are required</p>
                                    </div>

                                <!-- <p class="text-muted mb-4">Create a login split page using Bootstrap 4.</p> -->
                                    @include('includes.message')
                                    @yield('content')
                                    <form action="/customer/login" method="POST" id="form" class="signin">

                                        <input type="hidden" name="token" value="{{\App\Classes\CSRFToken::_token()}}">
                                        <div class="form-group">
                                            <label for="email" class="">Email Address<span>*</span></label>
                                            <input type="email" class="form-control form-control-lg" placeholder="Enter email address" value="" id="email" name="email">
                                        </div>
                                        <div class="form-group">
                                            <label for="password" class="">Password</label>
                                            <input type="password" class="form-control form-control-lg" placeholder="Enter password" value="" id="password" name="password">
                                        </div>
                                        <div class="fpassword">
                                            <a href="/passwordreset" class="theme-color">Forgot your password?</a>
                                        </div>
                                        <button class="btn theme-bg text-white btn-block btn-lg" type="submit">Login</button>
                                        <div class="loginregtext">
                                            <a href="/customer/register" class="text-black-50">Don't have an account? <span class="theme-color">Register</span></a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div><!-- End -->

                    </div>
                </div>
            </div><!-- End -->

        </div>
    </div>
</body>