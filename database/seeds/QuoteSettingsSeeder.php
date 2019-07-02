<?php

use Illuminate\Database\Seeder;

/**
 * Class QuoteSettingsSeeder.
 */
class QuoteSettingsSeeder extends Seeder
{
    use \InvoiceSinger\Support\Concern\Seeders\PopulatesSettings;

    /**
     * Settings.
     *
     * @var array
     */
    protected $settings = [
        'quote.key' => [
            'value' => 1,
            'name' => 'Quote Key',
            'description' => 'Used as a marker for the incrementing value of quotes',
        ],
        'quote.pattern' => [
            'value' => 'QUO-%m%-%increment%',
            'name' => 'Quote Pattern',
            'description' => 'The numbering pattern that quotes will follow',
        ],
        'quote.term' => [
            'value' => '30 days',
            'name' => 'Quote Term',
            'description' => 'The duration after which being issued, an quote will expire',
        ],
        'quote.footer' => [
            'value' => 'Thank you for your business.\r\nKind regards',
            'name' => 'Footer',
            'description' => 'Notes/additional information to be added to the end of each invoice',
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
