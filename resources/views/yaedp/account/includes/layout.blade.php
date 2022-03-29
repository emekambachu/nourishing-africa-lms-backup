<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- Title -->
    <title> @yield('title') - Nourishing Africa</title>

    <!--- Favicon --->
    <link rel="icon" href="{{ asset('images/favicon.jpg') }}" type="image/x-icon"/>

    <!--- Icons css --->
    <link href="{{ asset('learning-assets/css/icons.css') }}" rel="stylesheet">

    <!-- Owl-carousel css-->
    <link href="{{ asset('learning-assets/plugins/owl-carousel/owl.carousel.css') }}" rel="stylesheet" />

    <!--- Right-sidemenu css --->
    <link href="{{ asset('learning-assets/plugins/sidebar/sidebar.css') }}" rel="stylesheet">

    <!--- Style css --->
    <link href="{{ asset('learning-assets/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('learning-assets/css/skin-modes.css') }}" rel="stylesheet">

    <!--- Sidemenu css --->
    <link href="{{ asset('learning-assets/css/sidemenu.css') }}" rel="stylesheet">

    <!--- Animations css --->
    <link href="{{ asset('learning-assets/css/animate.css') }}" rel="stylesheet">

    <!--- Select2 css-->
    <link href="{{ asset('learning-assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">

    <!--- Internal Fileupload css --->
    <link href="{{ asset('learning-assets/plugins/fileuploads/css/fileupload.css') }}"
          rel="stylesheet" type="text/css"/>

    <!--- Internal Fancy uploader css --->
    <link href="{{ asset('learning-assets/plugins/fancyuploder/fancy_fileupload.css') }}" rel="stylesheet" />

    <!--- Internal Sumoselect css --->
    <link rel="stylesheet" href="{{ asset('learning-assets/plugins/sumoselect/sumoselect.css') }}">

    <!--- Internal TelephoneInput css --->
    <link rel="stylesheet" href="{{ asset('learning-assets/plugins/telephoneinput/telephoneinput.css') }}">

    <!-- font awesome -->
{{--    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>--}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet">

    <link href="{{ asset('/users/plugins/bootstrap-select-1.13.14/css/bootstrap-select.min.css') }}" rel="stylesheet">

    <!-- custom css -->
    <link rel="stylesheet" href="{{ asset('learning-assets/css/custom.css') }}" />
    <link href="{{ asset('learning-assets/custom/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('learning-assets/style.css') }}" rel="stylesheet">

    <!--Vue-->
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- Styles -->
    {{--    <link href="{{ asset('css/app.css') }}" rel="stylesheet">--}}

    <!-- CSRF Token -->
    <script>window.Laravel = {csrfToken: '{{ csrf_token() }}'}</script>

@yield('top-assets')

</head>

<body class="main-body app sidebar-mini" style="background-color: #f9fafd;">

<!-- Loader -->
<div id="global-loader">
    <img src="{{ asset('learning-assets/img/loaders/loader-4.svg') }}" class="loader-img" alt="Loader">
</div>
<!-- /Loader -->

<!-- main-sidebar opened -->
<div class="app-sidebar__overlay" data-toggle="sidebar"></div>

<aside class="main-sidebar app-sidebar sidebar-scroll">

    <div class="main-sidebar-loggedin mb-3 mt-5 pt-3 pb-3">
        <div class="app-sidebar__user">
            <div class="dropdown user-pro-body text-center">
                <div class="">
                    <img src="{{ asset('images/na-logo-dark.png') }}" width="100" class="">
                </div>
            </div>
        </div>
    </div><!-- /user -->

    <div class="main-sidebar-body">
        <ul class="side-menu">

            <li class="slide mb-3">
                <a class="side-menu__item" href="{{ route('yaedp.account') }}">
                    <i class="side-menu__icon fa fa-desktop"></i>
                    <span class="side-menu__label">Dashboard</span></a>
            </li>

            <li class="slide mb-3">
                <a class="side-menu__item" data-toggle="slide" href="{{ route('yaedp.account.modules') }}">
                    <i class="side-menu__icon fa fa-book-open"></i>
                    <span class="side-menu__label">Modules</span>
                    <i class="angle fe fe-chevron-down"></i>
                </a>

                <x-Learning.YaedpMenu/>
            </li>

            <li class="slide mb-3">
                <a class="side-menu__item" data-toggle="slide"
                   href="{{ route('yaedp.account.assessments') }}">
                    <i class="side-menu__icon fa fa-graduation-cap"></i>
                    <span class="side-menu__label">Assessments</span>
                    <i class="angle fe fe-chevron-down"></i>
                </a>
                <ul class="slide-menu">
                    <li>
                        <a class="slide-item" href="{{ route('yaedp.account.assessments') }}">
                            Progress</a>
                    </li>
                    <li>
                        <a class="slide-item" href="{{ route('yaedp.account.assessment.certificate') }}">
                            Certificate</a>
                    </li>
                </ul>
            </li>

            <li class="slide mb-3">
                <a class="side-menu__item" href="{{ route('yaedp.account.faq') }}">
                    <i class="side-menu__icon fa fa-question"></i>
                    <span class="side-menu__label">FAQ</span></a>
            </li>

            <li class="slide mb-3">
                <a class="side-menu__item" href="{{ route('yaedp.account.settings') }}">
                    <i class="side-menu__icon fa fa-user-alt"></i>
                    <span class="side-menu__label">Account</span></a>
            </li>

            <li class="slide mb-3" style="">
                <a class="side-menu__item" href="{{ route('yaedp.logout') }}">
                    <i class="side-menu__icon fa fa-sign-out-alt text-danger"></i>
                    <span class="side-menu__label">Logout</span></a>
            </li>

        </ul>
    </div>

</aside>
<!-- /main-sidebar -->

<!-- main-content -->
<div id="app" class="main-content">
    <!-- main-header -->
    <div class="main-header side-header">

        <div id="top-menu" class="container-fluid p-0">
            <div class="main-header-left">
                <div class="app-sidebar__toggle mobile-toggle" data-toggle="sidebar">
                    <a class="open-toggle" href="#"><i class="header-icons" data-eva="menu-outline"></i></a>
                    <a class="close-toggle" href="#"><i class="header-icons" data-eva="close-outline"></i></a>
                </div>

                <span class="na-text-black font-weight-bold"
                      style="font-size: 16px; margin-left: 4px;">
                </span>
            </div>

            <div class="main-header-right" style="height : 100%">
                <div class="nav nav-item navbar-nav-right ml-auto" style="height : 100%">

                    <x-Learning.AccountNotificationComponent/>

                    <div class="dropdown main-profile-menu nav nav-item nav-link pr-3 pl-3 m-0 pt-3 pb-0">
                        <a class="profile-user d-flex" href="">
                            <img src="{{ asset('images/user.png') }}" alt="user-img"
                                 class="rounded-circle mCS_img_loaded"><span></span>
                            <label class="d-sm-none d-none d-md-block"
                                   style="padding-left:5px; padding-top: 5px; font-family: Inter; font-style: normal; font-weight: normal; font-size: 14px; color: #626161;">
                                <span class="light-green">
                                    {{ Auth::user()->surname .' '.Auth::user()->first_name }}</span>
                                <i class="fa fa-chevron-down" style="padding-left: 5px; padding-top: 3px;"></i>
                            </label>
                        </a>

                        <div class="dropdown-menu">
                            <div class="row p-3">
                                <div class="col-4">
                                    <img class="rounded-circle" style="margin: 0 auto;"
                                         src="{{ asset('images/user.png') }}">
                                </div>
                                <div class="col-8">
                                    <p class="tx-15 light-green mb-0">
                                        {{ Auth::user()->surname .' '.Auth::user()->first_name }}</p>
                                    <p class="tx-15 text-grey">
                                        {{ Auth::user()->business }}</p>
                                </div>
                                <div class="col-12 text-center">
                                    <hr style="border: 1px solid #ccc;"/>
                                    <a class="text-dark" href="{{ route('yaedp.account.settings') }}">
                                        <i class="fas fa-user mr-2"></i>  Account Settings
                                    </a>
                                </div>
                                <div class="col-12 text-center">
                                    <hr style="border: 1px solid #ccc;"/>
                                    <a class="dropdown-item na-text-dark-green na-investor-text1"
                                       style="font-size: 16px;" href="{{ route('yaedp.logout') }}">
                                        <i class="fas fa-sign-out-alt text-danger"></i> Logout</a>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- container -->
    <div class="container-fluid container-responsiveness" style="margin: 100px 0;">
        @yield('content')
    </div>
    <!-- /container -->
</div>
<!-- /main-content -->

<!--- Back-to-top
<a href="#top" id="back-to-top" style="position: fixed; bottom: 65px; right: 25px; z-index : 444;"><i class="las la-angle-double-up"></i></a> --->

<!--- JQuery min js --->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
        crossorigin="anonymous"></script>

<!--Custom-->
<script src="{{ asset('learning-assets/custom/notifications.js') }}"></script>

<!--- Datepicker js --->
<script src="{{ asset('learning-assets/js/datepicker.js') }}"></script>

<!--- Bootstrap Bundle js --->
<script src="{{ asset('learning-assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

<!--- Ionicons js --->
<script src="{{ asset('learning-assets/plugins/ionicons/ionicons.js') }}"></script>

<!--- Chart bundle min js --->
<script src="{{ asset('learning-assets/plugins/chart.js/Chart.bundle.min.js') }}"></script>

<!--- JQuery sparkline js --->
<script src="{{ asset('learning-assets/plugins/jquery-sparkline/jquery.sparkline.min.js') }}"></script>

<!--- Internal Sampledata js --->
<script src="{{ asset('learning-assets/js/chart.flot.sampledata.js') }}"></script>

<!--- Rating js --->
<script src="{{ asset('learning-assets/plugins/rating/jquery.rating-stars.js') }}"></script>
<script src="{{ asset('learning-assets/plugins/rating/jquery.barrating.js') }}"></script>

<!--- Eva-icons js --->
<script src="{{ asset('learning-assets/js/eva-icons.min.js') }}"></script>

<!--- Moment js --->
<script src="{{ asset('learning-assets/plugins/moment/moment.js') }}"></script>

<!--- Perfect-scrollbar js --->
<script src="{{ asset('learning-assets/plugins/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
<script src="{{ asset('learning-assets/plugins/perfect-scrollbar/p-scroll.js') }}"></script>

<!--- Sidebar js --->
<script src="{{ asset('learning-assets/plugins/side-menu/sidemenu.js') }}"></script>

<!-- right-sidebar js -->
<script src="{{ asset('learning-assets/plugins/sidebar/sidebar.js') }}"></script>
<script src="{{ asset('learning-assets/plugins/sidebar/sidebar-custom.js') }}"></script>

<!-- Morris js -->
<script src="{{ asset('learning-assets/plugins/raphael/raphael.min.js') }}"></script>
<script src="{{ asset('learning-assets/plugins/morris.js/morris.min.js') }}"></script>

<!--- Scripts js --->
<script src="{{ asset('learning-assets/js/script.js') }}"></script>

<!--- Index js --->
<script src="{{ asset('learning-assets/js/index.js') }}"></script>

<!--- Custom js --->
<script src="{{ asset('learning-assets/js/custom.js') }}"></script>

<!--- Fileuploads js --->
<script src="{{ asset('learning-assets/plugins/fileuploads/js/fileupload.js') }}"></script>
<script src="{{ asset('learning-assets/plugins/fileuploads/js/file-upload.js') }}"></script>

<!--- Fancy uploader js --->
<script src="{{ asset('learning-assets/plugins/fancyuploder/jquery.ui.widget.js') }}"></script>
<script src="{{ asset('learning-assets/plugins/fancyuploder/jquery.fileupload.js') }}"></script>
<script src="{{ asset('learning-assets/plugins/fancyuploder/jquery.iframe-transport.js') }}"></script>
<script src="{{ asset('learning-assets/plugins/fancyuploder/jquery.fancy-fileupload.js') }}"></script>
<script src="{{ asset('learning-assets/plugins/fancyuploder/fancy-uploader.js') }}"></script>

<!--- Internal Form-elements js --->
<script src="{{ asset('learning-assets/js/advanced-form-elements.js') }}"></script>
<script src="{{ asset('learning-assets/js/select2.js') }}"></script>

<!--- Internal Sumoselect js --->
<script src="{{ asset('learning-assets/plugins/sumoselect/jquery.sumoselect.js') }}"></script>

<!--- Internal Modal js --->
<script src="{{ asset('learning-assets/js/modal.js') }}"></script>

<!--- Internal Modal js --->
<script src="{{ asset('learning-assets/js/masonry.js') }}"></script>

<script src="{{ asset('/users/plugins/bootstrap-select-1.13.14/js/bootstrap-select.min.js') }}"></script>

@yield('bottom-assets')

</body>
</html>
