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
            @foreach($modules as $mod)
            <div class="col-lg-4 col-md-6 col-sm-12 mb-2">
                <div class="bg-white-radius-shadow border-light-green height-modules-box">

                @if(Auth::user()->startedModule($mod->id))
                    @if(Auth::user()->startedModule($mod->id)->status === 1)
                        <span class="bg-badge-success badge badge-pill mb-2">
                        Completed
                        </span>
                    @else
                        <span class="bg-badge-warning badge badge-pill mb-2">
                        In progress
                        </span>
                    @endif
                @else
                    <span class="bg-badge-danger badge badge-pill text-light-brown mb-2">
                    Not Started
                   </span>
                @endif

                    <div class="pt-2">
                        <img class="module-grid-image"
                             src="https://nourishingafrica.com/photos/learning/modules/{{ $mod->image }}"/>
                    </div>

                    <p class="na-text-dark-green mt-2 font-weight-bold">
                        {{ $mod->title }}
                    </p>
                    <p class="tx-14">
                        <i class="fa fa-book-open text-light-brown"></i> {{ $mod->learningCourses->count() }} Courses
                    </p>

                    <!--If this item is not the first module, check if the previous module has been completed-->
                    <!--If the previous module has been completed, make the next module available-->
                    @if(!$loop->first)
                        @if(Auth::user()->startedModule($mod->previousModule()->id))
                            @if(Auth::user()->startedModule($mod->previousModule()->id)->status === 1)
                                <a href="{{ route('yaedp.account.courses', $mod->id) }}">
                                    <button class="module-btn na-bg-dark-green text-white d-flex justify-content-center">
                                        Start</button>
                                </a>
                            @else
                                <button disabled class="module-btn bg-gray d-flex justify-content-center">
                                    Start </button>
                            @endif
                        @else
                            <button disabled class="module-btn bg-gray d-flex justify-content-center">
                                Start </button>
                        @endif
                    @else
                        <a href="{{ route('yaedp.account.courses', $mod->id) }}">
                            <button class="module-btn na-bg-dark-green text-white d-flex justify-content-center">
                                Start</button>
                        </a>
                    @endif
                </div>
            </div>
            @endforeach

        </div>

    </div>
@endsection

@section('bottom-assets')
@endsection
