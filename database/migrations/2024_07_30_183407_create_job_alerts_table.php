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
        Schema::create('job_alerts', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('candidate_id');
            $table->string('alert_name');
            $table->string('keyword');
            $table->integer('province_id');
            $table->string('frequency_id');
            $table->text('tag_id')->nullable();
            $table->string('job_type_id', 50)->nullable();
            $table->text('industry_id')->nullable();
            $table->text('min_salary')->nullable();
            $table->text('max_salary')->nullable();
            $table->boolean('active')->nullable();
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
        Schema::dropIfExists('job_alerts');
    }
};
