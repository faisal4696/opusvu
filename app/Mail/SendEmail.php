<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendEmail extends Mailable
{
    use Queueable, SerializesModels;

    private $name;
    private $email;
    private $id;
    private $password;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name,$email,$id,$password=null)
    {
        $this->name = $name;
        $this->email = $email;
        $this->id = $id;
        if($password!==null){
            $this->password = $password;
        }

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $name = $this->name;
        $email = $this->email;
        $id = $this->id;
        $password = $this->password;

        $subject = "Welcome to Opusvu";
        if($id=='forget'){
            return $this->view('mail.forget-password', compact("name",'email','password'))->subject($subject);
        }
    }
}
