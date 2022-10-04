<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class ContactUs implements ShouldQueue
{
   use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $contact;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->contact = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $data = [
            'subject' => $this->contact['clientSubject'],
            'email' => $this->contact['email'],
            'adminMessage' => $this->contact['adminMessage'],
        ];
        Mail::send('sendMail.contactUsForm', $data, function ($message) use ($data) {
            $message->from('info@pricemanager.pk', config('app.name'))->subject
            ('Contact Us');
            $message->to($data['email']);

        });
    }
}
