<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ URL::asset('style/main.css')}}">
    <title>@yield('title')</title>
</head>
<body>
    <div id="wrapper">
        <!--Header-->
        <header>
            <!--Logo-->
            <div id="logo">
                <a href="{{route('main')}}"><h1>Company Name</h1></a>
            </div>

            <!--Navigation Menu-->
            <nav>
                <ul>
                    <li class="menu-item">
                        <a class="dropbtn btn" href="#">Products</a>
                        <div class="dropdown-content">
                            <a href="{{route('swSiteIndex')}}">Software</a>
                            <a href="{{route('hwSiteIndex')}}">Hardware</a>
                        </div>
                    </li >
                    <li class="menu-item">
                        <a class="dropbtn btn" href="#">Services</a>
                        <div class="dropdown-content">
                            @foreach ($services as $service)
                                <a href="{{route('svSiteShow', $service)}}">{{$service->name}}</a>
                            @endforeach
                            <a href="{{route('crSiteIndex')}}">Courses</a>
                        </div>
                    </li>
                    <li class="menu-item">
                        <a class="btn" href="#">About</a>
                    </li>
                    <li class="menu-item">
                        <a class="btn" href="#">Contact</a>
                    </li>
                </ul>
            </nav>

            <!--Search Bar-->
            <script src="{{ URL::asset('script/search-bar.js')}}" defer></script>
            <div class="icon search" id="searchIcon">
                <img src="{{URL::asset('assets/icons/search.svg')}}" style="height: 100%;">
            </div>
            <div class="search-bar">
                <form action="{{url('search')}}"  method="get">
                    @csrf
                    <button type="submit">
                        <div class="icon search">
                            <img src="{{URL::asset('assets/icons/search.svg')}}" style="height: 100%;">
                        </div>
                    </button>
                    <input type="search" name="search" value="" placeholder="Search">
                </form>
            </div>
            <div id="account">
                @if (Auth::check())
                <div class="icon bell">
                    <img src="{{URL::asset('assets/icons/bell.svg')}}" style="height: 100%;">
                </div>
                    <div class="account-menu">
                        <div class="account-btn">
                            <div class="icon user">
                                <img src="{{URL::asset('assets/icons/user-circle.svg')}}" style="height: 100%;">
                            </div>
                        </div>
                        
                        <div class="dropdown-menu">
                            <a class="ddm" href="#">settings</a>
                            <hr>
                            <a class='ddm' href="{{route('userDashboard')}}">dashboard</a>
                            <hr>
                            <a class="ddm signout" href="{{route('userSignOut')}}">signout</a>
                        </div>
                    </div>
                    <script>
                        const accBtn = document.querySelector('#account .account-menu .account-btn')
                        const accDropMenu = document.querySelector('#account .account-menu .dropdown-menu')
                        accBtn.addEventListener('click', () => {
                            accDropMenu.classList.toggle('display')
                        })
                    </script>
                @else
                    <a href="{{route('loginForm')}}">
                        <p id="login-btn" class="user-logged-out">Login</p>
                    </a>
                    <a href="{{route('registerForm')}}">
                        <p id="register-btn" class="user-logged-out">Register</p>
                    </a>
                @endif
            </div>
        </header>

        <!--Main Content-->
        <main>
            @yield('content')
        </main>

        <!--Footer-->
        <footer>
            <div id="elements-container">
                <div class="container" id="brand-name">
                    <h1>Company Name</h1>
                    <p>Company Slogan</p>
                    <hr>
                    <div class="icon envelope" style="height: 28px; width:fit-content;">
                        <img src="{{URL::asset('assets/icons/envelope.svg')}}" style="height: 100%;">
                    </div>
                    <a href="" style="display: block;">info@brandname.com</a>
                </div>
                <div class="container" id="adress">
                    <h1>Adresses</h1>
                    <hr>
                    <h2>Country - City</h2>
                    <p>Full Adress</p>
                    <p>Zip Code</p>
                    <p>Phone</p>
                    <br>
                    <h2>Country - City</h2>
                    <p>Full Adress</p>
                    <p>Zip Code</p>
                    <p>Phone</p>
                    <br>
                    <h1>Follow Us</h1>
                    <hr>
                    <div id="social-icons">
                        <a href="">
                            <div class="icon twitter" style="height: 100%;">
                                <img src="{{URL::asset('assets/icons/twitter.svg')}}" style="height: 100%;">
                            </div>
                        </a>
                        <a href="">
                            <div class="icon linkedin" style="height: 100%;">
                                <img src="{{URL::asset('assets/icons/linkedin.svg')}}" style="height: 100%;">
                            </div>
                        </a>
                        <a href="">
                            <div class="icon instagram" style="height: 100%;">
                                <img src="{{URL::asset('assets/icons/instagram-alt.svg')}}" style="height: 100%;">
                            </div>
                        </a>
                        <a href="">
                            <div class="icon facebook" style="height: 100%;">
                                <img src="{{URL::asset('assets/icons/facebook.svg')}}" style="height: 100%;">
                            </div>
                        </a>
                    </div>
                </div>
                <div class="container" id="products">
                    <h1>Products</h1>
                    <hr>
                    <h2><a href="#">Services</a></h2>
                    @for ($i = 0; $i < 5; $i++)
                        @if (isset($services[$i])) 
                        <p><a href="{{route('svSiteShow', $services[$i])}}">{{$services[$i]->name}}</a></p>
                        @endif
                    @endfor
                    <p><a href="{{route('crSiteIndex')}}">Courses</a></p>
                    <br>
                    <h2><a href="{{route('hwSiteIndex')}}">Hardware</a></h2>
                    <br>
                    <h2><a href="{{route('swSiteIndex')}}">Software</a></h2>
                </div>
                <div class="container" id="client">
                    <h1>Client</h1>
                    <hr>
                    <p><a href="#">Login</a></p>
                    <p><a href="#">Register</a></p>
                    <p><a href="#">Dashboard</a></p>
                    <p><a href="#">Reviews</a></p>
                    <div id="lang-selector">
                        <script src="{{ URL::asset('script/lang-selector.js')}}" defer></script>
                        <div id="lang-options">
                            <ol>
                                <li value="french">French</li>
                                <li value="french">Arabic</li>
                                <li value="french">German</li>
                            </ol>
                        </div>
                        <div id="lang-btn">
                            <div class="icon globe">
                                <img src="{{URL::asset('assets/icons/globe.svg')}}" style="height: 100%;">
                            </div>
                            <p>English</p>
                        </div>
                    </div>
                </div>
            </div>
            <div id="sub-footer">
                <p><a href="#">@2023, Company Name, Inc.</a></p>
                <p><a href="#">Terms</a></p>
                <p><a href="#">Privacy</a></p>
                <p><a href="#">Security</a></p>
                <p><a href="#">Careers</a></p>
            </div>
        </footer>
    </div>
</body>
</html>