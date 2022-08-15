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

        @if($completedAssessment)
            <div class="row justify-content-center">
{{--                <div class="col-12 d-flex justify-content-center">--}}
{{--                    <img src="{{ asset('images/icons/certification.png') }}" width="250"/>--}}
{{--                </div>--}}
                <div class="col-12 text-center">
                    <div class="certificate-bg">
                        <p class="certificate-name">{{ Auth::user()->first_name.' '.Auth::user()->surname }}</p>
                        <p class="certificate-date">{{ Carbon\Carbon::now()->format('Y-m-d') }}</p>
                    </div>
{{--                    <h4>--}}
{{--                        <strong class="text-success">Congratulations</strong> on completing your modules!--}}
{{--                        We will inform you via email when your certificate is ready for download.--}}
{{--                    </h4>--}}
                </div>
            </div>
        @else
            <div class="row justify-content-center">
                <div class="col-12 text-center">
                    <h4>You are yet to complete your modules.<br>
                        Please complete all outstanding courses and assessments to view your certificate.</h4>
                </div>
            </div>
            <div class="row">
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
