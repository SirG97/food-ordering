@extends('customer.layout.base')
@section('title', 'Notifications')
@section('icon', 'fa-tachometer-alt')
@section('content')
    <div class="container">
        <div class="row">
            <div class="offset-md-2"></div>
            <div class="col-md-8">
                <h5 class="px-2 py-3">Notifications</h5>
                <div class="list-group list-group-flush">
                    @if(!empty($notifications) && count($notifications) > 0)
                        @foreach($notifications as $notification)
                            @if($notification['status'] == true)

                                <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
                                    <div class="d-flex w-100 justify-content-between">
                                        <div class=" d-flex flex-row align-items-center">
                                            <p class="font-weight-bold">{{$notification['message']}}</p>
                                        </div>

                                        <small class="font-weight-bold">{{$notification['created_at']->DiffForHumans()}}</small>
                                    </div>
                                </a>
                            @else
                                <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
                                    <div class="d-flex w-100 justify-content-between">
                                        <div class=" d-flex flex-row align-items-center">
                                            <p class="">{{$notification['message']}}</p>
                                        </div>

                                        <small>{{$notification['created_at']->DiffForHumans()}}</small>
                                    </div>
                                </a>
                            @endif

                        @endforeach

                    @else
                        <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
                            <div class="d-flex w-100 justify-content-center">
                                <div class=" d-flex flex-row align-items-center">
                                    <p class="">No notifications yet.</p>
                                </div>
                            </div>

                        </a>
                    @endif


                </div>
            </div>
        </div>
    </div>


@endsection()
