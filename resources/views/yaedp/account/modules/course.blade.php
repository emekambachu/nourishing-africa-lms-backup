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
                                <iframe width="853" height="480" src="https://web.microsoftstream.com/embed/video/161c45c5-56d4-4dcf-903e-0251679f7f7e?autoplay=false&showinfo=true" allowfullscreen style="border:none;"></iframe>
                            </div>
                        </div>
                        <div class="col-12">
                            <span>Description</span>
                            <span>Instructor</span>
                            <span>Resources</span>
                            <span>Discussion</span>
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
