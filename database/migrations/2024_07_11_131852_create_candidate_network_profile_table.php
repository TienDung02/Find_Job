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
        Schema::create('candidate_network_profile', function (Blueprint $table) {
            $table->integer('id_network_profile', true);
            $table->integer('id_candidate');
            $table->string('name');
            $table->string('url');
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
        Schema::dropIfExists('candidate_network_profile');
    }
};
