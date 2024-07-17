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
        Schema::create('company', function (Blueprint $table) {
            $table->integer('id_company', true);
            $table->integer('id_employer');
            $table->string('company_name');
            $table->string('company_tagline')->nullable();
            $table->string('headquarters')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->string('company_logo')->nullable();
            $table->string('video')->nullable();
            $table->string('since')->nullable();
            $table->string('company_website')->nullable();
            $table->string('email')->nullable();
            $table->string('phone', 20)->nullable();
            $table->string('twitter')->nullable();
            $table->string('facebook')->nullable();
            $table->string('industry')->nullable();
            $table->string('company_size', 40)->nullable();
            $table->string('company_average_salary')->nullable();
            $table->string('description')->nullable();
            $table->string('header_img')->nullable();
            $table->integer('active');
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
        Schema::dropIfExists('company');
    }
};
