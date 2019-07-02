<?php

use Illuminate\Database\Seeder;
use InvoiceSinger\Storage\Service\Contract\PaymentMethodServiceInterface;
use InvoiceSinger\Support\Concern\HasService;
use Symfony\Component\HttpFoundation\ParameterBag;

/**
 * Class PaymentMethodSeeder
 *
 * @method PaymentMethodServiceInterface getService(?string $name = null) : ServiceInterface
 */
class PaymentMethodSeeder extends Seeder
{
    use HasService;

    /**
     * PaymentMethodSeeder constructor.
     *
     * @param \InvoiceSinger\Storage\Service\Contract\PaymentMethodServiceInterface $service
     */
    function __construct(PaymentMethodServiceInterface $service)
    {
        $this->setService($service);
    }

    /**
     * Default payment methods.
     *
     * @var array
     */
    protected $methods = [
        ['name' => 'Cash', 'slug' => 'cash'],
        ['name' => 'BACS/Bank Transfer', 'slug' => 'bacs'],
        ['name' => 'Cheque', 'slug' => 'cheque'],
        ['name' => 'Online Payment', 'slug' => 'online'],
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     *
     * @throws \Exception
     */
    public function run()
    {
        foreach((array)$this->methods as $method) {
            $method['enabled'] = 1;
            $method['protected'] = 1;
            $this->getService()->create(new ParameterBag($method));
        }
    }
}
