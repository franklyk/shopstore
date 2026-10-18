<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class EmailVerificationCodeNotification extends Notification
{
    use Queueable;

    public function __construct(
        public readonly string $code
    ) {}

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Confirme seu e-mail | ShopStore')
            ->greeting('Olá, ' . $notifiable->name . '!')
            ->line('Recebemos uma solicitação para confirmar seu endereço de e-mail no ShopStore.')
            ->line('Utilize o código abaixo para concluir a verificação:')
            ->line('**' . $this->code . '**')
            ->line('O código é válido por 10 minutos e pode ser utilizado apenas uma vez.')
            ->line('Se você não solicitou essa verificação, ignore este e-mail.');
    }
}
