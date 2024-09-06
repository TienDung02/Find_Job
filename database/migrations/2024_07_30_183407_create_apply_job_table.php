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
        Schema::create('apply_jobs', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('job_id');
            $table->integer('company_id');
            $table->integer('user_id');
            $table->text('full_name')->nullable();
            $table->string('email', 50)->nullable();
            $table->text('message')->nullable();
            $table->text('cv')->nullable();
            $table->text('status_id')->nullable();
            $table->text('note')->nullable();
            $table->decimal('rating', 4, 3)->nullable();
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
        Schema::dropIfExists('apply_job');
    }
};
