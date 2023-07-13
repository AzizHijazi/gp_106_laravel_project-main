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
        Schema::create('working_times', function (Blueprint $table) {
            $table->id();
            $table->string('day',45);
            $table->boolean('status')->default(true);
            $table->enum('interval_type', ['daily', 'weekly', 'monthly'])->default('daily');
            $table->string('working_from',45);
            $table->string('working_to',45);
            $table->foreignId('hub_id')->constrained()->restrictOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('working_times');
    }
};
