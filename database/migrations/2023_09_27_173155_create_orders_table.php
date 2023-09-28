<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            // $table->integer('user_id');
            // $table->integer('book_id');
            $table->string('title');
            $table->string('name');
            $table->string('address');
            $table->integer('phone_number');
            $table->integer('quantity');
            $table->decimal('each_price');
            $table->decimal('total_price');
            $table->date('order_date');
            $table->date('delivery_date');
            $table->string('order_status')->nullable();
            $table->timestamps();
        }); 
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
