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
        Schema::create('job', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('id_employer');
            $table->string('title');
            $table->string('category');
            $table->string('job_type', 40);
            $table->string('location');
            $table->string('job_tag');
            $table->string('description', 999);
            $table->string('job_requirements', 9999);
            $table->integer('minimum_rate');
            $table->integer('maximum_rate');
            $table->integer('minimum_salary');
            $table->integer('maximum_salary');
            $table->string('closing_day', 40);
            $table->integer('apply');
            $table->string('active', 999);
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
        Schema::dropIfExists('job');
    }
};
