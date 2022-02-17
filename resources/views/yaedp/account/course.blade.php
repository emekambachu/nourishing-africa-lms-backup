@extends('yaedp.account.includes.layout')

@section('title')
    {{ $course->title }}
@endsection

@section('top-assets')
@endsection

@section('content')
    <div class="container mb-4">

        <p class="bread-crumbs">
            <a href="{{ route('yaedp.account') }}">Dashboard</a> / <a href="{{ route('yaedp.account.modules') }}">Modules</a> / <a href="{{ route('yaedp.account.courses', $course->learningModule->id) }}">Courses</a> / <span class="light-green">{{ $course->title }}</span>
        </p>

        <div class="mb-3">
            <h2 class="font-large-inter text-light-brown font-weight-bold">
                {{ $course->title }}</h2>
            <!--View course countdown-->
            <div id="courseCountdown"></div>
        </div>

        <div class="row">
            <div class="col-lg-9 col-md-9 col-sm-12">
                <div class="bg-white-radius-shadow border-light-green">

                    <div class="row">
                        <div class="col-12">
                            <div class="course-video">
                                <!--For responsiveness-->
                                <div style='max-width: 853px'>
                                    <div style='position: relative; padding-bottom: 56.25%; height: 0; overflow: hidden;'>
                                        <!--Insert Iframe-->
                                        {!! $course->video !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">

                    <div class="col-12 mt-3 mb-3 course-tabs">
                        <span id="description" class="d-inline text-dark active course-tab">
                            Description</span>
                        <span id="instructor" class="d-inline text-dark course-tab">
                            Instructor</span>
                        <span id="resources" class="d-inline text-dark course-tab">
                            Resources</span>
                        <span id="discussion" class="d-inline text-dark course-tab">
                            Discussion</span>
                    </div>

                    <div class="col-12 bg-white-radius-shadow tab-bodies" id="description-tab-body">
                        <p class="text-inter tx-14">
                            {!! $course->description !!}
                        </p>
                    </div>

                    <div class="col-12 bg-white-radius-shadow tab-bodies d-none"
                         id="instructor-tab-body">
                        <div class="row">
                            <div class="col-md-2 col-sm-12">
                                <img src="{{ asset('images/stock/lecturer.png') }}"/>
                            </div>
                            <div class="col-md-10 col-sm-12">
                                <h4 class="text-inter text-dark mb-0">{{ $course->trainers }}</h4>
                                <h3 class="text-inter text-grey">Lecturer Position and Company</h3>
                                <p class="text-inter text-grey tx-14"></p>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 bg-white-radius-shadow tab-bodies d-none"
                         id="resources-tab-body">
                        <div class="row p-2">

                            @if(!empty($course->document_one))
                                <div class="col-2 course-resources">
                                    <img src="{{ asset('images/icons/document.png') }}" width="40"/>
                                    <a href="{{ route('yaedp.account.course.download-document', [$course->id, $course->document_one]) }}">
                                        <span>Download</span>
                                    </a>
                                </div>
                            @endif

                            @if(!empty($course->document_two))
                                <div class="col-2 course-resources">
                                    <img src="{{ asset('images/icons/document.png') }}" width="40"/>
                                    <a href="{{ route('yaedp.account.course.download-document', [$course->id, $course->document_two]) }}">
                                        <span>Download</span>
                                    </a>
                                </div>
                            @endif

                        </div>
                    </div>

                    <div class="col-12 bg-white-radius-shadow tab-bodies d-none" id="discussion-tab-body">
                        <div class="row">
                            <div class="col-12 pl-3 pr-3 mb-3">
                                <label for="" class="float-left align-items-center discussion-comment-text">({{ count($discussion) }}) Comment{{ count($discussion) > 1 ? 's':'' }}</label>
                                <button class="float-right discussion-reply-btn" data-toggle="modal" data-target="#exampleModalCenter" data-type="Comment">Comment</button>
                                <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                      <div class="modal-content">
                                        <div class="modal-body">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="position: relative; right: 1px;">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <label class="news-update-view-page-form-text comment-title"></label>
                                                                <input type="hidden" id="ReplyID" value="">
                                                                <input type="hidden" id="type" value="">
                                                                <input type="hidden" id="courseId" value="{{ $course->id }}">
                                                                <input type="hidden" id="LMID" value="{{ $course->learningModule->id }}">
                                                                <input type="hidden" id="LCID" value="{{ $course->learningCategory->id }}">
                                                                <textarea row="5" id="comment" class="form-control" placeholder="Comments" required></textarea>
                                                                <span id="msg"></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="row">
                                                        <div class="col-md-6 col-sm-12">
                                                        </div>
                                                        <div class="col-md-6 col-sm-12">
                                                            <div class="float-right">
                                                                <button id="comment-submit-btn" class="comment-form-submit"><img class="pr-1 d-none" id="submit-img" src="{{ asset('images/floading.gif') }}">Submit</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                      </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 pl-3 pr-3 mt-3" style="height: 300px; overflow:scroll;">
                                @foreach($discussion as $item)
                                <div class="row mb-3">
                                    <div class="col-12">
                                        <img src="{{ asset('images/icons/profile.png') }}" alt="" class="">
                                        <label for="" class="pl-3 discussion-comment-name">{{ \App\Models\YaedpUser::getUserFullName($item->user_id) }}</label>
                                        <label for="" class="float-right discussion-comment-time">{{ Carbon\Carbon::parse($item->created_at)->diffForHumans(null, true).' ago' }}</label>
                                    </div>
                                    <div class="col-12 mt-2">
                                        <p class="discussion-comment-body">{{ $item->message }}</p>
                                    </div>
                                    <div class="col-12">
                                        <button class="discussion-comment-like" data-commentid="{{ $item->id }}" data-type="comment"><img id="commentlike{{ $item->id }}" src="{{ \App\Models\Learning\LearningDiscussionLike::check("comment", $course->id, $item->id) ? asset("images/icons/chkdfav.png") : asset("images/icons/like.png") }}" alt="">&nbsp;&nbsp; Like</button>
                                        <button class="discussion-comment-reply" data-commentdiv="subcomment{{ $item->id }}">Replies({{ \App\Models\Learning\LearningDiscussionReply::getCount($item->id) }})</button>
                                        <button class="discussion-comment-reply float-right" data-type="Reply" data-commentid="{{ $item->id }}" data-toggle="modal" data-target="#exampleModalCenter"><img src="{{asset("images/icons/reply.png")}}" alt="">&nbsp;&nbsp; Reply</button>
                                    </div>
                                </div>
                                @if($item->learningDiscussionReplies)
                                    <div id="subcomment{{ $item->id }}" class="ml-3 mt-3 d-none" style="border-left: 1px solid #ECEAEA;">
                                    @foreach($item->learningDiscussionReplies as $replies)
                                    @if($replies->status == 1)
                                        <div class="row pl-3 mb-3">
                                            <div class="col-12">
                                                <img src="{{ asset('images/icons/profile.png') }}" alt="" class="">
                                                <label for="" class="pl-3 discussion-comment-name">{{ \App\Models\YaedpUser::getUserFullName($replies->user_id) }}</label>
                                                <label for="" class="float-right discussion-comment-time">{{ Carbon\Carbon::parse($replies->created_at)->diffForHumans(null, true).' ago' }}</label>
                                            </div>
                                            <div class="col-12 mt-2">
                                                <p class="discussion-comment-body">{{ $replies->message }}</p>
                                            </div>
                                            <div class="col-12">
                                                <button class="discussion-comment-like" data-commentid="{{ $item->id }}" data-type="reply" data-replyid="{{ $replies->id }}"><img id="replylike{{ $replies->id }}" src="{{ \App\Models\Learning\LearningDiscussionLike::check("reply", $course->id, $item->id, $replies->id) ? asset("images/icons/chkdfav.png") : asset("images/icons/like.png") }}" alt="">&nbsp;&nbsp; Like</button>
                                                <button class="discussion-comment-reply float-right" data-type="Reply" data-commentid="{{ $item->id }}" data-toggle="modal" data-target="#exampleModalCenter"><img src="{{asset("images/icons/reply.png")}}" alt="">&nbsp;&nbsp; Reply</button>
                                            </div>
                                        </div>
                                    @endif
                                    @endforeach
                                    </div>
                                @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="col-lg-3 col-md-3 col-sm-12">
                <div class="bg-white-radius-shadow border-light-green p-0">
                    <h6 class="text-light-brown pb-2 border-bottom-grey pl-2 pt-2">
                        {{ $course->learningModule->title }}
                    </h6>

                    @foreach($courses as $c)
                        @if(Auth::user()->startedCourse($c->id, $c->learningModule->id))
                            @if(Auth::user()->startedCourse($c->id, $c->learningModule->id)->status === 1)
                            <div class="p-2 @if($c->id === $course->id) bg-lemon-green @endif ">
                                <span class="text-inter na-text-dark-green tx-12">
                                    {{ $c->title }}
                                    <i class="fa fa-check na-text-light-green text-right ml-2"></i>
                                </span>
                            </div>
                            @else
                            <div class="p-2 @if($c->id === $course->id) bg-lemon-green @endif ">
                                <span class="text-inter na-text-dark-green tx-12">
                                    {{ $c->title }}
                                    <i class="fa fa-play na-text-light-green text-right ml-2"></i>
                                </span>
                            </div>
                            @endif
                        @else
                            <div class="p-2">
                                <span class="text-inter na-text-dark-green tx-12">
                                    {{ $c->title }}
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

                <!--If there is a next course for this module-->
                @if($course->nextCourse($module->id))
                    <!--Id this course has started-->
                    @if(Auth::user()->startedCourse($course->id, $module->id))
                        <!--If this course has been completed-->
                        @if(Auth::user()->startedCourse($course->id, $module->id)->status === 1)
                            <a class="next-course-link" href="{{ route('yaedp.account.course', $course->nextCourse($module->id)->id) }}">
                                <button class="module-btn bg-light-brown d-flex justify-content-center">
                                    Next Course</button>
                            </a>
                        <!--If this course has been completed and there is no next course proceed to assessment, else go to next course-->
                        @elseif(Auth::user()->startedCourse($course->id, $module->id)->status === 1 && !$course->nextCourse($module->id))
                            <a class="next-course-link" href="{{ route('yaedp.account.assessment.start', $module->id) }}">
                                <button class="module-btn bg-light-brown d-flex justify-content-center">
                                    Start Assessment</button>
                            </a>
                        @else
                            <!--If none of the 2 conditions are true, show disabled button-->
                            <a disabled class="next-course-link" href="javascript:void(0);">
                                <button class="module-btn bg-gray d-flex justify-content-center">
                                    Next Course</button>
                            </a>
                        @endif
                    @endif
                @else
                    @if(Auth::user()->startedCourse($course->id, $module->id)->status === 1)
                        <a href="{{ route('yaedp.account.assessment.start', $course->learning_module_id) }}">
                            <button class="module-btn bg-light-brown d-flex justify-content-center">
                                Start Assessment</button>
                        </a>
                    @else
                        <a class="next-course-link" disabled href="javascript:void(0)">
                            <button class="module-btn bg-gray d-flex justify-content-center">
                                Start Assessment</button>
                        </a>
                    @endif
                @endif

            </div>
        </div>
    </div>

    <!--Timer Warning Modal-->
    <div class="modal effect-scale hide" id="timerAlert" style="padding-right: 22px;"
         data-next-route="{{ $course->nextCourse($module->id) ? route('yaedp.account.course', $course->nextCourse($module->id)->id) : null }}"
         data-assessment-route="{{ route('yaedp.account.assessment.start', $module->id) }}"
         data-next-course="{{ $course->nextCourse($module->id) ? 'has-next' : 'none' }}"
         data-completed-course="{{ Auth::user()->startedCourse($course->id, $course->learning_module_id)->status === 1 ? 'completed' : 'incomplete' }}">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h5 class="text-inter font-weight-bold text-center">
                        Your session will be recorded once you resume this course, leaving before the timer ends will not complete the course.
                    </h5>
                </div>
                <div class="modal-body">
                    <h5 class="text-center">Continue ?</h5>
                </div>
                <div class="modal-footer d-flex justify-content-center">
                    <button class="btn ripple btn-success startCourse" data-dismiss="modal" type="button"
                            data-route="{{ route('yaedp.account.course.complete', $course->id) }}"
                            data-study-timer="{{ $course->study_timer }}">Yes</button>
                    <a href="{{ route('yaedp.account.courses', $course->learning_module_id) }}">
                        <button class="btn ripple btn-warning" type="button">No, take me back</button>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('bottom-assets')

    <script>
        $(document).ready(function() {

            $('.course-tab').click(function(e){

                $('.course-tab').removeClass('active');
                $('.tab-bodies').addClass('d-none');

                $(this).addClass('active');

                if($(this).attr('id') == "description"){
                    $('#description-tab-body').removeClass('d-none');
                }

                if($(this).attr('id') == "instructor"){
                    $('#instructor-tab-body').removeClass('d-none');
                }

                if($(this).attr('id') == "resources"){
                    $('#resources-tab-body').removeClass('d-none');
                }

                if($(this).attr('id') == "discussion"){
                    $('#discussion-tab-body').removeClass('d-none');
                }
            });

            $('#exampleModalCenter').on('show.bs.modal', function (event) {
                const button = $(event.relatedTarget); // Button that triggered the modal
                const data_type = button.data('type'); // Extract info from data-* attributes
                const modal = $(this);
                modal.find('.comment-title').text(data_type);
                if(data_type == "Comment"){
                    modal.find('#ReplyID').val("");
                    modal.find('#comment').val("");
                    modal.find('#type').val("comment");
                }else if(data_type == "Reply"){
                    const data_id = button.data('commentid');
                    modal.find('#comment').val("");
                    modal.find('#type').val("reply");
                    modal.find('#ReplyID').val(data_id);
                }

            })

            $("#comment-submit-btn").on('click', function(){
                const modal = $(this);
                let type = $('#type').val();
                let data = {};
                let message = $('#comment').val();

                if(message == "" || message === ""){
                    $("#msg").addClass('text-warning');
                    $("#msg").text('This field is required.');
                    return false;
                }else{
                    $("#msg").removeClass('text-warning');
                    $("#msg").text('');
                }

                if(type == "comment"){
                    data = {
                        type : type,
                        message : message,
                        learning_course_id : $("#courseId").val(),
                        learning_category_id : $("#LCID").val(),
                        learning_module_id : $("#LMID").val()
                    };
                    //data.push(type, message, courseId, lmID, lcID);
                }else if(type == "reply"){
                    data = {
                        type : type,
                        message : message,
                        reply_id : $('#ReplyID').val(),
                    };
                    //let reply_id = $('#ReplyID').val();
                    //data.push(type, message, reply_id);
                }

                $.ajaxSetup({
                    headers:{
                        'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    url: "/yaedp/account/dicussion",
                    type: "POST",
                    data:  data,
                    timeout: 5000,
                    beforeSend : function()
                    {
                        $("#submit-img").removeClass('d-none');
                    },
                    success: function(data)
                    {
                        $("#submit-img").addClass('d-none');
                        $("#msg").addClass('text-success');
                        $("#msg").text('Comment Submitted.');
                        $('#comment').val("");
                    },
                    error: function(e, textStatus) 
                    {
                        $("#submit-img").addClass('d-none');
                        $("#msg").addClass('text-warning');
                        $("#msg").text('There was an issue submitting your comment, please check your internet connection and try again.');
                    }
                        
                });
            });

            $('.discussion-comment-reply').on('click', function (event) {
                const button = $(event.target); // Button that triggered the modal
                const subcommentdiv = button.data('commentdiv'); // Extract info from data-* attributes
                $("#"+subcommentdiv).toggleClass("d-none");
            });

            $('.discussion-comment-like').on('click', function(event){
                const button = $(this);
                const discussionId = button.data('commentid');
                const type = button.data('type');
                let replyId;
                let data = {};

                if(type == "comment"){
                    data = {
                        type : type,
                        learning_course_id : $("#courseId").val(),
                        learning_discussion_id : discussionId,
                    };
                }else if(type == "reply"){
                    replyId = button.data('replyid');
                    data = {
                        type : type,
                        learning_course_id : $("#courseId").val(),
                        learning_discussion_id : discussionId,
                        learning_discussion_reply_id : replyId,
                    };
                }

                $.ajax({
                    url: "/yaedp/account/dicussion/like",
                    type: "POST",
                    data:  data,
                    timeout: 5000,
                    headers:{
                        'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
                    },
                    beforeSend : function()
                    {
                        //$("#submit-img").removeClass('d-none');
                    },
                    success: function(data)
                    {
                        if(data.result == "like"){
                            if(type == "comment"){
                                $("#commentlike"+discussionId).attr('src', '/images/icons/chkdfav.png');
                            }else if(type == "reply"){
                                $("#replylike"+replyId).attr('src', '/images/icons/chkdfav.png');
                            }
                        }else{
                            if(type == "comment"){
                                $("#commentlike"+discussionId).attr('src', '/images/icons/like.png');
                            }else if(type == "reply"){
                                $("#replylike"+replyId).attr('src', '/images/icons/like.png');
                            }
                        }
                        
                    },
                    error: function(e, textStatus) 
                    {
                       console.log('There was an issue submitting your comment, please check your internet connection and try again.');
                    }
                });

            });
        });
    </script>

    <script src="{{ asset('learning-assets/custom/learning-views.js') }}" type="text/javascript"></script>

    <!--- Internal Modal js --->
    <script src="{{ asset('learning-assets/js/modal.js') }}"></script>

    <!--Start of Tawk.to Script-->
    <script type="text/javascript">
        var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
        (function(){
            var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
            s1.async=true;
            s1.src='https://embed.tawk.to/61fabd5c9bd1f31184da9efe/1fqtn7dcj';
            s1.charset='UTF-8';
            s1.setAttribute('crossorigin','*');
            s0.parentNode.insertBefore(s1,s0);
        })();
    </script>
    <!--End of Tawk.to Script-->
@endsection
