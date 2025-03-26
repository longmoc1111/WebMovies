<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ResetPasswordCustom extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public $token;
    public function __construct($token)
    {
        $this->token = $token;
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
        return (new MailMessage)
                    ->subject("Khôi phục mật khẩu")
                    ->greeting("Xin chào !")    
                    ->line('Bạn nhận được Email này vì có yêu cầu đặt lại mật khẩu.')
                    ->action('Đặt lại mật khẩu', url('/reset-password/'. $this->token))
                    ->line('Nếu bạn không sử dụng link này trong 1 giờ, đường link sẽ hết hạn');
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
