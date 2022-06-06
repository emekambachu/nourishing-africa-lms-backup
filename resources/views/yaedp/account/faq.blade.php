@extends('yaedp.account.includes.layout')

@section('title')
    FAQ
@endsection

@section('top-assets')

@endsection

@section('content')
    <div class="container mb-4">

        <p class="bread-crumbs">
            <a href="{{ route('yaedp.account') }}">Dashboard</a> / <span class="light-green">FAQ</span>
        </p>

        <div class="mb-3">
            <h2 class="font-large-inter text-light-brown font-weight-bold">
                FAQ</h2>
        </div>

        <div class="row">
            <div class="col-md-12">
                <h5 class="na-text-dark-green text-manrope tx-md-bold">Get Help</h5>
                <p class="text-inter">Many of the frequently asked questions about the YEADP training are answered below. If you would like more information about a specific course or module, direct your questions to our email, <a class="na-text-dark-green" href="mailto:yaedp@nourishingafrica.com">YAEDP@nourishingafrica.com</a></p>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body text-inter shadow-2">
                        <h4 class="na-text-dark-green">Help for learners</h4>
                        <p><a href="{{ route('yaedp.account.self-help') }}">
                                Watch self-help videos</a></p>
                        <p><a href="{{ route('yaedp.account.about-program') }}">
                                Find out more about the YAEDP program</a></p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="card">
                    <div class="card-body shadow-2">
                        <div>
                            <h4 class="na-text-dark-green">How it works: the online learning experience</h4>
                        </div>
                        <div aria-multiselectable="true" class="accordion" id="accordion" role="tablist">

                            <div class="card">
                                <div class="card-header" id="headingOne" role="tab">
                                    <a aria-controls="collapseOne" aria-expanded="false" data-toggle="collapse"
                                       href="#collapseOne" class="collapsed">How long is this training program?</a>
                                </div>
                                <div aria-labelledby="headingOne" class="collapse" data-parent="#accordion"
                                     id="collapseOne" role="tabpanel" style="">
                                    <div class="card-body">
                                        The training runs for six weeks. The training ends at 23:59 WAT on Sunday, 16 July 2022. You should have completed all modules and assessments within this 6-week period.
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-header" id="headingTwo" role="tab">
                                    <a aria-controls="collapseTwo" aria-expanded="false" class="collapsed"
                                       data-toggle="collapse" href="#collapseTwo">How long is each module?</a>
                                </div>
                                <div aria-labelledby="headingTwo" class="collapse" data-parent="#accordion"
                                     id="collapseTwo" role="tabpanel" style="">
                                    <div class="card-body">
                                        Each module consists of 3 – 5 courses delivered through individual instructor’s training videos, each about 25-minutes long. Participants therefore need to dedicate between 1 – 3 hours each week to complete a module.
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-header" id="headingThree" role="tab">
                                    <a aria-controls="collapseThree" aria-expanded="false" class="collapsed"
                                       data-toggle="collapse" href="#collapseThree">When are the assessment due?</a>
                                </div>
                                <div aria-labelledby="headingThree" class="collapse" data-parent="#accordion"
                                     id="collapseThree" role="tabpanel">
                                    <div class="card-body">
                                        Each course assessment is due within the week for each module. Assessments for each module must be completed before proceeding to the next module.
                                    </div>
                                </div><!-- collapse -->
                            </div>

                            <div class="card">
                                <div class="card-header" id="headingThree" role="tab">
                                    <a aria-controls="collapseThree" aria-expanded="false" class="collapsed"
                                       data-toggle="collapse" href="#collapseFour">
                                        Will I be able to contact other participants taking this training?</a>
                                </div>
                                <div aria-labelledby="headingThree" class="collapse" data-parent="#accordion"
                                     id="collapseFour" role="tabpanel">
                                    <div class="card-body">
                                        The e-learning platform provides a discussion forum which allows you to start/join relevant conversations with other participants. Please navigate to the course page and click on ‘Discussion Forum’ to participate.
                                    </div>
                                </div><!-- collapse -->
                            </div>

                            <div class="card">
                                <div class="card-header" id="headingThree" role="tab">
                                    <a aria-controls="collapseThree" aria-expanded="false" class="collapsed"
                                       data-toggle="collapse" href="#collapseFive">
                                        Will I have access to my dashboard and training content after the training ends?</a>
                                </div>
                                <div aria-labelledby="headingThree" class="collapse" data-parent="#accordion"
                                     id="collapseFive" role="tabpanel">
                                    <div class="card-body">
                                        Yes, all participants will have a 30-day read-only access to all the training content after the training ends.
                                    </div>
                                </div><!-- collapse -->
                            </div>

                            <div class="card">
                                <div class="card-header" id="headingThree" role="tab">
                                    <a aria-controls="collapseThree" aria-expanded="false" class="collapsed"
                                       data-toggle="collapse" href="#collapseEight">
                                        Are the assessments timed?</a>
                                </div>
                                <div aria-labelledby="headingThree" class="collapse" data-parent="#accordion"
                                     id="collapseEight" role="tabpanel">
                                    <div class="card-body">
                                        No, assessments are not timed. You can complete the assessments at your pace. However, participants must complete the previous module assessment before they can proceed to the next module.
                                    </div>
                                </div><!-- collapse -->
                            </div>

                            <div class="card">
                                <div class="card-header" id="headingThree" role="tab">
                                    <a aria-controls="collapseNine" aria-expanded="false" class="collapsed"
                                       data-toggle="collapse" href="#collapseTen">
                                        Can I re-watch previous modules?</a>
                                </div>
                                <div aria-labelledby="headingThree" class="collapse" data-parent="#accordion"
                                     id="collapseTen" role="tabpanel">
                                    <div class="card-body">
                                        Yes. You can re-watch completed videos by simply going back to the selected course and replaying it.
                                    </div>
                                </div><!-- collapse -->
                            </div>

                            <div class="card">
                                <div class="card-header" id="headingThree" role="tab">
                                    <a aria-controls="collapseNine" aria-expanded="false" class="collapsed"
                                       data-toggle="collapse" href="#collapseEleven">
                                        I am having trouble playing the videos</a>
                                </div>
                                <div aria-labelledby="headingThree" class="collapse" data-parent="#accordion"
                                     id="collapseEleven" role="tabpanel">
                                    <div class="card-body">
                                        Please check your internet connection and try again.
                                    </div>
                                </div><!-- collapse -->
                            </div>

                            <div class="card">
                                <div class="card-header" id="headingThree" role="tab">
                                    <a aria-controls="collapseTwelve" aria-expanded="false" class="collapsed"
                                       data-toggle="collapse" href="#collapseTwelve">
                                        I keep getting a server error code while trying to log in.</a>
                                </div>
                                <div aria-labelledby="headingThree" class="collapse" data-parent="#accordion"
                                     id="collapseTwelve" role="tabpanel">
                                    <div class="card-body">
                                        Please try clearing your browser cookies and log in again. For an optimal learning experience, we recommend that you use Mozilla Firefox or Google Chrome browsers.
                                    </div>
                                </div><!-- collapse -->
                            </div>

                            <div class="card">
                                <div class="card-header" id="headingThree" role="tab">
                                    <a aria-controls="collapseThirteen" aria-expanded="false" class="collapsed"
                                       data-toggle="collapse" href="#collapseThirteen">
                                        I am taken to an Error 400 page when I try to load a new page. What should I do?
                                    </a>
                                </div>
                                <div aria-labelledby="headingThree" class="collapse" data-parent="#accordion"
                                     id="collapseThirteen" role="tabpanel">
                                    <div class="card-body">
                                        This is most likely a browser issue. Please clear your cookies/cache in your browser settings and refresh the page to proceed.
                                    </div>
                                </div><!-- collapse -->
                            </div>

                            <div class="card">
                                <div class="card-header" id="headingThree" role="tab">
                                    <a aria-controls="collapseFifteen" aria-expanded="false" class="collapsed"
                                       data-toggle="collapse" href="#collapseFifteen">
                                        Can I retake the assessments
                                    </a>
                                </div>
                                <div aria-labelledby="headingThree" class="collapse" data-parent="#accordion"
                                     id="collapseFifteen" role="tabpanel">
                                    <div class="card-body">
                                        Yes, participants can retake the assessment twice after the initial try. Note that your most recent score for each assessment will be regarded as your final score for that module and will count towards your overall grade.
                                    </div>
                                </div><!-- collapse -->
                            </div>

                            <div class="card">
                                <div class="card-header" id="headingThree" role="tab">
                                    <a aria-controls="collapseThree" aria-expanded="false" class="collapsed"
                                       data-toggle="collapse" href="#collapseSix">
                                        How do I contact technical support? </a>
                                </div>
                                <div aria-labelledby="headingThree" class="collapse" data-parent="#accordion"
                                     id="collapseSix" role="tabpanel">
                                    <div class="card-body">
                                        Kindly watch the self-help videos and read through the questions on this FAQ page for responses to some common technical issues. You may also contact us at YAEDP@nourishingafrica.com if you experience any further technical issues.
                                    </div>
                                </div><!-- collapse -->
                            </div>

                        </div><!-- accordion -->
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body text-inter shadow-2">
                        <h4 class="na-text-dark-green">Questions about your courses</h4>
                        <p>Please visit the discussion forum to see some already answered questions by other students and course instructors.</p>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
