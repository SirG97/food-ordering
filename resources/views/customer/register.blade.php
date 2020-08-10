@extends('customer.layout.auth')
@section('title', 'Register')
@section('content')

    <form action="/customer/register" method="POST" id="form">
        <div class="formheadercontainer">
            <span class="formheadertext">Create your account</span>
        </div>
        <input type="hidden" name="token" value="{{\App\Classes\CSRFToken::_token()}}">
        <div class="form-group">

            <input type="email" class="form-control" placeholder="Email" value="" id="email" name="email">
        </div>
        <div class="form-row mb-2">
            <div class="col">

                <input type="text" class="form-control" placeholder="First name" value="" id="firstname" name="firstname">
            </div>
            <div class="col">

                <input type="text" class="form-control" placeholder="Last name" value="" id="surname" name="surname">
            </div>
        </div>
        <div class="form-group">
            <input type="text" class="form-control" placeholder="Phone number" value="" id="phone" name="phone">
        </div>
        <div class="form-group">
            <input type="password" class="form-control" placeholder="Password" value="" id="password" name="password">
        </div>
        <div class="form-group">
            <input type="password" class="form-control" placeholder="Confirm Password" value="" id="cpassword" name="cpassword">
        </div>
        <button class="btn btn-primary btn-block btn-lg" type="submit">Register</button>
        <div class="loginregtext">
            <a href="/customer/login">Already have an account? Login</a>
        </div>
    </form>
@endsection()