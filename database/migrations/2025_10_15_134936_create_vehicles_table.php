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
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            // Informasi Dasar Kendaraan
            $table->enum('vehicle_type', ['motor', 'mobil']);
            $table->string('brand');
            $table->string('model');
            $table->year('year');
            $table->string('license_plate')->unique();
            $table->string('vin')->unique()->comment('Vehicle Identification Number');

            // Detail Kendaraan
            $table->string('color');
            $table->integer('engine_capacity')->comment('Kapasitas mesin dalam CC');
            $table->enum('transmission', ['manual', 'matic', 'automatic']);
            $table->enum('fuel_type', ['pertalite', 'pertamax', 'solar', 'listrik']);
            $table->text('notes')->nullable();

            // Foreign Keys
            $table->foreignId('created_by')->constrained('users')->onDelete('cascade');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
