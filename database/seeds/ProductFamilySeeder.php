<?php

use Illuminate\Database\Seeder;
use InvoiceSinger\Storage\Service\Contract\ProductFamilyServiceInterface;
use InvoiceSinger\Support\Concern\HasService;
use Symfony\Component\HttpFoundation\ParameterBag;

/**
 * Class ProductFamilySeeder.
 */
class ProductFamilySeeder extends Seeder
{
    use HasService;

    /**
     * Default set of product families.
     *
     * @var array
     */
    protected $familes = [
        'Default Product Family',
    ];

    /**
     * ProductFamilySeeder constructor.
     *
     * @param \InvoiceSinger\Storage\Service\Contract\ProductFamilyServiceInterface $service
     */
    function __construct(ProductFamilyServiceInterface $service)
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
        foreach((array)$this->familes as $name) {
            $this->getService()->create(new ParameterBag(compact('name')));
        }
    }
}
