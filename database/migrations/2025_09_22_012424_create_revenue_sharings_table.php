<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('revenue_sharings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('booking_id')->constrained('bookings')->onDelete('cascade');
            $table->decimal('owner_share', 12, 2);
            $table->decimal('admin_share', 12, 2);
            $table->timestamp('settled_at')->nullable();
            $table->timestamps();
        });
    }
    public function down() {
        Schema::dropIfExists('revenue_sharings');
    }
};
