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
        Schema::create('requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('delivrable_id');
            $table->foreignId('mode_id')->nullable();
            $table->foreignId('assigned_to')->nullable();
            $table->dateTime('date')->nullable();
            $table->integer('number')->nullable();
            $table->boolean('for_me')->nullable();
            $table->integer('rating')->nullable();
            $table->string('comment')->nullable();
            $table->string('status')->default('pending');
            $table->json('user_data')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('CASCADE');
            $table->foreign('assigned_to')->references('id')->on('users')->onDelete('CASCADE');
            $table->foreign('delivrable_id')->references('id')->on('delivrables')->onDelete('CASCADE');
            $table->foreign('mode_id')->references('id')->on('delivrable_modes')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('requests');
    }
};
