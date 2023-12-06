<?php

namespace App\Mail;

use App\Models\RealEstateOffer;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\View;

class OfferMail extends Mailable
{
    use Queueable, SerializesModels;

    public $comment;
    public $offer;
    public $attach1;
    public $attach2;


    /**
     * Create a new message instance.
     *
     * @param RealEstateOffer $offer
     * @param $comment
     * @param $html
     * @param $pdf
     */
    public function __construct(RealEstateOffer $offer, $comment, $html, $pdf) // $comment - ezt ne hivd $message-nek, mert szetszall
    {
        $this->offer = $offer;
        $this->comment = $comment;
        $this->attach1 = $html;
        $this->attach2 = $pdf;
    }

    /**
     * Build the message.
     * @return $this
     */
    public function build()
    {
        return $this->view('RealEstateOffer.mail.offerMailTemplate',
            [
                'offer' => $this->offer,
                'comment' => $this->comment,
                'htmllink' => $this->attach1,
                'pdflink' => $this->attach2
            ])
            ->text('RealEstateOffer.mail.offerMailTextTemplate');
    }
}
