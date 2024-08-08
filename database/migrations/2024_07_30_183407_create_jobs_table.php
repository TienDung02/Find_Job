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
            $table->integer('category_id');
            $table->integer('job_type_id');
            $table->integer('location_id');
            $table->integer('tag_id');
            $table->dateTime('spotlight')->nullable();
            $table->text('description');
            $table->text('job_requirements');
            $table->integer('minimum_rate');
            $table->integer('maximum_rate');
            $table->integer('minimum_salary');
            $table->integer('maximum_salary');
            $table->string('closing_day', 40);
            $table->integer('apply');
            $table->boolean('active');
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
