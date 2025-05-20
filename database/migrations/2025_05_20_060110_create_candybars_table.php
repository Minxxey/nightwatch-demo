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
        Schema::create('candybars', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('amount')->nullable();
            $table->integer('candybarTreshhold')->nullable();
            $table->boolean('isAvailable');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('candybars');
    }
};
