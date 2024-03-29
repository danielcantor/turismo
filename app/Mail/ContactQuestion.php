<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactQuestion extends Mailable
{
    use Queueable, SerializesModels;
    public $name;
    public $email;
    public $phone;
    public $mensaje;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct( $name, $email, $phone, $message)
    {
        $this->name = $name;
        $this->email = $email;
        $this->phone = $phone;
        $this->mensaje = $message;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'))
            ->view('email.consulta' , [
                'name' => $this->name,
                'mail' => $this->email,
                'phone' => $this->phone,
                'mensaje' => $this->mensaje
            ])->subject('Recibiste una consulta de ' . $this->name)
            ->replyTo($this->email, $this->name);
    }
}
