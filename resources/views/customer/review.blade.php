@extends('customer.layout.base')
@section('title', 'Orders')
@section('icon', 'fa-tachometer-alt')
@section('content')
    <div class="table-responsive">
        <table class="table mt-4 order-t-header ">
            <thead>
            <tr>
                <th scope="col">Vendor</th>
                <th scope="col">Rating</th>
                <th scope="col">Comment</th>
                <th scope="col">Time</th>
                <th scope="col">Date</th>
            </tr>
            </thead>
            <tbody class="order-body">
            <tr class="my-3">

                <td>Amala Shitta</td>
                <td> <div class="justify-content-center">
                        <div class="containerdiv d-inline-block mr-2">
                            <div>
                                <img src="/img/stars_blank.png" alt="img">
                            </div>
                            <div class="cornerimage" style="width:calc(100%);">
                                <img src="/img/stars_full.png" alt="">
                            </div>
                        </div>
                    </div></td>
                <td>The food was awesome and well packaged, I love it</td>
                <td>12 Sep 2020</td>
                <td>10:00pm</td>
            </tr>
            <tr>
                <th scope="row">#JH8H3WNLAV</th>
                <td>Delivered</td>
                <td>Amala Shitta</td>
                <td>12 Sep 2020</td>
                <td>10:00pm</td>
            </tr>
            <tr>
                <th scope="row">#JH8H3WNLAV</th>
                <td>Delivered</td>
                <td>Amala Shitta</td>
                <td>12 Sep 2020</td>
                <td>10:00pm</td>
            </tr>
            <tr>
                <th scope="row">#JH8H3WNLAV</th>
                <td>Delivered</td>
                <td>Amala Shitta</td>
                <td>12 Sep 2020</td>
                <td>10:00pm</td>
            </tr>
            <tr>
                <th scope="row">#JH8H3WNLAV</th>
                <td>Delivered</td>
                <td>Amala Shitta</td>
                <td>12 Sep 2020</td>
                <td>10:00pm</td>
            </tr>
            <tr>
                <th scope="row">#JH8H3WNLAV</th>
                <td>Delivered</td>
                <td>Amala Shitta</td>
                <td>12 Sep 2020</td>
                <td>10:00pm</td>
            </tr>
            <tr>
                <th scope="row">#JH8H3WNLAV</th>
                <td>Delivered</td>
                <td>Amala Shitta</td>
                <td>12 Sep 2020</td>
                <td>10:00pm</td>
            </tr>
            <tr>
                <th scope="row">2</th>
                <td>Jacob</td>
                <td>Thornton</td>
                <td>@fat</td>
            </tr>
            <tr>
                <th scope="row">3</th>
                <td>Larry</td>
                <td>the Bird</td>
                <td>@twitter</td>
            </tr>
            </tbody>
        </table>
    </div>

@endsection()