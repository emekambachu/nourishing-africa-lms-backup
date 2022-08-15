@extends('includes.layout')

@section('meta-tags')
    <meta name="description" content="YAEDP | Export Diagnostic Tool"/>
    <meta name="robots" content="max-snippet:-1, max-image-preview:large, max-video-preview:-1"/>
    <link rel="canonical" href="{{ Request::fullUrl() }}" />
    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="object" />
    <meta property="og:title" content="YAEDP - Youth in Agrifood Export Development Program" />
    <meta property="og:url" content="{{ Request::fullUrl() }}" />
    <meta property="og:site_name" content="African Food Changemakers" />
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:description" content="YAEDP | Export Diagnostic Tool" />
    <meta name="twitter:title" content="YAEDP - Youth in Agrifood Export Development Program" />
    <meta name="twitter:site" content="@nourish_africa" />
@stop

@section('title')
    YAEDP - Youth in export development program
@stop

@section('top-assets')
    <!--Vue-->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- CSRF Token -->
    <script>window.Laravel = {csrfToken: '{{ csrf_token() }}'}</script>

    <!--- JQuery min js --->
    <script src="{{ asset('investors-assets/plugins/jquery/jquery.min.js') }}"></script>
    <link href="{{ asset('/users/plugins/bootstrap-select-1.13.14/css/bootstrap-select.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://res.cloudinary.com/dxfq3iotg/raw/upload/v1569006288/BBBootstrap/choices.min.css?version=7.0.0">
    <script src="https://res.cloudinary.com/dxfq3iotg/raw/upload/v1569006273/BBBootstrap/choices.min.js?version=7.0.0"></script>

    <link href="{{ asset('/custom/css/yaedp.css') }}" type="text/css" rel="stylesheet">
@stop

@section('top-panel')
    <section class="wow fadeIn parallax padding-50px-tb" data-stellar-background-ratio="0.5"
             style="background-image: url(&quot;{{ asset('images/login-intro.jpg') }}&quot;); visibility: visible; animation-name: fadeIn;background-attachment: unset; background-position: center; background-attachment: fixed;">
        <div class="opacity-medium bg-extra-dark-gray"></div>
        <div class="container">
            <div class="row align-items-center">
                <div class="col-12 d-flex mt-3 flex-column justify-content-center text-center extra-small-screen page-title-large">
                    <!-- start page title -->
                    <h1 class="text-white-2 mt-3 font-family: tahoma, arial, helvetica, sans-serif; text-align: center; font-weight-500 letter-spacing-minus-1" style="margin-bottom: 0; text-transform: uppercase;">
                        YAEDP | Export Diagnostic Tool</h1>
                    <!-- end page title -->
                </div>
            </div>
        </div>
    </section>

    <section class="wow fadeIn padding-20px-tb bg-brand-color"
             style="visibility: visible; animation-name: fadeIn;">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 breadcrumb alt-font text-small">
                    <!-- breadcrumb -->
                    <ul>
                        <li><a href="{{ url('/') }}" class="text-light"
                               style="text-align: center;">Home</a>
                        </li>
                        <li><a href="#" class="text-light custom-font2"
                               style="text-align: center;">
                                YAEDP | Export Readiness Diagnostic Tool</a>
                        </li>
                    </ul>
                    <!-- end breadcrumb -->
                </div>
            </div>
        </div>
    </section>
@stop

@section('content')
    <section class="wow fadeIn pt-5 pl-3 pr-3 pb-5" style="margin-top: 0px; z-index: 3;">
        <div class="shrink-responsiveness-ent-o container-fluid">
            <div class="row m-0 justify-content-center d-flex">

                <div class="col-12">
                    <p class="float-right text-medium">
                        <a class="text-danger" href="/yaedp/export-diagnostic/logout">
                            Logout <i class="fa fa-sign-out"></i>
                        </a>
                    </p>
                </div>

                <div class="col-md-8 test-container" style="border-radius: 12px">
                    <div id="intro">
                        <div class="row p-4">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <div class="big-scrn d-none d-sm-none d-md-block">
                                        <div class="row">
                                            <div class="col-2" style="justify-content: center;align-items: center;display: flex;">
                                                <img style="float: left;" src="{{ asset('images/newlogo.png') }}"
                                                     alt="" width="99" height="60" />
                                            </div>
                                            <div class="col-8 pt-4 text-center custom-font2">
                                                <h5 class="text-dark mb-0">
                                                    Welcome to the export-readiness<br> diagnostic tool.</h5>
                                                <h5 class="brand-text">
                                                    Participant Information</h5>
                                            </div>
                                            <div class="col-2" style="justify-content: center;align-items: center;display: flex;">
                                                <img style="float: left;" src="{{ asset('images/nepc-logo.png') }}"
                                                     alt="" width="150" height="90" />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="sm-scrn d-sm-block d-md-none">
                                        <div class="row">
                                            <div class="col-6" style="justify-content: center;align-items: center;display: flex;">
                                                <img style="float: left;"
                                                     src="{{ asset('images/newlogo.png') }}" alt=""
                                                     width="99" height="60" />
                                            </div>
                                            <div class="col-6"
                                                 style="justify-content: center;align-items: center;display: flex;">
                                                <img style="float: left;" src="{{ asset('images/nepc-logo.png') }}"
                                                     width="120" height="60" />
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <p class="yaedp-content text-extra-dark-gray text-large text-left">
                                                    <strong>Name: </strong>{{ Session::get('session_name') }}<br>
                                                    <strong>Mobile: </strong>{{ Session::get('session_mobile') }}<br>
                                                    <strong>Email: </strong>{{ Session::get('session_email') }}<br>
                                                    <strong>Date of Birth: </strong> {{ Session::get('session_dob') }}<br>
                                                    <strong>Gender: </strong> {{ Session::get('session_gender') }}<br>
                                                    <strong>State of Origin: </strong> {{ Session::has('session_state_origin') ? Session::get('session_state_origin') : '' }}<br>
                                                    <strong>State of Residence: </strong> {{ Session::has('session_state_residence') ? Session::get('session_state_residence') : '' }}<br>
                                                </p>
                                            </div>
                                            <div class="col-md-6">
                                                <p class="yaedp-content text-extra-dark-gray text-large text-left">
                                                    <strong>Business Name: </strong> {{ Session::get('session_business') }}<br>
                                                    <strong>Highest Education: </strong> {{ Session::get('session_education') }}<br>
                                                    <strong>Business Location: </strong> {{ Session::get('session_location') }}<br>
                                                    <strong>Registered Company: </strong> {{ Session::get('session_legal') === 1 ? 'Yes' : 'No' }}<br>
                                                    <strong>Company Type: </strong> {{ Session::get('session_company_type') }}<br>
                                                    <strong>Value Chain: </strong> {{ Session::get('session_value_chain') }}<br>
                                                    <strong>Focus Area: </strong> {{ Session::get('session_focus_area') }}<br>
                                                </p>
                                            </div>
                                        </div>

                                        <a class="justify-content-center d-flex"
                                           href="{{ route('yaedp.export-diagnostic.instructions') }}">
                                            <button type="button"
                                                    class="yedp-begin-btn btn active">Next</button>
                                        </a>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-6">
                                        <img class="d-none" src="{{ asset('images/newlogo.png') }}"
                                             alt="" width="150" height="150" /></div>
                                    <div class="col-6 d-none">
                                        <img class="float-right" src="{{ asset('images/nepc-logo.png') }}"
                                             alt="" width="70" height="40" /></div>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>

    </section>

@stop

@section('bottom-assets')
    <!--Bottom Assets-->
    <script type="text/javascript" src="{{ asset('custom/js/yaedp/form.js') }}"></script>
    <script src="{{ asset('/users/plugins/bootstrap-select-1.13.14/js/bootstrap-select.min.js') }}"></script>
@stop
