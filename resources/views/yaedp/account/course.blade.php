@extends('yaedp.account.includes.layout')

@section('title')
    {{ $course->title }}
@endsection

@section('top-assets')
@endsection

@section('content')
    <div class="container mb-4">

        <p class="bread-crumbs">
            <a href="{{ route('yaedp.account') }}">Dashboard</a> / <a href="{{ route('yaedp.account.modules') }}">Modules</a> / <a href="{{ route('yaedp.account.courses', $course->learningModule->id) }}">Courses</a> / <span class="light-green">{{ $course->title }}</span>
        </p>

        <div class="mb-3">
            <h2 class="font-large-inter text-light-brown font-weight-bold">
                {{ $course->title }}</h2>
            <!--View course countdown-->
            <div id="courseCountdown"></div>
        </div>

{{--        <progress class="progress-bar progress-bar-striped bg-success"--}}
{{--                  value="0" max="100" id="progressBar"></progress>--}}

        <div class="row">
            <div class="col-lg-9 col-md-9 col-sm-12">
                <div class="bg-white-radius-shadow border-light-green">

                    <div class="row">
                        <div class="col-12">
                            <div class="course-video">
                                <!--For responsiveness-->
                                <div style='max-width: 853px'>
                                    <div style='position: relative; padding-bottom: 56.25%; height: 0; overflow: hidden;'>
                                        <!--Insert Iframe-->
                                        {!! $course->video !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">

                    <div class="col-12 mt-3 mb-3 course-tabs">
                        <span id="description" class="d-inline text-dark active course-tab">
                            Description</span>
                        <span id="instructor" class="d-inline text-dark course-tab">
                            Instructor</span>
                        <span id="resources" class="d-inline text-dark course-tab">
                            Resources</span>
                        <span id="discussion" class="d-inline text-dark course-tab">
                            Discussion</span>
                    </div>

                    <div class="col-12 bg-white-radius-shadow tab-bodies" id="description-tab-body">
                        <p class="text-inter tx-14">
                            {!! $course->description !!}
                        </p>
                    </div>

                    <div class="col-12 bg-white-radius-shadow tab-bodies d-none"
                         id="instructor-tab-body">
                        <div class="row">
                            <div class="col-md-2 col-sm-12">
                                <img src="{{ asset('images/stock/lecturer.png') }}"/>
                            </div>
                            <div class="col-md-10 col-sm-12">
                                <h4 class="text-inter text-dark mb-0">{{ $course->trainers }}</h4>
                                <h3 class="text-inter text-grey">Lecturer Position and Company</h3>
                                <p class="text-inter text-grey tx-14">Amet minim mollit non deserunt ullamco est sit aliqua dolor do amet sint. Velit officia consequat duis enim velit mollit. Exercitation veniam consequat sunt nostrud amet. Amet minim mollit non deserunt ullamco est sit aliqua dolor do amet sint. Velit officia consequat duis enim velit mollit. Exercitation veniam consequat sunt nostrud amet.Amet minim mollit non deserunt ullamco est sit aliqua dolor do amet sint. Velit officia consequat duis enim velit mollit. Exercitation veniam consequat sunt nostrud amet.</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 bg-white-radius-shadow tab-bodies d-none"
                         id="resources-tab-body">
                        <div class="row p-2">

                            @if(!empty($course->document_one))
                                <div class="col-2 course-resources">
                                    <img src="{{ asset('images/icons/document.png') }}" width="40"/>
                                    <a href="{{ route('yaedp.account.course.download-document', [$course->id, $course->document_one]) }}">
                                        <span>Download</span>
                                    </a>
                                </div>
                            @endif

                            @if(!empty($course->document_two))
                                <div class="col-2 course-resources">
                                    <img src="{{ asset('images/icons/document.png') }}" width="40"/>
                                    <a href="{{ route('yaedp.account.course.download-document', [$course->id, $course->document_two]) }}">
                                        <span>Download</span>
                                    </a>
                                </div>
                            @endif

                        </div>
                    </div>

                    <div class="col-12 bg-white-radius-shadow tab-bodies d-none" id="discussion-tab-body">
                        <p class="text-inter tx-14">
                            Amet minim mollit non deserunt ullamco est sit aliqua dolor do amet sint. Velit officia consequat duis enim velit mollit. Exercitation veniam consequat sunt nostrud amet. Amet minim mollit non deserunt ullamco est sit aliqua dolor do amet sint. Velit officia consequat duis enim velit mollit. Exercitation veniam consequat sunt nostrud amet.Amet minim mollit non deserunt ullamco est sit aliqua dolor do amet sint. Velit officia consequat duis enim velit mollit. Exercitation veniam consequat sunt nostrud amet.
                        </p>
                    </div>
                </div>

            </div>

            <div class="col-lg-3 col-md-3 col-sm-12">
                <div class="bg-white-radius-shadow border-light-green p-0">
                    <h6 class="text-light-brown pb-2 border-bottom-grey pl-2 pt-2">
                        {{ $course->learningModule->title }}
                    </h6>

                    @foreach($courses as $c)
                        @if(Auth::user()->startedCourse($c->id, $c->learningModule->id))
                            @if(Auth::user()->startedCourse($c->id, $c->learningModule->id)->completed_course)
                            <div class="p-2 @if($c->id === $course->id) bg-lemon-green @endif ">
                                <span class="text-inter na-text-dark-green tx-12">
                                    {{ $c->title }}
                                    <i class="fa fa-check na-text-light-green text-right ml-2"></i>
                                </span>
                            </div>
                            @else
                            <div class="p-2 @if($c->id === $course->id) bg-lemon-green @endif ">
                                <span class="text-inter na-text-dark-green tx-12">
                                    {{ $c->title }}
                                    <i class="fa fa-play na-text-light-green text-right ml-2"></i>
                                </span>
                            </div>
                            @endif
                        @else
                            <div class="p-2">
                                <span class="text-inter na-text-dark-green tx-12">
                                    {{ $c->title }}
                                    <i class="fa fa-lock na-text-light-green text-right ml-2"></i>
                                </span>
                            </div>
                        @endif
                    @endforeach

                    <div class="p-2 bg-very-light-brown">
                        <span class="text-inter na-text-dark-green tx-12">
                            Assessment
                            <i class="fa fa-list text-right ml-2"></i>
                        </span>
                    </div>
                </div>

                @if($course->nextCourse())
                    @if(Auth::user()->startedCourse($course->id, $course->learning_module_id))
                        @if(Auth::user()->startedCourse($course->id, $course->learning_module_id)->completed_course)
                            <a href="{{ route('yaedp.account.course', $course->nextCourse()->id) }}">
                                <button class="module-btn bg-light-brown d-flex justify-content-center">
                                    Next Course</button>
                            </a>
                        @else
                            <a href="{{ route('yaedp.account.course', $course->nextCourse()->id) }}">
                                <button id="btn-next-course" disabled
                                        class="module-btn bg-gray d-flex justify-content-center">
                                    Next Course</button>
                            </a>
                        @endif
                    @endif
                @else
                    <a href="{{ route('yaedp.account.assessment.start', $course->learning_module_id) }}">
                        <button class="module-btn bg-light-brown d-flex justify-content-center">
                            Start Assessment</button>
                    </a>
                @endif

            </div>
        </div>
    </div>

    <!--Timer Warning Modal-->
    <div class="modal effect-scale hide" id="timerAlert" style="padding-right: 22px;"
         data-completed-course="{{ Auth::user()->startedCourse($course->id, $course->learning_module_id)->completed_course ? 1 : 0 }}">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h5 class="text-inter font-weight-bold text-center">
                        Your session will be recorded once you resume this course, leaving before the timer ends will not complete the course.
                    </h5>
                </div>
                <div class="modal-body">
                    <h5 class="text-center">Continue ?</h5>
                </div>
                <div class="modal-footer d-flex justify-content-center">
                    <button class="btn ripple btn-success startCourse" data-dismiss="modal" type="button"
                            data-route="{{ route('yaedp.account.course.complete', $course->id) }}"
                            data-study-timer="{{ $course->study_timer }}">Yes</button>
                    <a href="{{ route('yaedp.account.courses', $course->learning_module_id) }}">
                        <button class="btn ripple btn-warning" type="button">No, take me back</button>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('bottom-assets')

    <script>
        $(document).ready(function() {

            $('.course-tab').click(function(e){

                $('.course-tab').removeClass('active');
                $('.tab-bodies').addClass('d-none');

                $(this).addClass('active');

                if($(this).attr('id') == "description"){
                    $('#description-tab-body').removeClass('d-none');
                }

                if($(this).attr('id') == "instructor"){
                    $('#instructor-tab-body').removeClass('d-none');
                }

                if($(this).attr('id') == "resources"){
                    $('#resources-tab-body').removeClass('d-none');
                }

                if($(this).attr('id') == "discussion"){
                    $('#discussion-tab-body').removeClass('d-none');
                }
            });

        });
    </script>

    <script src="{{ asset('learning-assets/custom/learning-views.js') }}" type="text/javascript"></script>

    <!--- Internal Modal js --->
    <script src="{{ asset('learning-assets/js/modal.js') }}"></script>

    <!--Start of Tawk.to Script-->
    <script type="text/javascript">
        var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
        (function(){
            var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
            s1.async=true;
            s1.src='https://embed.tawk.to/61fabd5c9bd1f31184da9efe/1fqtn7dcj';
            s1.charset='UTF-8';
            s1.setAttribute('crossorigin','*');
            s0.parentNode.insertBefore(s1,s0);
        })();
    </script>
    <!--End of Tawk.to Script-->
@endsection
