<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMissingColumnsToAlatsTable extends Migration
{
    public function up()
    {
        Schema::table('alats', function (Blueprint $table) {
            $table->string('nup')->nullable()->after('id');
            $table->string('merk_type')->after('nama_alat');
            $table->year('tahun_perolehan')->nullable()->after('nama_alat');
            $table->string('penguasaan')->after('jumlah_alat');
        });
    }

    public function down()
    {
        Schema::table('alats', function (Blueprint $table) {
            $table->dropColumn([
                'nup',
                'merk_type',
                'tahun_perolehan',
                'penguasaan',
            ]);
        });
    }
}
