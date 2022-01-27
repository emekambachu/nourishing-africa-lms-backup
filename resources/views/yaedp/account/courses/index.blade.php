@extends('yaedp.account.includes.layout')

@section('title')
    Module Name
@endsection

@section('top-assets')
@endsection

@section('content')
    <div class="container mb-4">

        <p class="bread-crumbs">
            <a href="{{ route('yaedp.account') }}">Dashboard</a> / <a href="{{ route('yaedp.account.modules') }}">Modules</a> / <span class="light-green">Module Name</span>
        </p>
        <h1 class="font-large-inter text-light-brown font-weight-bold mb-0">
            Module Name</h1>

        <div class="row">
            <div class="col-12">
                <p class="tx-16 text-gray mb-0">Description about this module</p>
                <p class="light-green tx-16 text-right">Duration of this module</p>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12">
                <div class="bg-white-radius-shadow border-light-green">
                   <span class="bg-gray-100 badge badge-pill text-light-brown mb-3">
                       Not started
                   </span>
                    <div class="module-grid-container">
                        <span class="module-title badge">Module 1</span>
                    </div>
                    <p class="text-grey tx-14 mt-3">
                        Lessons on leveraging on export opportunities to increase your revenue significantly
                    </p>
                    <p class="text-grey tx-12 mt-3">
                        30:22
                    </p>
                    <button class="module-btn d-flex justify-content-center">
                        Start
                    </button>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12">
                <div class="bg-white-radius-shadow border-light-green">
                   <span class="bg-gray-100 badge badge-pill text-light-brown mb-3">
                       Not started
                   </span>
                    <div class="module-grid-container">
                        <span class="module-title badge">Module 1</span>
                    </div>
                    <p class="text-grey tx-14 mt-3">
                        Lessons on leveraging on export opportunities to increase your revenue significantly
                    </p>
                    <p class="text-grey tx-12 mt-3">
                        30:22
                    </p>
                    <button class="module-btn d-flex justify-content-center">
                        Start
                    </button>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12">
                <div class="bg-white-radius-shadow border-light-green">
                   <span class="bg-gray-100 badge badge-pill text-light-brown mb-3">
                       Not started
                   </span>
                    <div class="module-grid-container">
                        <span class="module-title badge">Module 1</span>
                    </div>
                    <p class="text-grey tx-14 mt-3">
                        Lessons on leveraging on export opportunities to increase your revenue significantly
                    </p>
                    <p class="text-grey tx-12 mt-3">
                        30:22
                    </p>
                    <button class="module-btn d-flex justify-content-center">
                        Start
                    </button>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('bottom-assets')
@endsection
