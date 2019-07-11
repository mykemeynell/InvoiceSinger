<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use UuidColumn\Concern\UuidColumn;

/**
 * Class CreateQuoteProductsTable.
 */
class CreateQuoteProductsTable extends Migration
{
    use UuidColumn;

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quote_products', function (Blueprint $table) {
            $this->createUuidColumn($table, 'id');

            $table->string('quote');
            $table->string('name');
            $table->text('description')->nullable();
            $table->float('price', 10, 2);
            $table->float('quantity', 10, 2);
            $table->string('unit');
            $table->float('subtotal', 10, 2);
            $table->string('tax_rate')->nullable();
            $table->float('discount', 10, 2)->default(0);
            $table->float('total', 10, 2);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('quote_products');
    }
}
