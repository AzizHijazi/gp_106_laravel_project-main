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
        Schema::create('internet_accounts', function (Blueprint $table) {
            $table->id();
            $table->string('speed', 45);
            $table->string('username', 45);
            $table->string('password');
            $table->date('expired');
            $table->boolean('status')->default(true);
            $table->foreignId('user_id')->constrained()->restrictOnDelete();
            $table->foreignId('hub_id')->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('internet_accounts');
    }
};
