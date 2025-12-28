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
        Schema::create('classes', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // 7A, 7B, 8A, dll
            $table->integer('grade'); // 7, 8, 9
            $table->string('room')->nullable(); // Ruangan kelas
            $table->foreignId('homeroom_teacher_id')->nullable()->constrained('teachers')->onDelete('set null'); // Wali kelas
            $table->integer('capacity')->default(32); // Kapasitas siswa
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('classes');
    }
};