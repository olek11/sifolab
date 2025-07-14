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
        Schema::create('peminjaman_alats', function (Blueprint $table) {
            $table->id();
            $table->string('nama_peminjam', 100)->nullable();
            $table->integer('nim_nip_nidn')->nullable();
            $table->string('nama_alat', length: 100)->nullable();
            $table->string('jurusan', length: 100)->nullable();
            $table->integer('no_hp',)->nullable();
            $table->integer('jumlah')->nullable();
            $table->date('peminjaman')->nullable();
            $table->date('pengembalian')->nullable();
            $table->string('keterangan', length: 150)->nullable();
            $table->string('paraf_peminjam')->nullable();
            $table->string('paraf_petugas')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peminjaman_alats');
    }
};
