<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('motors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('owner_id')->constrained('users')->onDelete('cascade');
            $table->string('brand');
            $table->string('model')->nullable();
            $table->string('type_cc')->nullable();
            $table->string('plate_number')->unique();
            $table->enum('status', ['draft','available','disewa','perawatan'])->default('draft');
            $table->string('photo')->nullable();
            $table->text('documents')->nullable();
            $table->timestamps();
        });
    }
    public function down() {
        Schema::dropIfExists('motors');
    }
};
