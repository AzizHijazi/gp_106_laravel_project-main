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
        Schema::create('component_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->mediumText('description');
            $table->integer('count')->unsigned();
            $table->float('price')->unsigned();
            $table->string('image');
            $table->foreignId('hub_id')->constrained()->restrictOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('component_types');
    }
};
