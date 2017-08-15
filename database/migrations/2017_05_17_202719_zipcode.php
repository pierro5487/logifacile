<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Zipcode extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cp_autocomplete', function (Blueprint $table) {
            $table->increments('id');
            $table->string('CODEPAYS',2)->nullable();
            $table->string('CP',10)->nullable();
            $table->string('VILLE',180)->nullable();
            $table->string('NOMADMIN1',100)->nullable();
            $table->string('CODEADMIN1',20)->nullable();
            $table->string('NOMADMIN2',100)->nullable();
            $table->string('CODEADMIN2',20)->nullable();
            $table->string('NOMADMIN3',100)->nullable();
            $table->string('CODEADMIN3',20)->nullable();
            $table->double('LATITUDE', 15, 8)->nullable();
            $table->double('LONGITUDE', 15, 8)->nullable();
            $table->integer('ACURANCY')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cp_autocomplete');
    }
}
