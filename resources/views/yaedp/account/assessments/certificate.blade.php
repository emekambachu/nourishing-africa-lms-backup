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

        <div class="row">
        @if($assessmentPassed)
            <div class="certificate-bg">
                <h4 class="certificate-name">{{ Auth::user()->first_name.' '.Auth::user()->surname }}</h4>
                <h4 class="certificate-date">{{ $certificateDate }}</h4>
            </div>
            <div class="col-12 d-flex justify-content-center">
                <a href="{{ route('yaedp.account.assessment.certificate.download') }}">
                    <button style="width:150px;" class="module-btn bg-light-brown d-flex justify-content-center">
                        Download</button>
                </a>
            </div>
        @endif
        </div>

    </div>
@endsection

@section('bottom-assets')
    <script src="{{ asset('learning-assets/custom/learning-submit-assessment.js') }}"></script>
@endsection
