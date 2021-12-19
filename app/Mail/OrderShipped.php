<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderShipped extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
     public $order;
    public function __construct($order)
    {
        $this->order= $order;
    }

    public function build()
    {
        return $this
        ->subject('khaled Kars')
        ->markdown('pdfMail', [
            'url' => route('order.pdf',['orderpdf'=>$this->order->pdf]),
            'logo'=>'/assets/img/brand/favicon.png'
        ]);
    }
}
