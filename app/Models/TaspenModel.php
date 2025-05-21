<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaspenModel extends Model
{
    use HasFactory;
    protected $table = "tb_taspen";
    protected $primaryKey = "id";
    protected $fillable = [
        'ebilling',
        'ntpn',
        'akun_potongan',
        'jenis_potongan',
        'nilai_potongan',
        'nama_npwp',
        'nomor_npwp',
        'bukti_pemby',
        'status1',
        'status2',
        'id_potonganls',
        'rek_belanja',
        'created_at',
        'updated_at',
        'id_taspen',
        'id_rinciantaspen',
        'qty',
        // 'kode_pot'
    ];
}
