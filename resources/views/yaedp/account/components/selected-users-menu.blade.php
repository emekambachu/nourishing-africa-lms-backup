@if($selected)
    <li class="slide mb-3">
        <a class="side-menu__item" href="{{ route('yaedp.account.business.profile') }}">
            <i class="side-menu__icon fa fa-briefcase"></i>
            <span class="side-menu__label">Business Profile</span></a>
    </li>
    <li class="slide mb-3">
        <a class="side-menu__item" href="{{ route('yaedp.account.export.resources') }}">
            <i class="side-menu__icon fa fa-lemon"></i>
            <span class="side-menu__label">Export Resources</span></a>
    </li>
@endif
