<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLigneFacture extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lignesfactures', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('document_id');
			$table->string('libelle');
			$table->mediumInteger('quantite');
			$table->decimal('prix_unitaire_HT',10,2);
			$table->decimal('taux_tva',5,2);
			$table->decimal('remise',5,2);
			$table->tinyInteger('createur_id');
			$table->integer('groupe_lignes_id');
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
		Schema::dropIfExists('lignesfactures');
    }
}
