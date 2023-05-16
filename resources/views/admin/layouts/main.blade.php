<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{URL::asset('style/cp-main.css')}}">
    <title>@yield('title')</title>
</head>
<body>
    <div class="wrapper">
        <div class="right-panel">
            <div class="logo">
                <h1>Company Name</h1>
            </div>
            <ul class="nav">
                <li class="section">
                    <a href="{{route('cp')}}">
                        <div class="section-header">
                            <i class="uil uil-chart-line"></i>
                            <h1>Statistics</h1>
                        </div>
                    </a> 
                </li>
                <li class="section">
                    <div class="section-header">
                        <i class="uil uil-cloud-computing"></i>
                        <h1>Product Management</h1>
                    </div>
                    <ul class="subsection">
                        <a href="{{route('hardwares.index')}}"><li>Hardwares</li></a>
                        <a href="{{route('softwares.index')}}"><li>Softwares</li></a>
                        <a href="{{route('services.index')}}"><li>Services</li></a>
                        <a href="{{route('courses.index')}}"><li>Courses</li></a>
                    </ul>
                </li>
                <li class="section">
                    <div class="section-header">
                        <i class="uil uil-clipboard-notes"></i>
                        <h1>Orders</h1>
                    </div>
                    <ul class="subsection">
                        <a href="{{route('indexPendingOrders')}}"><li>Pending</li></a>
                        <a href="{{route('indexDeliveringOrders')}}"><li>Delivering</li></a>
                        <a href="{{route('indexCompletedOrders')}}"><li>Completed</li></a>
                        <a href="{{route('indexArchivedOrders')}}"><li>Archived</li></a>
                    </ul>
                </li>
                <li class="section">
                    <div class="section-header">
                        <i class="uil uil-envelope"></i>
                        <h1>Mailing</h1>
                    </div>
                    <ul class="subsection">
                        <a href="{{route('adminIndexOngoingTickets')}}"><li>Ongoing</li></a>
                        <a href="{{route('adminIndexClosedTickets')}}"><li>Closed</li></a>
                        <a href="{{route('adminIndexArchivedTickets')}}"><li>Archived</li></a>
                    </ul>
                </li>
                <li class="section">
                    <div class="section-header">
                        <i class="uil uil-user-square"></i>
                        <h1>Acounts</h1>
                    </div>
                    <ul class="subsection">
                        <a href="{{route('users.index')}}"><li>Users</li></a>
                        <a href="{{route('admins.index')}}"><li>Administrators</li></a>
                    </ul>
                </li>
                <li class="section">
                    <a href="#">
                    <div class="section-header">
                        <i class="uil uil-setting"></i>
                        <h1>General</h1>
                    </div>
                    </a>
                </li>
            </ul>

            <div class="footer">
                <p>2022-2023</p>
            </div>
        </div>
        <section class="main">
            <div class="header">
                <div class="profile">
                    <a href="{{route('adminProfile')}}">
                        <div class="icon user-circle" style="height: 30px;">
                            <img src="{{URL::asset('assets/icons/user-circle.svg')}}" style="height: 100%;">
                        </div>
                    </a> 
                </div>
                <div class="icon bell" style="height: 30px;">
                    <img src="{{URL::asset('assets/icons/bell.svg')}}" style="height: 100%;">
                </div>
            </div>
            <section class="sub">
                <div class="content">
                    @yield('main-content')
                </div>
                <div class="left-panel">
                    @yield('left-panel')
                </div>
            </section>
        </section>
    </div>
</body>
</html>