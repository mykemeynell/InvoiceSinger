<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use UuidColumn\Concern\UuidColumn;

/**
 * Class CreatePaymentsTable.
 */
class CreatePaymentsTable extends Migration
{
    use UuidColumn;

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $this->createUuidColumn($table, 'id');
            $table->string('invoice');
            $table->string('method');
            $table->float('amount', 10, 2);
            $table->dateTime('paid_at');
            $table->text('notes')->nullable();
            $table->text('payload')->nullable();
            $table->tinyInteger('committed')->default(1);
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
        Schema::dropIfExists('payments');
    }
}
