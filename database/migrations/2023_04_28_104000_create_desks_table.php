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
        Schema::create('desks', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('desk_code');
            $table->float('price')->unsigned();
            $table->boolean('status')->default(true);
            $table->mediumText('description');
            $table->string('image');
            $table->foreignId('desk_type_id')->constrained()->restrictOnDelete();
            $table->foreignId('hub_id')->constrained()->restrictOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('desks');
    }
};