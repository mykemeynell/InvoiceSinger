<?php

use Illuminate\Database\Seeder;
use InvoiceSinger\Storage\Service\Contract\TaxRateServiceInterface;
use InvoiceSinger\Support\Concern\HasService;
use Symfony\Component\HttpFoundation\ParameterBag;

/**
 * Class DefaultTaxRatesSeeder.
 */
class DefaultTaxRatesSeeder extends Seeder
{
    use HasService;

    /**
     * Default tax rates.
     *
     * @var array
     */
    protected $taxRates = [
        20 => 'UK VAT',
    ];

    /**
     * DefaultTaxRatesSeeder constructor.
     *
     * @param \InvoiceSinger\Storage\Service\Contract\TaxRateServiceInterface $service
     *
     */
    function __construct(TaxRateServiceInterface $service)
    {
        $this->setService($service);
    }

    /**
     * Run the database seeds.
     *
     * @return void
     *
     * @throws \Exception
     */
    public function run(): void
    {
        foreach((array)$this->taxRates as $amount => $name) {
            $this->getService()->create(
                new ParameterBag(compact('amount', 'name'))
            );
        }
    }
}
