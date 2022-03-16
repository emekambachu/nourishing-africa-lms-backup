<div class="dropdown nav-item main-header-notification">
    <a class="new nav-link icon-shadow" href="#">
        <i class="fe fe-bell fe-2x" style="color: #929292;"></i>
        @if($countNotifications > 0)
            <span class="pulse"></span>
        @endif
    </a>
    <div class="dropdown-menu">
        <div class="menu-header-content bg-light-brown text-left d-flex">
            <div class="">
                <h6 class="menu-header-title text-white mb-0">
                    {{ $countNotifications }} New notification(s)</h6>
            </div>
            {{--                <div class="my-auto ml-auto">--}}
            {{--                    <a class="badge badge-pill badge-warning float-right" href="#">Mark All Read</a>--}}
            {{--                </div>--}}
        </div>

        <div class="main-notification-list Notification-scroll">
            @forelse($dropDownNotification as $notify)
                <a data-notification="{{ $notify->id }}"
                   data-route="{{ route('member.notification.open', $notify->id) }}"
                   href="{{ $notify->type == 'nomination-message' ? route($notify->route, $notify->id) : route($notify->route) }}"
                   class="d-flex p-3"
                   @if($notify->opened === 0) style="background-color: #eaeaea;" @endif>
                    <div class="">
                        <i class="la la-arrow-alt-circle-down text-warning"></i>
                    </div>
                    <div class="ml-3">
                        <h5 class="notification-label mb-1">{{ $notify->title }}</h5>
                        <p class="mb-1 tx-11 na-intern-text-grey">
                            {!! Str::limit($notify->description, 100) !!}</p>
                        <div class="notification-subtext tx-11">
                            {{ $notify->created_at->diffForHumans() }}</div>
                    </div>
                    <div class="ml-auto" >
                        <i class="las la-angle-right text-right text-muted"></i>
                    </div>
                </a>
            @empty
                <a>
                    <div class="ml-3 pt-2 pb-2">
                        <h5 class="notification-label mb-1">No notification</h5>
                    </div>
                </a>
            @endforelse
        </div>
        <div class="dropdown-footer">
            <a class="na-text-dark" href="{{ route('yaedp.account.notifications') }}">All notifications</a>
        </div>
    </div>
</div>
