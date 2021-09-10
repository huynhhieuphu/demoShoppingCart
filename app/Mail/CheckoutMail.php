<?php

namespace App\Mail;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CheckoutMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $order_id;
    protected $cart;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($order_id, $cart)
    {
        $this->order_id = $order_id;
        $this->cart = $cart;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $order = Order::findOrFail($this->order_id);

        return $this->from('phuhh2019@gmail.com')
                    ->view('public.checkout-mail')
                    ->with([
                        'order' => $order,
                        'cart' => $this->cart,
                    ]);
    }
}
