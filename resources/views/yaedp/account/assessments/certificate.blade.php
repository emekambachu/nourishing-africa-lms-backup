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
                <div class="col-12 text-center">
                    <h5>
                        <strong class="text-success">Congratulations</strong> on completing your modules!
                        Please download your certificate.<br>
                    </h5>
                    <p class="tx-17">
                        Once downloaded, you will be unable to redo any assessments<br>
                        <strong>Date Completed:</strong>
                        {{ Carbon\Carbon::parse($completedAssessment->created_at)->format('M d, Y') }}
                    </p>
                    <div class="certificate-bg">
                        <p class="certificate-name">{{ Auth::user()->first_name.' '.Auth::user()->surname }}</p>
                        <p class="certificate-date">{{ Carbon\Carbon::now()->format('Y-m-d') }}</p>
                    </div>
                    <a href="{{ route('yaedp.account.assessment.certificate.download') }}"
                       class="btn btn-rounded btn-success">
                        Download Certificate
                    </a>
                </div>
            </div>
        @else
            <div class="row justify-content-center">
                <div class="col-12 text-center">
                    <h4>You are yet to complete your modules.<br>
                        Please complete all outstanding courses and assessments to view your certificate.</h4>
                </div>
            </div>
        @endif

    </div>
@endsection

@section('bottom-assets')
    <script src="{{ asset('learning-assets/custom/learning-submit-assessment.js') }}"></script>
@endsection
