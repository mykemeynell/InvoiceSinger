<?php

use Illuminate\Database\Seeder;

/**
 * Class AppSettingsSeeder
 */
class AppSettingsSeeder extends Seeder
{
    use \InvoiceSinger\Support\Concern\Seeders\PopulatesSettings;

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
