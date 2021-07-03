<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotificacionAsistenciaAlumno extends Mailable
{
    use Queueable, SerializesModels;
    protected $alumno, $fecha;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($alumno, $fecha)
    {
        $this->alumno = $alumno;
        $this->fecha = $fecha;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->view('mail')
            ->subject("Notificación de asistencia")
            ->with([
                "alumno" => $this->alumno,
                "fecha" => $this->fecha,
            ]);
    }
}