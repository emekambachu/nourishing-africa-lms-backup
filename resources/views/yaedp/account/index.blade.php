@extends('yaedp.account.includes.layout')

@section('title')
    Dashboard
@endsection

@section('top-assets')
@endsection

@section('content')
    <div class="container-fluid">

        <h4 class="font-large-inter text-light-brown">
            Welcome {{ Auth::user()->first_name }}
        </h4>

        <div class="row bg-white na-border-radius border-brown p-3 mb-5">
            <div class="col-md-8 col-sm-8 col-xs-8">
                <div style="margin-bottom: 70px;">
                    <h4 class="text-inter text-dark mb-1">
                        Are you ready to take your agri-food business to the next level?</h4>
                    <p class="text-inter text-gray tx-14">
                        The Youth in Agri-Food Export Development Program (YAEDP) training covers a robust curriculum that takes participants on a comprehensive learning journey from the conception of the Nigerian export market specific to key export value chains to successful entry to the international market.<br><br>
                        The six-module program is designed to take you from opportunity identification to quality product launch, growth, and financing. With guidance from top agri-food industry experts and export specialists, you will develop an improved entrepreneurial mindset to build a profitable and sustainable export businesses. <a class="na-text-dark-green" href="{{ route('yaedp.account.about-program') }}">more</a></p>
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
                <div class="row mt-5">
                    <div class="col-6">
                        <div class="module-complete-counter">
                            <h1>{{ $countCompletedCourses }}</h1>
                            <p>Completed Courses</p>
                        </div>
                    </div>
                    <div class="col-6">
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

                    @forelse($startedCourses as $course)
                    <div class="col-md-6">
                        <div class="bg-white-radius-shadow mr-2 mb-5">
                            <div class="row na-border-bottom">
                                <div class="col-3">
                                    <img src="{{ asset('images/stock/image-26.png') }}"/>
                                </div>
                                <div class="col-9">
                                    <h5 class="font-large-inter text-dark text-left mb-0">
                                        {{ $course->learningCourse->title }}</h5>
                                    <p>
                                        <i class="fa fa-user text-light-brown"></i>
                                        <span class="text-grey">
                                            {{ $course->learningCourse->trainer }}</span>
                                    </p>
                                </div>
                                <div class="col-12">
                                    <p class="text-left text-inter text-dark bg-gray-radius p-1 mt-2">
                                    {{ \Illuminate\Support\Str::limit($course->learningCourse->description, 80, $end='...') }}</p>
                                </div>
                            </div>
                            <div class="row pt-3">
                                <div class="col-md-12">
                                    <div class="pb-3">
                                        <img src="{{ asset('images/icons/book-open-circle.png') }}" width="30"/>
                                        <span>{{ $course->learningModule->title }}</span>
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
                    @empty
                    <div class="col-md-6">
                        <div class="bg-white-radius-shadow mr-2 mb-5">
                            <div class="row">
                                <div class="col-12">
                                    <h5 class="text-dark text-left mb-0">
                                        You have no ongoing course</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforelse
                </div>
            </div>

            <div class="col-md-4">
                <div class="bg-white-radius-shadow text-center">
                    <h4 class="text-light-brown text-inter text-center">Progress</h4>
                    @if(count($moduleProgress) > 0)
                        @foreach($moduleProgress as $value)
                        <p class="mb-0 text-left tx-12">{{ $value['moduleTitle'] }}</p>
                        <div class="progress mb-3 na-border-radius">
                            <div class="progress-bar
                                @if($value['percent'] === 100) bg-success
                                @else bg-warning @endif p-2"
                                 role="progressbar"
                                 style="width: {{ $value['percent'] }}%" aria-valuenow="{{ $value['percent'] }}"
                                 aria-valuemin="0" aria-valuemax="100">{{ $value['percent'] }}%</div>
                        </div>
                        @endforeach
                    @else
                        <img src="{{ asset('images/icons/social-ideas.png')}}" width="200"/>
                        <p class="text-inter text-dark mt-3 text-center">You have not started any course</p>
                    @endif
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

        <div class="row" style="margin-top: 30px; margin-bottom: 30px;">
            <div class="col-12">
                <h4 class="text-light-brown text-inter">My Assessment</h4>
                <div class="bg-white-radius-shadow">

                    @forelse($moduleAssessments as $module)
                        <div class="bg-white-radius border-light-green mb-2">
                            <div class="row">
                                <div class="col-md-11 col-sm-11">
                                    <h5 class="text-inter text-dark">{{ $module->learningModule->title }}</h5>
                                </div>
                                <div class="col-md-1 col-sm-1">
                                    <h5 class="text-inter na-text-light-green float-right mr-2">
                                        {{ $module->percent === 0 ? 'None' : $module->percent }}%</h5>

                                    @if($module->retake < 3)
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

                    <a class="d-flex justify-content-center mt-30" href="{{ route('yaedp.account.assessments') }}">
                        <button class="btn-light-green-outline" type="button">
                            See more
                        </button>
                    </a>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('bottom-assets')
@endsection
