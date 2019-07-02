<?php

use Illuminate\Database\Seeder;
use InvoiceSinger\Support\Concern\Seeders\PopulatesSettings;

/**
 * Class AppSettingsSeeder
 */
class AppSettingsSeeder extends Seeder
{
    use PopulatesSettings;

    /**
     * Settings.
     *
     * @var array
     */
    protected $settings = [
        'app.currency' => [
            'value' => 'GBP',
            'name' => 'Currency',
            'description' => 'Currency used throughout the application',
        ],
        'app.online_payments.enabled' => [
            'value' => false,
            'name' => 'Online payments',
            'description' => 'Enable in order to accept online payments for invoices',
        ],
        'app.online_payments.provider' => [
            'value' => '',
            'name' => 'Payments Provider',
            'description' => 'The provider that payments will be processed by',
        ],
        'app.logo' => [
            'value' => '/images/logo/invoice-singer-white.png',
            'name' => 'Application logo',
            'description' => 'Application logo. Also used in invoices and quotes',
        ],
    ];

    /**
     * AppSettingsSeeder constructor.
     *
     * @param \LaravelDatabaseSettings\Service\Contract\SettingServiceInterface $service
     */
    function __construct(\LaravelDatabaseSettings\Service\Contract\SettingServiceInterface $service)
    {
        $this->setService($service);
    }
}
