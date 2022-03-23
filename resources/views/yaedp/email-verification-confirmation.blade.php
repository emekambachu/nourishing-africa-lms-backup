@extends('includes.layout')

@section('title')
    YAEDP | Email Confirmation
@endsection

@section('meta-tags')
    <meta name="description" content="Nourishing Africa | YAEDP - Email Confirmation"/>
    <meta name="robots" content="max-snippet:-1, max-image-preview:large, max-video-preview:-1"/>
    <link rel="canonical" href="{{ Request::fullUrl() }}" />
    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="Nourishing Africa | YAEDP - Email Confirmation" />
    <meta property="og:description" content="Nourishing Africa | YAEDP - Email Confirmation" />
    <meta property="og:url" content="{{ Request::fullUrl() }}" />
    <meta property="og:site_name" content="Nourishing Africa" />
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:description" content="Nourishing Africa | YAEDP - Email Confirmation" />
    <meta name="twitter:title" content="Nourishing Africa | YAEDP - Email Confirmation" />
    <meta name="twitter:site" content="@nourish_africa" />
    <meta name="twitter:creator" content="@nourish_africa" />
    <script type='application/ld+json' class='yoast-schema-graph yoast-schema-graph--main'>

    {"@context":"https://schema.org","@graph":[{"@type":"Organization","@id":"https://nourishingafrica.com/#organization","name":"Nourishing Africa","url":"https://nourishingafrica.com/","sameAs":["https://www.facebook.com/nourishafrica1","https://instagram.com/nourish_africa","https://www.linkedin.com/company/28506256","https://twitter.com/nourish_africa"],"logo":{"@type":"ImageObject","@id":"https://nourishingafrica.com/#logo","url":"https://nourishingafrica.com/wp-content/uploads/2019/04/NA-1-Official.png","width":848,"height":519,"caption":"Nourishing Africa"},"image":{"@id":"https://nourishingafrica.com/#logo"}},{"@type":"WebSite","@id":"https://nourishingafrica.com/#website","url":"https://nourishingafrica.com/","name":"Nourishing Africa","description":"A home for 1 million agri-food entrepreneurs transforming Africa&#039;s agricultural","publisher":{"@id":"https://nourishingafrica.com/#organization"},"potentialAction":{"@type":"SearchAction","target":"https://nourishingafrica.com/?s={search_term_string}","query-input":"required name=search_term_string"}},{"@type":"WebPage","@id":"https://nourishingafrica.com/#webpage","url":"https://nourishingafrica.com/","inLanguage":"en-US","name":"Welcome to Nourishing Africa Hub - Nourishing Africa","isPartOf":{"@id":"https://nourishingafrica.com/#website"},"about":{"@id":"https://nourishingafrica.com/#organization"},"datePublished":"2019-12-03T12:51:31+00:00","dateModified":"2020-02-07T15:22:22+00:00","description":"Welcome to Nourishing Africa Hub, A Home for Agri-Food Entrepreneurs Transforming Africa\u2019s Agricultural Landscape."}]}
</script>
@endsection

@section('top-assets')
    <link rel="stylesheet" href="{{ asset('learning-assets/style.css') }}" />
@endsection

@section('content')
    <section class="p-0 wow fadeIn bg-light"
             style="visibility: visible; animation-name: fadeIn; background-image: url(&quot;{{ asset('images/login-intro.jpg') }}&quot;); background-size: cover;">
        <div class="container-fluid">
            <div class="row">

                <div class="col-12 col-lg-4 wow fadeInRight" style=""></div>

                <div class="col-12 col-lg-4 wow fadeInLeft margin-20px-tb padding-four-all md-padding-eight-all md-padding-15px-lr sm-padding-50px-tb border-radius-4"
                     style="visibility: visible; animation-name: fadeInLeft; background-color: #fff;">
                    <div class="row m-0">
                        <div class="col-12 margin-six-bottom lg-margin-six-bottom md-margin-30px-bottom sm-no-margin-bottom">
                            <h4 class="na-text-dark-green learning-intro-header text-center mx-auto mx-lg-0 sm-width-100 mb-0">Email Verification</h4>
                            @include('includes.alerts')
                        </div>
                        <!-- start feature box item -->
                        <div class="col-12">
                            <p class="text-center login-shortcut margin-10px-bottom">
                                <a href="{{ route('yaedp.login') }}">
                                    <button class="login-form-btn">Login</button>
                                </a>
                            </p>
                        </div>
                        <!-- end feature box item -->
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection

@section('bottom-assets')
    <script src="{{ asset('learning-assets/custom/js/login-form.js') }}"></script>
@endsection
