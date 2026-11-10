<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Auth\Notifications\ResetPassword;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // メールアドレスの確認用メールのカスタマイズ
        VerifyEmail::toMailUsing(function ($notifiable, $url) {
            return (new MailMessage)
                ->subject('メールアドレスの確認')
                ->greeting('ご登録ありがとうございます')
                ->line('以下のボタンをクリックしてメールアドレスを確認してください。')
                ->action('メールアドレスを確認する', $url)
                ->line('このメールに心当たりがない場合は無視してください。');
        });

        // パスワード再設定用のメールのカスタマイズ
        ResetPassword::toMailUsing(function ($notifiable, $token) {
            return (new MailMessage)
                ->subject('パスワード再設定のご案内')
                ->greeting('こんにちは！')
                ->line('パスワード再設定のリクエストを受け付けました。')
                ->line('以下のボタンから新しいパスワードを設定してください。')
                ->action('パスワードを再設定する', url(route('password.reset', [
                    'token' => $token,
                    'email' => $notifiable->getEmailForPasswordReset(),
                ], false)))
                ->line('このリンクは一定時間経過すると無効になります。')
                ->line('このメールに心当たりがない場合は、何もする必要はありません。');
        });
    }
}
