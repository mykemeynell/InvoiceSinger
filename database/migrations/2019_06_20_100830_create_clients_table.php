<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use UuidColumn\Concern\UuidColumn;

/**
 * Class CreateClientsTable.
 */
class CreateClientsTable extends Migration
{
    use UuidColumn;

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $this->createUuidColumn($table, 'id');

            $table->string('first_name');
            $table->string('last_name')->nullable();
            $table->string('business_name')->nullable();

            $table->string('address_1')->nullable();
            $table->string('address_2')->nullable();
            $table->string('town_city')->nullable();
            $table->string('postcode')->nullable();
            $table->string('country')->nullable();

            $table->string('telephone')->nullable();
            $table->string('fax')->nullable();
            $table->string('mobile')->nullable();
            $table->string('email_address')->nullable();
            $table->string('web')->nullable();

            $table->string('vat_number')->nullable();

            $table->tinyInteger('is_active')->default(1);

            $table->timestamps();

            /*
             * Index.
             */
            $table->primary('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clients');
    }
}
