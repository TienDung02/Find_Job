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
        Schema::create('candidate_education', function (Blueprint $table) {
            $table->integer('id_education', true);
            $table->integer('id_candidate');
            $table->string('school_name');
            $table->string('qualification(s)');
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
        Schema::dropIfExists('candidate_education');
    }
};
