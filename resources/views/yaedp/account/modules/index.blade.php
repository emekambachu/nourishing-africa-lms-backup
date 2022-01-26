@extends('yaedp.account.includes.layout')

@section('title')
    Modules
@endsection

@section('top-assets')
@endsection

@section('content')
    <div class="container">

        <p class="bread-crumbs">
            <a href="{{ route('yaedp.account') }}">Dashboard</a> / <span class="light-green">Modules</span>
        </p>
        <h1 class="font-large-inter text-light-brown font-weight-bold">
            Modules</h1>

        <div class="row">
            <div class="col-lg-4 col-md-6 col-sm-12">
               <div class="bg-white-radius-shadow border-light-green">
                   <span class="bg-gray-100 badge badge-pill text-light-brown mb-3">
                       Not started
                   </span>
                   <div class="module-grid-container">
                       <span class="module-title badge">Module 1</span>
                       <div class="bg-lemon-green p-2 module-grid-content">
                           Lessons on leveraging on export opportunities to increase your revenue significantly Lessons on leveraging on export opportunities to increase your revenue significantly
                       </div>
                   </div>
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
