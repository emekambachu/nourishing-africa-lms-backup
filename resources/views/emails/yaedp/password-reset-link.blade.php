@extends('emails.layout')

@section('content')

    <div style="padding: 10px;">
        <h4>Dear {{ $name ?? 'Participant' }},</h4>

        Copy and paste this the link on a new browser page<br><br>

        <p>https://learning.nourishingafrica.com/yaedp/password-reset-token/{{ $verification_token }}</p>

        The Nourishing Africa Team
    </div>
@endsection

{{--@section('call-to-action')--}}
{{--    <div style="text-decoration:none;display:inline-block;color:#ffffff;background-color:#006600;border-radius:4px;-webkit-border-radius:4px;-moz-border-radius:4px;width:auto; width:auto;;border-top:1px solid #006600;border-right:1px solid #006600;border-bottom:1px solid #006600;border-left:1px solid #006600;padding-top:5px;padding-bottom:5px;font-family:Arial, Helvetica Neue, Helvetica, sans-serif;text-align:center;mso-border-alt:none;word-break:keep-all;">--}}
{{--        <a href="{{ route('yaedp.login') }}">--}}
{{--        <span style="padding-left:20px;padding-right:20px;font-size:16px;display:inline-block;letter-spacing:undefined;">--}}
{{--            <span style="font-size: 16px; color: #fff; line-height: 2; mso-line-height-alt: 32px;">Login</span>--}}
{{--        </span>--}}
{{--        </a>--}}
{{--    </div>--}}
{{--@endsection--}}
