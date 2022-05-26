<ul class="slide-menu">
    <li>
        <a class="slide-item" href="{{ route('yaedp.account.modules') }}">All</a>
    </li>
    @foreach($modules as $mod)
        @if(!$loop->first)
            <!--If module has been started, check completion-->
            @if(Auth::user()->startedModule($mod->previousModule()->id))
                <!--If module has been completed, show link-->
                @if(Auth::user()->startedModule($mod->previousModule()->id)->status === 1)
                <li>
                    <a class="slide-item text-light-brown" href="{{ route('yaedp.account.courses', $mod->id) }}"
                       data-placement="right" data-toggle="tooltip" title="{{ $mod->title }}">
                        Module {{ $loop->index + 1 }}</a>
                </li>
                @else
                <li>
                    <a class="slide-item text-light-brown" href="{{ route('yaedp.account.courses', $mod->id) }}"
                       data-placement="right" data-toggle="tooltip" title="{{ $mod->title }}">
                        Module {{ $loop->index + 1 }}</a>
                </li>
                @endif
            @else
            <li>
                <a disabled class="slide-item text-gray" href="javascript:void(0);"
                   data-placement="right" data-toggle="tooltip" title="{{ $mod->title }}">
                    Module {{ $loop->index + 1 }} <i class="fa fa-lock ml-1"></i></a>
            </li>
            @endif
        @else
        <li>
            <a class="slide-item text-light-brown" href="{{ route('yaedp.account.courses', $mod->id) }}"
               data-placement="right" data-toggle="tooltip" title="{{ $mod->title }}">
                Module {{ $loop->index + 1 }}</a>
        </li>
        @endif
    @endforeach
</ul>
