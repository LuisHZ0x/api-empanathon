<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('teams', function (Blueprint $table) {
            $table->increments('team_id');
            $table->string('team_name', 100)->unique();
            $table->string('invitation_code', 8)->unique()->nullable();
            $table->enum('experience_level', ['Principiante','Intermedio','Avanzado']);
            $table->text('motivation');
            $table->dateTime('registration_date')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->enum('team_status', ['activo','incompleto','eliminado'])->default('incompleto');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('teams');
    }
};