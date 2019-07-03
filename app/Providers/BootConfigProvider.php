<?php

namespace InvoiceSinger\Providers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;
use InvoiceSinger\Support\Concern\Providers\BootOnly;
use LaravelDatabaseSettings\Service\Contract\SettingServiceInterface;

/**
 * Class BootConfigProvider
 *
 * @package InvoiceSinger\Providers
 */
class BootConfigProvider extends ServiceProvider
{
    use BootOnly;

    /**
     * Bootstrap services.
     *
     * @param \LaravelDatabaseSettings\Service\Contract\SettingServiceInterface $service
     *
     * @return void
     */
    public function boot(SettingServiceInterface $service)
    {
        // Attempt to connect to the database - if an exception is thrown
        // return false from this method and don't load the settings into
        // config().
        try {
            DB::connection()->getPdo();
            DB::connection()->getDatabaseName();
        } catch(\Exception $exception) {
            return;
        }

        /** @var \Illuminate\Database\Eloquent\Collection $settings */
        $settings = $service->fetch();

        /** @var \LaravelDatabaseSettings\Entity\Contract\SettingEntityInterface $setting */
        foreach ($settings as $setting) {
            config()->set($setting->getKey(), $setting->getValue());
        }
    }
}
