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
        Schema::create('apply_job', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('job_id');
            $table->integer('candidate_id');
            $table->text('full_name');
            $table->string('email', 50);
            $table->text('message');
            $table->string('cv');
            $table->date('created_at');
            $table->date('updated_at');
            $table->date('deleted_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('apply_job');
    }
};
