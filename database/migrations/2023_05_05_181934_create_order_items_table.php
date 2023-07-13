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
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->morphs('item');
            $table->string('order_id');
            $table->enum('status', ['pending', 'confirmed', 'canceled'])->default('pending');
            $table->mediumText('details')->nullable();
            $table->float('price')->unsigned();
            $table->date('start_date');
            $table->date('end_date');
            $table->foreignId('hub_id')->constrained()->restrictOnDelete();
            $table->foreignId('user_id')->constrained()->restrictOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};