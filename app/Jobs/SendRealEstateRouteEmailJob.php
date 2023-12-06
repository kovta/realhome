<?php

namespace App\Jobs;

use App\Http\Controllers\RealEstateRouteController;
use App\Mail\RouteMail;
use App\Models\Route;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;

class SendRealEstateRouteEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $realEstateRouteId;
    protected $request;

    /**
     * Create a new job instance.
     *
     * @param  $request
     * @param  $realEstateRouteId
     */
    public function __construct($request, $realEstateRouteId)
    {
        $this->request = $request;
        $this->realEstateRouteId = $realEstateRouteId;
    }

    /**
     * Execute the job.
     *
     * @return void
     * @throws Exception
     */
    public function handle(): void
    {
        $realEstateRoute = Route::find($this->realEstateRouteId)->load('client')->load('createdBy');
        $message = $this->request['message'] || '';
        // TODO: generált PDF legyen letölthető az URL-ről
        $htmlLink = RealEstateRouteController::generateTemporaryUrl($realEstateRoute->id, 0);
        $pdfLink = RealEstateRouteController::generateTemporaryUrl($realEstateRoute->id, 1);
        $mail = new RouteMail($realEstateRoute, $message, $htmlLink, $pdfLink);
        $from = env('MAIL_FROM_ADDRESS', 'MAIL_FROM_ADDRESS is missing your env file!');
        $to = $this->request['target'];
        $subject = $this->request['subject'];
        $mail->from($from)->to($to)->subject($subject);
        if (isset($this->request['ccCheck'])) {
            $cc = $this->request['cc'];
            $mail->cc($cc);
        }
        Mail::send($mail);
    }
}
