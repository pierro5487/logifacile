<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMontageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('montages', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
			$table->boolean('size');
			$table->boolean('alu');
			$table->boolean('runflat');
			$table->boolean('truck');
			$table->boolean('montage');
			$table->boolean('equilibrage');
			$table->boolean('valve');
			$table->decimal('valeur',10,2);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('montages');
    }
}
