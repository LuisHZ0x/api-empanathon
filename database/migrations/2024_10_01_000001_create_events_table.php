<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id('event_id');
            $table->string('event_name', 100);
            $table->dateTime('start_date');
            $table->text('secret_theme')->nullable();
            $table->enum('event_status', ['inscripciones','fase1','fase2','finalizado'])->default('inscripciones');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('events');
    }
};