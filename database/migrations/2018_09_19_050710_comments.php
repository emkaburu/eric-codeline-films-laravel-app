<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Comments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('comments', function (Blueprint $table) {
            $table->increments('id');            
            $table->integer('user_id')->unsigned()->default(0);
            $table->foreign('user_id')
                ->references('id')->on('users');
            $table->integer('film_id')->unsigned()->default(0);
            $table->foreign('film_id')
                ->references('id')->on('films');
            $table->string('user_name');
            $table->text('comment');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comments');
    }
}
