<?php

namespace App\Mail;

use App\Models\Route;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\View;

class RouteMail extends Mailable
{
    use Queueable, SerializesModels;

    public $comment;
    public $route;
    public $attach1;
    public $attach2;


    /**
     * Create a new message instance.
     *
     * @param Route $route
     * @param $comment
     * @param $html
     * @param $pdf
     */
    public function __construct(Route $route, $comment, $html, $pdf) // $comment - ezt ne hivd $message-nek, mert szetszall
    {
        $this->route = $route;
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
        return $this->view('Route.mail.routeMailTemplate',
            [
                'route' => $this->route,
                'comment' => $this->comment,
                'htmllink' => $this->attach1,
                'pdflink' => $this->attach2
            ])
            ->text('Route.mail.routeMailTextTemplate');
    }
}
