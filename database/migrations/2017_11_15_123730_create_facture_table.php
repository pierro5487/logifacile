<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFactureTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('factures', function (Blueprint $table) {
			$table->increments('id');
			$table->dateTime('date_document');
			$table->string('etat')->default('brouillon');
			$table->string('numero');
			$table->mediumInteger('situation');
			$table->string('type');
			$table->integer('client_id');
			$table->string('nom_client');
			$table->string('adresse');
			$table->string('adresse_comp')->nullable();
			$table->string('code_postal');
			$table->string('ville');
			$table->string('pays');
			$table->string('note')->nullable();
			$table->dateTime('echeance');
			$table->mediumInteger('fichier_id')->nullable();
			$table->dateTime('date_envoi')->nullable();
			$table->dateTime('date_validation')->nullable();
			$table->string('type_envoi')->nullable();
			$table->decimal('accompte',10,4)->default(0);
			$table->decimal('totalHT_precedent',10,4)->default(0);
			$table->decimal('totalHT',10,4)->default(0);
			$table->decimal('totalTva',10,4)->default(0);
			$table->decimal('totalTTC',10,4)->default(0);
			$table->decimal('remise',10,4)->default(0);
			$table->tinyInteger('createur_id');
			$table->tinyInteger('modificateur_id')->nullable();
			$table->tinyInteger('validateur_id')->nullable();
			$table->boolean('is_auto_E')->default(0);
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
		Schema::dropIfExists('factures');
	}
}
