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
        <h1 class="font-large-inter text-light-brown font-weight-bold mb-0">
            {{ $module->title }}
        </h1>

        <div class="row">

            <div class="col-12">
                <p class="tx-16 text-gray mb-0">
                    {!! $module->description !!}</p>
                <p class="light-green tx-16 text-right">
                    {{ \Carbon\Carbon::parse($module->start)->format('M d, Y').' - '.\Carbon\Carbon::parse($module->start)->format('M d, Y')}}
                </p>
            </div>

            @foreach($courses as $course)
            <div class="col-lg-4 col-md-6 col-sm-12 mb-2">
                <div class="bg-white-radius-shadow border-light-green">

                    @if(Auth::user()->startedCourse($course->id, $module->id))
                        @if(Auth::user()->startedCourse($course->id, $module->id)->completed_course)
                            <span class="bg-badge-success badge badge-pill text-light-brown mb-2">
                            Completed
                            </span>
                        @else
                            <span class="bg-badge-warning badge badge-pill text-light-brown mb-2">
                            Ongoing
                            </span>
                        @endif
                    @else
                        <span class="bg-badge-danger badge badge-pill text-light-brown mb-2">
                        Not Started
                        </span>
                    @endif

                    <div class="module-grid-container pt-2">
                        {{--<span class="module-title">{{ $course->title }}</span>--}}
                    </div>

                        {{--                    <div class="module-grid-contents">--}}
                        {{--                        <p class="text-grey tx-14 mt-3">--}}
                        {{--                            {!! $course->description !!}--}}
                        {{--                        </p>--}}
                        {{--                    </div>--}}

                    <p class="na-text-dark-green mt-2 font-weight-bold">
                        {{ $course->title }}
                    </p>

                    <div>
                        <p class="text-grey tx-12 mt-3">
                            30:22
                        </p>
                    </div>

                    <!--If this item is not the first module, check if the previous module has been completed-->
                    <!--If the previous module has been completed, make the next module available-->
                    @if(!$loop->first)
                        @if(Auth::user()->startedCourse($course->previousCourse()->id, $module->id))
                            @if(Auth::user()->startedCourse($course->previousCourse()->id, $module->id)->completed_course)
                                <a href="{{ route('yaedp.account.course', $course->id) }}">
                                    <button class="module-btn bg-light-brown d-flex justify-content-center">
                                        Start</button>
                                </a>
                            @else
                                <button disabled class="module-btn bg-gray d-flex justify-content-center">
                                    Complete previous course to continue </button>
                            @endif
                        @else
                            <button disabled class="module-btn bg-gray d-flex justify-content-center">
                                Start previous course to continue </button>
                        @endif
                    @else
                        <a href="{{ route('yaedp.account.course', $course->id) }}">
                            <button class="module-btn bg-light-brown d-flex justify-content-center">
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
