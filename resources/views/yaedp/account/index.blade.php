@extends('yaedp.account.includes.layout')

@section('title')
    Dashboard
@endsection

@section('top-assets')
@endsection

@section('content')
    <div class="container-fluid">

        <h4 class="font-large-inter text-light-brown">
            Welcome {{ Auth::user()->surname }}
        </h4>

        <div class="row bg-white na-border-radius border-brown p-3 mb-5">
            <div class="col-md-8 col-sm-8 col-xs-8">
                <div style="margin-bottom: 70px;">
                    <h4 class="text-inter text-dark mb-0">Learn effectively on exports</h4>
                    <p class="text-inter light-green">Something new to learn today</p>
                </div>
                <div class="row">
                    <div class="col-md-4 text-left">
                        <img src="{{ asset('images/icons/book-open-circle.png') }}" width="30"/>
                        <span> {{ $modules->count() }} Modules</span>
                    </div>
                    <div class="col-md-4 text-left">
                        <img src="{{ asset('images/icons/book-open-circle.png') }}" width="30"/>
                        <span> {{ $courses->count() }} Courses</span>
                    </div>
                    <div class="col-md-4 text-left">
                        <img src="{{ asset('images/icons/user-circle-brown.png') }}" width="30"/>
                        <span> 10 Instructors</span>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-4 col-xs-4">
                <div class="row">
                    <div class="col-lg-5 col-md-5 col-sm-6 col-sx-6">
                        <div class="module-complete-counter">
                            <h1>{{ $countCompletedCourses }}</h1>
                            <p>Completed Courses</p>
                        </div>
                    </div>
                    <div class="col-lg-7 col-md-7 col-sm-6 col-sx-6">
                        <img src="{{ asset('images/icons/404-bad-request.png') }}" style="width: auto;"/>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-8">
                <div class="row">
                    <div class="col-12">
                        <h4 class="text-light-brown text-inter text-left float-left">My Progress</h4>
                        <a class="float-right na-text-dark-green" href="{{ route('yaedp.account.modules') }}">
                            See all modules</a>
                    </div>

                    @foreach($startedCourses as $course)
                    <div class="col-md-6">
                        <div class="bg-white-radius-shadow mr-2">
                            <div class="row na-border-bottom">
                                <div class="col-3">
                                    <img src="{{ asset('images/stock/image-26.png') }}"/>
                                </div>
                                <div class="col-9">
                                    <h4 class="font-large-inter text-dark text-left mb-0">
                                        {{ $course->learningCourse->title }}</h4>
                                    <p>
                                        <i class="fa fa-user text-light-brown"></i>
                                        <span class="text-grey">{{ $course->learningCourse->trainers }}</span>
                                    </p>
                                </div>
                                <div class="col-12">
                                    <p class="text-left text-inter text-dark bg-gray-radius p-1 mt-2">
                                        {{ $course->learningCourse->description }}</p>
                                </div>
                            </div>
                            <div class="row pt-3 pb-3">
                                <div class="col-md-12">
                                    <div class="pb-3">
                                        <img src="{{ asset('images/icons/book-open-circle.png') }}" width="30"/>
                                        <span>{{ $course->learningModule->title }}</span>
                                    </div>
{{--                                    <div class="pb-3">--}}
{{--                                        <img src="{{ asset('images/icons/tasks.png') }}" width="30"/>--}}
{{--                                        <span>1 Assignment</span>--}}
{{--                                    </div>--}}
                                    <div class="pb-3">
                                        <img src="{{ asset('images/icons/timing.png') }}" width="30"/>
                                        <span>
                                            {{ $course->learningModule->start.' - '.$course->learningModule->stop }}
                                        </span>
                                    </div>
                                </div>
                                <div class="col-12 text-center">
                                    <a class="text-center"
                                       href="{{ route('yaedp.account.course', $course->learningCourse->id) }}">
                                        <button class="btn-light-green-outline" type="button">
                                            Continue</button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <div class="row" style="margin-top: 30px; margin-bottom: 30px;">
                    <div class="col-12">
                        <h4 class="text-light-brown text-inter">My Assignments</h4>
                        <div class="bg-white-radius-shadow">
                            <h4>No Assignment</h4>
                            <p>You have not started any course, so you can’t access any of the assessments</p>
                            <a class="text-center mt-30" href="#">
                                <button class="btn-light-green-outline" type="button">
                                    Start Module
                                </button>
                            </a>
                        </div>
                    </div>
                </div>

            </div>

            <div class="col-md-4">
                <div class="bg-white-radius-shadow text-center">
                    <h4 class="text-light-brown text-inter text-center">Progress</h4>
                    <img src="{{ asset('images/icons/social-ideas.png')}}" width="200"/>
                    <p class="text-inter text-dark mt-3 text-center">You have not started any course</p>
                    <a href="{{ route('yaedp.account.modules') }}">
                        <button class="bg-light-brown na-border-radius wd-200 pt-2 pb-2" type="button">
                            Go to modules
                        </button>
                    </a>
                </div>
                <div class="mt-4 bg-light-brown na-border-radius p-3 text-center">
                    <p class="text-inter text-white">
                        Want to have access to latest news in agriculture?, subscribe to our newsletter</p>
                    <a href="https://nourishingafrica.com/subscribe" target="_blank">
                        <button class="bg-white na-border-radius wd-200 pt-2 pb-2">
                            Subscribe</button>
                    </a>
                </div>
            </div>

        </div>


    </div>
@endsection

@section('bottom-assets')
@endsection
