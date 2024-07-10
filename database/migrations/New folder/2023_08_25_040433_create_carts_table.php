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
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->references('id')
            ->on('users')
            ->onDelete('cascade');
            $table->foreignId('product_id')->nullable()->references('id')
            ->on('products')
            ->onDelete('cascade');
            $table->integer('quantity')->default(1);
            $table->boolean('status')->default(1);
            $table->boolean('wishlist')->default(0);
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
        Schema::dropIfExists('carts');
    }
};
