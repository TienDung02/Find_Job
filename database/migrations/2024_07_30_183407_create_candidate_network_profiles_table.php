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
        Schema::create('candidate_network_profiles', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('candidate_id');
            $table->string('name', 100);
            $table->string('url', 255);
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
        Schema::dropIfExists('candidate_network_profiles');
    }
};
