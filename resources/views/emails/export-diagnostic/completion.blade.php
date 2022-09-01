@extends('emails.layout')

@section('content')

    <div style="padding: 10px;">
        <h4>Dear {{ $name ?? 'Participant' }},</h4>
        <p>
            Thank you for completing the assessment, we will evaluate your responses in accordance with the program requirements and contact successful participants for further steps.<br><br>
            For more information contact us at <strong>yaedp@nourishingafrica.com</strong>.
        </p>

        <p>The Nourishing Africa Team</p>
    </div>
@endsection
