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
        Schema::create('companies', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('employer_id');
            $table->string('company_name', 100);
            $table->string('company_tagline', 100)->nullable();
            $table->string('headquarters', 100)->nullable();
            $table->string('latitude', 100)->nullable();
            $table->string('longitude', 255)->nullable();
            $table->string('company_logo', 255)->nullable();
            $table->string('video', 255)->nullable();
            $table->string('since', 255)->nullable();
            $table->string('company_website', 255)->nullable();
            $table->string('email', 255)->nullable();
            $table->string('phone', 20)->nullable();
            $table->string('twitter', 255)->nullable();
            $table->string('facebook', 255)->nullable();
            $table->string('industry_id', 255)->nullable();
            $table->string('company_size', 40)->nullable();
            $table->string('company_average_salary', 255)->nullable();
            $table->text('description')->nullable();
            $table->string('header_img', 255)->nullable();
            $table->integer('active');
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
        Schema::dropIfExists('companies');
    }
};
