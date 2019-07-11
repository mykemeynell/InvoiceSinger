<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use UuidColumn\Concern\UuidColumn;

/**
 * Class CreateQuotesTable.
 */
class CreateQuotesTable extends Migration
{
    use UuidColumn;

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quotes', function (Blueprint $table) {
            $this->createUuidColumn($table, 'id');

            $table->string('client');
            $table->string('key');
            $table->string('status')->default('draft');
            $table->text('terms')->nullable();

            $table->date('issued_at')->nullable();
            $table->date('expires_at')->nullable();
            $table->dateTime('sent_at')->nullable();
            $table->dateTime('approved_at')->nullable();
            $table->dateTime('rejected_at')->nullable();

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
        Schema::dropIfExists('quotes');
    }
}
