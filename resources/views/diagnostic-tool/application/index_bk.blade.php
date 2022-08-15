@extends('includes.layout')

@section('meta-tags')
    <meta name="description" content="yaedp | For young nigerian agripreneurs and cooperative leaders looking to export their products through training, market linkages and digital support."/>
    <meta name="robots" content="max-snippet:-1, max-image-preview:large, max-video-preview:-1"/>
    <link rel="canonical" href="{{ Request::fullUrl() }}" />
    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="object" />
    <meta property="og:title" content="YAEDP - Youth in Agrifood Export Development Program" />
    <meta property="og:url" content="{{ Request::fullUrl() }}" />
    <meta property="og:site_name" content="African Food Changemakers" />
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:description" content="yaedp | For young nigerian agripreneurs and cooperative leaders looking to export their products through training, market linkages and digital support." />
    <meta name="twitter:title" content="YAEDP - Youth in Agrifood Export Development Program" />
    <meta name="twitter:site" content="@nourish_africa" />
    <script type='application/ld+json' class='yoast-schema-graph yoast-schema-graph--main'>
    {
   "@context":"https://schema.org",
   "@graph":[
      {
         "@type":"Organization",
         "@id":"https://nourishingafrica.com/#organization",
         "name":"African Food Changemakers",
         "url":"https://nourishingafrica.com/",
         "sameAs":[
            "https://www.facebook.com/nourishafrica1",
            "https://instagram.com/nourish_africa",
            "https://www.linkedin.com/company/28506256",
            "https://twitter.com/nourish_africa"
         ],
         "logo":{
            "@type":"ImageObject",
            "@id":"https://nourishingafrica.com/#logo",
            "inLanguage":"en-US",
            "url":"https://nourishingafrica.com/wp-content/uploads/2019/04/NA-1-Official.png",
            "width":848,
            "height":519,
            "caption":"African Food Changemakers"
         },
         "image":{
            "@id":"https://nourishingafrica.com/#logo"
         }
      },
      {
         "@type":"WebSite",
         "@id":"https://nourishingafrica.com/#website",
         "url":"https://nourishingafrica.com/",
         "name":"African Food Changemakers",
         "inLanguage":"en-US",
         "description":"A home for 1 million agri-food entrepreneurs transforming Africa&#039;s agricultural",
         "publisher":{
            "@id":"https://nourishingafrica.com/#organization"
         },
         "potentialAction":{
            "@type":"SearchAction",
            "target":"https://nourishingafrica.com/?s={search_term_string}",
            "query-input":"required name=search_term_string"
         }
      },
      {
         "@type":"CollectionPage",
         "@id":"{{ Request::fullUrl() }}#webpage",
         "url":"{{ Request::fullUrl() }}",
         "name":"YAEDP - Youth in export development program",
         "isPartOf":{
            "@id":"https://nourishingafrica.com/#website"
         },
         "inLanguage":"en-US",
         "description":"For young nigerian agripreneurs and cooperative leaders looking to export their products through training, market linkages and digital support."
      }
   ]
}
</script>
@stop

@section('title')
    YAEDP - Youth in Agrifood Export Development Program
@stop

@section('top-assets')
    <!--Sharing buttons custom script-->
    <!--- JQuery min js --->
    <script src="{{ asset('investors-assets/plugins/jquery/jquery.min.js') }}"></script>
    <link href="{{ asset('/users/plugins/bootstrap-select-1.13.14/css/bootstrap-select.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://res.cloudinary.com/dxfq3iotg/raw/upload/v1569006288/BBBootstrap/choices.min.css?version=7.0.0">
    <script src="https://res.cloudinary.com/dxfq3iotg/raw/upload/v1569006273/BBBootstrap/choices.min.js?version=7.0.0"></script>

    <style type="text/css">
        span.page-link{
            background-color: #006600 !important;
            padding-top: 12px !important;
            height: 42px !important;
        }
        .page-item.disabled .page-link{
            color: #006600 !important;
            background-color: #FFFFFF !important;
            padding-top: 10px !important;
        }
        a.page-link{
            color: #006600 !important;
        }
        .page-item.active .page-link{
            background-color: #006600 !important;
        }
        .container-fluid{
            max-width: 1600px !important;
        }
        button.dropdown-toggle{
            padding-top: 15px !important;
            height : 48px !important;
            background-color: transparent !important;
            font-size: 1rem;
            font-weight: 400;
            line-height: 1.5;
            border-radius: 5px;
            color: #495057;
        }
        div.dropdown-menu{
        }
        .test-container{
            -webkit-box-shadow: 0px 0px 30px 0px rgb(0 0 0 / 10%);
            -moz-box-shadow: 0px 0px 30px 0px rgba(0, 0, 0, 0.1);
            box-shadow: 0px 0px 30px 0px rgb(0 0 0 / 10%);
            background: #ffffff url(/esp2/img/pattern_1.png) repeat;
        }
        .yedp-begin-btn{
            background: #006600;
            border: 2px solid #006600;
            box-sizing: border-box;
            border-radius: 5.06329px;
            font-family: tahoma, arial, helvetica, sans-serif;
            font-style: normal;
            font-weight: 500;
            font-size: 16px;
            line-height: 26px;
            color: #ffffff;
        }

        .yedp-begin-btn:hover{
            background: #FFFFFF;
            border: 2px solid #006600;
            box-sizing: border-box;
            border-radius: 5.06329px;
            font-family: tahoma, arial, helvetica, sans-serif;
            font-style: normal;
            font-weight: 500;
            font-size: 16px;
            line-height: 26px;
            color: #006600;
        }

        .yedp-begin-title{
            font-family: tahoma, arial, helvetica, sans-serif;
            font-style: normal;
            font-weight: bold;
            text-transform: capitalize
            font-size: 30px;
            line-height: 52px;
            text-align: center;
            color: #1E1E1E;
        }
        .yedp-begin-btn-next{
            background: #FFFFFF;
            border: 1.01266px solid #006600;
            box-sizing: border-box;
            border-radius: 5.06329px;
            font-family: tahoma, arial, helvetica, sans-serif;
            font-style: normal;
            font-weight: normal;
            font-size: 16px;
            line-height: 26px;
            color: #006600;
            width: 100px;
        }
        .ten{
            width: 10%;
            background-color: #006600;
        }
        .twenty{
            width: 20%;
            background-color: #006600;
        }
        .thirty{
            width: 30%;
            background-color: #006600;
        }
        .fifty{
            width: 50%;
            background-color: #006600;
        }
        .eighty{
            width: 80%;
            background-color: #006600;
        }
        .hundred{
            width: 100%;
            background-color: #006600;
        }
        .yaedp-content{
            font-family: tahoma, arial, helvetica, sans-serif;
            font-style: normal;
            font-weight: normal;
            text-align: justify;
            color: #1E1E1E;
        }
        .md-form {
            margin-top: unset;
            margin-bottom: unset;
        }

        .md-form-container {
            padding: 10px;
            background-color: #fff;
        }

        .form-check-input {
            position: absolute;
            margin-top: .2rem;
            margin-left: -2rem;
            opacity: 1 !important;
        }

        .privacy-policy-accordion-header {
            background: #046B60;
            color: #fff;
            border-radius: 0;
            padding: 18px 28px 19px;
        }

        .privacy-policy-accordion-body {
            background: #eeeded;
            padding: 35px 28px 25px;
            border-top: none;
        }

        .justify-text {
            text-align: justify;
            text-justify: inter-word;
        }

        strong {
            font-weight: 600;
        }
    </style>
@stop

@section('top-panel')
    <section class="wow fadeIn parallax" data-stellar-background-ratio="0.5" style="background-image: url(&quot;{{ asset('images/entrepreneurs/mem1.jpg') }}&quot;); visibility: visible; animation-name: fadeIn;background-attachment: unset; background-position: center;">
        <div class="opacity-medium bg-extra-dark-gray"></div>
        <div class="container">
            <div class="row align-items-center">
                <div class="col-12 d-flex mt-3 flex-column justify-content-center text-center extra-small-screen page-title-large">
                    <!-- start page title -->
                    <h1 class="text-white-2 mt-3 font-family: tahoma, arial, helvetica, sans-serif; text-align: center; font-weight-500 letter-spacing-minus-1" style="margin-bottom: 0; text-transform: uppercase;">
                        Youth In Agrifood Export Development Program
                    </h1>
                    <!-- end page title -->
                </div>
            </div>
        </div>
    </section>
    <section class="wow fadeIn padding-20px-tb bg-brand-color" style="visibility: visible; animation-name: fadeIn;">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 breadcrumb alt-font text-small">
                    <!-- breadcrumb -->
                    <ul>
                        <li><a href="{{ url('/') }}" class="text-light" style="font-family: tahoma, arial, helvetica, sans-serif; text-align: center;">Home</a></li>
                        <li><a href="#" class="text-light" style="font-family: tahoma, arial, helvetica, sans-serif; text-align: center;">
                                Youth in Agrifood Export Development Program</a></li>
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
            <div class="row m-0">
                {{--@if(Session::get('status') != "success")--}}
                <div class="col-md-12 test-container" style="border-radius: 12px">
                    <div id="intro">
                        <div class="row p-4">
                            <div class="col-md-8">
                                <div class="mb-3">
                                    <div class="big-scrn d-none d-sm-none d-md-block">
                                        <div class="row">
                                            <div class="col-2" style="justify-content: center;align-items: center;display: flex;">
                                                <img style="float: left;" src="{{ asset('images/newlogo.png') }}"
                                                     alt="" width="99" height="60" />
                                            </div>
                                            <div class="col-8 pt-4" style="display: flex; justify-content: left; align-items: center;">
                                                <p class="" style="color: #169179; font-size: 16pt; font-weight: 600; font-family: tahoma, arial, helvetica, sans-serif; text-align: center;">
                                                    Youth in Agrifood Export Development Program (YAEDP)
                                                </p>
                                            </div>
                                            <div class="col-2" style="justify-content: center;align-items: center;display: flex;">
                                                <img style="float: left;" src="{{ asset('images/yedp/logo-12.png') }}"
                                                     alt="" width="150" height="90" />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="sm-scrn d-sm-block d-md-none">
                                        <div class="row">
                                            <div class="col-6" style="justify-content: center;align-items: center;display: flex;">
                                                <img style="float: left;" src="{{ asset('images/newlogo.png') }}" alt=""
                                                     width="99" height="60" />
                                            </div>
                                            <div class="col-6" style="justify-content: center;align-items: center;display: flex;">
                                                <img style="float: left;" src="{{ asset('images/yedp/logo-2.png') }}" alt=""
                                                     width="120" height="60" />
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12 pt-4" style="display: flex; justify-content: left; align-items: center;">
                                                <p class="" style="color: #169179; font-size: 16pt; font-weight: 600; font-family: tahoma, arial, helvetica, sans-serif; text-align: center;">
                                                    Youth in Agrifood Export Development Program (YAEDP)
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <p class="yaedp-content">
                                    The Youth in Agri-food Export Development Program (YAEDP) is designed to develop the capacity of Nigerian youth, aged 25 – 40 to participate in the export sector.
                                    The program will provide training, market linkages, and digital support to entrepreneurs and co-operative leaders in the Nigerian agri-food sector.
                                </p>
                                <div class="row">
                                    <div class="col-md-12">
                                        <p class="mb-1">
                                    <span style="color: #1E1E1E; font-family: tahoma, arial, helvetica, sans-serif;">
                                        <strong>Locations<i class="fa fa-pin"></i></strong></span>
                                        </p>
                                        <p style="font-family: tahoma, arial, helvetica, sans-serif;">Abia, Adamawa, Cross River, Edo, FCT, Kano, Kaduna, Kogi, Lagos, Ogun, and Oyo.</p>

                                        <p class="mb-1">
                                            <span style="color: #1E1E1E; font-family: tahoma, arial, helvetica, sans-serif;"><strong>Value Chains:</strong></span>
                                        </p>
                                        <p style="font-family: tahoma, arial, helvetica, sans-serif; text-align: justify;">The YAEDP is accepting applications from agrifood entrepreners and cooperative leaders in these value chains: Cocoa, Spices, Sesame, Shea butter, Cashew, Cassava, Soybean, Rubber, and Ginger.</p>
                                        <p class="mb-1">
                                            <span style="color: #1E1E1E; font-family: tahoma, arial, helvetica, sans-serif;"><strong>Eligibility Criteria:</strong></span>
                                        </p>
                                        <ul>
                                            <li>
                                            <span style="font-family: tahoma, arial, helvetica, sans-serif; text-align: justify;">
                                                Nigerian agripreneurs and agro-cooperative leaders between 25 - 40 years old who are looking to export their produce.
                                            </span>
                                            </li>
                                            <li>
                                            <span style="font-family: tahoma, arial, helvetica, sans-serif; text-align: justify;">
                                                Applicants' businesses must be located in the priority states in the country.
                                            </span>
                                            </li>
                                            <li>
                                            <span style="font-family: tahoma, arial, helvetica, sans-serif; text-align: justify;">
                                                Applicants must produce and/or sell food products in the priority value chains.
                                            </span>
                                            </li>
                                            <li>
                                            <span style="font-family: tahoma, arial, helvetica, sans-serif; text-align: justify;">
                                                The business must have been operational for at least one year.
                                            </span>
                                            </li>
                                        </ul>
                                        <p style="color: #1E1E1E; font-family: tahoma, arial, helvetica, sans-serif; text-align: justify;">If selected, participants must be willing to dedicate at least 3 hours in a week for 6 - 8 weeks for the training component of the program. The training will be entirely online leveraging digital channel and media.</p>
                                    </div>
                                    <div class="col-md-3 mb-3 d-none" style="display: flex; justify-content: center; align-items: center;">
                                        <img class="d-none" style="border-style: solid; border-color: #046b60; height: 300px;"
                                             src="{{ asset('images/yedp/yedp.jpeg') }}" alt="" />
                                    </div>
                                </div>

                                <p style="text-align: justify; color: #1E1E1E; font-family: tahoma, arial, helvetica, sans-serif;">If you meet the eligibility criteria, apply today!</p>
                                <p style="text-align: justify; color: #1E1E1E; font-family: tahoma, arial, helvetica, sans-serif;">Applicants are to note that this program does not provide grants to participants. Application and participation in the program are free of charge. </p>
                                <p style="text-align: justify; color: #1E1E1E; font-family: tahoma, arial, helvetica, sans-serif;">
                                    APPLICATION DEADLINE: Application is ongoing until 30 April 2022
                                </p>
                                <p style="text-align: justify; color: #000000; font-size: 10pt; font-family: verdana, geneva, sans-serif;"><!-- pagebreak --></p>
                                <div class="row">
                                    <div class="col-6">
                                        <img class="d-none" src="{{ asset('images/yedp/yedp-2.jpeg') }}"
                                             alt="" width="150" height="150" /></div>
                                    <div class="col-6 d-none">
                                        <img class="float-right" src="{{ asset('images/yedp/riby_logo.png') }}"
                                             alt="" width="70" height="40" /></div>
                                </div>
                            </div>
                            <div class="col-md-4 mt-3" style="display: flex; justify-content: center; align-items: center;">
                                <div class="card shadow-none p-5">
                                    <h6 class="yedp-begin-title">Begin Application</h6>
                                    <button class="yedp-begin-btn btn active" onclick="proceedApplication()">Begin</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="formdiv" class="d-none">
                        <div id="indicator" class="report-dash mb-3">
                            <div id="myAnchor" class=''>
                                <div id="card-def-head" class="card-header bg-white stage-one-title pl-5 pr-5">
                                     <div class="progress">
                                        <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemax="100"></div>
                                    </div>
                                    <div id="stages-div" class="d-none" style="display: flex; justify-content: center; align-items: center;">
                                        <label id="stage-link-1" class="stage-link-active p-3"><span id="stage-link-icon-1" class="d-none link-icon"><i class="fas fa-check"></i></span>Personal Information</label>
                                        <label id="stage-link-2" class="stage-link p-3"><span id="stage-link-icon-2" class="d-none link-icon"><i class="fas fa-check"></i></span>Business Information</label>
                                        <label id="stage-link-3" class="stage-link p-3"><span id="stage-link-icon-3" class="d-none link-icon"><i class="fas fa-check"></i></span>Additional Information</label>
                                    </div>
                                    @include('includes.alerts')
                                </div>
                                <div class="card-body">
                                    <div id="stage-area-checkbox-1-form">
                                        <div id="stage-area-checkbox-1" class="stage-area-checkbox-active">
                                            <p class="stage-area-checkbox-txt">Do you have an existing business or lead an agro-cooperative?</p>
                                            <div class="form-group">
                                                <label class="custom-check"> Yes
                                                    <input type="checkbox" name="q1" value="yes" onclick="preliminaryQuestion('q1', 'yes')"/>
                                                    <span class="checkmark"></span>
                                                </label>
                                                <label class="custom-check"> No
                                                    <input type="checkbox" name="q1" value="no" onclick="preliminaryQuestion('q1', 'no')">
                                                    <span class="checkmark"></span>
                                                </label>
                                            </div>
                                        </div>
                                        <div id="stage-area-checkbox-2" class="stage-area-checkbox">
                                            <p class="stage-area-checkbox-txt">Is your business/cooperative  operating in the agriculture and food sector?</p>
                                            <div class="form-group">
                                                <label class="custom-check">Yes
                                                    <input type="checkbox" name="q2" value="yes" onclick="preliminaryQuestion('q2', 'yes')">
                                                    <span class="checkmark"></span>
                                                </label>
                                                <label class="custom-check">No
                                                    <input type="checkbox" name="q2" value="no" onclick="preliminaryQuestion('q2', 'no')">
                                                    <span class="checkmark"></span>
                                                </label>
                                            </div>
                                        </div>
                                        <div id="stage-area-checkbox-3" class="stage-area-checkbox">
                                            <p class="stage-area-checkbox-txt">Please enter your age </p>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input id="participant_age" type="number" inputmode="numeric" pattern="[0-9]*" min="0" name="q3" value="" class="form-control control-sm"/>
                                                        <button type="button" onclick="preliminaryQuestion('q3', $('#participant_age').val())" class="yedp-begin-btn-next">Next</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="stage-area-checkbox-backhome" class="d-none">
                                        <p class="text-center stage-area-checkbox-txt">Kindly note that if you do not have an existing business or lead an agro-cooperative within the agriculture and food sector, you are not eligible for this program. Thank you for your interest in the program. Kindly visit <a href="https://www.nourishingafrica.com">https://www.nourishingafrica.com</a> for other resources and opportunities in the African agrifood landscape.</p>
                                        <div class="form-group row mb-0">
                                            <div class="col-md-12 p-3" style="align-items: center; justify-content: center; display: flex;">
                                                <a href="{{ url('/') }}" class="btn btn-stage-one-active text-center">
                                                    Home
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <!--<div id="stage-area-checkbox-intro" class="p-5 d-none">
                                        <article style="text-align: justify; text-justify: inter-word;">
                                            <p class="stage-area-checkbox-txt"></p>
                                            <p class="stage-area-checkbox-txt"></p>
                                            <p class="stage-area-checkbox-txt"></p>
                                        </article>
                                        <div class="form-group row mb-0">
                                            <div class="col-md-12 text-center p-3">
                                                <button type="button" class="btn btn-stage-one-active text-center p-2 m-2">
                                                    {{ __('Home') }}
                                                </button>
                                            </div>
                                        </div>
                                    </div>-->
                                    <!-- Modal -->
                                    <div class="modal fade" id="myModal" role="dialog">
                                        <div class="modal-dialog modal-dialog-centered modal-md">

                                            <!-- Modal content-->
                                            <div class="modal-content">
                                                <div class="modal-header border-none">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                </div>
                                                <div class="modal-body text-center">
                                                <h6 class=""><span class="text-warning"><i class="fa fa-exclamation-triangle"></i></span> Please review your inputs for errors.</h6>
                                                </div>
                                                <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <form id="yedpTemplateForm" method="post" action="" enctype="multipart/form-data">
                                        @csrf
                                        <div id='indicator2' class='d-none'>
                                            <label class="important-field-text p-3">Fields with asterisk (<span class="text-danger">*</span>) are required</label>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="row">
                                                        <div class="col-md-12 form-group">
                                                            <label class="form-text">Surname <span class="text-danger">*</span>
                                                                <input class="form-control" type="text" placeholder="Enter your surname" name="surname" id="lname-part-1" required />
                                                                <span id="lname-part-1-fb" class="feedback-custom"></span>
                                                            </label>

                                                        </div>

                                                        <div class="col-md-12 form-group">
                                                            <label class="form-text">First Name <span class="text-danger">*</span>
                                                                <input class="form-control" type="text" placeholder="Enter your first name" name="firstname" id="fname-part-1" required />
                                                                <span id="fname-part-1-fb" class="feedback-custom"></span>
                                                            </label>
                                                        </div>

                                                        <!--<div class="col-md-12 form-group">
                                                            <label class="form-text">Please upload a valid ID card: <span class="text-danger">*</span>
                                                                <input class="form-control" id="id-card-part-1" name="id_card" type="file" onchange="processFile2(this)" required>
                                                                <span id="id-card-part-1-fb" class="feedback-custom"></span>
                                                            </label>
                                                        </div>-->

                                                        <div class="col-md-12 form-group">
                                                            <label class="form-text">Email <span class="text-danger">*</span>
                                                                <input class="form-control" name="email" type="email" placeholder="Enter your Email" id="email-part-1" required>
                                                                <span id="email-part-1-fb" class="feedback-custom"></span>
                                                            </label>
                                                        </div>

                                                        <div class="col-md-12 form-group">
                                                            <label class="form-text">Confirm Email <span class="text-danger">*</span>
                                                                <input class="form-control" type="email" placeholder="Confirm your Email" id="confirm-email-part-1" required>
                                                                <span id="confirm-email-part-1-fb" class="feedback-custom"></span>
                                                            </label>
                                                        </div>

                                                        <div class="col-md-12 form-group">
                                                            <label class="form-text">Date of birth <span class="text-danger">*</span>
                                                                <input class="form-control" type="date" name="dob" id="dob-part-1" max="1997-12-31" min="1982-01-01" required />
                                                                <input type="hidden" name="age" id="dob-part-1-clone"/>
                                                                <span id="dob-part-1-fb" class="feedback-custom"></span>
                                                            </label>
                                                        </div>
                                                        <div class="col-md-12 form-group">
                                                            <label class="form-text">Mobile Number
                                                                <input class="form-control" type="tel" placeholder="Enter your mobile number" id="phone-part-1" required/>
                                                                <input type="hidden" name="mobile" id="phone-part-1-clone"/>
                                                                <label id="phone-part-1-fb" class="feedback-custom text-danger" style="position: relative; top:8%;  margin-left:-10px; font-size: 13px; font-weight: 400;"></label>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="row">
                                                        <div class="col-md-12 form-group">
                                                            <label class="form-text">States of origin<span class="text-danger">*</span>
                                                                <select name="state_origin" id="state-origin-part-1" class="form-control" required>
                                                                    <option value="" selected>-- Select state --</option>
{{--                                                                    @foreach($states as $state)--}}
{{--                                                                        <option value="{{ $state->id }}">{{ $state->name }}</option>--}}
{{--                                                                    @endforeach--}}
                                                                </select>
                                                                <span id="state-origin-part-1-fb" class="feedback-custom"></span>
                                                            </label>
                                                        </div>
                                                        <div class="col-md-12 form-group">
                                                            <label class="form-text">States of residence<span class="text-danger">*</span>
                                                                <select name="state_residence" id="state-residence-part-1" class="form-control" required>
                                                                    <option value="" selected>-- Select state --</option>
{{--                                                                    @foreach($states as $state)--}}
{{--                                                                        <option value="{{ $state->id }}">{{ $state->name }}</option>--}}
{{--                                                                    @endforeach--}}
                                                                </select>
                                                                <span id="state-residence-part-1-fb" class="feedback-custom"></span>
                                                            </label>
                                                        </div>
                                                        <div class="col-md-12 form-group">
                                                            <label class="form-text">Gender <span class="text-danger">*</span>
                                                                <select name="gender" id="gender-part-1" class="form-control" required>
                                                                    <option value="" selected>-- Select gender --</option>
                                                                    <option value="Male">Male</option>
                                                                    <option value="Female">Female</option>
                                                                    <option value="Other">Other</option>
                                                                    <option value="Rather Not Say">Rather Not Say</option>
                                                                </select>
                                                                <span id="gender-part-1-fb" class="feedback-custom"></span>
                                                            </label>
                                                        </div>
                                                        <div class="col-md-12 form-group">
                                                            <label class="form-text">Highest level of education <span class="text-danger">*</span>
                                                                <select name="education_level" id="education-level-part-1" class="form-control" required>
                                                                    <option value="" selected>-- Select --</option>
                                                                    <option value="Secondary/High School">Secondary/High School</option>
                                                                    <option value="Tertiary Education (Graduate)">Tertiary Education (Graduate)</option>
                                                                    <option value="Tertiary Education (Postgraduate)">Tertiary Education (Postgraduate)</option>
                                                                    <option value="PhD">PhD or above</option>
                                                                </select>
                                                                <span id="education-level-part-1-fb" class="feedback-custom"></span>
                                                            </label>
                                                        </div>
                                                        <div class="col-md-12 form-group pass_show">
                                                            <label class="form-text">Create Password <span class="text-danger">*</span>
                                                                <input type="password" name="password" id="password-part-1" placeholder="Enter password" class="form-control"/>
                                                                <!--<span class="ptxt"><i class="fas fa-eye"></i></span>-->
                                                                <span id="password-part-1-fb" class="feedback-custom"></span>
                                                            </label>
                                                        </div>
                                                        <div class="col-md-12 form-group pass_show">
                                                            <label class="form-text">Confirm Password <span class="text-danger">*</span>
                                                                <input type="password" name="password_confirmation" id="password-confirmation-part-1" placeholder="Confirm password" class="form-control" />
                                                                <!--<span class="ptxt"><i class="fas fa-eye"></i></span>-->
                                                                <span id="password-confirmation-part-1-fb" class="feedback-custom"></span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row mb-0">
                                                <div class="col-md-12 text-center p-3">
                                                    <button type="button" class="btn btn-stage-one-active text-center" onclick="stagecontentpart1form()">
                                                        {{ __('Continue') }}
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <div id='indicator3' class='d-none'>
                                            <label class="important-field-text p-3">Fields with asterisk (<span class="text-danger">*</span>) are required</label>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="row">
                                                        <div class="col-md-12 form-group">
                                                            <label class="form-text">I am registering as <span class="text-danger">*</span>
                                                                <select name="registering_as" id="registering-as-part-2" required class="form-control" />
                                                                    <option value="" selected>-- Select --</option>
                                                                    <option value="agribusiness owner">An agribusiness owner</option>
                                                                    <option value="agro-commodity cooperative leader">An agro-commodity cooperative leader</option>
                                                                </select>
                                                                <span id="registering-as-part-2-fb" class="feedback-custom"></span>
                                                            </label>
                                                        </div>
                                                        <div class="col-md-12 form-group">
                                                            <label class="form-text">Business Name <span class="text-danger">*</span>
                                                                <input class="form-control" type="text" placeholder="Enter your business name" name="business" id="business-name-part-2" required />
                                                                <span id="business-name-part-2-fb" class="feedback-custom"></span>
                                                            </label>
                                                        </div>
                                                        <div class="col-md-12 form-group">
                                                            <label class="form-text">Business Address<span class="text-danger">*</span>
                                                                <textarea class="form-control" name="business_address" placeholder="Enter your business address" id="business-address-part-2" required></textarea>
                                                                <span id="business-address-part-2-fb" class="feedback-custom"></span>
                                                            </label>
                                                        </div>
                                                        <!--<div class="col-md-12 form-group">
                                                            <label class="form-text">Nearest bus stop and landmark: <span class="text-danger">*</span>
                                                                <input class="form-control" type="text" placeholder="Nearest bus stop and landmark" name="busstop_landmark" id="bus-stop-landmark-part-2" required />
                                                                <span id="bus-stop-landmark-part-2-fb" class="feedback-custom"></span>
                                                            </label>
                                                        </div>-->
                                                        <div class="col-md-12 form-group">
                                                            <label class="form-text">Location <span class="text-danger">*</span>
                                                                <select id="location-part-2" required class="form-control" onchange="otherDiv(this.value, 'loc-others', 'location-part-2-clone')"/>
                                                                    <option value="" selected>-- Select --</option>
                                                                    <option value="Abia">Abia</option>
                                                                    <option value="Adamawa">Adamawa</option>
                                                                    <option value="Cross River">Cross River</option>
                                                                    <option value="Edo">Edo</option>
                                                                    <option value="FCT">FCT</option>
                                                                    <option value="Kano">Kano</option>
                                                                    <option value="Kaduna">Kaduna</option>
                                                                    <option value="Kogi">Kogi</option>
                                                                    <option value="Lagos">Lagos</option>
                                                                    <option value="Ogun">Ogun</option>
                                                                    <option value="Oyo">Oyo</option>
                                                                    <option value="Others">Others</option>
                                                                </select>
                                                                <input type="hidden" name="location" id="location-part-2-clone">
                                                                <span id="location-part-2-fb" class="feedback-custom"></span>
                                                            </label>
                                                        </div>
                                                        <div id="loc-others" class="col-md-12 form-group d-none">
                                                            <label class="form-text">Please specify: <span class="text-danger">*</span>
                                                                <input class="form-control" type="text" placeholder="" id="loc-other-part-2" required />
                                                                <span id="loc-other-part-2-fb" class="feedback-custom"></span>
                                                            </label>
                                                        </div>
                                                        <div class="col-md-12 form-group">
                                                            <label class="form-text">Value Chain <span class="text-danger">*</span>
                                                                <select id="value-chain-part-2" class="form-control"
                                                                        onchange="otherDiv(this.value, 'vc-others', 'value-chain-part-2-clone')"/>
                                                                    <option value="" selected>-- Select --</option>
                                                                    <option value="Cocoa">Cocoa</option>
                                                                    <option value="Spices">Spices</option>
                                                                    <option value="Sesame">Sesame</option>
                                                                    <option value="Shea butter">Shea butter</option>
                                                                    <option value="Cashew">Cashew</option>
                                                                    <option value="Cassava">Cassava</option>
                                                                    <option value="Soybean">Soybean</option>
                                                                    <option value="Rubber">Rubber</option>
                                                                    <option value="Ginger">Ginger</option>
                                                                    <option value="Others">Others</option>
                                                                </select>
                                                                <input type="hidden" name="value_chain" id="value-chain-part-2-clone">
                                                                <span id="value-chain-part-2-fb" class="feedback-custom"></span>
                                                            </label>
                                                        </div>
                                                        <div id="vc-others" class="col-md-12 form-group d-none">
                                                            <label class="form-text">Please specify: <span class="text-danger">*</span>
                                                                <input class="form-control" type="text" placeholder="" id="vc-other-part-2" required />
                                                                <span id="vc-other-part-2-fb" class="feedback-custom"></span>
                                                            </label>
                                                        </div>
                                                        <div class="col-md-12 form-group">
                                                            <label class="form-text">Focus Area <span class="text-danger">*</span>
                                                                <select id="focus-area-part-2" class="form-control" onchange="otherDiv(this.value, 'fa-others', 'focus-area-part-2-clone')"/>
                                                                    <option value="" selected>-- Select --</option>
                                                                    <option value="Farming">Farming</option>
                                                                    <option value="Processing">Processing</option>
                                                                    <option value="Aggregation and commodity exchange">Aggregation and commodity exchange</option>
                                                                    <option value="Sales and exports">Sales and exports</option>
                                                                    <option value="Others">Others</option>
                                                                </select>
                                                                <input type="hidden" name="focus_area" id="focus-area-part-2-clone">
                                                                <span id="focus-area-part-2-fb" class="feedback-custom"></span>
                                                            </label>
                                                        </div>
                                                        <div id="fa-others" class="col-md-12 form-group d-none">
                                                            <label class="form-text">Please specify: <span class="text-danger">*</span>
                                                                <input class="form-control" type="text" placeholder="" id="fa-other-part-2" required />
                                                                <span id="fa-other-part-2-fb" class="feedback-custom"></span>
                                                            </label>
                                                        </div>
                                                        <!--<div class="form-group col-md-12">
                                                            <label class="form-text">Production capacity/volume (in kg/month): <span class="text-danger">*</span>
                                                                <input name="production_capacity" class="form-control" type="number" min="0" inputmode="numeric" pattern="[0-9]*" placeholder="" id="prod-cap-part-2" required />
                                                                <span id="prod-cap-part-2-fb" class="feedback-custom"></span>
                                                            </label>
                                                        </div>
                                                        <div class="col-md-12 form-group">
                                                            <label class="form-text">Where do you run your business/cooperative from? <span class="text-danger">*</span>
                                                                <select id="business-running-part-2" class="form-control" onchange="otherDiv(this.value, 'br-others', 'business-running-part-2-clone')"/>
                                                                    <option value="" selected>-- Select --</option>
                                                                    <option value="home based">Home Based</option>
                                                                    <option value="rented/leased facility">Rented/leased facility</option>
                                                                    <option value="own property">Own property</option>
                                                                    <option value="Others">Others</option>
                                                                </select>
                                                                <input type="hidden" name="business_running" id="business-running-part-2-clone">
                                                                <span id="business-running-part-2-fb" class="feedback-custom"></span>
                                                            </label>
                                                        </div>
                                                        <div id="br-others" class="col-md-12 form-group d-none">
                                                            <label class="form-text">Please specify: <span class="text-danger">*</span>
                                                                <input class="form-control" type="text" placeholder="" id="br-other-part-2" required />
                                                                <span id="br-other-part-2-fb" class="feedback-custom"></span>
                                                            </label>
                                                        </div>-->
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="row">
                                                        <div class="col-md-12 form-group">
                                                            <label class="form-text">
                                                                Is your business/cooperative registered in Nigeria?
                                                                <span class="text-danger">*</span>
                                                                <select name="company_legal" id="company-legal-part-2" required class="form-control" <!--onchange="CompanyLegal(this.value)" -->/>
                                                                    <option value="" selected>-- Select --</option>
                                                                    <option value="1&5">Yes</option>
                                                                    <option value="0&0">No</option>
                                                                </select>
                                                                <span id="company-legal-part-2-fb" class="feedback-custom"></span>
                                                            </label>
                                                        </div>
                                                        <!--<div id="legalPane1" class="col-md-12 form-group d-none">
                                                            <label class="form-text">Business Corporate Affairs Commission(CAC) registration number: <span class="text-danger">*</span>
                                                                <input class="form-control" type="text" placeholder="Enter your registration number" name="registration_number" id="registration-number-part-2"/>
                                                                <span id="registration-number-part-2-fb" class="feedback-custom"></span>
                                                            </label>
                                                        </div>
                                                        <div id="legalPane2" class="col-md-12 form-group d-none">
                                                            <label class="form-text">Please upload your registration document (CAC document, cooperative registration, etc.) <span class="text-danger">*</span>
                                                                <input class="form-control" id="registration-number-doc-part-2" name="registration_number_doc" type="file" onchange="processFile(this)" >
                                                                <span id="registration-number-doc-part-2-fb" class="feedback-custom"></span>
                                                            </label>
                                                        </div>-->
                                                        <div class="col-md-12 form-group">
                                                            <label class="form-text">Type of business entity:<span class="text-danger">*</span>
                                                                <select name="company_type" id="company-type-part-2" class="form-control" />
                                                                    <option value="" selected>-- Select company type --</option>
                                                                    <option value="sole proprietorship">Sole Proprietorship</option>
                                                                    <option value="partnership">Partnership</option>
                                                                    <option value="LLC">LLC</option>
                                                                    <option value="Cooperative society">Cooperative society</option>
                                                                </select>
                                                                <span id="company-type-part-2-fb" class="feedback-custom"></span>
                                                            </label>
                                                        </div>
                                                        <div class="col-md-12 form-group">
                                                            <label class="form-text">Do you belong to a business association/network? <span class="text-danger">*</span>
                                                                <select name="business_association" id="business-association-part-2" required class="form-control" onchange="BusinessAssociation(this.value)" />
                                                                    <option value="" selected>-- Select --</option>
                                                                    <option value="1">Yes</option>
                                                                    <option value="0">No</option>
                                                                </select>
                                                                <span id="business-association-part-2-fb" class="feedback-custom"></span>
                                                            </label>
                                                        </div>
                                                        <div id="baPane" class="col-md-12 form-group d-none">
                                                            <label class="form-text">Please state the business association/network name: <span class="text-danger">*</span>
                                                                <input class="form-control" type="text" placeholder="Enter the name" name="business_association_name" id="business-association-name-part-2" required />
                                                                <span id="business-association-name-part-2-fb" class="feedback-custom"></span>
                                                            </label>
                                                        </div>
                                                        <div class="col-md-12 form-group">
                                                            <label class="form-text">Business Website
                                                                <input type="text" placeholder="Enter your business website"
                                                                       name="website" id="website-part-2" class="form-control"
                                                                       onchange="$(this).val($(this).val().toLowerCase())">
                                                                <span id="website-part-2-fb" class="feedback-custom"></span>
                                                            </label>
                                                        </div>
                                                        <div id="social-media-1" class="col-md-12 form-group">
                                                            <label class="form-text">Business Facebook Link
                                                                <input type="text" class="form-control" name="facebook"
                                                                       id="def_social_media_link-part-2"
                                                                       placeholder="e.g https://facebook.com/accountname"
                                                                       onchange="$(this).val($(this).val().toLowerCase())">
                                                                <span id="def_social_media_link-part-2-fb" class="feedback-custom"></span>
                                                            </label>
                                                        </div>

                                                        <div id="social-media-2" class="col-md-12 form-group">
                                                            <label class="form-text">Business LinkedIn Link
                                                                <input type="text" class="form-control" name="linkedin"
                                                                       id="def_social_media_link_2-part-2"
                                                                       placeholder="e.g https://linkedin.com/accountname"
                                                                       onchange="$(this).val($(this).val().toLowerCase())">
                                                                <span id="def_social_media_link_2-part-2-fb" class="feedback-custom"></span>
                                                            </label>
                                                        </div>

                                                        <div id="social-media-3" class="col-md-12 form-group">
                                                            <label class="form-text">Business Twitter Link
                                                                <input type="text" class="form-control" name="twitter"
                                                                       id="def_social_media_link_3-part-2"
                                                                       placeholder="e.g https://twitter.com/accountname"
                                                                       onchange="$(this).val($(this).val().toLowerCase())">
                                                                <span id="def_social_media_link_3-part-2-fb" class="feedback-custom"></span>
                                                            </label>
                                                        </div>

                                                        <div id="social-media-3" class="col-md-12 form-group">
                                                            <label class="form-text">Business Instagram Link
                                                                <input type="text" class="form-control" name="instagram"
                                                                       id="def_social_media_link_4-part-2"
                                                                       placeholder="e.g https://instagram.com/accountname"
                                                                       onchange="$(this).val($(this).val().toLowerCase())">
                                                                <span id="def_social_media_link_4-part-2-ig" class="feedback-custom"></span>
                                                                <div id="social-info" class="alert alert-info d-none pb-0 pl-1">
                                                                    <label for="">
                                                                        Please insert your business website or one of your social media handles.</label>
                                                                </div>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group row mb-0">
                                                <div class="col-md-12 text-center p-3">
                                                    <button type="button" class="btn btn-stage-one-active-prev text-center p-2 m-2"
                                                            onclick="backstagecontentpart1form(this)">
                                                        {{ __('Previous Step') }}
                                                    </button>
                                                    <button type="button" class="btn btn-stage-one-active text-center p-2 m-2"
                                                            onclick="stagecontentpart2form()">
                                                        {{ __('Next Step') }}
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <div id='indicator4' class='d-none'>
                                            <label class="important-field-text p-3">Fields with asterisk (<span class="text-danger">*</span>) are required</label>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="row">
                                                        <div class="col-md-12 form-group">
                                                            <label class="form-text">Please describe your business including a description of products and or services offered  <span class="text-danger">*</span>
                                                                <textarea class="form-control" placeholder="" name="business_description" id="business-description-part-3" required></textarea>
                                                                <span id="business-description-part-3-fb" class="feedback-custom"></span>
                                                            </label>
                                                        </div>
                                                        <div class="col-md-12 form-group">
                                                            <label class="form-text">How long has your business been in operations? <span class="text-danger">*</span>
                                                                <select name="business_operation" id="business-operation-part-3" required class="form-control" />
                                                                    <option value="" selected>-- Select --</option>
                                                                    <option value="<1,0">Less than 1 year</option>
                                                                    <option value="1 - 3 years,5">1-3 years</option>
                                                                    <option value="4 - 7 years,5">4-7 years</option>
                                                                    <option value="7 - 10 years,5">7-10 years</option>
                                                                    <option value="10+ years,5">10+</option>
                                                                </select>
                                                                <span id="business-operation-part-3-fb" class="feedback-custom"></span>
                                                            </label>
                                                        </div>
                                                        <div class="col-md-12 form-group">
                                                            <label class="form-text">Total number of employees (inclusive of the founder): <span class="text-danger">*</span>
                                                                <input class="form-control" type="number" min="0" inputmode="numeric" pattern="[0-9]*" placeholder="Total number of full-time employees" name="number_employees" id="number-employees-part-3" required />
                                                                <span id="number-employees-part-3-fb" class="feedback-custom"></span>
                                                            </label>
                                                        </div>
                                                        <!--<div class="col-md-12 form-group">
                                                            <label class="form-text">Total number of full-time employees: <span class="text-danger">*</span>
                                                                <input class="form-control" type="number" min="0" inputmode="numeric" pattern="[0-9]*" placeholder="Total number of full-time employees" name="number_ft_employees" id="number-ft-employees-part-3" required />
                                                                <span id="number-ft-employees-part-3-fb" class="feedback-custom"></span>
                                                            </label>
                                                        </div>
                                                        <div class="col-md-12 form-group">
                                                            <label class="form-text">Total number of part-time employees: <span class="text-danger">*</span>
                                                                <input class="form-control" type="number" min="0" inputmode="numeric" pattern="[0-9]*" placeholder="Total number of part-time employees" name="number_pt_employees" id="number-pt-employees-part-3" required />
                                                                <span id="number-pt-employees-part-3-fb" class="feedback-custom"></span>
                                                            </label>
                                                        </div>-->
                                                        <div class="col-md-12 form-group">
                                                            <label class="form-text">Total number of women employees: <span class="text-danger">*</span>
                                                                <input class="form-control" type="number" min="0" inputmode="numeric" pattern="[0-9]*" placeholder="Total number of women employees" name="number_women_employees" id="number-women-employees-part-3" required />
                                                                <span id="number-women-employees-part-3-fb" class="feedback-custom"></span>
                                                            </label>
                                                        </div>
                                                        <div class="col-md-12 form-group">
                                                            <label class="form-text">Are you interested in exporting your agrifood produce? <span class="text-danger">*</span>
                                                                <select name="export_interest" id="export-interest-part-3" required class="form-control" />
                                                                    <option value="" selected>-- Select --</option>
                                                                    <option value="Yes&5">Yes</option>
                                                                    <option value="No&0">No</option>
                                                                    <option value="Already exporting&5">I am already exporting</option>
                                                                </select>
                                                                <span id="export-interest-part-3-fb" class="feedback-custom"></span>
                                                            </label>
                                                        </div>
                                                        <!--<div class="col-md-12 form-group">
                                                            <label class="form-text">Where do you project your business to be in the next one year in terms of revenue level and profit margin and how do you plan to achieve it? <span class="text-danger">*</span>
                                                                <textarea class="form-control" name="buisness_revenue_projection" placeholder="" id="buisness-revenue-projection-part-3" required></textarea>
                                                                <span id="buisness-revenue-projection-part-3-fb" class="feedback-custom"></span>
                                                            </label>
                                                        </div>-->
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="row">
                                                        <!--<div class="col-md-12 form-group">
                                                            <label class="form-text">Aproximately how many new jobs is your business able to create in the next one year? <span class="text-danger">*</span>
                                                                <input class="form-control" type="number" min="0" inputmode="numeric" pattern="[0-9]*" placeholder="" name="new_jobs_projection" id="new-jobs-projection-part-3" required />
                                                                <span id="new-jobs-projection-part-3-fb" class="feedback-custom"></span>
                                                            </label>
                                                        </div>
                                                        <div class="col-md-12 form-group">
                                                            <label class="form-text">Please explain how you will create these jobs. <span class="text-danger">*</span>
                                                                <textarea class="form-control" name="job_creation_summary" placeholder="" id="job-creation-summary-part-3" required></textarea>
                                                                <span id="job-creation-summary-part-3-fb" class="feedback-custom"></span>
                                                            </label>
                                                        </div>
                                                        <div class="col-md-12 form-group">
                                                            <label class="form-text">What is your ownership stake in the business?  <span class="text-danger">*</span>
                                                                <select name="business_ownership_stake" id="business-ownership-stake-part-3" required class="form-control" />
                                                                    <option value="" selected>-- Select --</option>
                                                                    <option value="Less than 50%,10">Less than 50%</option>
                                                                    <option value="50% or more,20">50% or more</option>
                                                                    <option value="100%,30">100%</option>
                                                                </select>
                                                                <span id="business-ownership-stake-part-3-fb" class="feedback-custom"></span>
                                                            </label>
                                                        </div>
                                                        <div class="col-md-12 form-group">
                                                            <label class="form-text">The revenues/sales in Naira recorded by the business in 2021? <span class="text-danger">*</span>
                                                                <select name="business_revenue" id="business-revenue-part-3" required class="form-control" />
                                                                    <option value="" selected>-- Select --</option>
                                                                    <option value="0 – 100,000&1">0 – 100,000</option>
                                                                    <option value="100,000 – 500,000&2">100,000 – 500,000</option>
                                                                    <option value="500,000 - 2,000,000&3">500,000 - 2,000,000</option>
                                                                    <option value="2,000,000 - 5,000,000&4">2,000,000 - 5,000,000</option>
                                                                    <option value="5,000,000 - above&5">5,000,000 - above</option>
                                                                </select>
                                                                <span id="business-revenue-part-3-fb" class="feedback-custom"></span>
                                                            </label>
                                                        </div>-->
                                                        <!--<div class="col-md-6 form-group">
                                                            <label class="form-text">The profit in Naira recorded by the business in 2021?<span class="text-danger">*</span>
                                                                <select name="business_profit" id="business-profit-part-3" required class="form-control" />
                                                                    <option value="" selected>-- Select --</option>
                                                                    <option value="0 – 50,000&1">0 – 50,000</option>
                                                                    <option value="50,000 – 100,000&3">50,000 – 100,000</option>
                                                                    <option value="100,000 – 500,000&4">100,000 – 500,000</option>
                                                                    <option value="500,000 - above&5">500,000 - above</option>
                                                                </select>
                                                                <span id="business-profit-part-2-fb" class="feedback-custom"></span>
                                                            </label>
                                                        </div>-->
                                                        <div class="col-md-12 form-group">
                                                            <label class="form-text">This program aims to support underrepresented youths such as youths with disabilities. Do you have any physical health conditions? <span class="text-danger">*</span>
                                                                <select name="disabilities" id="disabilities-part-3" required class="form-control" onchange="disabilityChange()"/>
                                                                    <option value="" selected>-- Select --</option>
                                                                    <option value="1">Yes</option>
                                                                    <option value="0">No</option>
                                                                </select>
                                                                <span id="company-legal-part-2-fb" class="feedback-custom"></span>
                                                            </label>
                                                        </div>
                                                        <div id="disabilityPane" class="col-md-12 form-group d-none">
                                                            <label class="form-text">Please Specify: <span class="text-danger">*</span>
                                                                <input class="form-control" type="text" placeholder="" name="disability_type" id="disability-type-part-3" required />
                                                                <span id="disability-type-part-3-fb" class="feedback-custom"></span>
                                                            </label>
                                                        </div>
                                                        <div class="col-md-12 form-group">
                                                            <label class="form-text">Does your business or cooperative have an export license or is in the process of obtaining one?<span class="text-danger">*</span>
                                                                <select name="export_license" id="export-license-part-3" class="form-control" />
                                                                    <option value="" selected>-- Select --</option>
                                                                    <option value="I have an export licence&5">I have an export licence</option>
                                                                    <option value="I am currently in the process of obtaining an export licence&0">I am currently in the process of obtaining an export licence</option>
                                                                    <option value="I do not have an export licence and I am not in the process of obtaining one at this time&0">I do not have an export licence and I am not in the process of obtaining one at this time</option>
                                                                </select>
                                                                <span id="export-license-part-3-fb" class="feedback-custom"></span>
                                                            </label>
                                                        </div>
                                                        <div class="col-md-12 form-group">
                                                            <label class="form-text">How did you hear about this program?<span class="text-danger">*</span>
                                                                <select name="referred_by" id="referral-type-part-3" required class="form-control" onchange="referralevent()" />
                                                                    <option value="" selected>-- Select --</option>
                                                                    <option value="African Food Changemakers">African Food Changemakers</option>
                                                                    <option value="NEPC/EEFP">NEPC/EEFP</option>
                                                                    <option value="Riby">Riby</option>
                                                                    <option value="Social media">Social media</option>
                                                                    <option value="Word of mouth">Word of mouth</option>
                                                                    <option value="From another organisation">From another organisation</option>
                                                                </select>
                                                                <span id="referral-type-part-3-fb" class="feedback-custom"></span>
                                                            </label>
                                                        </div>
                                                        <div id="referred_by_suffix_part" class="col-md-12 form-group d-none">
                                                            <label class="form-text">Please Specify<span class="text-danger">*</span>
                                                            <input type="text" class="form-control" name="referred_by_suffix" id="referred_by_suffix-part-3" placeholder="Please Specify" value="">
                                                            <span id="referred_by_suffix-part-3-fb" class="feedback-custom"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group row mb-0">
                                                <div class="col-md-12 text-center p-3">
                                                    <button type="button" class="btn btn-stage-one-active-prev text-center p-2 m-2"
                                                            onclick="backstagecontentpart2form(this)">
                                                        {{ __('Previous Step') }}
                                                    </button>
                                                    <button type="button" class="btn btn-stage-one-active text-center p-2 m-2"
                                                            onclick="stagecontentpart3form()">
                                                        {{ __('Submit') }}
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
{{--                --}}{{--@else--}}
{{--                <div class="w-100 h-100" style="display: flex; justify-content: center; align-items: center;">--}}
{{--                    <div class="container mt-5">--}}
{{--                        <div class="row">--}}
{{--                            <div id="stage-area-part-1" class="card stage-area">--}}
{{--                                <div class="card-header bg-white stage-one-title">--}}
{{--                                    <label id="info-text">Registration Complete</label>--}}
{{--                                </div>--}}
{{--                                <div class="card-body">--}}
{{--                                    <div id="stage-area-checkbox-intro" class="pl-5 pr-5 pb-5 pt-3">--}}
{{--                                        <article style="text-align: justify; text-justify: inter-word;">--}}
{{--                                            <span class="text-dark">Thank you for applying to the Youth in Agrifood Export Development Program. </span><br><br>--}}

{{--                                            <p class="font-weight-500 text-dark">We have received your application and it is now under review.</p>--}}
{{--                                            <p class="font-weight-500 text-dark">All applicants will be informed of their status via email. If you have questions about the application or program, please visit the FAQ section on the YAEDP application page.</p>--}}
{{--                                            <p class="font-weight-500 text-dark">For any additional questions, please contact <a href="mailto:yaedp@nourishingafrica.com">YAEDP@nourishingafrica.com</a>. We will respond to your inquiry as soon as we can! Due to the high volume of applications, please expect a delay in response.</p>--}}
{{--                                        </article>--}}
{{--                                        <div class="form-group row mb-0">--}}
{{--                                            <div class="col-md-12 text-center p-3">--}}
{{--                                                <a href="{{ route('entrepreneur.sign-up-form') }}" class="btn btn-stage-one-active-prev text-center p-2 m-2" style="white-space: normal !important;">--}}
{{--                                                    {{ __('Are You an Agripreneur? Sign up to join the African Food Changemakers Community') }}--}}
{{--                                                </a>--}}
{{--                                            </div>--}}
{{--                                            <div class="col-md-12 text-center p-3">--}}
{{--                                                <a href="https://nourishingafrica.com" class="btn btn-stage-one-active-prev text-center p-2 m-2" style="white-space: normal !important;">--}}
{{--                                                   {{ __('Go to African Food Changemakers Home Page') }}--}}
{{--                                                </a>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                @endif--}}
            </div>

        </div>

    </section>

@stop

@section('bottom-assets')
    <!--Bottom Assets-->
    <script type="text/javascript" src="{{ asset('custom/js/yaedp/form.js') }}"></script>
    <script src="{{ asset('/users/plugins/bootstrap-select-1.13.14/js/bootstrap-select.min.js') }}"></script>
    <script type="text/javascript">
        function proceedApplication(){
            document.getElementById("intro").classList.add("d-none");
            document.getElementById("formdiv").classList.remove("d-none");
            //document.getElementById('myAnchor').scrollIntoView(true).slow(2000);
            $('html, body').animate({
                scrollTop: $("#myAnchor").offset().top
            }, 500);
            return false;
        }
    </script>
@stop
