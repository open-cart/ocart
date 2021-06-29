<?php

namespace Ocart\Core\Providers;

use Illuminate\Support\ServiceProvider;

class EmailConfigServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->booted(function () {
            $config = $this->app->make('config');
            $setting = setting();

            $config->set([
                'mail' => array_merge($config->get('mail'), [
                    'default' => $setting->get('email_driver', $config->get('mail.default')),
                    'from'    => [
                        'address' => $setting->get('email_from_address', $config->get('mail.from.address')),
                        'name'    => $setting->get('email_from_name', $config->get('mail.from.name')),
                    ],
                ]),
            ]);

            switch ($setting->get('email_driver', $config->get('mail.default'))) {
                case 'smtp':
                    $config->set([
                        'mail.mailers.smtp' => array_merge($config->get('mail.mailers.smtp'), [
                            'transport' => 'smtp',
                            'host' => $setting->get('mailer_host', $config->get('mail.mailers.smtp.host')),
                            'port' => (int)$setting->get('mailer_port', $config->get('mail.mailers.smtp.port')),
                            'encryption' => $setting->get('mailer_encryption',
                                $config->get('mail.mailers.smtp.encryption')),
                            'username' => $setting->get('mailer_username', $config->get('mail.mailers.smtp.username')),
                            'password' => $setting->get('mailer_password', $config->get('mail.mailers.smtp.password')),
                        ]),
                    ]);
                    break;
                default:
                    break;
            }
        });
    }
}