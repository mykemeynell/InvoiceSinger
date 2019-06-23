<?php

use Illuminate\Database\Seeder;

/**
 * Class InvoiceSettingsSeeder
 */
class InvoiceSettingsSeeder extends Seeder
{
    use \InvoiceSinger\Support\Concern\Seeders\PopulatesSettings;

    /**
     * Settings.
     *
     * @var array
     */
    protected $settings = [
        'invoice.key' => [
            'value' => 1,
            'name' => 'Invoice Key',
            'description' => 'Used as a marker for the incrementing value of invoices',
        ],
        'invoice.pattern' => [
            'value' => 'INV-%m%-%increment%',
            'name' => 'Invoice Pattern',
            'description' => 'The numbering pattern that invoices will follow',
        ],
        'invoice.term' => [
            'value' => '30 days',
            'name' => 'Invoice Term',
            'description' => 'The duration after which being raised, an invoice will become overdue',
        ],
    ];

    /**
     * InvoiceSettingsSeeder constructor.
     *
     * @param \LaravelDatabaseSettings\Service\Contract\SettingServiceInterface $service
     */
    function __construct(\LaravelDatabaseSettings\Service\Contract\SettingServiceInterface $service)
    {
        $this->setService($service);
    }
}
