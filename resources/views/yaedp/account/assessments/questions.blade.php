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

                    <div class="col-12" id="loader">
                        <img class="assessment-loader d-none display-block"
                             src="{{ asset('images/icons/assessment-loader.png') }}"
                             width="200"/>
                    </div>

                    @include('yaedp.account.includes.alerts')

                    @if($modulePassed)
                        <h5 class="text-center mb-3">You've passed this module, go to next available module.</h5>
                        <a href="{{ route('yaedp.account.modules') }}">
                            <button style="width:100px;"
                                    class="module-btn bg-light-brown d-flex justify-content-center mt-2">
                                Modules</button>
                        </a>
                    @elseif($exhaustedRetakes)
                        <h5 class="text-center mb-3">Sorry, you've exhausted your retakes. Do better i other modules to get a better chance of success.</h5>
                        <a href="{{ route('yaedp.account.modules') }}">
                            <button style="width:100px;"
                                    class="module-btn bg-light-brown d-flex justify-content-center mt-2">
                                Modules</button>
                        </a>
                    @else
                        <form id="submit-form" method="post"
                          data-route="{{ route('yaedp.account.assessment.submit', $module->id) }}">
                        @csrf

                        <div class="row d-flex justify-content-center">
                            <div id="questions-container">
                                @foreach($questions as $quest)
                                    <div class="col-md-12 text-left ml-3 mb-4 mt-4">

                                        <h5 class="na-text-light-green text-inter mb-0">
                                            Question {{ $loop->iteration }}</h5>
                                        <p class="text-inter text-dark">{{ $quest->question }}</p>
                                        <input type="hidden" name="answers[{{ $loop->index }}][question_id]"
                                               value="{{ $quest->id }}">
                                        <input type="hidden" name="answers[{{ $loop->index }}][correct_answer]"
                                               value="{{ $quest->correct_answer }}">

                                        <div class="form-check">
                                            <input class="form-check-input" type="radio"
                                                   name="answers[{{ $loop->index }}][answer]" id="flexRadioDefault1"
                                                   value="{{ $quest->option_one }}" required>
                                            <label class="form-check-label text-dark" for="flexRadioDefault1">
                                                {{ $quest->option_one }}</label>
                                        </div>

                                        <div class="form-check">
                                            <input class="form-check-input" type="radio"
                                                   name="answers[{{ $loop->index }}][answer]" id="flexRadioDefault1"
                                                   value="{{ $quest->option_two }}">
                                            <label class="form-check-label text-dark" for="flexRadioDefault1">
                                                {{ $quest->option_two }}</label>
                                        </div>

                                        @if(!empty($quest->option_three))
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio"
                                                       name="answers[{{ $loop->index }}][answer]"
                                                       id="flexRadioDefault1"
                                                       value="{{ $quest->option_three }}">
                                                <label class="form-check-label text-dark" for="flexRadioDefault1">
                                                    {{ $quest->option_three }}</label>
                                            </div>
                                        @endif

                                        @if(!empty($quest->option_four))
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio"
                                                       name="answers[{{ $loop->index }}][answer]"
                                                       id="flexRadioDefault1"
                                                       value="{{ $quest->option_four }}">
                                                <label class="form-check-label text-dark" for="flexRadioDefault1">
                                                    {{ $quest->option_four }}</label>
                                            </div>
                                        @endif

                                        @if(!empty($quest->option_five))
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio"
                                                       name="answers[{{ $loop->index }}][answer]"
                                                       id="flexRadioDefault1"
                                                       value="{{ $quest->option_five }}">
                                                <label class="form-check-label text-dark" for="flexRadioDefault1">
                                                    {{ $quest->option_five }}</label>
                                            </div>
                                        @endif

                                        @if(!empty($quest->option_six))
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio"
                                                       name="answers[{{ $loop->index }}][answer]"
                                                       id="flexRadioDefault1"
                                                       value="{{ $quest->option_six }}">
                                                <label class="form-check-label text-dark" for="flexRadioDefault1">
                                                    {{ $quest->option_six }}</label>
                                            </div>
                                        @endif
                                    </div>
                                @endforeach
                                <button type="submit" style="width:100px;"
                                        class="module-btn bg-light-brown d-flex justify-content-center mt-2">
                                    Submit</button>
                            </div>

                        </div>
                    </form>
                    @endif

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
                </div>

            </div>
        </div>
    </div>
@endsection

@section('bottom-assets')
    <script src="{{ asset('learning-assets/custom/learning-submit-assessment.js') }}"></script>
@endsection
