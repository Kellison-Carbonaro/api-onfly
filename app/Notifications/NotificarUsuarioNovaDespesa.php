<?php

namespace App\Notifications;

use App\Models\Usuarios;
use App\Models\Despesas;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NotificarUsuarioNovaDespesa extends Notification
{
    use Queueable;
    private $despesa;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Despesas $despesa)
    {
        $this->despesa = $despesa;
    }

    public function viaQueues(): array
    {
        return [
            'mail' => 'mail-queue',
            'slack' => 'slack-queue',
        ];
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $usuario = Usuarios::find($this->despesa->usuarios_id);
        return (new MailMessage)
            ->subject('Despesa cadastrada!!!')
            ->greeting('Ola! Você tem uma nova despesa cadastrada')
            ->line('Foi cadastrado uma nova despesa para você ' . $usuario['nome'])
            ->line('Descrição da despesa: ' . $this->despesa->descricao)
            ->line('Valor: R$' . $this->despesa->preco)
            ->salutation('Até a próxima!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
