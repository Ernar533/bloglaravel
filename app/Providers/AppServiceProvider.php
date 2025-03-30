<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Auth\Notifications\VerifyEmail;
use App\Notifications\SendVerifyWithQueueNotfication;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Регистрация сервисов приложения.
     */
    public function register(): void
    {
        //
    }

    /**
     * Загрузка сервисов приложения.
     */
    public function boot(): void
    {
        // Переопределяем уведомление на свое
        VerifyEmail::toMailUsing(function ($notifiable, $url) {
            return (new SendVerifyWithQueueNotfication())->toMail($notifiable);
        });
    }
}
