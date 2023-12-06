<?php

namespace App\Jobs;

use App\Mail\UserPassword;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;

class SendUserPassword implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var User
     */
    protected User $user;
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
     * Create a new job instance.
     * @param User $user The user to whom send the letter
     * @param User $creator Admin who sends the letter
     * @param string $password The unique password
     */
    public function __construct(User $user, User $creator, string $password)
    {
        $this->user = $user;
        $this->creatorName = $creator->name;
        $this->creatorEmail = $creator->email;
        $this->password = $password;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(): void
    {
        $mail = new UserPassword($this->user->name, $this->creatorName, $this->creatorEmail, $this->password);
        $mail->from(env('MAIL_FROM_ADDRESS', 'MAIL_FROM_ADDRESS is missing your env file!'))
            ->to($this->user->email);
        Mail::send($mail);
    }
}
