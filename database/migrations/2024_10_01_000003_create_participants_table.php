<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('participants', function (Blueprint $table) {
            $table->id('participant_id');
            $table->string('full_name', 150);
            $table->string('email', 100);
            $table->string('phone', 15)->nullable();
            $table->string('major', 50)->nullable();
            $table->unsignedInteger('team_id');
            $table->boolean('is_leader')->default(false);
            $table->timestamp('registration_date');
            $table->timestamps();

            $table->foreign('team_id')->references('team_id')->on('teams')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('participants');
    }
};