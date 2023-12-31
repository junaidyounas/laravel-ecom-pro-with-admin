<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable(); // User who placed the order
            $table->unsignedBigInteger('cart_id')->nullable();
            $table->string('status')->default('pending'); // Initial status is 'pending'
            $table->string('name');
            $table->string('phone');
            $table->string('address');
            $table->string('province');
            $table->string('post_code')->nullable();
            $table->string('reference')->unique();
            $table->timestamps();

            $table->foreign('cart_id')->references('id')->on('carts');
        });

        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('product_id');
            $table->integer('quantity');
            // Add other columns as needed
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
        Schema::dropIfExists('orders');
        Schema::dropIfExists('order_items');
    }
};