<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;


return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->enum('role', ['admin', 'vehicle_owner', 'workshop'])
                  ->default('vehicle_owner')
                  ->after('avatar')
                  ->nullable();
        });

        // Set semua data lama ke vehicle_owner jika null
        DB::table('users')->whereNull('role')->update(['role' => 'vehicle_owner']);

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('role');
        });
    }
};
