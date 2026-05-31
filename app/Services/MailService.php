<?php

namespace App\Services;

use App\Models\Setting;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Mail;

class MailService
{
    /**
     * Configure the mailer from database settings then send.
     */
    public static function sendToAdmin(Mailable $mailable): bool
    {
        try {
            $to = Setting::get('notification_email', Setting::get('site_email', 'hello@mozulafrica.com'));

            static::configureMailer();

            Mail::to($to)->send($mailable);
            return true;
        } catch (\Throwable $e) {
            \Log::error('MailService::sendToAdmin failed: ' . $e->getMessage());
            return false;
        }
    }

    public static function configureMailer(): void
    {
        $host       = Setting::get('smtp_host');
        $port       = Setting::get('smtp_port');
        $username   = Setting::get('smtp_username');
        $password   = Setting::get('smtp_password');
        $encryption = Setting::get('smtp_encryption', 'tls');
        $fromAddr   = Setting::get('mail_from_address', Setting::get('site_email', 'hello@mozulafrica.com'));
        $fromName   = Setting::get('mail_from_name', Setting::get('site_name', 'Mozul Africa'));

        if ($host && $port) {
            config([
                'mail.default'                          => 'smtp',
                'mail.mailers.smtp.host'                => $host,
                'mail.mailers.smtp.port'                => (int) $port,
                'mail.mailers.smtp.username'            => $username,
                'mail.mailers.smtp.password'            => $password,
                'mail.mailers.smtp.encryption'          => $encryption === 'none' ? null : $encryption,
            ]);
        }

        config([
            'mail.from.address' => $fromAddr,
            'mail.from.name'    => $fromName,
        ]);
    }

    public static function notificationsEnabled(): bool
    {
        return (bool) Setting::get('email_notifications_enabled', '1');
    }
}
