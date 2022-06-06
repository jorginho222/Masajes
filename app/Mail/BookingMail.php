<?php

namespace App\Mail;

use App\Models\Booking;
use App\Models\BookingOrder;
use Illuminate\Http\Request;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class BookingMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $booking;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Booking $booking, BookingOrder $order)
    {
        $this->booking = $booking;
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
            ->subject('Confirmacion de reserva')
            ->markdown('mails.booking')
            ->with([
                'link' => '/inboxes',
                'name' => $request->user()->name,
                'booking' => $this->booking,
                'order' => $this->order,
            ]);
    }
}
