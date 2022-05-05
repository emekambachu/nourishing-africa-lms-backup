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
            <div class="col-md-12">
                <h5 class="na-text-dark-green text-manrope tx-md-bold">
                    WATCH HELPFUL HOW-TO VIDEOS FOR PARTICIPANTS</h5>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="na-text-dark-green">Update your profile</h4>
                    </div>
                    <div class="card-body text-inter shadow-2">
                        <iframe src="https://drive.google.com/file/d/1zC1LiiTtPwQ-zT5CVJffUvE4YZsIeFex/preview"
                                width="100%" height="480" allow="autoplay"></iframe>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="na-text-dark-green">Starting a journey</h4>
                    </div>
                    <div class="card-body text-inter shadow-2">
                        <iframe src="https://drive.google.com/file/d/1wykcNaz8pU3hnoadHi4Pv3oDnDnt2cSo/preview"
                                width="100%" height="480" allow="autoplay"></iframe>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body text-inter shadow-2">
                        <h4 class="na-text-dark-green">Questions about your courses</h4>
                        <p>Please visit the Discussion thread under each course to see some already answered questions by other students and course instructors.</p>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection