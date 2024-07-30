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
        Schema::create('candidate_educations', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('candidate_id');
            $table->string('school_name', 50);
            $table->string('qualification', 50);
            $table->date('start_day');
            $table->date('end_day');
            $table->text('note');
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
        Schema::dropIfExists('candidate_educations');
    }
};
