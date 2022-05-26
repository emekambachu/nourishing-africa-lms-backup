@extends('includes.layout')

@section('title')
    Terms of use
@endsection

@section('meta-tags')

    <meta name="description" content="Nourishing Africa | Terms of Use"/>
    <meta name="keywords" content="Nourishing Africa, Terms of Use"/>

    <meta name="robots" content="max-snippet:-1, max-image-preview:large, max-video-preview:-1"/>
    <link rel="canonical" href="{{ Request::fullUrl() }}" />

    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="Nourishing Africa | YAEDP | Terms of Use" />
    <meta property="og:description" content="Nourishing Africa | YAEDP | Terms of Use" />
    <meta property="og:url" content="{{ Request::fullUrl() }}" />
    <meta property="og:site_name" content="Nourishing Africa" />

    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:description" content="Nourishing Africa | YAEDP | Terms of Use" />
    <meta name="twitter:title" content="Nourishing Africa | YAEDP | Terms of Use" />
    <meta name="twitter:site" content="@nourish_africa" />
    <meta name="twitter:creator" content="@nourish_africa" />

    <script type='application/ld+json' class='yoast-schema-graph yoast-schema-graph--main'>
    {
   "@context":"https://schema.org",
   "@graph":[
      {
         "@type":"Organization",
         "@id":"https://nourishingafrica.com/#organization",
         "name":"Nourishing Africa",
         "url":"https://nourishingafrica.com/",
         "sameAs":[
            "https://www.facebook.com/nourishafrica1",
            "https://instagram.com/nourish_africa",
            "https://www.linkedin.com/company/28506256",
            "https://twitter.com/nourish_africa"
         ],
         "logo":{
            "@type":"ImageObject",
            "@id":"https://nourishingafrica.com/#logo",
            "url":"https://nourishingafrica.com/wp-content/uploads/2019/04/NA-1-Official.png",
            "width":848,
            "height":519,
            "caption":"Nourishing Africa"
         },
         "image":{
            "@id":"https://nourishingafrica.com/#logo"
         }
      },
      {
         "@type":"WebSite",
         "@id":"https://nourishingafrica.com/#website",
         "url":"https://nourishingafrica.com/",
         "name":"Nourishing Africa",
         "description":"Nourishing Africa | YAEDP | Terms of Use",
         "publisher":{
            "@id":"https://nourishingafrica.com/#organization"
         },
         "potentialAction":{
            "@type":"SearchAction",
            "target":"https://nourishingafrica.com/?s={search_term_string}",
            "query-input":"required name=search_term_string"
         }
      },
      {
         "@type":"WebPage",
         "@id":"https://nourishingafrica.com/#webpage",
         "url":"{{ Request::fullUrl() }}",
         "inLanguage":"en-US",
         "name":"Nourishing Africa | YAEDP | Terms of Use",
         "isPartOf":{
            "@id":"https://nourishingafrica.com/#website"
         },
         "about":{
            "@id":"https://nourishingafrica.com/#organization"
         },
         "datePublished":"2019-12-03T12:51:31+00:00",
         "dateModified":"2020-02-07T15:22:22+00:00",
         "description":"Nourishing Africa | YAEDP | Terms of Use"
      }
   ]
}
</script>
@stop

@section('title')
    Terms of Use
@stop

@section('top-assets')
    <style>
        .privacy-policy-accordion-header{
            background: #046B60;
            color: #fff;
            border-radius: 0;
            padding: 18px 28px 19px;
        }

        .privacy-policy-accordion-body{
            background: #eeeded;
            padding: 35px 28px 25px;
            border-top: none;
        }

        .justify-text{
            text-align: justify;
            text-justify: inter-word;
        }
    </style>
@stop

@section('content')
    <section class="wow fadeIn parallax padding-four-bottom padding-four-top"
             data-stellar-background-ratio="0.5"
             style="background-image: url(&quot;{{ asset('images/banners/privacy_policy_banner.jpg') }}&quot;);
             visibility: visible; animation-name: fadeIn;">
        <div class="opacity-medium bg-extra-dark-gray"></div>
        <div class="container">
            <div class="row align-items-center">
                <div class="col-12 d-flex flex-column justify-content-center text-center extra-small-screen page-title-large">
                    <!-- start page title -->
                    <h1 class="text-white-2 text-center alt-font font-weight-500 letter-spacing-minus-1 margin-10px-bottom">Terms of Use</h1>
                    <!-- end page title -->
                </div>
            </div>
        </div>
    </section>

    <section class="wow fadeIn padding-20px-tb border-bottom bg-brand-color"
             style="visibility: visible; animation-name: fadeIn;">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 breadcrumb alt-font text-small">
                    <!-- breadcrumb -->
                    <ul>
                        <li><a href="{{ url('/') }}" class="text-light text-small">Home</a></li>
                        <li><a href="javascript:void(0)" class="text-light text-small">Terms of Use</a></li>
                    </ul>
                    <!-- end breadcrumb -->
                </div>
            </div>
        </div>
    </section>

    <section class="wow fadeIn padding-three-top" style="visibility: visible; animation-name: fadeIn;">
        <div class="container">

            <div class="row">
                <div class="col-md-12">
                    <p style="font-size: 16px;" class="brand-text">Last updated: May 2022 </p>
                    <p class="justify-text">
                        Terms of Use of the Nourishing Africa Learning Management System<br><br>
                        The Nourishing Africa Learning Management System (“LMS”, “Portal”) offers products and services provided by Nourishing Africa Limited, (“Nourishing Africa"). These Terms of Use ("Terms") govern your use of our website, apps, and other products and services ("Services").<br>
                        As some of our Services may be software that is downloaded to your computer, phone, tablet, or other device, you agree that we may automatically update this software, and that these Terms will apply to such updates. Please read these Terms carefully, and contact us if you have any questions, requests for information, or complaints. By clicking “I accept” and by using our Services, you agree to be bound by these Terms, including the policies referenced in these Terms.
                    </p>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-12 col-lg-12">
                    <!-- start accordion -->
                    <div class="panel-group accordion-style3" id="accordion-3">
                        <!-- start tab content -->
                        <div class="panel panel-default">
                            <div class="privacy-policy-accordion-header">
                                <a class="accordion-toggle" data-toggle="collapse"
                                   data-parent="#accordion-3" href="#accordion-3-One">
                                    <div class="panel-title">
                                        <span class="text-white-2 sm-width-80 d-inline-block">
                                            A. Who may use our services</span>
                                        <i class="fas fa-angle-up float-right"></i>
                                    </div>
                                </a>
                            </div>

                            <div id="accordion-3-One" class="panel-collapse collapse show" data-parent="#accordion-3">
                                <div class="privacy-policy-accordion-body">
                                    <p class="justify-text">You may use this Service only if you have been granted exclusive access by Nourishing Africa, and only in compliance with these Terms and all applicable laws. When you create your profile account on the Portal, and subsequently when you use certain features, you must provide us with accurate and complete information, and you agree to update your information to keep it accurate and complete. Any use or access by anyone under the age of 18 is prohibited, and certain regions and Content Offerings may have additional requirements and/or restrictions.</p>
                                </div>
                            </div>
                        </div>
                        <!-- end tab content -->

                        <!-- start tab content -->
                        <div class="panel panel-default">
                            <div class="privacy-policy-accordion-header">
                                <a class="accordion-toggle" data-toggle="collapse"
                                   data-parent="#accordion-3" href="#accordion-3-Two">
                                    <div class="panel-title">
                                        <span class="text-white-2 sm-width-80 d-inline-block">
                                            B. Our License to You</span>
                                        <i class="indicator fas fa-angle-down float-right"></i>
                                    </div>
                                </a>
                            </div>
                            <div id="accordion-3-Two" class="panel-collapse collapse" data-parent="#accordion-3">
                                <div class="privacy-policy-accordion-body">
                                    <p class="justify-text">
                                        Subject to these Terms and our policies (including the Use Policy, Honour Code, course-specific eligibility requirements, and other terms), we grant you a limited, personal, non-exclusive, non-transferable, and revocable license to use our Services. You may download content from our Services only for your personal, non-commercial use, unless you obtain our written permission to otherwise use the content.<br>
                                        You also agree that you will create, access, and/or use only one user account, unless expressly permitted by Nourishing Africa, and you will not share access to your account or access information for your account with any third party. Using our Services does not give you ownership of or any intellectual property rights in our Services or the content you access.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <!-- end tab content -->

                        <!-- start tab content -->
                        <div class="panel panel-default">
                            <div class="privacy-policy-accordion-header">
                                <a class="accordion-toggle" data-toggle="collapse"
                                   data-parent="#accordion-3" href="#accordion-3-Three">
                                    <div class="panel-title">
                                        <span class="text-white-2 sm-width-80 d-inline-block">
                                            C. Consent Offerings</span>
                                        <i class="indicator fas fa-angle-down float-right"></i>
                                    </div>
                                </a>
                            </div>
                            <div id="accordion-3-Three" class="panel-collapse collapse" data-parent="#accordion-3">
                                <div class="privacy-policy-accordion-body">
                                    <p class="justify-text">
                                        1.	Nourishing Africa offers courses and content ("Content Offerings") provided by expert Instructors, trainers or other providers ("Content Providers"). In these Terms of Use, ‘Content’ refers to all the content available on the Portal, including funding courses, videos, eBooks, and user materials.<br>
                                        2.	Sources of this Content may come from third-party websites or Nourishing Africa partner organizations. Nourishing Africa does not take responsibility for the content of any commentary/posts/links, etc., generated by users on any portion of the Portal.<br>
                                        3.	While we seek to provide world-class Content Offerings from our Content Providers, if unexpected events do occur, Nourishing Africa reserves the right to cancel, interrupt, reschedule, or modify any Content Offerings, or change the point value or weight of any assignment, quiz, or other assessment, either solely, or in accordance with Content Provider instructions. Content Offerings are subject to the Disclaimers and Limitation of Liability sections below.<br>
                                        4.	Nourishing Africa does not grant academic credit for the completion of Content Offerings. Unless otherwise explicitly indicated by a credit-granting institution, participation in or completion of Content Offerings does not confer any academic credit. Even if credit is awarded by one institution, there is no presumption that other institutions will accept that credit. Nourishing Africa and the associated Content Providers have no obligation to have Content Offerings recognized by any educational institution or accreditation organization.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <!-- end tab content -->

                        <!-- start tab content -->
                        <div class="panel panel-default">
                            <div class="privacy-policy-accordion-header">
                                <a class="accordion-toggle" data-toggle="collapse"
                                   data-parent="#accordion-3" href="#accordion-3-Four">
                                    <div class="panel-title">
                                        <span class="text-white-2 sm-width-80 d-inline-block">
                                            D. Operation of the portal</span>
                                        <i class="indicator fas fa-angle-down float-right"></i>
                                    </div>
                                </a>
                            </div>
                            <div id="accordion-3-Four" class="panel-collapse collapse" data-parent="#accordion-3">
                                <div class="privacy-policy-accordion-body">
                                    <p class="justify-text">
                                        1.	Nourishing Africa reserves the right to suspend or terminate the operation of the Portal at any time for the purposes of support and maintenance or to update the information contained on the Website.<br>
                                        2.	Nourishing Africa is not obliged to give any notice of such termination or suspension.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <!-- end tab content -->

                        <!-- start tab content -->
                        <div class="panel panel-default">
                            <div class="privacy-policy-accordion-header">
                                <a class="accordion-toggle" data-toggle="collapse"
                                   data-parent="#accordion-3" href="#accordion-3-Five">
                                    <div class="panel-title">
                                        <span class="text-white-2 sm-width-80 d-inline-block">
                                            E. User Content</span>
                                        <i class="indicator fas fa-angle-down float-right"></i>
                                    </div>
                                </a>
                            </div>
                            <div id="accordion-3-Five" class="panel-collapse collapse" data-parent="#accordion-3">
                                <div class="privacy-policy-accordion-body">
                                    <p class="justify-text">
                                        The Services enable you to share your content, such as homework, quizzes, exams, projects, other assignments you submit, posts you make in the forums, and the like ("User Content"), with Nourishing Africa, instructors, and/or other users. You retain all intellectual property rights in, and are responsible for, the User Content you create and share.<br>
                                        User Content does not include course content or other materials made available on or placed on to the Portal by or on behalf of Nourishing Africa and the Content Providers using the Services or Content Offerings. As between Nourishing Africa and Content Providers, such Content Offerings are governed by the relevant agreements in place between Nourishing Africa and Content Providers.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <!-- end tab content -->

                        <!-- start tab content -->
                        <div class="panel panel-default">
                            <div class="privacy-policy-accordion-header">
                                <a class="accordion-toggle" data-toggle="collapse"
                                   data-parent="#accordion-3" href="#accordion-3-six">
                                    <div class="panel-title">
                                        <span class="text-white-2 sm-width-80 d-inline-block">
                                           F. How Nourishing Africa and Others May Use User Content</span>
                                        <i class="indicator fas fa-angle-down float-right"></i>
                                    </div>
                                </a>
                            </div>
                            <div id="accordion-3-six" class="panel-collapse collapse" data-parent="#accordion-3">
                                <div class="privacy-policy-accordion-body">
                                    <p class="justify-text">
                                        To the extent that you provide User Content, you grant Nourishing Africa a fully transferable, royalty-free, perpetual, sublicensable, non-exclusive, worldwide license to copy, distribute, modify, create derivative works based on, publicly perform, publicly display, and otherwise use the User Content.<br>
                                        This license includes granting Nourishing Africa the right to authorize Content Providers to use User Content with their registered users. We reserve the right to remove or modify User Content for any reason, including User Content that we believe violates these Terms or other policies including our Acceptable Use Policy and Code of Conduct.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <!-- end tab content -->

                        <!-- start tab content -->
                        <div class="panel panel-default">
                            <div class="privacy-policy-accordion-header">
                                <a class="accordion-toggle" data-toggle="collapse"
                                   data-parent="#accordion-3" href="#accordion-3-seven">
                                    <div class="panel-title">
                                        <span class="text-white-2 sm-width-80 d-inline-block">
                                           G. Feedback</span>
                                        <i class="indicator fas fa-angle-down float-right"></i>
                                    </div>
                                </a>
                            </div>
                            <div id="accordion-3-seven" class="panel-collapse collapse" data-parent="#accordion-3">
                                <div class="privacy-policy-accordion-body">
                                    <p class="justify-text">
                                        We welcome your suggestions, ideas, comments, and other feedback regarding the Services ("Feedback"). By submitting any Feedback, you grant us the right to use the Feedback without any restriction or any compensation to you. By accepting your Feedback, Nourishing Africa does not waive any rights to use similar or related Feedback previously known to Nourishing Africa, developed by our employees, contractors, or obtained from other sources.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <!-- end tab content -->

                        <!-- start tab content -->
                        <div class="panel panel-default">
                            <div class="privacy-policy-accordion-header">
                                <a class="accordion-toggle" data-toggle="collapse"
                                   data-parent="#accordion-3" href="#accordion-3-eight">
                                    <div class="panel-title">
                                        <span class="text-white-2 sm-width-80 d-inline-block">
                                           H. Security</span>
                                        <i class="indicator fas fa-angle-down float-right"></i>
                                    </div>
                                </a>
                            </div>
                            <div id="accordion-3-eight" class="panel-collapse collapse" data-parent="#accordion-3">
                                <div class="privacy-policy-accordion-body">
                                    <p class="justify-text">
                                        We care about the security of our users. While we work to protect the security of your account and related information, Nourishing Africa cannot guarantee that unauthorized third parties will not be able to defeat our security measures. Please notify us immediately of any compromise or unauthorized use of your account by emailing YAEDP@nourishingafrica.com
                                    </p>
                                </div>
                            </div>
                        </div>
                        <!-- end tab content -->

                        <!-- start tab content -->
                        <div class="panel panel-default">
                            <div class="privacy-policy-accordion-header">
                                <a class="accordion-toggle" data-toggle="collapse"
                                   data-parent="#accordion-3" href="#accordion-3-nine">
                                    <div class="panel-title">
                                        <span class="text-white-2 sm-width-80 d-inline-block">
                                           I. User code of conduct</span>
                                        <i class="indicator fas fa-angle-down float-right"></i>
                                    </div>
                                </a>
                            </div>
                            <div id="accordion-3-nine" class="panel-collapse collapse" data-parent="#accordion-3">
                                <div class="privacy-policy-accordion-body">
                                    <p class="justify-text">
                                        1.	All Users of the Portal will be expected to be guided by the principles of integrity, trust and confidentiality.<br>
                                        2.	Users may not transmit any chain letters or junk email to any other User or any other person associated with the Portal. Illegal and/or unauthorized use of the Portal, including collecting the name, email address or any other personal or confidential information of any User or any other person by electronic or other means for any reason, including, without limitation, the purpose of sending unsolicited email and unauthorized framing of or linking to the Website, will be investigated and appropriate legal action may be taken.<br>
                                        3.	It is a violation of these Terms to use the Portal or any information obtained from the Website in order to: (i) harass, abuse, or harm another person (including, but not limited to, using profanity in messages or joining collaborator teams in bad faith), (ii) contact, advertise to, solicit, or sell to any User or other person without their prior explicit consent. In order to protect such persons, Nourishing Africa reserves the right to remove content from Users that violates the acceptable use and place restriction on the violating User's account at Nourishing Africa's sole and absolute discretion.<br>
                                        4.	Users shall not use the Portal or its content to post or submit content (including but not limited to, written materials or images) at any time for any purpose that in Nourishing Africa's opinion is unlawful, prohibited, threatening, abusive, defamatory, libelous, invasive of privacy or publicity rights, hateful or offensive on racial, ethnic, sexual or any other grounds, vulgar, obscene, profane or otherwise objectionable, which encourages conduct that would constitute a criminal offence, gives rise to civil liability or otherwise violates any law. Users shall comply with any applicable local, state, national or international statutes, rules, regulations, ordinances, decrees, laws, codes, orders, regulations or treaties when using the Portal.<br>
                                        5.	Other than as expressly outlined in these Terms, Users may not reproduce, republish, upload, post, modify, copy, alter, distribute, sell, resell, transmit, transfer, decompile, license, assign, publish or exploit, in any way, any Content on the Portal without the express written permission of Nourishing Africa and the copyright owner. No changes in or deletion of author attribution, trademark legend or copyright notice shall be made, and no ownership rights shall be transferred in the event of any permitted copying, redistribution or publication of copyrighted material.<br>
                                        6.	The Portal includes features and functionalities whereby a User may post and transmit information, images and other materials. All such information, images and materials, whether publicly posted or publicly or privately transmitted, are the sole responsibility of the Member who originates such content. Nourishing Africa reserves the right to remove or refuse to post or distribute any content and restrict, suspend, or terminate the participation of any Member from the Portal and from all Nourishing Africa Services at any time, with or without prior notice.<br>
                                        7.	Users are prohibited from sharing their password, letting a third party have access to their account, doing anything that may put their account at risk, attempting to access any other user's account, breaking or circumventing our authentication or security measures or otherwise test the vulnerability of our systems or networks, trying to reverse engineer any portion of our Services, trying to interfere with any user, host, or network, for example by sending a virus, overloading, spamming, or mail-bombing, using our Services to distribute malware, impersonating or misrepresenting your affiliation with any person or entity, or encouraging or helping anyone do any of the things on this list.<br>
                                        8.	Users also agree to abide by the following code:<br>
                                        a)	I will register with only one account, unless expressly permitted to register for additional accounts by Nourishing Africa.<br>
                                        b)	My answers to assignment, quizzes, exams, projects, and other assignments will be my own work (except for assignments that explicitly permit collaboration) as specified in the Nourishing Africa.<br>
                                        c)	I will not make solutions to quizzes, exams, projects, and other assignments available to anyone else (except to the extent an assignment explicitly permits sharing solutions). This includes both solutions written by me, as well as any solutions provided by the course staff or others.<br>
                                        d)	I will not engage in any other activities that will dishonestly improve my results or dishonestly improve or hurt the results of others.<br>
                                        9.	Any violation of this code may result in your access to all or part of the Services being suspended, disabled, or terminated. Specific Content Offerings may have additional rules and requirements.

                                    </p>
                                </div>
                            </div>
                        </div>
                        <!-- end tab content -->

                        <!-- start tab content -->
                        <div class="panel panel-default">
                            <div class="privacy-policy-accordion-header">
                                <a class="accordion-toggle" data-toggle="collapse"
                                   data-parent="#accordion-3" href="#accordion-3-ten">
                                    <div class="panel-title">
                                        <span class="text-white-2 sm-width-80 d-inline-block">
                                           J. Copyright and trademark policy</span>
                                        <i class="indicator fas fa-angle-down float-right"></i>
                                    </div>
                                </a>
                            </div>
                            <div id="accordion-3-ten" class="panel-collapse collapse" data-parent="#accordion-3">
                                <div class="privacy-policy-accordion-body">
                                    <p class="justify-text">
                                        Nourishing Africa respects the intellectual property rights of our Content Providers, Users, and other third parties and expects our users to do the same when using the Services. We reserve the right to suspend, disable, or terminate the accounts of users who repeatedly infringe or are repeatedly charged with infringing the copyrights, trademarks, or other intellectual property rights of others.<br>
                                        If you believe in good faith that materials on the Nourishing Africa Portal infringe your copyright, you may send us a notice requesting that the material be removed or access to it blocked.<br>
                                        We suggest that you consult your legal advisor before filing a notice. Also, be aware that there can be penalties for false claims.<br>
                                        The official emblem or logo of Nourishing Africa, shall not, under any circumstances, be used without Nourishing Africa’s prior written consent, nor represent or imply an association or affiliation with Nourishing Africa.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <!-- end tab content -->

                        <!-- start tab content -->
                        <div class="panel panel-default">
                            <div class="privacy-policy-accordion-header">
                                <a class="accordion-toggle" data-toggle="collapse"
                                   data-parent="#accordion-3" href="#accordion-3-eleven">
                                    <div class="panel-title">
                                        <span class="text-white-2 sm-width-80 d-inline-block">
                                           K. Third party consent</span>
                                        <i class="indicator fas fa-angle-down float-right"></i>
                                    </div>
                                </a>
                            </div>
                            <div id="accordion-3-eleven" class="panel-collapse collapse" data-parent="#accordion-3">
                                <div class="privacy-policy-accordion-body">
                                    <p class="justify-text">
                                        Through the Services, you will have the ability to access and/or use content provided by Content Providers, other users, and/or other third parties and links to websites and services maintained by third parties. Nourishing Africa cannot guarantee that such third-party content, in the Services or elsewhere, will be free of material you may find objectionable or otherwise inappropriate or of malware or other contaminants that may harm your computer, mobile device, or any files therein. Nourishing Africa disclaims any responsibility or liability related to your access or use of, or inability to access or use, such third-party content.<br>
                                        Our Content Providers and integrated service providers are third party beneficiaries of the Terms and may enforce those provisions of the Terms that relate to them. (in what context do you want them to enforce terms that relate to them? Lets discuss)

                                    </p>
                                </div>
                            </div>
                        </div>
                        <!-- end tab content -->

                        <!-- start tab content -->
                        <div class="panel panel-default">
                            <div class="privacy-policy-accordion-header">
                                <a class="accordion-toggle" data-toggle="collapse"
                                   data-parent="#accordion-3" href="#accordion-3-twelve">
                                    <div class="panel-title">
                                        <span class="text-white-2 sm-width-80 d-inline-block">
                                           L. Copyright and Trademark</span>
                                        <i class="indicator fas fa-angle-down float-right"></i>
                                    </div>
                                </a>
                            </div>
                            <div id="accordion-3-twelve" class="panel-collapse collapse" data-parent="#accordion-3">
                                <div class="privacy-policy-accordion-body">
                                    <p class="justify-text">
                                        Nourishing Africa respects the intellectual property rights of our users, Content Providers, and other third parties and expects our users to do the same when using the Services. We have adopted and implemented the Nourishing Africa Copyright and Trademark Policy below in accordance with applicable law, including the Digital Millennium Copyright Act.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <!-- end tab content -->

                        <!-- start tab content -->
                        <div class="panel panel-default">
                            <div class="privacy-policy-accordion-header">
                                <a class="accordion-toggle" data-toggle="collapse"
                                   data-parent="#accordion-3" href="#accordion-3-thirteen">
                                    <div class="panel-title">
                                        <span class="text-white-2 sm-width-80 d-inline-block">
                                           M. Modification of Terms</span>
                                        <i class="indicator fas fa-angle-down float-right"></i>
                                    </div>
                                </a>
                            </div>
                            <div id="accordion-3-thirteen" class="panel-collapse collapse" data-parent="#accordion-3">
                                <div class="privacy-policy-accordion-body">
                                    <p class="justify-text">
                                        Nourishing Africa may modify these Terms in its sole discretion from time to time, and such modifications shall automatically become part of these Terms and shall be effective once posted by Nourishing Africa on the Portal. Users’ use of the Portal will be subject to any such modifications.<br>
                                        For any material changes to the Terms, we will take reasonable steps to notify you of such changes, via a banner on the website, email notification, another method, or combination of methods. In all cases, your continued use of the Services after publication of such changes, with or without notification, constitutes binding acceptance of the revised Terms.<br>
                                        All Users should review the Portal and these Terms from time to time for any modifications. Neither the course of conduct between parties nor trade practice shall act or be deemed to modify any provision of these Terms.

                                    </p>
                                </div>
                            </div>
                        </div>
                        <!-- end tab content -->

                        <!-- start tab content -->
                        <div class="panel panel-default">
                            <div class="privacy-policy-accordion-header">
                                <a class="accordion-toggle" data-toggle="collapse"
                                   data-parent="#accordion-3" href="#accordion-3-fourteen">
                                    <div class="panel-title">
                                        <span class="text-white-2 sm-width-80 d-inline-block">
                                           N. Termination</span>
                                        <i class="indicator fas fa-angle-down float-right"></i>
                                    </div>
                                </a>
                            </div>
                            <div id="accordion-3-fourteen" class="panel-collapse collapse" data-parent="#accordion-3">
                                <div class="privacy-policy-accordion-body">
                                    <p class="justify-text">
                                        We are constantly changing and improving our Services. We may add or remove functions, features, or requirements, and we may suspend (to the extent allowed by applicable law) or stop part of our Services altogether. Accordingly, Nourishing Africa has the right to terminate any User’s account if found to be in violation of these Terms.<br>
                                        We may not be able to deliver the Services to certain regions or countries for various reasons, due to applicable export control requirements or internet access limitations and restrictions from governing authorities. None of Nourishing Africa, its Content Providers, its contributors, sponsors, and other business partners, and their employees, contractors, and other agents (the "Nourishing Africa Parties") shall have any liability to you for any such action. You can stop using our Services at any time.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <!-- end tab content -->

                        <!-- start tab content -->
                        <div class="panel panel-default">
                            <div class="privacy-policy-accordion-header">
                                <a class="accordion-toggle" data-toggle="collapse"
                                   data-parent="#accordion-3" href="#accordion-3-fifteen">
                                    <div class="panel-title">
                                        <span class="text-white-2 sm-width-80 d-inline-block">
                                           O. Disclaimers</span>
                                        <i class="indicator fas fa-angle-down float-right"></i>
                                    </div>
                                </a>
                            </div>
                            <div id="accordion-3-fifteen" class="panel-collapse collapse" data-parent="#accordion-3">
                                <div class="privacy-policy-accordion-body">
                                    <p class="justify-text">
                                        To the maximum extent permitted by law, the services and all included content are provided on an "as is" basis without warranty of any kind, whether express or implied. The Nourishing Africa Parties specifically disclaim any and all warranties and conditions of merchantability, fitness for a particular purpose, and non-infringement, and any warranties arising out of course of dealing or usage of trade.<br>
                                        The Nourishing Africa Parties further disclaim any and all liability related to your access or use of the services or any related content. You acknowledge and agree that any access to or use of the services or such content is at your own risk.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <!-- end tab content -->

                        <!-- start tab content -->
                        <div class="panel panel-default">
                            <div class="privacy-policy-accordion-header">
                                <a class="accordion-toggle" data-toggle="collapse"
                                   data-parent="#accordion-3" href="#accordion-3-sixteen">
                                    <div class="panel-title">
                                        <span class="text-white-2 sm-width-80 d-inline-block">
                                           P. Limitation of Liability</span>
                                        <i class="indicator fas fa-angle-down float-right"></i>
                                    </div>
                                </a>
                            </div>
                            <div id="accordion-3-sixteen" class="panel-collapse collapse" data-parent="#accordion-3">
                                <div class="privacy-policy-accordion-body">
                                    <p class="justify-text">
                                        To the maximum extent permitted by law, the Nourishing Africa Parties shall not be liable for any indirect, incidental, special, consequential, or punitive damages, or any loss of profits or revenues, whether incurred directly or indirectly, or any loss of data, use, goodwill, or other intangible losses, resulting from:<br>
                                        (a) your access to or use of or inability to access or use the services;<br>
                                        (b) any conduct or content of any party other than the applicable Nourishing Africa Party, including without limitation, any defamatory, offensive, or illegal conduct; or<br>
                                        (c) unauthorized access, use, or alteration of your content or information.<br>
                                        You acknowledge and agree that the disclaimers and the limitations of liability set forth in this Terms of Use reflect a reasonable and fair allocation of risk between you and the Nourishing Africa Parties, and that these limitations are an essential basis to Nourishing Africa’s ability to make the services available to you.<br>
                                        You agree that any cause of action related to the services must commence within one (1) year after the cause of action accrues. Otherwise, such cause of action is permanently barred.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <!-- end tab content -->

                        <!-- start tab content -->
                        <div class="panel panel-default">
                            <div class="privacy-policy-accordion-header">
                                <a class="accordion-toggle" data-toggle="collapse"
                                   data-parent="#accordion-3" href="#accordion-3-seventeen">
                                    <div class="panel-title">
                                        <span class="text-white-2 sm-width-80 d-inline-block">
                                           Q. Governing Law</span>
                                        <i class="indicator fas fa-angle-down float-right"></i>
                                    </div>
                                </a>
                            </div>
                            <div id="accordion-3-seventeen" class="panel-collapse collapse"
                                 data-parent="#accordion-3">
                                <div class="privacy-policy-accordion-body">
                                    <p class="justify-text">
                                        These Terms shall be governed by the laws of the Federal Republic of Nigeria.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <!-- end tab content -->

                    </div>
                    <!-- end accordion -->
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 mt-3">
                    <p class="alt-font" style="font-size: 17px;">
                        For more information about these Terms of use, please contact <strong><a href="mailto:yaedp@nourishingafrica.com">yaedp@nourishingafrica.com</a></strong>
                    </p>
                </div>
            </div>

        </div>
    </section>
@stop
