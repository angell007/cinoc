<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDocumentoContratadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documento_contratados', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('id_empresa')->nullable();
            $table->integer('id_candidato')->nullable();
            $table->date('fecha')->nullable();
            $table->text('notas')->nullable();
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('documento_contratados');
    }
}
