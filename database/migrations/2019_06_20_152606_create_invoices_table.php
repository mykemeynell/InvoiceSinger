<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use UuidColumn\Concern\UuidColumn;

class CreateInvoicesTable extends Migration
{
    use UuidColumn;

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $this->createUuidColumn($table, 'id');

            $table->string('client');
            $table->string('key');
            $table->date('raised_at');
            $table->date('due_at');
            $table->dateTime('sent_at')->nullable();
            $table->string('status')->default('draft');
            $table->string('payment_method')->default('cash');
            $table->text('terms')->nullable();

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
        Schema::dropIfExists('invoices');
    }
}
