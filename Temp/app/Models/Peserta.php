<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peserta extends Model
{
    protected $table = 'peserta';
    protected $primaryKey = 'id_peserta';
    public $timestamps = false;
    protected $fillable = [
        'nama_peserta', 'start', 'end', 'id_daftar',
        'status', 'kd_daftar',
    ];
}
