<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ URL::asset('style/main.css')}}">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
    <title>@yield('title')</title>
</head>
<body>
    <div id="wrapper">
        <!--Header-->
        <header>
            <!--Logo-->
            <div id="logo">
                <h1>Brand Name</h1>
            </div>

            <!--Navigation Menu-->
            <nav>
                <ul>
                    <li class="menu-item">
                        <a href="#">Products</a>
                    </li >
                    <li class="menu-item">
                        <a href="#">Services</a>
                    </li>
                    <li class="menu-item">
                        <a href="#">About</a>
                    </li>
                    <li class="menu-item">
                        <a href="#">Contact</a>
                    </li>
                </ul>
            </nav>

            <!--Search Bar-->
            <script src="{{ URL::asset('script/search-bar.js')}}" defer></script>
            <i class="uil uil-search" id="searchIcon"></i>
            <div class="search-bar">
                <i class="uil uil-search"></i>
                <input type="text" placeholder="Search">
            </div>

            <div id="account">
                <i class="uil uil-bell"></i>
                <a href="/pfe/public/register"><i class="uil uil-user-circle"></i></a>
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
                    <h1>Brand Name</h1>
                    <p>Brand Slogan</p>
                    <hr>
                    <i class="uil uil-envelope-alt"></i>
                    <a href="">info@brandname.com</a>
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
                        <a href=""><i class="uil uil-twitter"></i></a>
                        <a href=""><i class="uil uil-linkedin"></i></a>
                        <a href=""><i class="uil uil-instagram"></i></a>
                        <a href=""><i class="uil uil-facebook"></i></a>
                    </div>
                </div>
                <div class="container" id="products">
                    <h1>Products</h1>
                    <hr>
                    <h2><a href="#">Services</a></h2>
                    <p><a href="#">Categorie 1</a></p>
                    <p><a href="#">Categorie 2</a></p>
                    <p><a href="#">Categorie 3</a></p>
                    <br>
                    <h2><a href="#">Hardware/Software</a></h2>
                    <p><a href="#">Categorie 1</a></p>
                    <p><a href="#">Categorie 2</a></p>
                    <p><a href="#">Categorie 3</a></p>
                    <br>
                    <h2><a href="#">Courses</a></h2>
                    <p><a href="#">Categorie 1</a></p>
                    <p><a href="#">Categorie 2</a></p>
                    <p><a href="#">Categorie 3</a></p>
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
                            <i class="uil uil-globe"></i>
                            <p>English</p>
                        </div>
                    </div>
                </div>
            </div>
            <div id="sub-footer">
                <p><a href="#">@2023, Brand Name, Inc.</a></p>
                <p><a href="#">Terms</a></p>
                <p><a href="#">Privacy</a></p>
                <p><a href="#">Security</a></p>
                <p><a href="#">Careers</a></p>
            </div>
        </footer>
    </div>
</body>
</html>