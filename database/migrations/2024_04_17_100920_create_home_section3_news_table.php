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
        Schema::create('home_section3_news', function (Blueprint $table) {
            $table->id();
           $table->string('title1')->nullable();
            $table->string('url1')->nullable();
            $table->text('image1')->nullable();
           $table->string('title2')->nullable();
            $table->string('url2')->nullable();
            $table->text('image2')->nullable();
           $table->string('title3')->nullable();
            $table->string('url3')->nullable();
            $table->text('image3')->nullable();
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
        Schema::dropIfExists('home_section3_news');
    }
};
