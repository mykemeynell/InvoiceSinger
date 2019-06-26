<?php

use Illuminate\Database\Seeder;
use InvoiceSinger\Storage\Service\Contract\UnitServiceInterface;
use InvoiceSinger\Support\Concern\HasService;
use Symfony\Component\HttpFoundation\ParameterBag;

/**
 * Class UnitSeeder.
 */
class UnitSeeder extends Seeder
{
    use HasService;

    /**
     * Default units.
     *
     * @var array
     */
    protected $units = [
        ['name' => 'Hours', 'unit' => 'hour/hours'],
        ['name' => 'Pieces', 'unit' => 'piece/pieces'],
        ['name' => 'Container', 'unit' => 'containers/container'],
    ];

    /**
     * UnitSeeder constructor.
     *
     * @param \InvoiceSinger\Storage\Service\Contract\UnitServiceInterface $service
     */
    function __construct(UnitServiceInterface $service)
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
    public function run()
    {
        foreach((array) $this->units as $unit) {
            $this->getService()->create(new ParameterBag($unit));
        }
    }
}
