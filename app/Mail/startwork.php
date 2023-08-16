<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class StartWork extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $fname = $this->data['fname'];
        $lname = $this->data['lname'];
        $email = $this->data['email'];
        $phone = $this->data['phone'];
        $msg = $this->data['msg'];
        $file = $this->data['file'];

        return $this->from($email, $fname . ' ' . $lname)
                    ->subject('New Start Work Form Submission')
                    ->view('emails.startwork')->attach($file->getRealPath(), [
                    'as' => $file->getClientOriginalName(),
                    'mime' => $file->getMimeType(),
                ]);
}
}