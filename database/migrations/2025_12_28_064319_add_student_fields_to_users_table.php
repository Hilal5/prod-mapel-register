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
        Schema::table('users', function (Blueprint $table) {
            $table->string('nis')->unique()->nullable()->after('id'); // Nomor Induk Siswa
            $table->enum('role', ['admin', 'student'])->default('student')->after('email');
            $table->foreignId('class_id')->nullable()->constrained('classes')->onDelete('set null')->after('role');
            $table->string('phone')->nullable()->after('email');
            $table->text('address')->nullable()->after('phone');
            $table->enum('gender', ['L', 'P'])->nullable()->after('address'); // Laki-laki, Perempuan
            $table->date('birth_date')->nullable()->after('gender');
            $table->string('photo')->nullable()->after('birth_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['class_id']);
            $table->dropColumn([
                'nis', 
                'role', 
                'class_id', 
                'phone', 
                'address', 
                'gender', 
                'birth_date', 
                'photo'
            ]);
        });
    }
};