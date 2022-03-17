@extends('yaedp.account.includes.layout')

@section('title')
    About YAEDP
@endsection

@section('top-assets')
@endsection

@section('content')
    <div class="container-fluid">

        <h4 class="font-large-inter text-light-brown">
            Welcome {{ Auth::user()->first_name }}
        </h4>

        <div class="row bg-white na-border-radius border-brown p-3 mb-3">
            <div class="col-10">
                <div style="margin-bottom: 70px;">
                    <h4 class="text-inter text-dark mb-1">
                        Are you ready to take your agri-food business to the next level?</h4>
                    <p class="text-inter text-gray tx-14">
                        The Youth in Agri-Food Export Development Program (YAEDP) training covers a robust curriculum that takes participants on a comprehensive learning journey from the conception of the Nigerian export market specific to key export value chains to successful entry to the international market.<br><br>
                        The six-module program is designed to take you from opportunity identification to quality product launch, growth, and financing. With guidance from top agri-food industry experts and export specialists, you will develop an improved entrepreneurial mindset to build a profitable and sustainable export businesses.</p>
                </div>
            </div>
            <div class="col-md-2">
                <img src="{{ asset('images/icons/404-bad-request.png') }}" style="width: 250px;"/>
            </div>
        </div>

        <div class="row bg-white na-border-radius border-brown p-3 mb-3">
            <div class="col-10">
                <div style="margin-bottom: 70px;">
                    <p class="text-inter text-gray tx-14">
                        <strong>How the training works</strong>
                        The YEADP training consists of a six-module, twenty courses program taught over a six-week interval. The training sessions are delivered by top expert trainers in the export industry and self-paced to give room for flexibility in your schedule. The portal includes discussion groups that allow you to interact directly with other learners on the platform as well as a Q&A feature that allows you to ask direct questions from the instructors.
                    </p>
                </div>
            </div>
            <div class="col-2">
                <img src="{{ asset('images/icons/online-course.png') }}" style="width: 120px;"/>
            </div>
        </div>

        <div class="row bg-white na-border-radius border-brown p-3 mb-3">
            <div class="col-10">
                <div style="margin-bottom: 70px;">
                    <p class="text-inter text-gray tx-14">
                        <strong>Hands-on Practical course</strong>
                        Every module of the curriculum contains courses. The courses have been carefully curated and come with assessments to ensure that you achieved the learning outcomes. The completion of the assessment unlocks the next level of learning. You will need to finish each of the courses in a module to move on to the next module.
                    </p>
                </div>
            </div>
            <div class="col-2">
                <img src="{{ asset('images/icons/course.png') }}" style="width: 120px;"/>
            </div>
        </div>

        <div class="row bg-white na-border-radius border-brown p-3 mb-3">
            <div class="col-10">
                <div style="margin-bottom: 70px;">
                    <p class="text-inter text-gray tx-14">
                        <strong>Earn a certificate</strong>
                        When you complete all the courses, modules and assessments, you will earn a certificate of completion that you can share with your professional network.
                    </p>
                </div>
            </div>
            <div class="col-2">
                <img src="{{ asset('images/icons/certificate.png') }}" style="width: 120px;"/>
            </div>
        </div>

    </div>
@endsection

@section('bottom-assets')
@endsection
