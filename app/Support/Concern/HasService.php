<?php

namespace InvoiceSinger\Support\Concern;

use ArchLayer\Service\Contract\ServiceInterface;
use Exception;
use Illuminate\Support\Collection;

/**
 * Trait HasService.
 *
 * @package InvoiceSinger\Support\Concern
 */
trait HasService
{
    /**
     * Holds the services that are used within the parent object.
     *
     * @var \Illuminate\Support\Collection
     */
    protected $services;

    /**
     * Set a service within the object $services property.
     *
     * @param \ArchLayer\Service\Contract\ServiceInterface $service
     * @param string|null                                  $name
     *
     * @return Collection
     */
    protected function setService(ServiceInterface $service, ?string $name = null): Collection
    {
        if (! $this->services instanceof Collection) {
            $this->services = collect([]);
        }

        return $this->services->put(self::normalizeName($name), $service);
    }

    /**
     * Get a service that has been added into the parent object. A name can be specified if more than one
     * service has been registered.
     *
     * @param string|null $name
     *
     * @return \ArchLayer\Service\Contract\ServiceInterface
     *
     * @throws \Exception
     */
    protected function getService(?string $name = null): ServiceInterface
    {
        $name = self::normalizeName($name);

        if ($service = $this->services->get($name)) {
            return $service;
        }

        throw new Exception("Service at {$name} hasn't been set");
    }

    /**
     * Return a normalized string when getting or setting service by name.
     * Ensures that when a service is set, the string does not contain characters
     * that could cause unexpected or unwanted behaviour.
     *
     * @param string|null $name
     *
     * @return string
     */
    private static function normalizeName(?string $name = null): string
    {
        if (is_null($name)) {
            return 'default';
        }

        return preg_replace("/[^a-z\-]/i", '-', strtolower($name));
    }
}
