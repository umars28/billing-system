<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class LowBalanceNotification extends Notification
{
    public function __construct(public float $balance) {}

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Saldo Anda Hampir Habis')
            ->line('Saldo akun Anda saat ini: Rp ' . number_format($this->balance, 0))
            ->line('Segera lakukan top-up agar layanan VPS Anda tidak terhenti.');
    }
}

