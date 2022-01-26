@extends('yaedp.account.includes.layout')

@section('title')
    Course Name
@endsection

@section('top-assets')
@endsection

@section('content')
    <div class="container">

        <p class="bread-crumbs">
            <a href="{{ route('yaedp.account') }}">Dashboard</a> / <a href="{{ route('yaedp.account.modules') }}">Modules</a> / <a href="{{ route('yaedp.account.courses') }}">Courses</a> / <span class="light-green">Course Name</span>
        </p>
        <h1 class="font-large-inter text-light-brown font-weight-bold mb-0">
            Course Name</h1>

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
                                        <iframe width="853" height="480" src="https://web.microsoftstream.com/embed/video/161c45c5-56d4-4dcf-903e-0251679f7f7e?autoplay=false&showinfo=true" allowfullscreen style="border:none; position: absolute; top: 0; left: 0; right: 0; bottom: 0; height: 100%; max-width: 100%;"></iframe>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 mt-5">
                            <div class="d-inline text-dark course-tabs">Description</div>
                            <div class="d-inline text-dark course-tabs">Instructor</div>
                            <div class="d-inline text-dark course-tabs">Resources</div>
                            <div class="d-inline text-dark course-tabs">Discussion</div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-12">
                <div class="bg-white-radius-shadow border-light-green">

                </div>
            </div>
        </div>

    </div>
@endsection

@section('bottom-assets')
@endsection
