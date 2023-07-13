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
        Schema::create('rents', function (Blueprint $table) {
            $table->id();
            $table->morphs('item');
            $table->enum('status', ['pending', 'confirmed', 'canceled'])->default('pending');
            $table->mediumText('details')->nullable();
            $table->mediumText('response')->nullable();
            $table->float('price')->unsigned();
            $table->date('start_date');
            $table->date('end_date');
           // $table->foreignId('order_items_id')->constrained()->restrictOnDelete();
           // $table->foreignId('rent_type_id')->constrained()->default(0);
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
        Schema::dropIfExists('rents');
    }
};