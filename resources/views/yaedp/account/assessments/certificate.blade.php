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
            <div class="row pt-5 pb-5">
                <div class="certificate-bg-sample">
                    <img src="{{ asset('images/icons/certificate_yaedp_500_sample.png') }}"/>
                </div>
            </div>

            <div class="row">
                <div class="col-12 justify-content-center">
                    <h4><strong>Congratulations</strong> on successfully passing your overall assessment.<br>
                        Your certificate will be available on the <strong>16th of july, 2022</strong>.</h4>
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
