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
        Schema::create('blog_comments', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('blog_id');
            $table->integer('user_id');
            $table->string('content')->nullable();
            $table->integer('reply_to');
            $table->text('img_1')->nullable();
            $table->text('img_2')->nullable();
            $table->text('img_3')->nullable();
            $table->text('img_4')->nullable();
            $table->text('img_5')->nullable();
            $table->text('img_6')->nullable();
            $table->text('img_7')->nullable();
            $table->text('img_8')->nullable();
            $table->text('img_9')->nullable();
            $table->text('img_10')->nullable();
            $table->text('img_11')->nullable();
            $table->text('img_12')->nullable();
            $table->text('img_13')->nullable();
            $table->text('img_14')->nullable();
            $table->text('img_15')->nullable();
            $table->text('img_16')->nullable();
            $table->text('img_17')->nullable();
            $table->text('img_18')->nullable();
            $table->text('img_19')->nullable();
            $table->text('img_20')->nullable();
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
        Schema::dropIfExists('users');
    }
};
