@extends('includes.layout')

@section('meta-tags')
    <meta name="description" content="YAEDP | Export Diagnostic Tool"/>
    <meta name="robots" content="max-snippet:-1, max-image-preview:large, max-video-preview:-1"/>
    <link rel="canonical" href="{{ Request::fullUrl() }}" />
    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="object" />
    <meta property="og:title" content="YAEDP - Youth in Agrifood Export Development Program" />
    <meta property="og:url" content="{{ Request::fullUrl() }}" />
    <meta property="og:site_name" content="Nourishing Africa" />
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
             style="background-image: url(&quot;{{ asset('images/login-intro.jpg') }}&quot;); visibility: visible; animation-name: fadeIn; background-attachment: unset; background-position: center; background-attachment: fixed;">
        <div class="opacity-medium bg-extra-dark-gray"></div>
        <div class="container">
            <div class="row align-items-center">
                <div class="col-12 d-flex mt-3 flex-column justify-content-center text-center extra-small-screen page-title-large">
                    <!-- start page title -->
                    <h1 class="text-white-2 mt-3"
                        style="margin-bottom: 0; text-transform: uppercase; text-align: center; font-weight-500: letter-spacing-minus-1;">
                        YAEDP | Export Readiness Diagnostic Tool</h1>
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
                               style="font-family: tahoma, arial, helvetica, sans-serif; text-align: center;">Home</a>
                        </li>
                        <li><a href="#" class="text-light"
                               style="font-family: tahoma, arial, helvetica, sans-serif; text-align: center;">
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
                {{--@if(Session::get('status') != "success")--}}
                <div class="col-md-9 test-container" style="border-radius: 12px">
                    <div id="intro">
                        <div class="row p-4">

                            <div class="col-md-7">
                                <div class="mb-3">
                                    <div class="big-scrn d-none d-sm-none d-md-block">
                                        <div class="row">
                                            <div class="col-2" style="justify-content: center;align-items: center;display: flex;">
                                                <img style="float: left;" src="{{ asset('images/newlogo.png') }}"
                                                     alt="" width="99" height="60" />
                                            </div>
                                            <div class="col-8 pt-4" style="display: flex; justify-content: left; align-items: center;">
                                                <p class="" style="color: #169179; font-size: 16pt; font-weight: 600; font-family: tahoma, arial, helvetica, sans-serif; text-align: center;">
                                                    Youth in Agri-food Export Development Program (YAEDP)
                                                </p>
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
                                        <div class="row">
                                            <div class="col-12 pt-4" style="display: flex; justify-content: left; align-items: center;">
                                                <p class="" style="color: #169179; font-size: 16pt; font-weight: 600; font-family: tahoma, arial, helvetica, sans-serif; text-align: center;">
                                                    YAEDP | Export Readiness Diagnostic Tool
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">

                                        <p class="yaedp-content text-large">
                                            <strong>Objective: </strong><br>
                                            This tool is designed to evaluate the export-readiness level of YAEDP participants by assessing multi-level information about their previous, current, and future business operations. It will also collect research data for analytical and program reporting purposes.
                                        </p>

                                        <p class="yaedp-content text-large">
                                            <strong>Introduction: </strong><br>
                                            These range of questions/assessments are to evaluate your business in alignment with export requirements and to further move to the next stage of the YAEDP program.<br>
                                        </p>

                                        <p class="yaedp-content text-large">
                                            Answer all questions as it relates to your business.<br>
                                            Kindly note that information provided will be authenticated by Nourishing Africa.
                                        </p>

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

                            <div id="app" class="col-md-5 mt-3"
                                 style="justify-content: center; align-items: center;">
                                @if(session('logged_out'))
                                    <div class="alert alert-danger mg-b-0" role="alert">
                                        <button aria-label="Close" class="close" data-dismiss="alert" type="button">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        <strong>{{ session('logged_out') }}</strong>
                                    </div>
                                @endif
                                <export-diagnostic-login></export-diagnostic-login>
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
