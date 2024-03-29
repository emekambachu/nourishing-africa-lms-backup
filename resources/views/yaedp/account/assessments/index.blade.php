@extends('yaedp.account.includes.layout')

@section('title')
    Assessments
@endsection

@section('top-assets')

@endsection

@section('content')
    <div class="container mb-4">

        <p class="bread-crumbs">
            <a href="{{ route('yaedp.account') }}">Dashboard</a> / <span class="light-green">Assessments</span>
        </p>

        <div class="mb-3">
            <h2 class="font-large-inter text-light-brown font-weight-bold">
                Assessments | My Grades</h2>
        </div>

        <div class="row">
            @if($completedAssessment)
                <div class="col-12 justify-content-center">
                    <p class="text-center na-text-dark-green text-manrope tx-30 mb-0">Overall Score</p>
                    <h6 class="text-center na-text-dark-green text-manrope tx-70">
                        {{ $completedAssessment->percent }}%</h6>
                </div>
                <div class="col-12 d-flex justify-content-center">
                    <img src="{{ asset('images/icons/medal2.png') }}" width="100"/>
                </div>
                <div class="col-12 justify-content-center">
                    <a href="{{ route('yaedp.account.assessment.certificate') }}">
                        <button style="width:150px;" class="module-btn bg-light-brown d-flex justify-content-center">
                            Get Certificate</button>
                    </a>
                    <p class="tx-17 text-center">
                        <strong>Date Completed:</strong>
                        {{ Carbon\Carbon::parse($completedAssessment->created_at)->format('M d, Y') }}
                    </p>
                </div>
            @endif

            <div class="col-lg-12 col-md-12 col-sm-12">
                <p class="na-text-dark-green text-inter mb-1 tx-20">Score Breakdown</p>
                @forelse($moduleAssessments as $module)
                <div class="bg-white-radius-shadow border-light-green mb-2">
                    <div class="row">
                        <div class="col-md-11 col-sm-11">
                            <h5 class="text-inter text-dark">{{ $module->learningModule->title }}</h5>
                        </div>
                        <div class="col-md-1 col-sm-1">
                            <h5 class="text-inter na-text-light-green float-right mr-2">
                                {{ $module->percent === 0 ? 'None' : $module->percent }}%</h5>

                            @if(!$hasCertificate && $module->retake < 3)
                            <a href="{{ route('yaedp.account.assessment.questions', $module->learning_module_id) }}">
                                <button class="module-btn bg-danger text-white d-flex justify-content-center">
                                    Retake ({{ 3 - $module->retake }})</button>
                            </a>
                            @endif
                        </div>
                    </div>
                </div>
                @empty
                    <div class="bg-white-radius-shadow border-light-green">
                        <div class="row">
                            <div class="col-md-10 col-sm-10">
                                <h6 class="text-inter text-gray">No assessment taken</h6>
                            </div>
                        </div>
                    </div>
                @endforelse
            </div>

        </div>
    </div>
@endsection

@section('bottom-assets')
    <script src="{{ asset('learning-assets/custom/learning-submit-assessment.js') }}"></script>
@endsection
