@extends('yaedp.account.includes.layout')

@section('title')
    Self-help Videos
@endsection

@section('top-assets')

@endsection

@section('content')
    <div class="container mb-4">

        <p class="bread-crumbs">
            <a href="{{ route('yaedp.account') }}">Dashboard</a> / <span class="light-green">Self-help videos</span>
        </p>

        <div class="mb-3">
            <h2 class="font-large-inter text-light-brown font-weight-bold">
                Self-help Videos</h2>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="na-text-dark-green">Re-watch the welcome video</h5>
                    </div>
                    <div class="card-body text-inter shadow-2">
                        <video width="100%" controls preload="auto">
                            <source src=""
                                    type="video/mp4">
                            Your browser does not support HTML video.
                        </video>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="na-text-dark-green">Updating your profile</h5>
                    </div>
                    <div class="card-body text-inter shadow-2">
                        <video width="100%" controls preload="auto">
                            <source src="https://learning.nourishingafrica.com/videos/yaedp/self-help/Update Profile.mp4"
                                    type="video/mp4">
                            Your browser does not support HTML video.
                        </video>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="na-text-dark-green">Starting or joining a discussion</h5>
                    </div>
                    <div class="card-body text-inter shadow-2">
                        <video width="100%" controls preload="auto">
                            <source src="https://learning.nourishingafrica.com/videos/yaedp/self-help/Starting or Joining a Discussion.mp4"
                                    type="video/mp4">
                            Your browser does not support HTML video.
                        </video>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="na-text-dark-green">Taking an assessment</h5>
                    </div>
                    <div class="card-body text-inter shadow-2">
                        <video width="100%" controls preload="auto">
                            <source src="https://learning.nourishingafrica.com/videos/yaedp/self-help/Taking an Assessment.mp4"
                                    type="video/mp4">
                            Your browser does not support HTML video.
                        </video>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="na-text-dark-green">Viewing your assessment</h5>
                    </div>
                    <div class="card-body text-inter shadow-2">
                        <video width="100%" controls preload="auto">
                            <source src="https://learning.nourishingafrica.com/videos/yaedp/self-help/Viewing Your Assessments.mp4"
                                    type="video/mp4">
                            Your browser does not support HTML video.
                        </video>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="na-text-dark-green">Downloading your certificate</h5>
                    </div>
                    <div class="card-body text-inter shadow-2">
                        <video width="100%" controls preload="auto">
                            <source src="https://learning.nourishingafrica.com/videos/yaedp/self-help/Downloading Your Certificate.mp4"
                                    type="video/mp4">
                            Your browser does not support HTML video.
                        </video>
                    </div>
                </div>
            </div>

        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body text-inter shadow-2">
                        <h4 class="na-text-dark-green">Questions about your courses</h4>
                        <p>Please visit the discussion forum under each course to see some already answered questions by other students and course instructors.</p>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
