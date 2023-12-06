<?php

namespace App\Jobs;

use App\Http\Controllers\RealEstateOfferController;
use App\Mail\OfferMail;
use App\Models\RealEstateOffer;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;

class SendRealEstateOfferEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $realEstateOfferId;
    protected $request;

    /**
     * Create a new job instance.
     *
     * @param  $request
     * @param  $realEstateOfferId
     */
    public function __construct($request, $realEstateOfferId)
    {
        $this->request = $request;
        $this->realEstateOfferId = $realEstateOfferId;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $realEstateOffer = RealEstateOffer::find($this->realEstateOfferId)->load('client')->load('createdBy');
        $message = $this->request['message'] || '';
        $htmlLink = RealEstateOfferController::generateTemporaryUrl($realEstateOffer->id, 0);
        $pdfLink = RealEstateOfferController::generateTemporaryUrl($realEstateOffer->id, 1);
        $mail = new OfferMail($realEstateOffer, $message, $htmlLink, $pdfLink);
        $from = env('MAIL_FROM_ADDRESS', 'MAIL_FROM_ADDRESS is missing your env file!');
//        if (isset($this->request['ccCheck'])) {
//            $from = $this->request['sender'];
//        }
        $to = $this->request['target'];
        $subject = $this->request['subject'];
        $mail->from($from)->to($to)->subject($subject);
        if (isset($this->request['ccCheck'])) {
            // ez hibás volt, mert fixen rögzítette a html hidden mezőben a html renerelésével a feladót és ha
            // a user átírta az input mezőben, akkor is a fixen rögzített email címre ment a cc:
            // $cc = $this->request['cc'];
            // $mail->cc($cc);
            // ez a helyes működés: a feladó kapjon másolatot
            // $mail->cc($from);
            // mivel a mail szerver nem enged más címről küldeni csak az info@realhome.hu -ról, ezért
            // ideiglenesen az allábbi megoldást alkalmazom:
            $mail->cc($this->request['sender']);
        }
        Mail::send($mail);
    }
}
