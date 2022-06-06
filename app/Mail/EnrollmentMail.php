<?php

namespace App\Mail;

use Illuminate\Http\Request;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use App\Models\EnrollmentOrder;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class EnrollmentMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(EnrollmentOrder $order)
    {
        $this->order = $order; 
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(Request $request)
    {
        return $this->from(env('MAIL_FROM_ADDRESS'), env('APP_NAME'))
            ->subject('Confirmacion de Inscripción')
            ->markdown('mails.enrollment')
            ->with([
                'link' => '/inboxes',
                'name' => $request->user()->name,
                'order' => $this->order,
            ]);
    }
}
