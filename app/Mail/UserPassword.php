<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserPassword extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var string
     */
    protected string $userName;
    /**
     * @var string
     */
    protected string $creatorName;
    /**
     * @var string
     */
    protected string $creatorEmail;
    /**
     * @var string
     */
    protected string $password;

    /**
     * Create a new message instance.
     * @param string $user
     * @param string $creatorName
     * @param string $creatorEmail
     * @param string $password
     */
    public function __construct(string $user, string $creatorName, string $creatorEmail, string $password)
    {
        $this->userName =  $user;
        $this->creatorName = $creatorName;
        $this->creatorEmail = $creatorEmail;
        $this->password = $password;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(): self
    {
        return $this->view('User.mail.UserPasswordMailTemplate', [
            'name' => $this->userName,
            'password' => $this->password,
            'createdByName' => $this->creatorName,
            'createdByEmail' => $this->creatorEmail,
        ])->text('User.mail.UserPasswordMailTextTemplate');
    }
}
