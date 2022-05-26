@extends('yaedp.account.includes.layout')

@section('title')
    {{ $module->title }}
@endsection

@section('top-assets')
@endsection

@section('content')
    <div class="container mb-4">

        <p class="bread-crumbs">
            <a href="{{ route('yaedp.account') }}">Dashboard</a> / <a href="{{ route('yaedp.account.modules') }}">Modules</a> / <a href="{{ route('yaedp.account.courses', $module->id) }}">Courses</a> / <span class="light-green">{{ $module->title }}</span>
        </p>

        <div class="mb-3">
            <h2 class="font-large-inter text-light-brown font-weight-bold">
                {{ $module->title }}</h2>
        </div>

        <div class="row">
            <div class="col-lg-9 col-md-9 col-sm-12">
                <div class="bg-white-radius-shadow border-light-green">

                    <div class="row d-flex justify-content-center">
                        <div class="col-8 text-center">
                            <img src="{{ asset('images/icons/e-learning.png') }}" width="150" class="mb-4"/>
{{--                            <p class="text-center tx-16">--}}
{{--                                <strong class="na-text-dark-green">Well-done</strong> You have completed this module. You can now take the Assessment to proceed to the next module.--}}
{{--                            </p>--}}
                            <p class="text-center tx-16">
                                <strong class="na-text-dark-green">Well-done</strong><br>
                                You are to complete this assessment before proceeding to the next module.<br><br>

                                Note that your performance in each assessment counts towards your overall performance; you need an overall grade of 80% or higher to be able to download your certificate on completion of this program.<br><br>

                                Each participant can retake the assessment two times after their initial try. We recommend that you retake the assessment only if you are confident in your ability to score a higher mark.<br>
                                <strong>Note that your most recent score will be regarded as your final score for the module and will count towards your overall grade for the training</strong>.<br><br>

                                Click on ‘Begin Assessment’ to proceed.
                            </p>
                            <!--If none of the 2 conditions are true, show disabled button-->
                            <a href="{{ route('yaedp.account.assessment.questions', $module->id) }}">
                                <button class="module-btn bg-light-brown d-flex justify-content-center mt-2">
                                    Begin</button>
                            </a>
                        </div>
                    </div>
                </div>

            </div>

            <div class="col-lg-3 col-md-3 col-sm-12">
                <div class="bg-white-radius-shadow border-light-green p-0">
                    <h6 class="text-light-brown pb-2 border-bottom-grey pl-2 pt-2">
                        Modules
                    </h6>

                    @foreach($modules as $m)
                        @if(Auth::user()->startedModule($m->id))
                            @if(Auth::user()->startedModule($m->id)->status === 1)
                                <div class="p-2 @if($m->id === $module->id) bg-lemon-green @endif ">
                                    <span class="text-inter na-text-dark-green tx-12">
                                        {{ $m->title }}
                                    </span>
                                    <i class="fa fa-check na-text-light-green float-right ml-2"></i>
                                </div>
                            @else
                                <div class="p-2 @if($m->id === $module->id) bg-lemon-green @endif ">
                                    <span class="text-inter na-text-dark-green tx-12">
                                        {{ $m->title }}
                                    </span>
                                    <i class="fa fa-play na-text-light-green float-right ml-2"></i>
                                </div>
                            @endif
                        @else
                            <div class="p-2">
                                <span class="text-inter na-text-dark-green tx-12">
                                    {{ $m->title }}
                                </span>
                                <i class="fa fa-lock na-text-light-green float-right ml-2"></i>
                            </div>
                        @endif
                    @endforeach

                    <div class="p-2 bg-very-light-brown">
                        <span class="text-inter na-text-dark-green tx-12">
                            Assessment
                            <i class="fa fa-list float-right ml-2"></i>
                        </span>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('bottom-assets')

@endsection
