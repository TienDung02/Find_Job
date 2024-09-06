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
        Schema::create('candidate_resumes', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('candidate_id');
            $table->string('full_name', 40);
            $table->string('email', 40);
            $table->string('professional_title', 100);
            $table->integer('province_id')->nullable();
            $table->integer('district_id')->nullable();
            $table->integer('ward_id')->nullable();
            $table->string('tag_id')->nullable();
            $table->string('photo', 255)->nullable();
            $table->integer('type_salary')->nullable();
            $table->integer('salary')->nullable();
            $table->integer('minimum_salary')->nullable();
            $table->integer('maximum_salary')->nullable();
            $table->text('resume_content')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('candidate_resumes');
    }
};
