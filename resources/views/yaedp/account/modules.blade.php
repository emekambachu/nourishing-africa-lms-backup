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
                <div class="bg-white-radius-shadow border-light-green">

                @if(Auth::user()->startedModule($mod->id))
                    @if(Auth::user()->startedModule($mod->id)->completed_module)
                        <span class="bg-badge-success badge badge-pill text-light-brown mb-2">
                        Completed
                        </span>
                    @else
                        <span class="bg-badge-warning badge badge-pill text-light-brown mb-2">
                        Ongoing
                        </span>
                    @endif
                @else
                    <span class="bg-badge-danger badge badge-pill text-light-brown mb-2">
                    Not Started
                   </span>
                @endif

                    <div class="module-grid-container pt-2">
{{--                        <span class="module-title">{{ $mod->title }}</span>--}}
                        <div class="bg-lemon-green p-2 module-grid-content">
                            {{ \Illuminate\Support\Str::limit($mod->description, $limit = 100, $end = '...') }}
                        </div>
                    </div>

                    <p class="na-text-dark-green mt-2 font-weight-bold">
                        {{ $mod->title }}
                    </p>

                    <!--If this item is not the first module, check if the previous module has been completed-->
                    <!--If the previous module has been completed, make the next module available-->
                    @if(!$loop->first)
                        @if(Auth::user()->startedModule($mod->previousModule()->id))
                            @if(Auth::user()->startedModule($mod->previousModule()->id)->completed_module)
                                <a href="{{ route('yaedp.account.courses', $mod->id) }}">
                                    <button class="module-btn bg-light-brown d-flex justify-content-center">
                                        Start</button>
                                </a>
                            @else
                                <button disabled class="module-btn bg-gray d-flex justify-content-center">
                                    Complete previous module to continue </button>
                            @endif
                        @else
                            <button disabled class="module-btn bg-gray d-flex justify-content-center">
                                Start previous module to continue </button>
                        @endif
                    @else
                        <a href="{{ route('yaedp.account.courses', $mod->id) }}">
                            <button class="module-btn bg-light-brown d-flex justify-content-center">
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
