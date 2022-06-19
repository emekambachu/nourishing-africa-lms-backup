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
                        <div style="padding:56.25% 0 0 0;position:relative;">
                            <iframe src="https://player.vimeo.com/video/717588967?h=214fdf5d57&amp;badge=0&amp;autopause=0&amp;player_id=0&amp;app_id=58479" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen style="position:absolute;top:0;left:0;width:100%;height:100%;" title="YAEDP Welcome New.mp4"></iframe>
                        </div>
                        <script src="https://player.vimeo.com/api/player.js"></script>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="na-text-dark-green">Updating your profile</h5>
                    </div>
                    <div class="card-body text-inter shadow-2">
                        <div style="padding:56.25% 0 0 0;position:relative;"><iframe src="https://player.vimeo.com/video/721554425?h=22c8497ad5&amp;badge=0&amp;autopause=0&amp;player_id=0&amp;app_id=58479" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen style="position:absolute;top:0;left:0;width:100%;height:100%;" title="Update Profile"></iframe></div>
                        <script src="https://player.vimeo.com/api/player.js"></script>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="na-text-dark-green">Starting or joining a discussion</h5>
                    </div>
                    <div class="card-body text-inter shadow-2">
                        <div style="padding:56.25% 0 0 0;position:relative;"><iframe src="https://player.vimeo.com/video/721553870?h=2e493b76ea&amp;badge=0&amp;autopause=0&amp;player_id=0&amp;app_id=58479" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen style="position:absolute;top:0;left:0;width:100%;height:100%;" title="Starting or Joining a Discussion"></iframe></div>
                        <script src="https://player.vimeo.com/api/player.js"></script>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="na-text-dark-green">Taking an assessment</h5>
                    </div>
                    <div class="card-body text-inter shadow-2">
                        <div style="padding:56.25% 0 0 0;position:relative;"><iframe src="https://player.vimeo.com/video/721554176?h=5973ae7813&amp;badge=0&amp;autopause=0&amp;player_id=0&amp;app_id=58479" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen style="position:absolute;top:0;left:0;width:100%;height:100%;" title="Taking an Assessment"></iframe></div>
                        <script src="https://player.vimeo.com/api/player.js"></script>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="na-text-dark-green">Viewing your assessment</h5>
                    </div>
                    <div class="card-body text-inter shadow-2">
                        <div style="padding:56.25% 0 0 0;position:relative;"><iframe src="https://player.vimeo.com/video/721554690?h=768330a119&amp;badge=0&amp;autopause=0&amp;player_id=0&amp;app_id=58479" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen style="position:absolute;top:0;left:0;width:100%;height:100%;" title="Viewing Your Assessments"></iframe></div>
                        <script src="https://player.vimeo.com/api/player.js"></script>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="na-text-dark-green">Downloading your certificate</h5>
                    </div>
                    <div class="card-body text-inter shadow-2">
                        <div style="padding:56.25% 0 0 0;position:relative;"><iframe src="https://player.vimeo.com/video/721553575?h=c9a0761d01&amp;badge=0&amp;autopause=0&amp;player_id=0&amp;app_id=58479" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen style="position:absolute;top:0;left:0;width:100%;height:100%;" title="Downloading Your Certificate"></iframe></div>
                        <script src="https://player.vimeo.com/api/player.js"></script>
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
