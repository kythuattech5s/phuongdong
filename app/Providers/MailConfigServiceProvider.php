<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use vanhenry\helpers\helpers\SettingHelper;

class MailConfigServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {   
        $mailDriver = SettingHelper::getSetting("mail_driver","smtp");
        $mailHost = SettingHelper::getSetting("5","smtp.gmail.com");
        $mailPort = SettingHelper::getSetting("mail_port","465");
        $mailFromAddress = SettingHelper::getSetting("mail_from_address","");
        $mailFromName = SettingHelper::getSetting("mail_from_name","");
        $mailEncryption = SettingHelper::getSetting("mail_encryption","ssl");
        $mailUsername = SettingHelper::getSetting("mail_username","");
        $mailPassword = SettingHelper::getSetting("mail_password","");
        $config = [
            'driver'        => $mailDriver,
            'host'          => $mailHost,
            'port'          => $mailPort,
            'from'          => [
                'address'       => $mailFromAddress,
                'name'          => $mailFromName
            ],
            'encryption'    => $mailEncryption,
            'username'      => $mailUsername,
            'password'      => $mailPassword,
            'sendmail'      => "/usr/sbin/sendmail -bs",
            'pretend'       => false,
            'secret' => SettingHelper::getSetting('MAILGUN_SECRET') ?? env('MAILGUN_SECRET'),
            'domain' => SettingHelper::getSetting('MAILGUN_DOMAIN') ?? env('MAILGUN_DOMAIN'),
            'endpoint' => SettingHelper::getSetting('MAILGUN_ENDPOINT') ?? env('MAILGUN_ENDPOINT')
       ];
		\Config::set('mail',$config);
    }
}