<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendEmailValidationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $data;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data){
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $data = $this->data;

        Mail::send('emails.yaedp.email-verification', $data, static function ($message) use ($data) {
            $message->from('yaedp@nourishingafrica.com', 'African Food Changemakers | YAEDP');
            $message->to($data['email'], $data['name']);
            $message->replyTo('yaedp@nourishingafrica.com', 'African Food Changemakers | YAEDP');
            $message->subject('Email verification');
        });
    }
}
