@extends('yaedp.account.includes.layout')

@section('title')
    Business Profile
@endsection

@section('top-assets')
    <!--Vue-->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!--- Internal Prism css --->
    <link href="{{ asset('learning-assets/plugins/prism/prism.css') }}" rel="stylesheet">
    <!--- Internal Inputtags css --->
    <link href="{{ asset('learning-assets/assets/plugins/inputtags/inputtags.css') }}" rel="stylesheet">
    <!--yaedp-business-profile css-->
    <link href="{{ asset('learning-assets/css/yaedp-business-profile.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div id="app" class="container mb-4">

        <p class="bread-crumbs">
            <a href="{{ route('yaedp.account') }}">Dashboard</a> / <span class="light-green">Business profile</span>
        </p>

        <div class="mb-3">
            <h2 class="font-large-inter text-light-brown font-weight-bold">
                Business Profile</h2>
        </div>

        <div>
            <yaedp-business-profile
                :yaedp_user="{{ $yaedpUser }}"
                :selected_user="{{ $selectedUser }}"
            ></yaedp-business-profile>
        </div>
    </div>
@endsection

@section('bottom-assets')

    <!--- Internal Inputtags js --->
    <script src="{{ asset('learning-assets/plugins/inputtags/inputtags.js') }}"></script>

    <!--- Tabs JS-->
    <script src="{{ asset('learning-assets/plugins/tabs/jquery.multipurpose_tabcontent.js') }}"></script>
    <script src="{{ asset('learning-assets/js/tabs.js') }}"></script>

    <!--- Internal Prism js --->
    <script src="{{ asset('learning-assets/plugins/prism/prism.js') }}"></script>
@endsection
