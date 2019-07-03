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
        try {
            DB::connection()->getPdo();

            if(DB::connection()->getDatabaseName()) {
                /** @var \Illuminate\Database\Eloquent\Collection $settings */
                $settings = $service->fetch();

                /** @var \LaravelDatabaseSettings\Entity\Contract\SettingEntityInterface $setting */
                foreach ($settings as $setting) {
                    config()->set($setting->getKey(), $setting->getValue());
                }
            }
        } catch(\Exception $exception) {}
    }
}
