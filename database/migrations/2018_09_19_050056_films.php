<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Films extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('films', function (Blueprint $table) {
            $table->increments('id');            
            $table->string('name');
            $table->text('description');
            $table->date('realease_date');
            $table->integer('rating')->default(0);
            $table->decimal('ticket_price', 10,2);
            $table->string('country');
            $table->integer('genre_id')->unsigned()->default(0);
            $table->foreign('genre_id')
                ->references('id')->on('genres');
            $table->string("photo_url")->default('movie.jpg');
            $table->string("slug");
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
        Schema::dropIfExists('films');
    }
}
