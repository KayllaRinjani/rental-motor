<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('motors', function (Blueprint $table) {
            $table->enum('status', ['available', 'unavailable', 'repair'])
                  ->default('available')
                  ->after('id'); // ganti 'id' dengan kolom yang pasti ada
        });
    }

    public function down(): void
    {
        Schema::table('motors', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};
