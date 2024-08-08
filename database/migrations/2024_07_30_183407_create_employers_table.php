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
        Schema::create('employers', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('user_id');
            $table->string('avatar', 255);
            $table->string('first_name', 255);
            $table->string('last_name', 255);
            $table->string('tel', 255);
            $table->text('about');
            $table->integer('active');
            $table->integer('free_jobs_count');
            $table->string('job_package')->nullable();
            $table->dateTime('package_expiration')->nullable();
            $table->integer('jobs_remaining')->nullable();
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
        Schema::dropIfExists('employers');
    }
};
