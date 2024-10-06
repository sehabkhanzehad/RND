@php
    $layout = \App\Models\Layout::first();
@endphp
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    @yield('title')
    <meta name="description" content="">
    <meta name="keywords" content="">

    <!-- Favicons -->
    <link href="{{ $layout->favicon }}" rel="icon">
    <link href="{{ asset('assets') }}/homepage/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('assets') }}/homepage/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('assets') }}/homepage/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="{{ asset('assets') }}/homepage/vendor/aos/aos.css" rel="stylesheet">
    <link href="{{ asset('assets') }}/homepage/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="{{ asset('assets') }}/homepage/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="{{ asset('assets') }}/homepage/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- Main CSS File -->
    <link href="{{ asset('assets') }}/homepage/css/main.css" rel="stylesheet">
</head>

<body class="index-page">

    <header id="header" class="header d-flex align-items-center fixed-top">
        <div class="container-fluid container-xl position-relative d-flex align-items-center">

            <a href="{{ route('home.index') }}" class="logo d-flex align-items-center me-auto">
                <!-- Uncomment the line below if you also wish to use an image logo -->
                <img src="{{ $layout->header_logo }}" alt="">
                {{-- <h1 class="sitename">Logis</h1> --}}
            </a>

            <nav id="navmenu" class="navmenu">
                <ul>
                    <li><a href="{{ route('home.index') }}" class="active">Home<br></a></li>
                    <li><a href="{{ route('home.about') }}">About</a></li>
                    <li><a href="{{ route('home.service') }}">Services</a></li>
                    <li><a href="{{ route('home.project') }}">Projects</a></li>
                    <li><a href="{{ route('home.pricing') }}">Pricing</a></li>
                    {{-- <li class="dropdown"><a href="#"><span>Dropdown</span> <i
                                class="bi bi-chevron-down toggle-dropdown"></i></a>
                        <ul>
                            <li><a href="#">Dropdown 1</a></li>
                            <li class="dropdown"><a href="#"><span>Deep Dropdown</span> <i
                                        class="bi bi-chevron-down toggle-dropdown"></i></a>
                                <ul>
                                    <li><a href="#">Deep Dropdown 1</a></li>
                                    <li><a href="#">Deep Dropdown 2</a></li>
                                    <li><a href="#">Deep Dropdown 3</a></li>
                                    <li><a href="#">Deep Dropdown 4</a></li>
                                    <li><a href="#">Deep Dropdown 5</a></li>
                                </ul>
                            </li>
                            <li><a href="#">Dropdown 2</a></li>
                            <li><a href="#">Dropdown 3</a></li>
                            <li><a href="#">Dropdown 4</a></li>
                        </ul>
                    </li> --}}
                    <li><a href="{{ route('home.contact') }}">Contact</a></li>
                </ul>
                <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
            </nav>

            {{-- <a class="btn-getstarted" href="get-a-quote.html">Get a Quote</a> --}}
            <a class="btn-getstarted" target="_blank" href="{{ route('user.login') }}">Temp Sign In</a>

        </div>
    </header>

    <main class="main">
        @yield('content')
    </main>


    <footer id="footer" class="footer dark-background">

        <div class="container footer-top">
            <div class="row gy-4">
                <div class="col-lg-5 col-md-12 footer-about">
                    <a href="{{ route('home.index') }}" class="logo d-flex align-items-center me-auto">
                        {{-- <span class="sitename">Logis</span> --}}
                        <img src="{{ $layout->footer_logo }}" alt="">
                    </a>


                    <p style="text-align: justify">{{ $layout->footer_text }}</p>
                    <div class="social-links d-flex mt-4">
                        <a href="{{ $layout->facebook_link }}"><i class="bi bi-facebook"></i></a>
                        <a href="{{ $layout->linkedin_link }}"><i class="bi bi-linkedin"></i></a>
                        <a href="{{ $layout->whatsapp_link }}"><i class="bi bi-whatsapp"></i></a>
                        <a href="{{ $layout->instagram_link }}"><i class="bi bi-instagram"></i></a>
                        <a href="{{ $layout->twitter_link }}"><i class="bi bi-twitter-x"></i></a>
                    </div>
                </div>

                <div class="col-lg-2 col-6 footer-links">
                    <h4>Useful Links</h4>
                    <ul>
                        <li><a href="{{ route('home.index') }}">Home</a></li>
                        <li><a href="{{ route('home.about') }}">About us</a></li>
                        <li><a href="{{ route('home.service') }}">Services</a></li>
                        <li><a href="{{ route('home.pricing') }}">Pricing</a></li>
                        <li><a href="{{ route('home.contact') }}">Contact</a></li>
                        {{-- <li><a href="#">Terms of service</a></li> --}}
                        {{-- <li><a href="#">Privacy policy</a></li> --}}
                    </ul>
                </div>

                <div class="col-lg-2 col-6 footer-links">
                    <h4>Our Services</h4>
                    <ul>
                        <li><a href="#">Web Design</a></li>
                        <li><a href="#">Web Development</a></li>
                        <li><a href="#">Product Management</a></li>
                        <li><a href="#">Marketing</a></li>
                        <li><a href="#">Graphic Design</a></li>
                    </ul>
                </div>

                <div class="col-lg-3 col-md-12 footer-contact text-center text-md-start">
                    <h4>Contact Us</h4>
                    <address>
                        {{ $contacts->address }}
                    </address>
                    <p class="mt-4"><strong>Phone:</strong> <span>{{ $contacts->phone }}</span></p>
                    <p><strong>Email:</strong> <span>{{ $contacts->email }}</span></p>
                </div>

            </div>
        </div>

        <div class="container copyright text-center mt-4">
            <p>© <span>Copyright</span> <strong class="px-1 sitename">RND GLOBAL NEST</strong> <span>All Rights
                    Reserved</span>
            </p>
            <div class="credits">
                <!-- All the links in the footer should remain intact. -->
                <!-- You can delete the links only if you've purchased the pro version. -->
                <!-- Licensing information: https://bootstrapmade.com/license/ -->
                <!-- Purchase the pro version with working PHP/AJAX contact form: [buy-url] -->
                Developed by <a href="{{ route('home.index') }}">RND GLOBAL NEST</a>
            </div>
        </div>

    </footer>

    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Preloader -->
    <div id="preloader"></div>

    <!-- Vendor JS Files -->
    <script src="{{ asset('assets') }}/homepage/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('assets') }}/homepage/vendor/php-email-form/validate.js"></script>
    <script src="{{ asset('assets') }}/homepage/vendor/aos/aos.js"></script>
    <script src="{{ asset('assets') }}/homepage/vendor/purecounter/purecounter_vanilla.js"></script>
    <script src="{{ asset('assets') }}/homepage/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="{{ asset('assets') }}/homepage/vendor/swiper/swiper-bundle.min.js"></script>

    <!-- Main JS File -->
    <script src="{{ asset('assets') }}/homepage/js/main.js"></script>

</body>

</html>
