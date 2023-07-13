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
        Schema::create('meeting_room_orders', function (Blueprint $table) {
            $table->id();
            $table->date('day');
            $table->datetime('start_date');
            $table->datetime('end_date');
            $table->enum('status', ['pending', 'confirmed', 'canceled'])->default('pending');
            $table->float('total')->unsigned();
            $table->foreignId('meeting_room_id')->constrained()->restrictOnDelete();
            $table->foreignId('hub_id')->constrained();
            $table->foreignId('user_id')->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('meeting_room_orders');
    }
};
