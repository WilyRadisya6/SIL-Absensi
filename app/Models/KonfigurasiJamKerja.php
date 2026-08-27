<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KonfigurasiJamKerja extends Model
{
    protected $table = 'konfigurasi_jam_kerja';
    protected $fillable = ['jam_masuk', 'jam_pulang'];
}
