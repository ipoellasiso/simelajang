<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PajakguModel extends Model
{
    use HasFactory;
    protected $table = "pajakkppgu";
    protected $primaryKey = "id";
    protected $fillable = [
        'ebilling',
        'ntpn',
        'akun_pajak',
        'jenis_pajak',
        'nilai_pajak',
        'rek_belanja',
        'nama_npwp',
        'nomor_npwp',
        'bukti_pemby',
        'status2',
        'created_at',
        'updated_at',
        'id_potonganls',
        'id_opd',
        'no_spm',
        'periode',
        'status1'
    ];
}
