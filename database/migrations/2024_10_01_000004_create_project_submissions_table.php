<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('project_submissions', function (Blueprint $table) {
            $table->increments('submission_id');
            $table->unsignedInteger('team_id')->unique();
            $table->string('project_name', 150);
            $table->text('description');
            $table->string('github_link', 255);
            $table->string('used_technologies', 300)->nullable();
            $table->enum('project_type', ['Estandar','IA','Juego']);
            $table->dateTime('submission_date')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->decimal('score', 4, 2)->default(0);
            $table->enum('submission_status', ['pendiente','calificado'])->default('pendiente');
            $table->text('judge_comments')->nullable();
            $table->timestamps();

            $table->foreign('team_id')->references('team_id')->on('teams');
        });
    }

    public function down()
    {
        Schema::dropIfExists('project_submissions');
    }
};