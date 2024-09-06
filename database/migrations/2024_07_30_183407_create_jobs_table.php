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
        Schema::create('jobs', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('company_id');
            $table->string('title', 255);
            $table->string('category_id');
            $table->integer('job_type_id');
            $table->integer('province_id');
            $table->integer('district_id');
            $table->integer('ward_id');
            $table->string('location');
            $table->string('tag_id')->nullable();
            $table->dateTime('spotlight')->nullable();
            $table->text('description')->nullable();
            $table->text('job_requirements')->nullable();
            $table->text('benefit')->nullable();
            $table->integer('type_salary')->nullable();
            $table->integer('salary')->nullable();
            $table->integer('minimum_salary')->nullable();
            $table->integer('maximum_salary')->nullable();
            $table->string('closing_day', 40);
            $table->integer('active');
            $table->boolean('fill');
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
        Schema::dropIfExists('jobs');
    }
};
