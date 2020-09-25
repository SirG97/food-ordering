 @php
    $priviledge = App\Classes\Session::get('priviledge');
@endphp
@if($priviledge === 'Admin')
    @extends('user.layout.base')
@elseif($priviledge === 'Manager')
    @extends('user.layout.usermenu')
@endif

