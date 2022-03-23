@extends('emails.layout')

@section('content')

    <div style="padding: 10px;">
        <h4>Dear {{ $name ?? 'Participant' }},</h4>

        To confirm your email change, click on the link below to confirm your new email address.<br><br>

        <a href="{{ route('yaedp.account.email-confirmation.token', $verification_token) }}">Click here</a>.<br><br>

        The Nourishing Africa Team
    </div>
@endsection
