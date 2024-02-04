<?php

// app/Mail/ResetPassword.php

namespace App\Mail;

use Illuminate\Mail\Mailable;

class ResetPassword extends Mailable
{
    public $resetLink;

    public function __construct($resetLink)
    {
        $this->resetLink = $resetLink;
    }

    public function build()
    {
        return $this->view('emails.reset-password');
    }
}
