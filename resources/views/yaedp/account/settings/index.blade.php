@extends('yaedp.account.includes.layout')

@section('title')
    Account Settings
@endsection

@section('top-assets')
    <!--Vue-->
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!--- Internal Prism css --->
    <link href="{{ asset('learning-assets/plugins/prism/prism.css') }}" rel="stylesheet">

    <!--- Internal Inputtags css --->
    <link href="{{ asset('learning-assets/assets/plugins/inputtags/inputtags.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div id="app" class="container mb-4">

        <p class="bread-crumbs">
            <a href="{{ route('yaedp.account') }}">Dashboard</a> / <span class="light-green">Account settings</span>
        </p>

        <div class="mb-3">
            <h2 class="font-large-inter text-light-brown font-weight-bold">
                Account Settings</h2>
        </div>

        <div>
            <account-settings-component
                :profile="{{ Auth::user() }}">
            </account-settings-component>
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
