<?php

namespace InvoiceSinger\Support\Concern\Seeders;

use InvoiceSinger\Support\Concern\HasService;

/**
 * Trait PopulatesSettings.
 *
 * Used to populate the settings table in the database - takes the $settings
 * property and migrates them into the database. Structure:
 * [
 *  '<key>' => [
 *      'value' => '<value>',
 *      'name' => '<short name>',
 *      'description' => '<description of setting>',
 *   ], ...
 * ];
 *
 * @package InvoiceSinger\Support\Concern\Seeders
 */
trait PopulatesSettings
{
    use HasService;

    /**
     * Run the database seeds.
     *
     * @return void
     * @throws \Exception
     */
    public function run()
    {
        foreach($this->settings as $key => $attributes) {
            $this->getService()->create(new \Symfony\Component\HttpFoundation\ParameterBag(
                array_merge($attributes, compact('key'))
            ));
        }
    }
}
