<!doctype html>
<html class="no-js" lang="en">

<head>
    <!-- title -->
    <title>@yield('title') - Nourishing Africa</title>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1" />
    <meta name="author" content="nourishing africa">

<!--SEO-->
@yield('meta')

<!-- favicon -->
    <link rel="shortcut icon" href="{{ asset('images/fav_circle.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/fav_circle.png') }}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('images/fav_circle.png') }}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('images/fav_circle.png') }}">

    <!-- animation -->
    <link rel="stylesheet" href="{{ asset('css/animate.css') }}" />
    <!-- bootstrap -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" />
    <!-- et line icon -->
    <link rel="stylesheet" href="{{ asset('css/et-line-icons.css') }}" />

    <!-- font-awesome icon -->
    <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}" />

    <!--Font Awesome CDN-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

    <!-- themify icon -->
    <link rel="stylesheet" href="{{ asset('css/themify-icons.css') }}">

    <!-- swiper carousel -->
    <link rel="stylesheet" href="{{ asset('css/swiper.min.css') }}">

    <!-- justified gallery -->
    <link rel="stylesheet" href="{{ asset('css/justified-gallery.min.css') }}">

    <!-- magnific popup -->
    <link rel="stylesheet" href="{{ asset('css/magnific-popup.css') }}" />

    <!-- revolution slider -->
    <link rel="stylesheet" type="text/css" href="{{ asset('revolution/css/settings.css') }}" media="screen" />
    <link rel="stylesheet" type="text/css" href="{{ asset('revolution/css/layers.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('revolution/css/navigation.css') }}">

    <!-- bootsnav -->
    <link rel="stylesheet" href="{{ asset('css/bootsnav.css') }}">

    <!-- bootstrap tags -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap-tagsinput.css') }}" />

    <!-- style -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />

    <!-- responsive css -->
    <link rel="stylesheet" href="{{ asset('css/responsive.css') }}" />

<!--[if IE]>
    <script src="{{ asset('js/html5shiv.js') }}"></script>
    <![endif]-->

    <!-- custom css -->
    <link rel="stylesheet" href="{{ asset('css/custom-new.css') }}" />
    <link rel="stylesheet" href="{{ asset('custom/css/style.css') }}" />

    <!-- Basic stylesheet -->
    <link rel="stylesheet" href="{{ asset('css/owl.carousel.css') }}">

    <!-- Default Theme -->
    <link rel="stylesheet" href="{{ asset('css/owl.theme.css') }}">

    <link rel="stylesheet" href="{{ asset('css/intlTelInput.css') }}">

    <!-- font awesome -->
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">

    <!--Jquery UI-->
    <link href="{{ asset('custom/js/libs/jquery-ui-1.12.1/jquery-ui.min.css') }}" rel="stylesheet">

@yield('top-assets')

<!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Google Tag Manager -->
{{--    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':--}}
{{--                new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],--}}
{{--            j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=--}}
{{--            'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);--}}
{{--        })(window,document,'script','dataLayer','GTM-WG4ZJ6Q');</script>--}}
<!-- End Google Tag Manager -->

    <!-- Hotjar Tracking Code for nourishingafrica.com -->
    <script>
        (function(h,o,t,j,a,r){
            h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
            h._hjSettings={hjid:2299733,hjsv:6};
            a=o.getElementsByTagName('head')[0];
            r=o.createElement('script');r.async=1;
            r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
            a.appendChild(r);
        })(window,document,'https://static.hotjar.com/c/hotjar-','.js?sv=');
    </script>

    <!-- GTranslate: https://gtranslate.io/ -->
    <style type="text/css">
        <!--
        a.gflag {vertical-align:middle;font-size:16px;padding:1px 0;background-repeat:no-repeat;background-image:url(//gtranslate.net/flags/16.png);}
        a.gflag img {border:0;}
        a.gflag:hover {background-image:url(//gtranslate.net/flags/16a.png);}
        #goog-gt-tt {display:none !important;}
        .goog-te-banner-frame {display:none !important;}
        .goog-te-menu-value:hover {text-decoration:none !important;}
        body {top:0 !important;}
        #google_translate_element2 {display:none!important;}
        -->
        ul.nav>li.simple-dropdown>ul.dropdowwn-menu {
            margin-top: -100px !important;
        }
    </style>

    <div id="google_translate_element2"></div>

    <!--Google Translate-->
    <script type="text/javascript">
        function googleTranslateElementInit2() {new google.translate.TranslateElement({pageLanguage: 'en',autoDisplay: false}, 'google_translate_element2');}
    </script><script type="text/javascript" src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit2"></script>

    <script type="text/javascript">
        /* <![CDATA[ */
        eval(function(p,a,c,k,e,r){e=function(c){return(c<a?'':e(parseInt(c/a)))+((c=c%a)>35?String.fromCharCode(c+29):c.toString(36))};if(!''.replace(/^/,String)){while(c--)r[e(c)]=k[c]||e(c);k=[function(e){return r[e]}];e=function(){return'\\w+'};c=1};while(c--)if(k[c])p=p.replace(new RegExp('\\b'+e(c)+'\\b','g'),k[c]);return p}('6 7(a,b){n{4(2.9){3 c=2.9("o");c.p(b,f,f);a.q(c)}g{3 c=2.r();a.s(\'t\'+b,c)}}u(e){}}6 h(a){4(a.8)a=a.8;4(a==\'\')v;3 b=a.w(\'|\')[1];3 c;3 d=2.x(\'y\');z(3 i=0;i<d.5;i++)4(d[i].A==\'B-C-D\')c=d[i];4(2.j(\'k\')==E||2.j(\'k\').l.5==0||c.5==0||c.l.5==0){F(6(){h(a)},G)}g{c.8=b;7(c,\'m\');7(c,\'m\')}}',43,43,'||document|var|if|length|function|GTranslateFireEvent|value|createEvent||||||true|else|doGTranslate||getElementById|google_translate_element2|innerHTML|change|try|HTMLEvents|initEvent|dispatchEvent|createEventObject|fireEvent|on|catch|return|split|getElementsByTagName|select|for|className|goog|te|combo|null|setTimeout|500'.split('|'),0,{}))
        /* ]]> */
    </script>


</head>

<body>

<!-- Google Tag Manager (noscript) -->
<noscript>
    <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-WG4ZJ6Q"
            height="0" width="0"
            style="display:none;visibility:hidden;">
    </iframe>
</noscript>
<!-- End Google Tag Manager (noscript) -->

<header class="m-0">
    <!-- start navigation -->
    <nav class="navbar navbar-default bootsnav text-dark navbar-expand-lg bg-white">
        <div class="container-fluid nav-header-container" style='padding-top: 10px;'>
            <!-- start logo -->
            <div class="col-auto pl-md-5">
                <a href="{{ url('/') }}" title="Nourishing Africa" >
                    <img src="{{ asset('images/newlogo.png') }}"
                         data-rjs="{{ asset('images/newlogo.png') }}" width="100px"
                         class="logo-light default" alt="Nourishing Nfrica logo">
                </a>
            </div>
            <!-- end logo -->

            <!--Language Translator Display-->
            <div class="translator-bg pt-0 pb-0 pl-1 pr-1 bg-white">
                <a href="#" onclick="doGTranslate('en|en');return false;" title="English"
                   style="background-position:-0px -0px;">ENGLISH
                </a>
                <span class="text-dark">| </span>
                <a href="#" onclick="doGTranslate('en|fr');return false;" title="French"
                   style="background-position:-200px -100px;">FRANÇAIS
                </a>
                <span class="text-dark">| </span>
                <a href="#" onclick="doGTranslate('en|pt');return false;" title="Portuguese"
                   style="background-position:-200px -100px;">PORTUGUESE
                </a>
            </div>

            <div class="col accordion-menu pr-0 pr-md-3">
                <button type="button" class="navbar-toggler collapsed" data-toggle="collapse" data-target="#navbar-collapse-toggle-1">
                    <span class="sr-only">toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <div class="navbar-collapse collapse justify-content-md-center" id="navbar-collapse-toggle-1">
                    <ul id="accordion" class="nav navbar-nav navbar-left no-margin alt-font text-normal navtopmenu" data-in="fadeIn" data-out="fadeOut">
                        <li class="dropdown simple-dropdown"><a href="{{ url('/') }}" style="color: #267c26">Home</a></li>
                        <li class="dropdown simple-dropdown"><a href="{{ url('about') }}" style="color: #267c26">About Us</a>
                            <i class="fas fa-angle-down dropdown-toggle" data-toggle="dropdown" aria-hidden="true"></i>
                            <!-- start sub menu -->
                            <ul class="dropdown-menu" role="menu">
                                <li class="dropdown d-none"><a class="dropdown-toggle" data-toggle="dropdown"
                                                               href="{{ url('about') }}">Impact and Reach</a></li>
                                <li class="dropdown d-none"><a class="dropdown-toggle" data-toggle="dropdown"
                                                               href="{{ url('about') }}">Our Approach</a></li>
                                <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown"
                                                        href="{{ route('team.new') }}?page=our_team">Our Team</a></li>
                                <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown"
                                                        href="{{ route('team.new') }}?page=our_board">Our Board</a></li>
                                <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown"
                                                        href="{{ route('team.new') }}?page=our_partners">Our Partners</a></li>
                                <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown"
                                                        href="{{ route('team.new') }}?page=our_ambassadors">Our Ambassadors</a></li>
                                <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown"
                                                        href="{{ url('careers') }}">Nourishing Africa Careers</a></li>
                            </ul>
                        </li>
                        <li class="dropdown simple-dropdown"><a href="#" style="color: #267c26">Membership</a>
                            <i class="fas fa-angle-down dropdown-toggle" data-toggle="dropdown" aria-hidden="true"></i>
                            <!-- start sub menu -->
                            <ul class="dropdown-menu" role="menu">
                                <li class="dropdown">
                                    <a class="dropdown-toggle" data-toggle="dropdown"
                                       href="{{ url('entrepreneurs') }}">Our Members</a></li>
                                <li class="dropdown">
                                    <a class="dropdown-toggle" data-toggle="dropdown"
                                       href="{{ url('membership') }}">Membership</a></li>

                                <li class="dropdown">
                                    @guest
                                        <a class="dropdown-toggle" data-toggle="dropdown"
                                           href="{{ route('entrepreneur.sign-up-form') }}">Sign up</a>
                                    @else
                                        <a class="dropdown-toggle" data-toggle="dropdown"
                                           href="{{ route('user-logout') }}">Log out</a>
                                    @endguest
                                </li>


                            </ul>
                        </li>
                        <li class="dropdown simple-dropdown">
                            <a href="#" style="color: #267c26">Programs</a>
                            <i class="fas fa-angle-down dropdown-toggle" data-toggle="dropdown" aria-hidden="true"></i>
                            <!-- start sub menu -->
                            <ul class="dropdown-menu" role="menu">
                                <li class="dropdown">
                                    <a class="dropdown-toggle" data-toggle="dropdown"
                                       href="{{ route('esp-index-page') }}">Entrepreneur Support Program</a></li>
                                <li class="dropdown">
                                    <a class="dropdown-toggle" data-toggle="dropdown"
                                       href="{{ route('esp.login.form') }}">ESP Login</a></li>
                                {{--                                <li class="dropdown">--}}
                                {{--                                    <a class="dropdown-toggle" data-toggle="dropdown"--}}
                                {{--                                           href="{{ route('investor-login') }}">Investment Portal</a></li>--}}
                                {{--                                <li class="dropdown">--}}
                                {{--                                    <a class="dropdown-toggle" data-toggle="dropdown"--}}
                                {{--                                           href="{{ route('intern-matchmaking.institution.login-form') }}">Talent Matching</a></li>--}}
                            </ul>
                        </li>
                        <li class="dropdown simple-dropdown">
                            <a href="javascript:void(0)" style="color: #267c26">Resources</a>
                            <i class="fas fa-angle-down dropdown-toggle" data-toggle="dropdown" aria-hidden="true"></i>
                            <!-- start sub menu -->
                            <ul class="dropdown-menu" role="menu">
                                <li class="dropdown">
                                    <a class="dropdown-toggle" data-toggle="dropdown"
                                       href="{{ url('data') }}">Data</a>
                                </li>
                                <li class="dropdown simple-dropdown">
                                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">Funding</a>
                                    <i class="dropdown-toggle" data-toggle="dropdown" aria-hidden="true"></i>
                                    <ul class="dropdown-menu" role="menu" style="background-color: rgb(255, 255, 255);">
                                        <li class="dropdown">
                                            <a class="dropdown-toggle" data-toggle="dropdown"
                                               href="{{ url('funding') }}" style="color: #006600" >Financial Support</a></li>
                                        <li class="dropdown">
                                            <a class="dropdown-toggle" data-toggle="dropdown"
                                               href="{{ url('capacity-building') }}" style="color: #006600">Capacity Building</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown"
                                                        href="{{ url('events') }}">Events</a></li>
                                <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown"
                                                        href="{{ url('jobs') }}">Jobs</a></li>
                                <li class="dropdown">
                                    <a class="dropdown-toggle" data-toggle="dropdown"
                                       href="{{ url('trainings') }}">Trainings and Workshops</a>
                                </li>
                                <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown"
                                                        href="{{ url('technology-innovation') }}">Technology and Innovation</a>
                                </li>
                            </ul>
                        </li>
                        <li class="dropdown simple-dropdown">
                            <a href="javascript:void(0)" style="color: #267c26">SME Toolkit</a>
                            <i class="fas fa-angle-down dropdown-toggle" data-toggle="dropdown" aria-hidden="true"></i>
                            <!-- start sub menu -->
                            <ul class="dropdown-menu" role="menu">
                                <li class="dropdown">
                                    <a class="dropdown-toggle" data-toggle="dropdown"
                                       href="{{ url('ask-an-expert') }}">Ask an Expert</a></li>

                                <li class="dropdown">
                                    <a class="dropdown-toggle" data-toggle="dropdown"
                                       href="{{ route('association-directory') }}">Association Directory</a>
                                </li>

                                <li class="dropdown">
                                    <a class="dropdown-toggle" data-toggle="dropdown"
                                       href="{{ url('first-thursdays') }}">First Thursdays</a></li>

                                <li class="dropdown">
                                    <a class="dropdown-toggle" data-toggle="dropdown"
                                       href="{{ url('podcasts') }}">Podcasts</a>
                                </li>

                                <li class="dropdown simple-dropdown"><a href="#">Food Culture</a>
                                    <i class="dropdown-toggle" data-toggle="dropdown" aria-hidden="true"></i>
                                    <!-- start sub menu -->
                                    <ul class="dropdown-menu" role="menu" style="background-color: rgb(255, 255, 255);">
                                        <li class="dropdown">
                                            <a class="dropdown-toggle" data-toggle="dropdown"
                                               href="{{ url('food') }}" style="color: #006600">Food</a>
                                        </li>
                                        <li class="dropdown">
                                            <a class="dropdown-toggle" data-toggle="dropdown"
                                               href="{{ url('chefs-and-cooks') }}" style="color: #006600">Chefs and Cooks</a>
                                        </li>
                                    </ul>
                                </li>

                                {{-- <li class="dropdown">
                                    <a class="dropdown-toggle" data-toggle="dropdown"
                                    href="{{ url('recorded-webinars') }}">Recorded Webinars</a>
                                </li>

                                <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown"
                                    href="{{ url('covid19') }}">Covid-19</a>
                                </li>
                                <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown"
                                    href="{{ url('covid-agribusiness') }}">Covid-19 and Agribusiness</a>
                                </li> --}}
                            </ul>
                        </li>

                        <li class="dropdown simple-dropdown">
                            <a href="{{ route('front_news_update.all') }}" style="color: #267c26">News & Updates</a>
                        </li>

                        <li class="dropdown simple-dropdown d-sm-block d-md-none">
                            <a href="javascript:void(0)" style="color: #267c26">Login</a>
                            <i class="fas fa-angle-down dropdown-toggle" data-toggle="dropdown" aria-hidden="true"></i>
                            <!-- start sub menu -->
                            <ul class="dropdown-menu" role="menu" style="margin-top: 15px; margin-left: -25px;">
                                <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown"
                                                        href="{{ route('login') }}">Membership Login</a></li>
                                <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown"
                                                        href="#">Investors Login</a></li>
                                <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown"
                                                        href="#">Institutions Login</a></li>
                            </ul>
                        </li>
                        {{-- <li class="dropdown simple-dropdown"><a href="javascript:void(0)" style="color: #267c26">Events</a>
                            <i class="fas fa-angle-down dropdown-toggle" data-toggle="dropdown" aria-hidden="true"></i>
                            <!-- start sub menu -->
                            <ul class="dropdown-menu" role="menu">
                                <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown"
                                    href="{{ url('events') }}">Events</a></li>
                                <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown"
                                    href="{{ url('virtual-roadshow') }}">Virtual Road Show</a></li>
                            </ul>
                        </li>

                        <li class="dropdown simple-dropdown"><a href="#" style="color: #267c26">Food Culture</a>
                            <i class="dropdown-toggle" data-toggle="dropdown" aria-hidden="true"></i>
                            <!-- start sub menu -->
                            <ul class="dropdown-menu" role="menu">
                                <li class="dropdown">
                                    <a class="dropdown-toggle" data-toggle="dropdown" href="{{ url('food') }}">Food</a>
                                </li>
                                <li class="dropdown">
                                    <a class="dropdown-toggle" data-toggle="dropdown"
                                       href="{{ url('chefs-and-cooks') }}">Chefs and Cooks</a>
                                </li>
                            </ul>
                        </li> --}}
                    </ul>
                </div>
            </div>

            <div class="col-auto pr-lg-0">
                <div class="pr-md-5">
                    @auth
                        <ul id="accordion-mobile" class="nav navbar-nav no-margin alt-font text-normal"
                            data-in="fadeIn" data-out="fadeOut" style="background-color: transparent !important;">
                            <li class="dropdown simple-dropdown" style="background-color: #efb443 !important; border-radius: 5px;">
                                <a href="{{ route('member.dashboard') }}" class="m-0 text-white" style="background-color: #efb443 !important; padding: 8px; border-radius: 5px; font-family: inter; font-size: 14px;">
                                    Dashboard
                                    <i class="dropdown-toggle" data-toggle="dropdown" aria-hidden="true"></i>
                                </a>
                                <!-- start sub menu -->
                                <ul class="dropdown-menu" role="menu" style="margin-top: 15px; margin-left: -25px;">
                                    <li class="dropdown">
                                        <a class="dropdown-toggle" data-toggle="dropdown"
                                           href="{{ route('new-member-profile-setting') }}">Profile</a>
                                    </li>
                                    <li class="dropdown">
                                        <a class="dropdown-toggle" data-toggle="dropdown"
                                           href="{{ route('new-member-profile-ps') }}">Account</a>
                                    </li>
                                    <li class="dropdown">
                                        <a class="dropdown-toggle" data-toggle="dropdown"
                                           href="{{ route('user-logout') }}">Logout</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    @else
                        <ul id="accordion-mobile" class="nav navbar-nav no-margin alt-font text-normal d-none d-sm-none d-md-block"
                            data-in="fadeIn" data-out="fadeOut"
                            style="background-color: transparent !important;">
                            <li class="dropdown simple-dropdown"
                                style="background-color: #efb443 !important; border-radius: 5px;">
                                <a href="javascript:void(0)" class="m-0 text-white"
                                   style="background-color: #efb443 !important; padding: 8px; border-radius: 5px; font-family: inter; font-size: 14px;">
                                    Login
                                    <i class="dropdown-toggle" data-toggle="dropdown" aria-hidden="true"></i>
                                </a>
                                <!-- start sub menu -->
                                <ul class="dropdown-menu" role="menu" style="margin-top: 15px; margin-left: -25px;">
                                    <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown"
                                                            href="{{ route('login') }}">Membership Login</a></li>
                                    <!--<li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown"
                                                            href="#">Investors Login</a></li>
                                    <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown"
                                                            href="#">Institutions Login</a></li>-->
                                </ul>
                            </li>
                        </ul>
                    @endauth
                </div>
            </div>
        </div>
    </nav>
    @yield('top-panel')
</header>

@yield('content')

<!-- start footer -->
<footer class="footer-standard-dark footer-bg" style="background-color: #0e6a0e;">
    <div class="footer-widget-area padding-three-top sm-padding-10px-top">
        <div class="container-fluid pl-5 pr-5">
            <div class="row">
                <div class="col-lg-3 col-md-6 widget md-no-border-right md-margin-30px-bottom sm-text-center">
                    <!-- start logo -->
                    <a href="#" class="margin-20px-bottom d-inline-block">
                        <img class="footer-logo-new" src="{{ asset('images/logo2.png') }}"
                             data-rjs="{{ asset('images/logo2.png') }}" alt="nourishing africa logo"/></a>
                    <!-- end logo -->
                    <br/>
                    <p class="text-small width-95 sm-width-100" style="color:#FFF">
                        A Home for Agri-Food Entrepreneurs Transforming Africa's Agricultural Landscape.</p>
                </div>

                <!-- start additional links -->
                <div class="col-lg-3 col-md-6 widget padding-45px-left md-padding-15px-left md-no-border-right md-margin-30px-bottom text-center text-md-left">
                    <div class="widget-title add-link margin-10px-bottom font-weight-300"
                         style="color:#FFF">Quick Links</div>
                    <ul class="list-unstyled add-link-sub">
                        <li><a class="text-small text-white"
                               href="https://nourishingafrica.com/subscribe">Subscribe</a></li>
                        <!-- <li><a class="text-small text-white" href="https://nourishingafrica.com/about">About us</a></li> -->
                        <li><a class="text-small text-white"
                               href="https://nourishingafrica.com/team">The Team</a></li>
                        <!-- <li><a class="text-small text-white" href="https://nourishingafrica.com/careers">Careers</a></li> -->
                        <li><a class="text-small text-white"
                               href="https://nourishingafrica.com/terms-of-use">Terms of Use</a></li>
                        <li><a class="text-small text-white"
                               href="https://nourishingafrica.com/privacy-policy">Privacy Policy</a></li>
                        <li><a class="text-small text-white"
                               href="https://nourishingafrica.com/faq">FAQs</a></li>
                    </ul>
                </div>
                <!-- end additional links -->

                <!-- start contact information -->
                <div class="col-lg-3 col-md-6 widget padding-45px-left md-padding-15px-left md-clear-both md-no-border-right sm-margin-30px-bottom text-center text-md-left">
                    <div class="widget-title add-link margin-10px-bottom font-weight-300" style="color:#FFF">Contact Info</div>


                    <div class="text-small add-link-sub" style="color:#FFF">
                        <i class="far fa-envelope fa-2x p-2"></i> <a href="mailto:info@nourishingafrica.com">
                            <span class="add-link-sub"> info@nourishingafrica.com</span></a>
                    </div>
                    <div class="text-small add-link-sub" style="color:#FFF">
                        <i class="fa fa-phone fa-2x p-2" aria-hidden="true"></i>
                        <span class="add-link-sub"> +234 802 988 8231</span>
                    </div>

                    <div class="social-icon-style-8 d-inline-block vertical-align-middle p-2">
                        <ul class="small-icon no-margin-bottom">
                            <li><a class="facebook text-white-2" href="https://www.facebook.com/nourishafrica1"
                                   target="_blank"><i class="fab fa-facebook-f" aria-hidden="true"></i></a></li>
                            <li><a class="twitter text-white-2" href="https://twitter.com/nourish_africa"
                                   target="_blank"><i class="fab fa-twitter"></i></a></li>
                            <li><a class="linkedin text-white-2" href="https://www.linkedin.com/company/nourishing-africa/"
                                   target="_blank"><i class="fab fa-linkedin"></i></a></li>
                            <li><a class="instagram text-white-2" href="https://www.instagram.com/nourish_africa/"
                                   target="_blank"><i class="fab fa-instagram no-margin-right" aria-hidden="true"></i></a></li>
                            <li><a class="instagram text-white-2" href="https://www.youtube.com/channel/UCDb5yT_Y9BGrURR-wSi2oaw"
                                   target="_blank"><i class="fab fa-youtube no-margin-right" aria-hidden="true"></i></a></li>
                        </ul>
                    </div>

                </div>
                <!-- end contact information -->

                <!-- Start Social -->
                <div class="col-lg-3 col-md-6 widget padding-5px-left md-padding-15px-left text-center text-md-left">
                    <div class="widget-title subscribe-text text-medium-gray margin-20px-bottom font-weight-300" style="color:#FFF">Get early access to information on agriculture</div>
                    <div class="input-group justify-content-center">
                        <form action="https://nourishingafrica.us4.list-manage.com/subscribe/post?u=8d6c3d892f4444def72b2173a&amp;id=612875e9df"
                              method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form"
                              class="validate" target="_blank" novalidate>
                            <div class="row">
                                <div class="col-md-9 col-sm-9 no-padding">
                                    <input type="email" class="footer-subscribe"
                                           name="EMAIL" id="mce-FNAME"
                                           placeholder="Enter your email">
                                </div>
                                <div class="col-md-3 col-sm-3 no-padding">
                                    <span class="input-group-btn">
                                        <button class="btn md-float-left" type="submit">
                                            subscribe
                                        </button>
                                    </span>
                                </div>
                            </div>

                        </form>
                    </div>

                    <div class="float-left margin-five-top">
                        <a href="#" onclick="window.open('https://www.sitelock.com/verify.php?site=nourishingafrica.com','SiteLock','width=600,height=600,left=160,top=170');" ><img class="img-responsive" alt="SiteLock" title="SiteLock" src="//shield.sitelock.com/shield/nourishingafrica.com" /></a>
                    </div>

                </div>
            </div>
            <!-- End Social -->
        </div>
    </div>

    <div class="footer-bg padding-15px-tb text-center sm-padding-10px-tb">
        <div class="container">
            <div class="row">
                <!-- start copyright -->
                <div class="col-md-12 text-small text-center footer-content">
                    &copy; {{ date('Y') }} Nourishing Africa</div>
                <!-- end copyright -->
            </div>
        </div>
    </div>

</footer>
<!-- end footer -->

<!-- start scroll to top -->
<a class="scroll-top-arrow" href="javascript:void(0);"><i class="ti-arrow-up"></i></a>
<!-- end scroll to top -->
<!-- javascript libraries -->

{{--<script src="https://code.jquery.com/jquery-3.5.1.min.js"--}}
{{--            integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>--}}

<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

<!--<script type="text/javascript" src="js/modernizr.js"></script>-->
<script type="text/javascript" src="{{ asset('js/bootstrap.bundle.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/jquery.easing.1.3.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/skrollr.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/smooth-scroll.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/jquery.appear.js') }}"></script>
<!-- menu navigation -->
<script type="text/javascript" src="{{ asset('js/bootsnav.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/jquery.nav.js') }}"></script>
<!-- animation -->
<script type="text/javascript" src="{{ asset('js/wow.min.js') }}"></script>
<!-- page scroll -->
<script type="text/javascript" src="{{ asset('js/page-scroll.js') }}"></script>
<!-- swiper carousel -->
<script type="text/javascript" src="{{ asset('js/swiper.min.js') }}"></script>
<!-- counter -->
<script type="text/javascript" src="{{ asset('js/jquery.count-to.js') }}"></script>

<script type="text/javascript" src="{{ asset('js/intlTelInput.js') }}"></script>
<!-- parallax -->
<script type="text/javascript" src="{{ asset('js/jquery.stellar.js') }}"></script>
<!-- magnific popup -->
<script type="text/javascript" src="{{ asset('js/jquery.magnific-popup.min.js') }}"></script>
<!-- portfolio with shorting tab -->
<script type="text/javascript" src="{{ asset('js/isotope.pkgd.min.js') }}"></script>
<!-- images loaded -->
<script type="text/javascript" src="{{ asset('js/imagesloaded.pkgd.min.js') }}"></script>
<!-- pull menu -->
<script type="text/javascript" src="{{ asset('js/classie.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/hamburger-menu.js') }}"></script>
<!-- counter -->
<script type="text/javascript" src="{{ asset('js/counter.js') }}"></script>
<!-- fit video -->
<script type="text/javascript" src="{{ asset('js/jquery.fitvids.js') }}"></script>

<!-- skill bars -->
<script type="text/javascript" src="{{ asset('js/skill.bars.jquery.js') }}"></script>
<!-- justified gallery -->
<script type="text/javascript" src="{{ asset('js/justified-gallery.min.js') }}"></script>
<!--pie chart-->
<script type="text/javascript" src="{{ asset('js/jquery.easypiechart.min.js') }}"></script>
<!-- instagram -->
<script type="text/javascript" src="{{ asset('js/instafeed.min.js') }}"></script>
<!-- retina -->
<script type="text/javascript" src="{{ asset('js/retina.min.js') }}"></script>
<!-- revolution -->
<script type="text/javascript" src="{{ asset('revolution/js/jquery.themepunch.tools.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('revolution/js/jquery.themepunch.revolution.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/main.js') }}"></script>

<script src="{{ asset('js/owl.carousel.js') }}"></script>
<script src="{{ asset('custom/js/libs/jquery-ui-1.12.1/jquery-ui.min.js') }}"></script>
<script src="{{ asset('custom/js/smart-search.js') }}"></script>
{{--<script type="text/javascript">
    @if(App\CustomTracker::getVisitorsInMemoryData("video-guide")->count() == 0)
        $(document).ready(function () {
            setTimeout(() => {
                $("#customToast").removeClass("d-none");
            }, 5000);
        });
    @endif
    function watchVideo(){
        $("#tutorialVideo").removeClass("d-none");
    }
    function hideWatchVideo(){
        $("#tutorialVideo").addClass("d-none");
    }

    function notInterested(){
        $('#customToast').addClass('d-none');

        $.ajax({
            type: 'POST',
            url: '{{ route('homepage.customtracker') }}',
            data: { action : 'video-guide' },
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            },
            beforeSend: function () {
               console.log("sending ...");
            },
            success: function (Response) {
                console.log(Response);

            },
            error: function (Response) {
                console.log(Response);
            },
            complete: function (Response) {
                console.log(Response);
            }
        });
    }
</script>
<div id="customToast" class="d-none card" style="position: fixed; top: 80px; right: 0px; z-index: 999;">
    <div class="toast-header">
      <strong class="mr-auto">Welcome Tutorial</strong>
      <button type="button" class="ml-2 mb-1 close" onclick="$('#customToast').addClass('d-none');">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="toast-body">
      Hello, we have made a tutorial for you to get you started!
      <div class="row">
          <div class="col-6"><button class="btn btn-sm btn-primary" onclick="watchVideo()">Watch Tutorial</button></div>
          <div class="col-6"><button class="btn btn-sm btn-info" onclick="notInterested()">Not Interested</button></div>
      </div>
    </div>
</div>
<div id="tutorialVideo" class="w-100 h-100 d-none" style="position: fixed; z-index: 999; top: 0px; bottom: 0px; left: 0px; right: 0px;">
    <div class="opacity-medium bg-extra-dark-gray" style="z-index: 999;"></div>
    <div class="row h-100">
        <button class="btn btn-sm btn-warning" style="position: absolute; top:10px; right: 10px; z-index: 99999;" onclick="hideWatchVideo()">x close</button>
        <div class="d-flex justify-content-center align-items-center w-100 h-100" style="z-index: 9999;">
            <iframe src="https://www.youtube.com/watch?v=rNdqfOxPz30" frameborder="0"></iframe>
        </div>
    </div>
</div> --}}

@yield('bottom-assets')

</body>

</html>
