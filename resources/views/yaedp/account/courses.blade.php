@extends('yaedp.account.includes.layout')

@section('title')
    {{ $module->title }}
@endsection

@section('top-assets')
@endsection

@section('content')
    <div class="container">

        <p class="bread-crumbs">
            <a href="{{ route('yaedp.account') }}">Dashboard</a> / <a href="{{ route('yaedp.account.modules') }}">Modules</a> / <span class="light-green">{{ $module->title }}</span>
        </p>

        <h1 class="font-large-inter font-weight-bold mb-0">
            {{ $module->title }}
        </h1>

        <div class="row">
            <div class="col-12">
                <p class="light-green tx-16 text-right">
                    {{ \Carbon\Carbon::parse($module->start)->format('M d, Y').' - '.\Carbon\Carbon::parse($module->end)->format('M d, Y')}}
                </p>
            </div>

            @foreach($courses as $course)
            <div class="col-lg-4 col-md-6 col-sm-12 mb-2">
                <div class="bg-white-radius-shadow border-light-green" style="height: 580px;">

                    <div>
                        @if(Auth::user()->startedCourse($course->id, $module->id))
                            @if(Auth::user()->startedCourse($course->id, $module->id)->status === 1)
                                <span class="bg-badge-success badge badge-pill mb-2">
                            Completed
                            </span>
                            @else
                                <span class="bg-badge-warning badge badge-pill mb-2">
                            In progress
                            </span>
                            @endif
                        @else
                            <span class="bg-badge-danger badge badge-pill text-light-brown mb-2">
                                Not Started
                            </span>
                            <span class="float-right">
                                <i class="fa fa-lock"></i>
                            </span>
                        @endif

                    </div>

                    <div class="pt-2">
                        <img class="module-grid-image"
                             src="https://nourishingafrica.com/photos/learning/courses/{{ $course->image }}"/>
                    </div>

                    <p class="na-text-dark-green mt-2 font-weight-bold">
                        {{ $course->title }}</p>

                    <div>
                        <span>
                            <i class="fa fa-user-alt text-light-brown"></i> {{ $course->trainer }}
                        </span>
                        <span class="float-right">
                            <i class="fa fa-clock class text-light-brown"></i> {{ $course->study_timer }}:00 Mins
                        </span>
                    </div>
                    <!--If this item is not the first module, check if the previous module has been completed-->
                    <!--If the previous module has been completed, make the next module available-->
                    @if(!$loop->first)
                        @if(Auth::user()->startedCourse($course->previousCourse($module->id)->id, $module->id))
                            @if(Auth::user()->startedCourse($course->previousCourse($module->id)->id, $module->id)->status === 1)
                                <a href="{{ route('yaedp.account.course', $course->id) }}">
                                    <button class="module-btn na-bg-dark-green text-white d-flex justify-content-center">
                                        Start</button>
                                </a>
                            @else
                                <button disabled class="module-btn bg-gray d-flex justify-content-center">
                                    Start </button>
                            @endif
                        @else
                            <button disabled class="module-btn bg-gray d-flex justify-content-center">
                                Start </button>
                        @endif
                    @else
                        <a href="{{ route('yaedp.account.course', $course->id) }}">
                            <button class="module-btn na-bg-dark-green text-white d-flex justify-content-center">
                                Start</button>
                        </a>
                    @endif
                </div>
            </div>
            @endforeach
        </div>

    </div>

@endsection

@section('bottom-assets')
@endsection
