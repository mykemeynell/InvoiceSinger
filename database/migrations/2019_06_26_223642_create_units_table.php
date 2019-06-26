<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use UuidColumn\Concern\UuidColumn;

/**
 * Class CreateUnitsTable.
 */
class CreateUnitsTable extends Migration
{
    use UuidColumn;

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('units', function (Blueprint $table) {
            $this->createUuidColumn($table, 'id');
            $table->string('name');
            $table->string('unit');
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
        Schema::dropIfExists('units');
    }
}
