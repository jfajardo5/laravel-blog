<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            /**
             * Primary Columns
             */
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('user_id');
            $table->string('slug', 150);
            $table->string('title', 255);
            $table->text('body');
            $table->softDeletes();

            /**
             * Foreign Keys
             */
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('articles');
    }
}
