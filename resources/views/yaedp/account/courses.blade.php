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
                <div class="bg-white-radius-shadow border-light-green" style="height: 380px;">

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

    <!--Welcome Modal-->
    <div class="modal effect-scale hide" id="intro-dialogue{{ $module->id }}"
         data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-dialog-centered" style="max-width: 700px;" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h5 class="text-inter font-weight-bold text-center">
                        Welcome to Module {{ $module->number }}</h5>
                </div>
                <div id="intro-iframe{{ $module->id }}" class="modal-body">
                    <video width="100%" controls>
                        <source src="{{ $module->introduction_video }}"
                                type="video/mp4">
                        Your browser does not support HTML video.
                    </video>
                </div>
                <div class="modal-footer d-flex justify-content-center">
                    <button id="intro-close-forever" class="btn ripple btn-danger btn-rounded startCourse"
                            data-dismiss="modal" type="button">Close forever</button>
                    <button id="intro-close-once" class="btn ripple btn-rounded bg-light-green text-white"
                            type="button" data-dismiss="modal">Close once</button>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('bottom-assets')
    <script>
        $(function(){
            $(document).ready(function(){
                // localStorage.removeItem('intro-shown');
                let introShown = localStorage.getItem('intro-shown'+{{ $module->id }})
                if (!introShown) {
                    setTimeout(function(){
                        $("#intro-dialogue"+{{ $module->id }}).modal('show');
                    }, 1000);
                    // on click intro close forever, store in local storage to show once
                    // also remove the video iframe
                    $('#intro-close-forever').click(function(){
                        localStorage.setItem('intro-shown'+{{ $module->id }}, 1);
                        $('#intro-iframe'+{{ $module->id }}).remove();
                    });
                    // on clicked intro close once, only remove video iframe
                    $('#intro-close-once').click(function(){
                        $('#intro-iframe'+{{ $module->id }}).remove();
                    });
                }

            });

        });
    </script>
@endsection
