<?php

namespace App\Mail;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ResetPasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The user instance.
     *
     * @var user
     */
    public $user;
    public $resetPasswordURL;

    /**
     * Create a new message instance.
     *
     * @param User $user
     * @param $resetPasswordURL
     */
    public function __construct(User $user,$resetPasswordURL)
    {
        //
        $this->user = $user;
        $this->resetPasswordURL = $resetPasswordURL;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.ResetPasswordMail');
    }
}
