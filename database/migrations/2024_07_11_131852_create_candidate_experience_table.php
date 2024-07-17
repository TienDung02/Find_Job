<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('candidate_experience', function (Blueprint $table) {
            $table->integer('id_experience', true);
            $table->integer('id_candidate');
            $table->string('Employer');
            $table->string('job_title');
            $table->date('start_day');
            $table->date('end_day');
            $table->string('note', 999);
            $table->date('create_day');
            $table->date('update_day');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('candidate_experience');
    }
};
