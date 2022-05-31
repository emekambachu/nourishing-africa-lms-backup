@extends('yaedp.account.includes.layout')

@section('title')
    Dashboard
@endsection

@section('top-assets')
@endsection

@section('content')
    <div class="container-fluid">

        <h4 class="font-large-inter text-light-brown">
            Welcome {{ Auth::user()->first_name }}</h4>

        <div class="row bg-white na-border-radius border-brown p-3 mb-5">
            <div class="col-md-9 col-sm-9">
                <div style="margin-bottom: 70px;">
                    <h4 class="text-inter text-dark mb-1">
                        Are you ready to take your agri-food business to the next level?</h4>
                    <p class="text-inter text-gray tx-15 text-justify">
                        The Youth in Agri-Food Export Development Program (YAEDP) training covers a robust curriculum that takes participants on a comprehensive learning journey from the conception of the Nigerian export market specific to key export value chains to successful entry to the international market....
                        <a class="na-text-dark-green font-weight-bold"
                           href="{{ route('yaedp.account.about-program') }}">See more</a>
                    </p>
                </div>
                <div class="row">
                    <div class="col-md-4 text-left">
                        <div class="member-bg-lemon d-inline d-flex p-3 border-radius-8">
                            <img src="{{ asset('images/icons/modules.png') }}" width="70"/>
                            <span class="ml-2">
                                <h2>{{ $modules->count() }}</h2>
                                <p>Modules</p>
                            </span>
                        </div>
                    </div>
                    <div class="col-md-4 text-left">
                        <div class="bg-lighter-brown d-inline d-flex p-3 border-radius-8">
                            <img src="{{ asset('images/icons/online-course.png') }}" width="70"/>
                            <span class="ml-2">
                                <h2>{{ $sumCourses }}</h2>
                                <p>Courses</p>
                            </span>
                        </div>
                    </div>
                    <div class="col-md-4 text-left">
                        <div class="bg-light-purple d-inline d-flex p-3 border-radius-8">
                            <img src="{{ asset('images/icons/instructors.png') }}" width="70"/>
                            <span class="ml-2">
                                <h2>12</h2>
                                <p>Instructors</p>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-3">
                <div class="module-complete-counter">
                    <h1>{{ $countCompletedCourses }}</h1>
                    <p>Completed Courses</p>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="row">

                    <div class="col-12">
                        <h4 class="text-light-brown text-inter text-left float-left">My Courses</h4>
                    </div>

                    <div class="col-md-8">
                        <div class="row">
                            @forelse($startedCourses as $course)
                                <div class="col-md-6">
                                    <div class="bg-white-radius-shadow mr-2 mb-5 height-dashboard-courses">

                                        <div class="row p-2 justify-content-end">
                                            @if($course->status === 1)
                                                <span class="bg-badge-success badge badge-pill mb-2 float-right">
                                            Completed</span>
                                            @else
                                                <span class="bg-badge-warning badge badge-pill mb-2 float-right">
                                            Ongoing</span>
                                            @endif
                                        </div>

                                        <div class="row border-bottom-dark-green pb-2" style="height: 130px;">
                                            <div class="col-3">
                                                <img class="rounded-5" src="{{ asset('images/stock/image-26.png') }}"/>
                                            </div>
                                            <div class="col-9">
                                                <h5 class="font-large-inter text-dark text-left mb-0 tx-12">
                                                    {{ $course->learningCourse->title }}</h5>
                                                <p>
                                                    <i class="fa fa-user text-light-brown"></i>
                                                    <span class="text-grey">
                                            {{ $course->learningCourse->trainer }}</span>
                                                </p>
                                            </div>
                                        </div>

                                        <div class="row pb-2">
                                            <div class="col-12">
                                                <p class="text-left text-inter text-dark p-1 mt-2">
                                                    {{ \Illuminate\Support\Str::limit($course->learningCourse->description, 80, $end='...') }}</p>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="pb-1">
                                                    <img src="{{ asset('images/icons/book-open-circle.png') }}"
                                                         width="30"/>
                                                    <span>{{ $course->learningModule->title }}</span>
                                                </div>
                                            </div>
                                            <div class="col-12 text-center btn-bottom">
                                                <a class="text-center"
                                                   href="{{ route('yaedp.account.course', $course->learningCourse->id) }}">
                                                    <button class="module-btn na-bg-dark-green text-white"
                                                            type="button">
                                                        {{ $course->status === 1 ? 'Retake' : 'Continue' }}</button>
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
                            @if(count($completedCourseViews) > 0)
                                @foreach(array_slice($moduleProgress, 0, 3) as $key => $value)
                                    @if($value['percent'] > 0)
                                        <!--array_slice will stop the array after the 3rd loop-->
                                        <p class="mb-0 text-left tx-12">{{ $value['moduleTitle'] }}</p>
                                        <div class="progress mb-3 na-border-radius">
                                            <div class="progress-bar
                                            @if($value['percent'] === 100) bg-success
                                            @else bg-warning @endif"
                                                 role="progressbar"
                                                 style="width: {{ $value['percent'] }}%"
                                                 aria-valuenow="{{ $value['percent'] }}"
                                                 aria-valuemin="0" aria-valuemax="100">
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            @else
                                <img src="{{ asset('images/icons/social-ideas.png')}}" width="200"/>
                                <p class="text-inter text-dark mt-3 text-center">You have not started any course</p>
                            @endif
                            <a href="{{ route('yaedp.account.modules') }}">
                                <button class="na-investor-bg-dark-green text-white na-border-radius wd-200 pt-2 pb-2" type="button">
                                    Go to modules
                                </button>
                            </a>
                        </div>

                    </div>

                </div>
            </div>
        </div>

        <div class="row" style="margin-top: 30px; margin-bottom: 30px;">
            <div class="col-md-6">
                <h4 class="text-light-brown text-inter">My Assessments</h4>
            </div>
            <div class="col-md-6 text-right">
                <a class="text-success" href="{{ route('yaedp.account.assessments') }}">See all assessments</a>
            </div>
            <div class="col-12">
                <div class="bg-white-radius-shadow">
                    @forelse($moduleAssessments as $module)
                        <div class="bg-lemon-green mb-2 p-2 border-radius-8">
                            <div class="row">
                                <div class="col-md-10">
                                    <h5 class="text-inter text-grey">
                                        {{ $module->learningModule->title }}
                                    </h5>
                                </div>
                                <div class="col-md-2 d-inline d-flex">
                                    @if($module->retake < 3)
                                        <a class="text-success tx-15 mr-1 pr-1 border-right-2"
                                           href="{{ route('yaedp.account.assessment.questions', $module->learning_module_id) }}">Retake ({{ 3 - $module->retake }})
                                        </a>
                                    @endif
                                    <h5 class="text-inter text-grey mr-2">
                                        {{ $module->percent === 0 ? 'None' : $module->percent }}%</h5>
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

    </div>

    <!--Welcome Modal-->
    <div class="modal effect-scale hide" id="intro-dialogue"
         data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-dialog-centered" style="max-width: 700px;" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h5 class="text-inter font-weight-bold text-center">
                        Welcome to the Youth in Agri-Food Export Development Program (YAEDP)!</h5>
                </div>
                <div id="intro-iframe" class="modal-body">
{{--                    <video width="100%" controls>--}}
{{--                        <source src="/videos/YAEDP Welcome Video.mp4" type="video/mp4">--}}
{{--                        <source src="mov_bbb.ogg" type="video/ogg">--}}
{{--                        Your browser does not support HTML video.--}}
{{--                    </video>--}}
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
    <!--- Internal Modal js --->
    <script src="{{ asset('learning-assets/custom/intro-popup.js') }}"></script>
@endsection
