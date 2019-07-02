<?php

use Illuminate\Database\Seeder;

/**
 * Class PaymentMethodSeeder
 */
class PaymentMethodSeeder extends Seeder
{
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
     */
    public function run()
    {
        //
    }
}
