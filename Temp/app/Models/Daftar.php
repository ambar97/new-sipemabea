<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Daftar extends Model
{
    protected $table = 'pendaftar';
    protected $primaryKey = 'id_daftar';
    public $timestamps = false;
    protected $fillable = [
        'type', 'nama_instansi', 'tujuan_magang', 'start_date', 'end_date', 'proposal',
        'email', 'notelp', 'jurusan', 'no_surat', 'status_pendaftar', 'note', 'berkas_toter', 'kd_daftar',

    ];
}
