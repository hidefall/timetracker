<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class WelcomeUser extends Mailable
{
    use Queueable, SerializesModels;

    private $firstname;
    private $lastname;

    public function __construct($firstname, $lastname)
    {
        $this->firstname = $firstname;
        $this->lastname = $lastname;
    }


    public function build()
    {
        return $this->view('mail.welcome', ['firstname'=>$this->firstname, 'lastname'=>$this->lastname]);
    }
}
