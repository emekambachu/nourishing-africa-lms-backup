@extends('yaedp.account.includes.layout')

@section('title')
    Dashboard
@endsection

@section('top-assets')
@endsection

@section('content')
    <div class="container-fluid">
        <h4 class="font-large-inter text-light-brown">
            Welcome {{ Auth::user()->surname }}
        </h4>
        <div class="row bg-white na-border-radius">
            <div class="col-md-8 col-sm-8 col-xs-8">
                <h4 class="text-inter">Learn effectively on exports</h4>
                <p class="text-inter">Something new to learn today</p>
            </div>
            <div class="col-md-4 col-sm-4 col-xs-4">
                kf[pkjporjrpojrnrprmrnroinrinr
            </div>

        </div>
    </div>
@endsection

@section('bottom-assets')
@endsection
