<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PaymentStatus extends Mailable
{
    use Queueable, SerializesModels;
    public $customerName;
    public $orderNumber;
    public $orderDate;
    public $orderTotal;
    public $status;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($customerName, $orderNumber, $orderDate, $orderTotal, $status)
    {
        $this->customerName = $customerName;
        $this->orderNumber = $orderNumber;
        $this->orderDate = $orderDate;
        $this->orderTotal = $orderTotal;
        $this->status = $status;
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
                $subject = 'Pago Exitoso - Cynthia Garske';
                break;
            case 'pending':
                $view = 'emails.payment_pending';
                $subject = 'Pago Pendiente - Cynthia Garske';
                break;
            case 'failed':
                $view = 'emails.payment_failed';
                $subject = 'Pago Fallido - Cynthia Garske';
                break;
        }

        return $this->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'))
            ->view($view, [
                'customerName' => $this->customerName,
                'orderNumber' => $this->orderNumber,
                'orderDate' => $this->orderDate,
                'orderTotal' => $this->orderTotal
            ])->subject($subject)
            ->replyTo(env('MAIL_REPLY_TO_ADDRESS'), env('MAIL_REPLY_TO_NAME'));
    }
}
