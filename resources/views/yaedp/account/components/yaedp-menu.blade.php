<ul class="slide-menu">
    <li>
        <a class="slide-item" href="{{ route('yaedp.account.modules') }}">All</a>
    </li>
    @foreach($modules as $mod)
    <li>
        <a class="slide-item" href="{{ route('yaedp.account.courses', $mod->id) }}">
            Module {{ $loop->index + 1 }}
        </a>
    </li>
    @endforeach
</ul>
