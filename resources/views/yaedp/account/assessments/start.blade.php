@extends('yaedp.account.includes.layout')

@section('title')
    {{ $module->title }}
@endsection

@section('top-assets')
@endsection

@section('content')
    <div class="container mb-4">

        <p class="bread-crumbs">
            <a href="{{ route('yaedp.account') }}">Dashboard</a> / <a href="{{ route('yaedp.account.modules') }}">Modules</a> / <a href="{{ route('yaedp.account.courses', $module->id) }}">Courses</a> / <span class="light-green">{{ $module->title }}</span>
        </p>

        <div class="mb-3">
            <h2 class="font-large-inter text-light-brown font-weight-bold">
                {{ $module->title }}</h2>
        </div>

        <div class="row">
            <div class="col-lg-9 col-md-9 col-sm-12">
                <div class="bg-white-radius-shadow border-light-green">

                    <div class="row">
                        <div class="col-12">
                            <p>
                                Congratulations on completing your courses on <strong>{{ $module->title }}</strong>.<br><br>
                                Proceed to your assessment and take the test in one sitting to complete this module.
                            </p>
                            <!--If none of the 2 conditions are true, show disabled button-->
                            <a href="{{ route('') }}">
                                <button class="module-btn bg-light-brown d-flex justify-content-center mt-2">
                                    Begin Test</button>
                            </a>
                        </div>
                    </div>
                </div>

            </div>

            <div class="col-lg-3 col-md-3 col-sm-12">
                <div class="bg-white-radius-shadow border-light-green p-0">
                    <h6 class="text-light-brown pb-2 border-bottom-grey pl-2 pt-2">
                        Modules
                    </h6>

                    @foreach($modules as $m)
                        @if(Auth::user()->startedModule($m->id))
                            @if(Auth::user()->startedModule($m->id)->status === 1)
                                <div class="p-2 @if($m->id === $module->id) bg-lemon-green @endif ">
                                <span class="text-inter na-text-dark-green tx-12">
                                    {{ $m->title }}
                                    <i class="fa fa-check na-text-light-green text-right ml-2"></i>
                                </span>
                                </div>
                            @else
                                <div class="p-2 @if($m->id === $module->id) bg-lemon-green @endif ">
                                <span class="text-inter na-text-dark-green tx-12">
                                    {{ $m->title }}
                                    <i class="fa fa-play na-text-light-green text-right ml-2"></i>
                                </span>
                                </div>
                            @endif
                        @else
                            <div class="p-2">
                                <span class="text-inter na-text-dark-green tx-12">
                                    {{ $m->title }}
                                    <i class="fa fa-lock na-text-light-green text-right ml-2"></i>
                                </span>
                            </div>
                        @endif
                    @endforeach

                    <div class="p-2 bg-very-light-brown">
                        <span class="text-inter na-text-dark-green tx-12">
                            Assessment
                            <i class="fa fa-list text-right ml-2"></i>
                        </span>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('bottom-assets')

@endsection
