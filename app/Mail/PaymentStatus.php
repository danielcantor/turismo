<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PaymentStatus extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $orderCode;
    public $orderDate;
    public $totalPrice;
    public $status;
    public $email;
    public $billingInfo;
    public $productInfo;
    public $passengers;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name, $orderCode, $orderDate, $totalPrice, $status, $email, $billingInfo = [], $productInfo = [], $passengers = [])
    {
        $this->name = $name;
        $this->orderCode = $orderCode;
        $this->orderDate = $orderDate;
        $this->totalPrice = $totalPrice;
        $this->status = $status;
        $this->email = $email;
        $this->billingInfo = $billingInfo;
        $this->productInfo = $productInfo;
        $this->passengers = $passengers;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $view = '';
        $subject = '';

        switch ($this->status) {
            case 'success':
                $view = 'emails.payment_success';
                $subject = "Confirmación de tu compra #{$this->orderCode} - Cynthia Garske";
                break;
            case 'pending':
                $view = 'emails.payment_pending';
                $subject = "Pago Pendiente - Cynthia Garske";
                break;
            case 'failed':
                $view = 'emails.payment_failed';
                $subject = "Pago Fallido - Cynthia Garske";
                break;
            case 'reserved':
                $view = 'emails.reservation_confirmed';
                $subject = "Confirmación de reserva #{$this->orderCode} - Cynthia Garske";
                break;
        }

        return $this->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'))
            ->view($view, [
                'name' => $this->name,
                'orderCode' => $this->orderCode,
                'orderDate' => $this->orderDate,
                'totalPrice' => $this->totalPrice,
                'billingInfo' => $this->billingInfo,
                'productInfo' => $this->productInfo,
                'passengers' => $this->passengers,
            ])
            ->subject($subject)
            ->replyTo(env('MAIL_REPLY_TO_ADDRESS'), env('MAIL_REPLY_TO_NAME'));
    }
}
