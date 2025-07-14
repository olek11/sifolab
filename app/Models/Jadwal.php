<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    protected $table = 'jadwals'; // Menentukan nama tabel

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'jenis_kegiatan',
        'judul_kegiatan',
        'hari_tanggal_mulai',
        'hari_tanggal_selesai',
        'jam_mulai',
        'jam_selesai',
        'penanggung_jawab',
        'asisten_penanggung_jawab',
        'status',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'jam_mulai' => 'datetime',
        'jam_selesai' => 'datetime',
        'hari_tanggal_mulai' => 'date',
        'hari_tanggal_selesai' => 'date',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];
}
