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
            $table->integer('id_job');
            $table->integer('id_candidate');
            $table->string('full_name');
            $table->string('email');
            $table->string('message', 999);
            $table->string('cv');
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
        Schema::dropIfExists('apply_job');
    }
};
