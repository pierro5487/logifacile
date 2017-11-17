<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGroupeligne extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('groupe_ligne', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('document_id');
			$table->integer('auto_id')->nullable();
			$table->string('immatriculation')->nullable();
			$table->string('auto_string')->nullable();
			$table->integer('kilometrage')->nullable();
			$table->dateTime('date_document')->nullable();
			$table->boolean('no_header')->default(true);
			$table->tinyInteger('createur_id');
			$table->softDeletes();
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
		Schema::dropIfExists('groupe_ligne');
    }
}
