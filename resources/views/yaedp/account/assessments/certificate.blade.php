@extends('yaedp.account.includes.layout')

@section('title')
    Assessments
@endsection

@section('top-assets')

@endsection

@section('content')
    <div class="container mb-4">

        <p class="bread-crumbs">
            <a href="{{ route('yaedp.account') }}">Dashboard</a> / <span class="light-green">Certificate</span>
        </p>

        <div class="mb-3">
            <h2 class="font-large-inter text-light-brown font-weight-bold">Certificate</h2>
        </div>

        @if($completedAssessment && $completedAssessment->percent > 80)
{{--            <div class="row" style="margin-bottom: 100px;">--}}
{{--                <div class="certificate-bg-sample">--}}
{{--                    <img src="{{ asset('images/icons/certificate_yaedp_500_sample.png') }}"/>--}}
{{--                </div>--}}
{{--            </div>--}}

            <div class="row justify-content-center">
                <div class="col-12 text-center">
                    <h4><strong>Congratulations</strong> Congratulations on completing your modules!
                        We will inform you via email when your certificate is ready for download.</h4>
                </div>
            </div>

{{--            <div class="certificate-bg justify-content-center">--}}
{{--                <h4 class="certificate-name">{{ Auth::user()->first_name.' '.Auth::user()->surname }}</h4>--}}
{{--                <p class="certificate-date">{{ $certificateDate }}</p>--}}
{{--            </div>--}}
{{--            <div class="col-12 justify-content-center">--}}
{{--                <a href="{{ route('yaedp.account.assessment.certificate.download') }}">--}}
{{--                    <button style="width:150px;" class="module-btn bg-light-brown d-flex justify-content-center">--}}
{{--                        Download</button>--}}
{{--                </a>--}}
{{--            </div>--}}
        @else
            <div class="row">
                <p class="mb-5">You are yet to complete your modules.<br>
                    Please complete all outstanding courses and assessments to view your certificate.</p>
                <div class="certificate-bg-sample">
                    <img src="{{ asset('images/icons/certificate_yaedp_500_sample.png') }}"/>
                </div>
            </div>
        @endif

    </div>
@endsection

@section('bottom-assets')
    <script src="{{ asset('learning-assets/custom/learning-submit-assessment.js') }}"></script>
@endsection
