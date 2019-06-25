<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(AppSettingsSeeder::class);
        $this->call(InvoiceSettingsSeeder::class);
        $this->call(QuoteSettingsSeeder::class);
        $this->call(ProductFamilySeeder::class);
        $this->call(DefaultTaxRatesSeeder::class);
    }
}
