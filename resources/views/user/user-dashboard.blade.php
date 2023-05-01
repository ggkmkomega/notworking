<head>
    <link rel="stylesheet" href="{{ URL::asset('style/dashboard.css')}}">
</head>
@extends('layouts.website-main')
@section('content')
    <h1 class="title">User Dashboard</h1>
    <hr>
    <div class="db-wrapper">
        <div class="left-panel">

            <br>
            <h3>Account</h3>
            <ul>
                <a href="#"><li>Account Settings</li></a>
                <a href="#"><li>Verify Email</li></a>
                <a href="#"><li>Notification Settings</li></a>
            </ul>
            <br>

            <h3>Orders</h3>
            <ul>
                <a href="#"><li>New Order</li></a>
                <a href="#"><li>Order Tracker</li></a>
            </ul>
            <br>

            <a href=""><h3>Subscription</h3></a>
            <br>

        </div>
        <div class="content">
            @yield('section-content')   
        </div>
    </div>
@endsection