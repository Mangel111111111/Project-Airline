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
        Schema::create('flights', function (Blueprint $table) {
            $table->id();
            $table->foreignId('origin_airport_id')->constrained('airports')->onDelete('cascade');
            $table->foreignId('destination_airport_id')->constrained('airports')->onDelete('cascade');
            $table->dateTime('departureTime');
            $table->dateTime('arrivalTime');
            $table->foreignId('airplane_id')->constrained()->onDelete('cascade');
            $table->integer('seatCapacity');
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('flights');
    }
};
