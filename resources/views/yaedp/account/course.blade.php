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

        <h1 class="font-large-inter text-light-brown font-weight-bold mb-0">
            {{ $course->title }}</h1>

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
{{--                                        <iframe width="853" height="480" src="https://web.microsoftstream.com/embed/video/161c45c5-56d4-4dcf-903e-0251679f7f7e?autoplay=false&showinfo=true" allowfullscreen style="border:none; position: absolute; top: 0; left: 0; right: 0; bottom: 0; height: 100%; max-width: 100%;"></iframe>--}}

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

{{--                    <div class="bg-lemon-green p-2">--}}
{{--                        <span class="text-inter na-text-dark-green tx-16">--}}
{{--                            Module name <i class="fa fa-check na-text-light-green text-right ml-2"></i></span>--}}
{{--                        <p class="text-inter text-grey">The export details in agriculture</p>--}}
{{--                    </div>--}}

{{--                    <div class="p-2">--}}
{{--                        <span class="text-inter na-text-dark-green tx-16">--}}
{{--                            Module name <i class="fas fa-lock text-gray text-right ml-2"></i></span>--}}
{{--                        <p class="text-inter text-grey">The export details in agriculture</p>--}}
{{--                    </div>--}}

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

@endsection
