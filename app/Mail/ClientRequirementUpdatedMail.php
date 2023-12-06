<?php

namespace App\Mail;

use App\Models\ClientRequirement;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ClientRequirementUpdatedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $clientRequirement;


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(ClientRequirement $clientRequirement)
    {
        $this->clientRequirement = $clientRequirement;
    }

    /**
     * Build the message.
     * @return $this
     */
    public function build()
    {
        return $this->view('ClientRequirement.mail.clientRequirementUpdatedMailTemplate', ['record' => $this->clientRequirement])
            ->text('ClientRequirement.mail.clientRequirementUpdatedMailTextTemplate');
    }
}
