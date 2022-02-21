@if(session('success'))
    <div class="alert alert-success" role="alert">
        <button aria-label="Close" class="close" data-dismiss="alert" type="button">
            <span aria-hidden="true">&times;</span>
        </button>
        <strong>{{ session('success') }}</strong>
    </div>
@endif

@if(session('warning'))
    <div class="alert alert-danger mg-b-0" role="alert">
        <button aria-label="Close" class="close" data-dismiss="alert" type="button">
            <span aria-hidden="true">&times;</span>
        </button>
        <strong>{{ session('warning') }}</strong>
    </div>
@endif

@if($errors->any())
    <div class="alert alert-danger alert-dismissable text-center" style="width: 80%; margin: 0 auto;">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
        <ul style="list-style: none; margin: 0 auto;">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
