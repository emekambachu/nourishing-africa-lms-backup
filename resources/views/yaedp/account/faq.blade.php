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
                <h5 class="na-text-dark-green text-manrope tx-md-bold">Get Help (LMS ON DEMAND HELP FOR STUDENTS)</h5>
                <p class="text-inter">Many of the frequently asked questions about the YEADP training are answered below. If you would like more information about a specific course or module, direct your questions to our email, <a class="na-text-dark-green" href="mailto:yaedp@nourishingafrica.com">YAEDP@nourishingafrica.com</a></p>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body text-inter shadow-2">
                        <h4 class="na-text-dark-green">Help for learners</h4>
                        <p>Watch Helpful how-to videos for students</p>
                        <p>Learn how to navigate the LMS portal</p>
                        <p>Find out more about the YAEDP program</p>
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
                                        The training runs for six weeks in different cohorts. All assessments must be completed within this period to enable you download your e-certificate.
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
                                        Each course assessment is due within the week for each module. Assessments for each course must be completed before proceeding to the next course/module.
                                    </div>
                                </div><!-- collapse -->
                            </div>

                            <div class="card">
                                <div class="card-header" id="headingThree" role="tab">
                                    <a aria-controls="collapseThree" aria-expanded="false" class="collapsed"
                                       data-toggle="collapse" href="#collapseFour">How many students are in my program? Will I be able to contact my classmates?</a>
                                </div>
                                <div aria-labelledby="headingThree" class="collapse" data-parent="#accordion"
                                     id="collapseFour" role="tabpanel">
                                    <div class="card-body">
                                        The training will be taken by different cohorts of participants, with up to 5,000 participants per cohort. Participants The learning platform provides a discussion forum which allows you to start/join relevant conversations with other students.
                                    </div>
                                </div><!-- collapse -->
                            </div>

                            <div class="card">
                                <div class="card-header" id="headingThree" role="tab">
                                    <a aria-controls="collapseThree" aria-expanded="false" class="collapsed"
                                       data-toggle="collapse" href="#collapseFive">
                                        Will I have access to my dashboard and course content after the 6-weeks period?</a>
                                </div>
                                <div aria-labelledby="headingThree" class="collapse" data-parent="#accordion"
                                     id="collapseFive" role="tabpanel">
                                    <div class="card-body">
                                        You will also have a 30-day read-only access to all the training content after its conclusion to review the course materials at your own leisure.
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
                                        For technical assistance, please go to how to for pre-recorded solutions to technical problems. We are always ready to help!
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
                        <p>Please visit the Q&A page to see some already answered questions by the instructors.<br><br>
                            If you do not find the answer you are looking for, send your questions directly using the ‘Ask the Instructor’ pop-up button that appears at the bottom right corner of each course page. </p>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
