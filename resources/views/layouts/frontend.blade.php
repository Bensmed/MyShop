<?php
use App\Models\Settings;
$settings = Settings::where('id', 1)->first();

$facebook_pixel = $settings->facebook_pixel;
?>
<!doctype html>
<html lang="en">

<head>


    <!--====== Required meta tags ======-->
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="{{ $settings->website_description }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    @yield('title')

    <!--====== Title ======-->
    <title>{{ $settings->website_title }}</title>

    <!-- CSS -->
    <script src="{{ asset('css/app.css') }}" defer></script>
    <link rel="stylesheet" href="{{ URL::asset('assets/css/style.css') }}">

    <!--====== Favicon Icon ======-->
    <link rel="shortcut icon" href="{{ URL::asset('images/Logo/' . $settings->favicon) }}" type="image/png">

    @if ($facebook_pixel !== null)
        <!-- Meta Pixel Code -->
        <script>
            ! function(f, b, e, v, n, t, s) {
                if (f.fbq) return;
                n = f.fbq = function() {
                    n.callMethod ?
                        n.callMethod.apply(n, arguments) : n.queue.push(arguments)
                };
                if (!f._fbq) f._fbq = n;
                n.push = n;
                n.loaded = !0;
                n.version = '2.0';
                n.queue = [];
                t = b.createElement(e);
                t.async = !0;
                t.src = v;
                s = b.getElementsByTagName(e)[0];
                s.parentNode.insertBefore(t, s)
            }(window, document, 'script',
                'https://connect.facebook.net/en_US/fbevents.js');
            fbq('init', {{ $facebook_pixel }});
            fbq('track', 'PageView');
        </script>

        <noscript><img height="1" width="1" style="display:none"
                src="https://www.facebook.com/tr?id={{ $facebook_pixel }}&ev=PageView&noscript=1" /></noscript>
        <!-- End Meta Pixel Code -->
    @endif




    <style>
        :root {
            /* Green #13bb89*/
            --main-color: {{ $settings->primary_color }};
            /*#be123c;*/
            --hover-color: {{ $settings->hover_color }};
            /*#e11d48*/
            --main-color-opacity: {{ $settings->transparent_color }};

            --second-color: #ffb503;
            --price-color: #1b1b1b;
            --price-red-color: #bd081c;
            --link-color: #203656;
            --bar-color: #1b1b1b;
            --product-price: #13bb89;
            --light-color: #8F9BAD;
            --color-main-text: #021523;

            /* -------- Socail Media */
            --facebook: #3b5998;
            --twitter: #1da1f2;
            --instagram: #f46f30;
            --linkedin: #0a66c2;
            --youtube: #ff0000;
            --whatsapp: #25d366;
        }

    </style>

    <!--====== Bootstrap css ======-->
    <link rel="stylesheet" href="{{ URL::asset('assets/css/bootstrap.min.css') }}">

    <!--====== Animate css ======-->
    <link rel="stylesheet" href="{{ URL::asset('assets/css/animate.css') }}">

    <!--====== Magnific Popup css ======-->
    <link rel="stylesheet" href="{{ URL::asset('assets/css/magnific-popup.css') }}">

    <!--====== Slick css ======-->
    <link rel="stylesheet" href="{{ URL::asset('assets/css/slick.css') }}">

    <!--====== Line Icons css ======-->
    <link rel="stylesheet" href="{{ URL::asset('assets/css/LineIcons.css') }}">

    <!--====== Default css ======-->
    <link rel="stylesheet" href="{{ URL::asset('assets/css/default.css') }}">

    <!--====== Style css ======-->
    <link rel="stylesheet" href="{{ URL::asset('assets/css/style.css') }}">

    <!--====== Responsive css ======-->
    <link rel="stylesheet" href="{{ URL::asset('assets/css/responsive.css') }}">

    <!--====== Google Fonts ======-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600&display=swap" rel="stylesheet">

    <script src="https://code.iconify.design/2/2.2.0/iconify.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/js/all.min.js"></script>

    <!--====== Font Awesome icon ======-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">


    @yield('styles')

</head>

<body>

    <div id="app">
        <!--====== PRELOADER PART START ======-->

        <div class="preloader">
            <div class="spin">
                <div class="cube1"></div>
                <div class="cube2"></div>
            </div>
        </div>

        <!--====== PRELOADER PART START ======-->

        <!--====== HEADER PART START ======-->

        <header class="header-area">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <nav class="navbar navbar-fixed-top navbar-expand-lg">
                            <a class="navbar-brand" href="{{ url('/') }}">
                                <img src="{{ URL::asset('images/Logo/' . $settings->logo) }}" alt="Logo">
                            </a> <!-- Logo -->
                            <button class="navbar-toggler" type="button" data-toggle="collapse"
                                data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                                aria-expanded="false" aria-label="Toggle navigation">
                                <span class="bar-icon"></span>
                                <span class="bar-icon"></span>
                                <span class="bar-icon"></span>
                            </button>

                            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                <ul id="nav" class="navbar-nav ml-auto">
                                    <li class="nav-item mr-2">
                                        <a href="{{ url('/') }}"> Accueil</a>
                                    </li>
                                    <li class="nav-item mr-2">
                                        <a href="{{ url('/a-propos') }}"> À propos</a>
                                    </li>

                                    <li class="nav-item mr-2">
                                        <a href="{{ url('/confidentialite') }}"> Confidentialité</a>
                                    </li>
                                    @if (Route::has('login'))
                                        @auth

                                            <cart> </cart>



                                            <li class="nav-item">
                                                <a href="{{ url('/profil') }}"><i class="fa-solid fa-user "></i>
                                                    Profil</a>
                                            </li>
                                            <li class="nav-item ">
                                                <a href="{{ url('/logout') }}"><i class="fa-solid fa-power-off"></i>
                                                    Déconnecter </a>
                                            </li>
                                        @else
                                            <li class="nav-item">
                                                <a href="{{ route('login') }}" style="color: #fe7865;">Se Connecter</a>
                                            </li>

                                            @if (Route::has('register'))
                                                <li class="nav-item">
                                                    <a href="{{ route('register') }}"
                                                        style="color: #fe7865;">Inscrivez-vous</a>
                                                </li>
                                            @endif
                                        @endauth

                                    @endif
                                </ul> <!-- navbar nav -->
                            </div>
                        </nav> <!-- navbar -->
                    </div>
                </div> <!-- row -->
            </div> <!-- container -->
        </header>
        @auth
            @if (auth()->user()->role == 'Admin')
                <!--====== HEADER PART ENDS ======-->
                <section class="mt-120">
                    <!-- Wrapper -->
                    <div class="wrapper">

                        <!-- Sidebar -->
                        <nav class="sidebar">

                            <!-- close sidebar menu -->
                            <div class="dismiss">
                                <i class="fas fa-arrow-left"></i>
                            </div>

                            <div class="text-center py-5">
                                <h4><a style="color: #FFFFFF"><i
                                            class="fa-solid fa-screwdriver-wrench mr-2"></i>Dashboard</a>
                                </h4>
                            </div>

                            <ul class="list-unstyled menu-elements">
                                <li @class(['active' => request()->is('/*')])>
                                    <a class="scroll-link" href="{{ url('/') }}"><i class="fas fa-home mr-2"></i>
                                        Mon magasin
                                    </a>
                                </li>
                                <li @class([
                                    'active' =>
                                        request()->is('admin/produits*') || request()->is('admin/categories*'),
                                ])>
                                    <a href="#manageShop" data-toggle="collapse" aria-expanded="false"
                                        class="dropdown-toggle" role="button" aria-controls="manageShop">
                                        <i class="fa-solid fa-store mr-2"></i>Gérer le magasin <i
                                            class="lni-chevron-down ml-2"></i>
                                    </a>
                                    <ul class="collapse list-unstyled" id="manageShop">
                                        <li>
                                            <a class="scroll-link" href="{{ URL('/admin/produits') }}"><i
                                                    class="fa-brands fa-product-hunt mr-2"></i>Produits</a>
                                        </li>
                                        <li>
                                            <a class="scroll-link" href="{{ URL('/admin/categories') }}"><i
                                                    class="fa fa-list-alt mr-2"></i>Catégories</a>
                                        </li>
                                        <li>
                                            <a class="scroll-link" href="{{ URL('/admin/collections') }}"><i
                                                    class="fas fa-filter mr-2"></i>Collections</a>
                                        </li>
                                    </ul>
                                </li>
                                <li @class([
                                    'active' => request()->is('admin/ventes*'),
                                ])>
                                    <a class="scroll-link" href="{{ URL('/admin/ventes') }}"><i
                                            class="fa-solid fa-cart-shopping mr-2"></i>
                                        Ventes</a>
                                </li>
                                <li @class([
                                    'active' => request()->is('admin/coupons*'),
                                ])>
                                    <a class="scroll-link" href="{{ URL('/admin/coupons') }}"><i
                                            class="fa fa-gift mr-2"></i>
                                        Coupons</a>
                                </li>

                                <li @class([
                                    'active' => request()->is('admin/sliders*'),
                                    'active' => request()->is('admin/banner*'),
                                ])>
                                    <a href="#widgets" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"
                                        role="button" aria-controls="widgets">
                                        <i class="fa-solid fa-gauge-high mr-2"></i>Widget
                                        <i class="lni-chevron-down ml-2"></i></a>
                                    <ul class="collapse list-unstyled" id="widgets">
                                        <li>
                                            <a class="scroll-link" href="{{ URL('/admin/sliders') }}"><i
                                                    class="fa-solid fa-film mr-2"></i>Slider</a>
                                        </li>
                                        <li>
                                            <a class="scroll-link" href="{{ URL('/admin/banner') }}"><i
                                                    class="fas fa-image mr-2"></i>Banner</a>
                                        </li>
                                    </ul>
                                </li>

                                <hr style="background-color: #444444;">
                                <li @class([
                                    'active' => request()->is('admin/statistiques*'),
                                ])>
                                    <a class="scroll-link" href="{{ URL('/admin/statistique') }}"><i
                                            class="fas fa-chart-bar mr-2"></i>
                                        Statistiques</a>
                                </li>
                                <li @class([
                                    'active' => request()->is('admin/utilisateurs*'),
                                ])>
                                    <a class="scroll-link" href="{{ URL('/admin/utilisateurs') }}"><i
                                            class="fas fa-user mr-2"></i>
                                        Gérer les
                                        utilisateurs</a>
                                </li>



                                <li @class([
                                    'mb-1',
                                    'active' => request()->is('admin/parametres*'),
                                ])>
                                    <a href="#settings" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"
                                        role="button" aria-controls="settings">
                                        <i class="fas fa-cog mr-2"></i>Paramètres <i class="lni-chevron-down ml-2"></i>
                                    </a>
                                    <ul class="collapse list-unstyled" id="settings">
                                        <li>
                                            <a class="scroll-link" href="{{ URL('/admin/parametres') }}"><i
                                                    class="fas fa-cog mr-2"></i>Paramètres
                                                générale</a>
                                        </li>
                                        <li>
                                            <a class="scroll-link" href="{{ URL('/admin/a-propos') }}"><i
                                                    class="fa fa-info-circle mr-2"></i>À propos</a>
                                        </li>
                                        <li>
                                            <a class="scroll-link" href="{{ URL('/admin/confidentialite') }}"><i
                                                    class="fa fa-lock mr-2"></i>Confidentialité</a>
                                        </li>
                                        <li>
                                            <a class="scroll-link" href="#"><i class="fa fa-refresh mr-2"></i>Mise à
                                                jour</a>
                                        </li>
                                    </ul>
                                </li>



                            </ul>


                        </nav>
                        <!-- End sidebar -->

                        <!-- Dark overlay -->
                        <div class="overlay"></div>

                        <!-- Content -->
                        <div class="content">

                            <!-- open sidebar menu -->
                            <a class="btn btn-primary btn-customized open-menu" href="#" role="button">
                                <i class="fa-solid fa-screwdriver-wrench mr-2"></i><span>Dashboard</span>
                            </a>

                            <!-- ... -->

                            <!-- here is the page's content (not shown here) -->
                            @yield('content')
                            <!-- ... -->

                        </div>
                        <!-- End content -->

                    </div>
                    <!-- End wrapper -->
                </section>
            @elseif (auth()->user()->role == 'User')
                @yield('content')
            @endif
        @else
            @yield('content')
        @endauth


        <!--====== FOOTER PART START ======-->

        <section id="footer" class="footer-area">
            <div class="container">
                <div class="footer-widget pt-75 pb-120">
                    <div class="row">
                        <div class="col-lg-4 col-md-5 col-sm-7">
                            <div class="footer-logo mt-40">
                                <a href="#">
                                    <img src="{{ URL::asset('images/Logo/' . $settings->logo) }}" alt="Logo">
                                </a>
                                <p class="mt-10">{{ $settings->website_description }}</p>
                                <ul class="footer-social mt-25">
                                    @if ($settings->facebook != null)
                                        <li><a href="{{ $settings->facebook }}"><i
                                                    class="lni-facebook-filled"></i></a></li>
                                    @endif
                                    @if ($settings->twitter != null)
                                        <li><a href="{{ $settings->twitter }}"><i
                                                    class="lni-twitter-original"></i></a>
                                        </li>
                                    @endif
                                    @if ($settings->instagram != null)
                                        <li><a href="{{ $settings->instagram }}"><i class="lni-instagram"></i></a>
                                        </li>
                                    @endif
                                </ul>
                            </div> <!-- footer logo -->
                        </div>

                        <div class="col-lg-3 col-md-3 col-sm-5">
                            <div class="footer-link mt-50">
                                <h5 class="f-title">Liens importants</h5>
                                <ul>
                                    <li><a href="#">Accueil</a></li>
                                    <li><a href="#">À propos</a></li>
                                    <li><a href="#">Confidentienlité</a></li>
                                    <li><a href="#">Contact</a></li>
                                </ul>
                            </div> <!-- footer link -->
                        </div>
                        <div class="col-lg-5 col-md-5 col-sm-7">
                            <div class="footer-info mt-50">
                                <h5 class="f-title">Contact Info</h5>
                                <ul>
                                    <li>
                                        <div class="single-footer-info mt-20">
                                            <span>Téléphone:</span>
                                            <div class="footer-info-content">
                                                <p>{{ $settings->phone1 }}</p>
                                                <p>{{ $settings->phone2 }}</p>
                                            </div>
                                        </div> <!-- single footer info -->
                                    </li>
                                    <li>
                                        <div class="single-footer-info mt-20">
                                            <span>Email :</span>
                                            <div class="footer-info-content">
                                                <p>{{ $settings->email }}</p>
                                            </div>
                                        </div> <!-- single footer info -->
                                    </li>
                                    <li>
                                        <div class="single-footer-info mt-20">
                                            <span>Address :</span>
                                            <div class="footer-info-content">
                                                <p>{{ $settings->address }}</p>
                                            </div>
                                        </div> <!-- single footer info -->
                                    </li>
                                </ul>
                            </div> <!-- footer link -->
                        </div>
                    </div> <!-- row -->
                </div> <!-- footer widget -->
                <div class="footer-copyright pt-15 pb-15">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="copyright text-center">
                                <p>Powred by <a href="https://handelp.com" target=”_blank”>Handelp Agency</a></p>
                                <p>Developed by <a href="https://www.linkedin.com/in/mohammed-bensouna/"
                                        target=”_blank”>Bensouna</a></p>
                            </div> <!-- copyright -->
                        </div>
                    </div> <!-- row -->
                </div> <!--  footer copyright -->
            </div> <!-- container -->
        </section>

        <!--====== FOOTER PART ENDS ======-->

        <!--====== BACK TO TOP PART START ======-->

        <a href="#" class="back-to-top"><i class="lni-chevron-up"></i></a>

        <!--====== BACK TO TOP PART ENDS ======-->
    </div>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/js/all.min.js"></script>

    <!--====== jquery js ======-->
    <script src="{{ URL::asset('assets/js/vendor/modernizr-3.6.0.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/vendor/jquery-1.12.4.min.js') }}"></script>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!--====== Bootstrap js ======-->
    <script src="{{ URL::asset('assets/js/bootstrap.min.js') }}"></script>


    <!--====== Slick js ======-->
    <script src="{{ URL::asset('assets/js/slick.min.js') }}"></script>

    <!--====== Magnific Popup js ======-->
    <script src="{{ URL::asset('assets/js/jquery.magnific-popup.min.js') }}"></script>

    <!--====== nav js ======-->
    <script src="{{ URL::asset('assets/js/jquery.nav.js') }}"></script>

    <!--====== Nice Number js ======-->
    <script src="{{ URL::asset('assets/js/jquery.nice-number.min.js') }}"></script>

    <!--====== Main js ======-->
    <script src="{{ URL::asset('assets/js/main.js') }}"></script>

    @yield('scripts')

    <script>
        window.onbeforeunload = function() {
            window.scrollTo(0, 0);
        }

        jQuery(document).ready(function() {

            $('.dismiss, .overlay').on('click', function() {
                $('.sidebar').removeClass('active');
                $('.overlay').removeClass('active');
            });

            $('.open-menu').on('click', function(e) {
                e.preventDefault();
                $('.sidebar').addClass('active');
                $('.overlay').addClass('active');
                // close opened sub-menus
                $('.collapse.show').toggleClass('show');
                $('a[aria-expanded=true]').attr('aria-expanded', 'false');
            });

            /* other code */

        });

        // /*
        // Navigation
        // */
        // $('a.scroll-link').on('click', function(e) {
        //     e.preventDefault();
        //     scroll_to($(this), 0);
        // });
    </script>


</body>

</html>
