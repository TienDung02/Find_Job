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
        Schema::create('candidate', function (Blueprint $table) {
            $table->integer('id_candidate', true);
            $table->integer('id_user');
            $table->string('avatar');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('tel', 40);
            $table->string('email');
            $table->string('about', 999);
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
        Schema::dropIfExists('candidate');
    }
};
