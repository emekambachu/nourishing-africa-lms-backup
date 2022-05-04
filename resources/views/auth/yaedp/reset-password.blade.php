@extends('includes.layout')

@section('title')
    YAEDP | Reset Password
@endsection

@section('meta-tags')
    <meta name="description" content="Nourishing Africa | YAEDP - Login"/>
    <meta name="robots" content="max-snippet:-1, max-image-preview:large, max-video-preview:-1"/>
    <link rel="canonical" href="{{ Request::fullUrl() }}" />
    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="Nourishing Africa | YAEDP | Reset Password" />
    <meta property="og:description" content="Nourishing Africa | YAEDP | Reset Password" />
    <meta property="og:url" content="{{ Request::fullUrl() }}" />
    <meta property="og:site_name" content="Nourishing Africa" />
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:description" content="Nourishing Africa | YAEDP | Reset Password" />
    <meta name="twitter:title" content="Nourishing Africa | YAEDP | Reset Password" />
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
            <div class="row d-flex justify-content-center">

                <div class="col-12 col-lg-4 wow fadeInLeft margin-20px-tb padding-four-all md-padding-eight-all md-padding-15px-lr sm-padding-50px-tb border-radius-4" style="visibility: visible; animation-name: fadeInLeft; background-color: #fff;">
                    <div class="row m-0">
                        <div class="col-12 margin-six-bottom lg-margin-six-bottom md-margin-30px-bottom sm-no-margin-bottom text-center">
                            <h4 class="na-text-dark-green learning-intro-header text-center mx-auto mx-lg-0 sm-width-100 mb-0">
                                Welcome to YAEDP</h4>
                            <p class="text-center font-normal-manrope-black">
                                Insert your new password</p>
                            <p style="display: none;"
                               class="fa fa-4x fa-spin fa-spinner brand-text" id="loader"></p>
                            <div id="validation-alert"></div>
                        </div>

{{--                        <p class="text-center fa fa-4x fa-spin fa-spinner brand-text" id="loader"></p>--}}
                        <div id="validation-alert"></div>

                        <!-- start feature box item -->
                        <div class="col-12 aligncenter margin-six-bottom md-margin-30px-bottom last-paragraph-no-margin">
                            <form method="post" id="password-update-form"
                                  action="{{ route('yaedp.password-reset-confirm', $verifiedUser->verification_token) }}">
                                @csrf
                                <div class="row" id="form-fields">
                                    <div class="col-md-12 col-xl-12 col-lg-12">
                                        <div class="form-group">
                                            <label class="login-form-label">Password</label><br>
                                            <input type="password" name="password" id="password"
                                                   class="login-form @error('password') is-invalid @enderror"
                                                   placeholder="Enter Password" required="">
                                            <i class="far fa-eye field-icon" id="toggle_password"></i>
                                            @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label class="login-form-label">Confirm Password</label><br>
                                            <input type="password" name="password_confirm" id="password_confirm"
                                                   class="login-form" placeholder="Confirm password" required="">
                                            <i class="far fa-eye field-icon" id="toggle_password"></i>
                                            @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <button type="submit" id="password-update-btn"
                                                class="login-form-btn"
                                                data-route="{{ route('yaedp.password-reset-confirm', $verifiedUser->verification_token) }}">
                                            Reset password</button>
                                    </div>

                                    <div class="col-12">
                                        <p class="font-small-manrope-black margin-10px-bottom">
                                            By using this you agree to our <a class="login-link" href="">
                                                Terms of Service</a> and <a class="login-link" href="">Privacy Policy</a>
                                        </p>
                                        <p class="text-center login-shortcut margin-10px-bottom">
                                            Have an account? <a class="na-text-dark-green"
                                                                href="{{ route('yaedp.login') }}">Login</a>
                                        </p>
                                        <p class="text-center login-shortcut margin-10px-bottom">
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
    <script src="{{ asset('learning-assets/custom/js/login-form.js') }}"></script>
    <script src="{{ asset('learning-assets/custom/js/password-reset.js') }}"></script>
@endsection
