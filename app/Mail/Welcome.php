<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Lang;

class Welcome extends Mailable
{
    use Queueable, SerializesModels;

    public $subject;
    public $firstname;
    public $emailid;
    public $password;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->emailid      = $data['emailid'];
        $this->password     = $data['password'];
        $this->firstname    = $data['first_name'];
        $this->subject      = str_replace('{siteName}', config('app.name'), Lang::get('email.welcome'));
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.welcome')
            ->subject($this->subject);
    }
}
