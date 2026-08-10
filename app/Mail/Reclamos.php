<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Reclamos extends Mailable
{
    use Queueable, SerializesModels;

    public $reclamo;

    /**
     * Create a new message instance.
     */
    public function __construct($mensaje)
    {
        $this->reclamo = $mensaje;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->view('emails.reclamos')
            ->subject('Hoja de Reclamación Virtual - DELTAPACK');
    }
}
