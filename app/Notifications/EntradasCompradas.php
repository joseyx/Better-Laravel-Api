<?php

namespace App\Notifications;

use App\Models\Horario;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class EntradasCompradas extends Notification
{
    use Queueable;

    private $horarioId;
    private $userId;
    private $asientos;

    /**
     * Create a new notification instance.
     */
    public function __construct($horarioId, $userId, $asientos)
    {
        $this->horarioId = $horarioId;
        $this->userId = $userId;
        $this->asientos = $asientos;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $horario = Horario::with('asientos', 'pelicula', 'sala')->find($this->horarioId);
        $user = User::find($this->userId);

        $qrContent = 'Asientos comprados: ' . implode(', ', $this->asientos) . "\n"
        . 'Cliente: ' . $user->name . "\n"
        . 'Email: ' . $user->email;

        $qr = QrCode::size(300)->generate($qrContent);


        return (new MailMessage)
            ->subject('Compra de entradas')
            ->greeting('¡Hola!')
            ->line('Usted ha realizado una compra para la película: ' . $horario->pelicula->nombre)
            ->line('En la sala: ' . $horario->sala->nombre)
            ->line('Para la hora: ' . $horario->hora)
            ->line('Muestre el qr en la entrada de la sala:')
            ->action('insert', $qr)
            ->line('Gracias por su compra!');
    }
    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
