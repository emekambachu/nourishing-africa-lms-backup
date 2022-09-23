@extends('yaedp.account.includes.layout')

@section('title')
    Document Uploads
@endsection

@section('top-assets')
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
@endsection

@section('content')
    <div id="app" class="container">
        <p class="bread-crumbs">
            <a href="{{ route('yaedp.account') }}">Dashboard</a> / <span class="light-green">Document Uploads</span>
        </p>
        <h1 class="font-large-inter text-light-brown font-weight-bold">
            Document Uploads</h1>

        <document-uploads
            :auth="{{ Auth::user() }}"
        ></document-uploads>

    </div>
@endsection

@section('bottom-assets')
@endsection
