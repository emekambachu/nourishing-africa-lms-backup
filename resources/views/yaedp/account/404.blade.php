@extends('yaedp.account.includes.layout')

@section('title')
    404
@endsection

@section('top-assets')
@endsection

@section('content')
    <div class="container-fluid">

        <h3 class="font-large-inter text-light-brown">Unauthorized access</h3>

        <div class="row bg-white na-border-radius border-brown p-3 mb-3">
            <div class="col-12 justify-content-center d-flex">
                <img src="{{ asset('images/404/error_404_dashboard.jpg') }}" style="width: 500px;"/>
            </div>
        </div>

    </div>
@endsection

@section('bottom-assets')
@endsection
