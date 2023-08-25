<?php

namespace App\Mail;

use App\Models\Notifications;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendEmail extends Mailable
{
    use Queueable, SerializesModels;
    protected $notification;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($id)
    {
        $this->notification = Notifications::where('id', $id)->with('user')->first();
    }

    public function build()
    {
        return $this->from(env("MAIL_FROM_ADDRESS"), env("MAIL_FROM_NAME"))
            ->to($this->notification->user->email ?? env("MAIL_FROM_ADDRESS"), $this->notification->user->name_surname ?? env("MAIL_FROM_NAME"))
            ->subject($this->notification->title)
            ->view('emails.sendmessage', ['notification' => $this->notification]);
    }
}
