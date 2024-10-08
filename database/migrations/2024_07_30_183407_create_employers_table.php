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
            $table->string('tel', 255)->nullable();
            $table->text('about')->nullable();
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
