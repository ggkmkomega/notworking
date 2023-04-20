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
                    <h1>Statistics</h1>
                    
                </li>
                <li class="section">
                    <h1>Product Management</h1> 
                    <ul class="subsection">
                        <a href="{{route('hardwares.index')}}"><li>Hardwares</li></a>
                        <a href="#"><li>Softwares</li></a>
                        <a href="#"><li>Services</li></a>
                        <a href="#"><li>Courses</li></a>
                    </ul>
                </li>
                <li class="section">
                    <h1>Orders</h1>
                    <ul class="subsection">
                        <a href="#"><li>Pending</li></a>
                        <a href="#"><li>Delivering</li></a>
                        <a href="#"><li>Completed</li></a>
                        <a href="#"><li>Archived</li></a>
                    </ul>
                </li>
                <li class="section">
                    <h1>Mailing</h1>
                    <ul class="subsection">
                        <a href="#"><li>Incoming</li></a>
                        <a href="#"><li>being Contacted</li></a>
                        <a href="#"><li>Archived</li></a>
                    </ul>
                </li>
                <li class="section">
                    <h1>Acounts</h1>
                    <ul class="subsection">
                        <a href="#"><li>Users</li></a>
                        <a href="#"><li>Administrators</li></a>
                    </ul>
                </li>
                <li class="section">
                    <h1>General</h1>
                    <ul class="subsection">
                        <a href="#"><li>todo...</li></a>
                    </ul>
                </li>
            </ul>

            <div class="footer">
                <p>2022-2023</p>
            </div>
        </div>
        <section class="main">
            <div class="header">
                
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