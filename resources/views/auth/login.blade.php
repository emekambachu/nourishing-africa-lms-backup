@extends('includes.layout')

@section('meta-tags')
    <meta name="description" content="Nourishing Africa | Learning - Login"/>
    <meta name="robots" content="max-snippet:-1, max-image-preview:large, max-video-preview:-1"/>
    <link rel="canonical" href="{{ Request::fullUrl() }}" />
    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="Nourishing Africa | Learning - Login" />
    <meta property="og:description" content="Nourishing Africa | Learning - Login" />
    <meta property="og:url" content="{{ Request::fullUrl() }}" />
    <meta property="og:site_name" content="Nourishing Africa" />
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:description" content="Nourishing Africa | Learning - Login" />
    <meta name="twitter:title" content="Nourishing Africa | Learning - Login" />
    <meta name="twitter:site" content="@nourish_africa" />
    <meta name="twitter:creator" content="@nourish_africa" />
    <script type='application/ld+json' class='yoast-schema-graph yoast-schema-graph--main'>

    {"@context":"https://schema.org","@graph":[{"@type":"Organization","@id":"https://nourishingafrica.com/#organization","name":"Nourishing Africa","url":"https://nourishingafrica.com/","sameAs":["https://www.facebook.com/nourishafrica1","https://instagram.com/nourish_africa","https://www.linkedin.com/company/28506256","https://twitter.com/nourish_africa"],"logo":{"@type":"ImageObject","@id":"https://nourishingafrica.com/#logo","url":"https://nourishingafrica.com/wp-content/uploads/2019/04/NA-1-Official.png","width":848,"height":519,"caption":"Nourishing Africa"},"image":{"@id":"https://nourishingafrica.com/#logo"}},{"@type":"WebSite","@id":"https://nourishingafrica.com/#website","url":"https://nourishingafrica.com/","name":"Nourishing Africa","description":"A home for 1 million agri-food entrepreneurs transforming Africa&#039;s agricultural","publisher":{"@id":"https://nourishingafrica.com/#organization"},"potentialAction":{"@type":"SearchAction","target":"https://nourishingafrica.com/?s={search_term_string}","query-input":"required name=search_term_string"}},{"@type":"WebPage","@id":"https://nourishingafrica.com/#webpage","url":"https://nourishingafrica.com/","inLanguage":"en-US","name":"Welcome to Nourishing Africa Hub - Nourishing Africa","isPartOf":{"@id":"https://nourishingafrica.com/#website"},"about":{"@id":"https://nourishingafrica.com/#organization"},"datePublished":"2019-12-03T12:51:31+00:00","dateModified":"2020-02-07T15:22:22+00:00","description":"Welcome to Nourishing Africa Hub, A Home for Agri-Food Entrepreneurs Transforming Africa\u2019s Agricultural Landscape."}]}

</script>
@endsection

@section('top-assets')
    <link rel="stylesheet" href="{{ asset('custom/css/learning.css') }}" />
@endsection

@section('content')
    <section class="p-0 wow fadeIn bg-light-gray" style="visibility: visible; animation-name: fadeIn;">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-lg-6 md-height-500px wow fadeInRight intro-image"
                     style="background-image: url(&quot;{{ asset('images/login-intro.jpg') }}&quot;);
                     visibility: visible; animation-name: fadeInRight; background-size: cover;">
                </div>

                <div class="col-12 col-lg-6 wow fadeInLeft padding-four-all md-padding-eight-all md-padding-15px-lr sm-padding-50px-tb" style="visibility: visible; animation-name: fadeInLeft; background-color: rgb(246, 247, 255);">
                    <div class="row m-0">
                        <div class="col-12 col-xl-10 margin-six-bottom lg-margin-six-bottom md-margin-30px-bottom sm-no-margin-bottom">
                            <h4 class="na-text-dark-green na-header-text font-weight-600 text-center md-width-70 mx-auto mx-lg-0 sm-width-100 sm-margin-30px-bottom">Login to your institution</h4>
                        </div>
                        <!-- start feature box item -->
                        <div class="col-12 margin-six-bottom md-margin-30px-bottom last-paragraph-no-margin">

                            <form method="post" action="{{ route('login') }}">
                                @csrf
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="login-form-label">Email</label><br>
                                            <input type="email" name="email"
                                                   class="login-form @error('email') is-invalid @enderror"
                                                   placeholder="email" required="">
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-12 col-xl-12 col-lg-12">
                                        <div class="form-group">
                                            <label class="login-form-label">Password</label><br>
                                            <input type="password" name="password" id="password"
                                                   class="login-form @error('email') is-invalid @enderror"
                                                   placeholder="Enter Password" required="">
                                            <i class="far fa-eye field-icon" id="toggle_password"></i>
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-lg-6 col-xs-6">
                                        <div class="float-left" style="display: block;">
                                            <input style="display: inline; width: 50px;" type="checkbox"
                                                   name="remember" id="remember">
                                            <label class="text-medium">Remember me</label>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-lg-6 col-xs-6">
                                        <div class="float-right" style="display: block;">
                                            <p class="text-center login-shortcut">
                                                <a class="na-text-dark-green"
                                                   href="{{ route('learning.forgot-password') }}">
                                                    Reset Password</a>
                                            </p>
                                        </div>
                                    </div>

                                    <div class="col-12 mt-5">
                                        <button type="submit" class="login-form-btn">Login</button>
                                    </div>

                                    <div class="col-12 mt-5">
                                        <p class="text-center login-shortcut">
                                            No account? <a class="na-text-dark-green"
                                           href="https://nourishingafrica.com/yaedp/application">Sign up</a>
                                        </p>
                                    </div>
                                </div>

                            </form>
                        </div>
                        <!-- end feature box item -->
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection

@section('bottom-assets')
    <script src="{{ asset('custom/js/learning/login-form.js') }}"></script>
@endsection
