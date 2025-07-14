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
        Schema::create('jadwals', function (Blueprint $table) {
            $table->id(); // Kolom ID otomatis
            $table->string('jenis_kegiatan', 100)->nullable(); // Sesuai form
            $table->string('judul_kegiatan', 100)->nullable(); // Sesuai form
            $table->date('hari_tanggal_mulai')->nullable(); // Sesuai form
            $table->date('hari_tanggal_selesai')->nullable(); // Sesuai form
            $table->time('jam_mulai')->nullable(); // Sesuai form, tipe time
            $table->time('jam_selesai')->nullable(); // Sesuai form, tipe time
            $table->string('penanggung_jawab', 100)->nullable(); // Sesuai form
            $table->string('asisten_penanggung_jawab', 100)->nullable(); // Sesuai form
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending'); // Status default
            $table->timestamps(); // created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwals');
    }
};
