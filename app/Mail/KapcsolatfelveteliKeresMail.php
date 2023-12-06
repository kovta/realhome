<?php

namespace App\Mail;

use App\Models\ClientRequirement;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Request;

class KapcsolatfelveteliKeresMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;


    /**
     * KapcsolatfelveteliKeresMail constructor.
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     * @return $this
     */
    public function build()
    {
        return $this->view('KapcsolatfelveteliKeres.mail.kapcsolatfelveteliKeresMailTemplate', ['record' => $this->data])
            ->text('KapcsolatfelveteliKeres.mail.kapcsolatfelveteliKeresMailTextTemplate');
    }
}
