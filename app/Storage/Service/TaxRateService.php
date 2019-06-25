<?php

namespace InvoiceSinger\Storage\Service;

use ArchLayer\Service\Service;
use InvoiceSinger\Storage\Repository\Contract\TaxRateRepositoryInterface;
use InvoiceSinger\Storage\Service\Contract\TaxRateServiceInterface;

/**
 * Class TaxRateService.
 *
 * @package InvoiceSinger\Storage\Service
 */
class TaxRateService extends Service implements TaxRateServiceInterface
{
    /**
     * TaxRateService constructor.
     *
     * @param \InvoiceSinger\Storage\Repository\Contract\TaxRateRepositoryInterface $repository
     */
    function __construct(TaxRateRepositoryInterface $repository)
    {
        $this->setRepository($repository);
    }
}
