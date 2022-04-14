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

        <div class="row">
            <div class="col-lg-9 col-md-9 col-sm-12">
                <div class="card h-100 w-100">
                    <div class="card-header border-bottom">
                        <label class="learning-discussion-header-title" for=""><span style="color: #D75C03;"> Discussion - </span>({{ $course->title }})</label>
                        <br/>
                        <label class="learning-discussion-header-comment-fig mb-0 mt-3" for="">{{ count($discussion) }} Comment{{ count($discussion) > 1 ? 's':'' }}</label>
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
                                                        <input type="hidden" id="directReplyId" value="">
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
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 pl-3 pr-3 mt-3">
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
                                        <button class="discussion-comment-like" data-commentid="{{ $item->id }}" data-type="comment">
                                            <img id="commentlike{{ $item->id }}" style="width: 16px; height: 16px;" src="{{ \App\Models\Learning\LearningDiscussionLike::check("comment", $course->id, $item->id) ? asset("images/icons/chkdfav.png") : asset("images/icons/like.png") }}" alt="">
                                            &nbsp;&nbsp; Like ({{ \App\Models\Learning\LearningDiscussionLike::countLikes("comment", $course->id, $item->id) }})
                                        </button>
                                        <button class="discussion-comment-reply" data-commentdiv="subcomment{{ $item->id }}">Replies({{ \App\Models\Learning\LearningDiscussionReply::getCount($item->id) }})</button>
                                        <button class="discussion-comment-reply float-right" data-type="directCommentReply" data-directreplyid="{{ $item->id }}" data-commentid="{{ $item->id }}" data-toggle="modal" data-target="#exampleModalCenter"><img src="{{asset("images/icons/reply.png")}}" alt="">&nbsp;&nbsp; Reply</button>
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
                                                <button class="discussion-comment-like" data-commentid="{{ $item->id }}" data-type="reply" data-replyid="{{ $replies->id }}">
                                                    <img id="replylike{{ $replies->id }}" style="width: 16px; height: 16px;" src="{{ \App\Models\Learning\LearningDiscussionLike::check("reply", $course->id, $item->id, $replies->id) ? asset("images/icons/chkdfav.png") : asset("images/icons/like.png") }}" alt="">
                                                    &nbsp;&nbsp; Like ({{ \App\Models\Learning\LearningDiscussionLike::countLikes("reply", $course->id, $item->id, $replies->id) }})
                                                </button>
                                                <button class="discussion-comment-reply float-right" data-type="Reply" data-directreplyid="{{ $replies->id }}" data-commentid="{{ $item->id }}" data-toggle="modal" data-target="#exampleModalCenter"><img src="{{asset("images/icons/reply.png")}}" alt="">&nbsp;&nbsp; Reply</button>
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
@endsection

@section("bottom-assets")
    <script src="{{ asset('learning-assets/custom/learning-discussions.js') }}" type="text/javascript"></script>
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
