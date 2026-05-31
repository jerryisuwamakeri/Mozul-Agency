<?php

use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        $settings = [
            // Notifications group
            ['key' => 'email_notifications_enabled', 'label' => 'Enable Email Notifications', 'value' => '1',                      'type' => 'boolean', 'group' => 'notifications', 'order' => 1],
            ['key' => 'notification_email',           'label' => 'Admin Notification Email',   'value' => 'hello@mozulafrica.com',   'type' => 'text',    'group' => 'notifications', 'order' => 2],
            // SMTP group
            ['key' => 'smtp_host',                   'label' => 'SMTP Host',                  'value' => '',                        'type' => 'text',    'group' => 'smtp', 'order' => 1],
            ['key' => 'smtp_port',                   'label' => 'SMTP Port',                  'value' => '587',                     'type' => 'text',    'group' => 'smtp', 'order' => 2],
            ['key' => 'smtp_username',               'label' => 'SMTP Username',              'value' => '',                        'type' => 'text',    'group' => 'smtp', 'order' => 3],
            ['key' => 'smtp_password',               'label' => 'SMTP Password',              'value' => '',                        'type' => 'password','group' => 'smtp', 'order' => 4],
            ['key' => 'smtp_encryption',             'label' => 'Encryption',                 'value' => 'tls',                     'type' => 'text',    'group' => 'smtp', 'order' => 5],
            ['key' => 'mail_from_address',           'label' => 'From Email Address',         'value' => 'hello@mozulafrica.com',   'type' => 'text',    'group' => 'smtp', 'order' => 6],
            ['key' => 'mail_from_name',              'label' => 'From Name',                  'value' => 'Mozul Africa',            'type' => 'text',    'group' => 'smtp', 'order' => 7],
        ];

        foreach ($settings as $setting) {
            \App\Models\Setting::updateOrCreate(['key' => $setting['key']], $setting);
        }
    }

    public function down(): void
    {
        $keys = [
            'email_notifications_enabled', 'notification_email',
            'smtp_host', 'smtp_port', 'smtp_username', 'smtp_password',
            'smtp_encryption', 'mail_from_address', 'mail_from_name',
        ];

        \App\Models\Setting::whereIn('key', $keys)->delete();
    }
};
