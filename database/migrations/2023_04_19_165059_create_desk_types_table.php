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
        Schema::create('desk_types', function (Blueprint $table) {
            $table->id();
            $table->string('name', 45);
            $table->mediumText('info');
            $table->integer('size');
            $table->foreignId('hub_id')->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('desk_types');
    }
};
