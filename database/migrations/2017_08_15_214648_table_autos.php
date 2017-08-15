<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TableAutos extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('autos', function (Blueprint $table) {
			$table->increments('id');
			$table->string('marque_id');
			$table->string('model_id');
			$table->string('immat');
			$table->string('client_id')->nullable();
			$table->integer('kilometrage')->nullable();
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
		Schema::dropIfExists('autos');
	}
}
