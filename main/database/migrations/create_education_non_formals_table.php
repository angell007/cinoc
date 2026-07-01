<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEducationNonFormalsTable extends Migration
{
    /**
     * Ejecuta las migraciones.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('education_non_formals', function (Blueprint $table) {
            $table->id();
            $table->enum('training_type', ['curso', 'taller', 'diplomado', 'seminario', 'certificacion']);
            $table->string('institution');
            $table->enum('certification_status', ['certificado', 'no_certificado']);
            $table->string('program_name');
            // $table->foreignId('country_id')->constrained()->onDelete('cascade');
            // $table->foreignId('state_id')->constrained()->onDelete('cascade');
            // $table->foreignId('city_id')->constrained()->onDelete('cascade');
            $table->unsignedInteger('duration');
            $table->date('date');
            $table->timestamps();
        });
    }

    /**
     * Revierte las migraciones.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('education_non_formals');
    }
}
