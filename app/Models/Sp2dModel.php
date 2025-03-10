<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sp2dModel extends Model
{
    use HasFactory;
    // public $timestamps = false;
    protected $table = "sp2d";
    protected $primaryKey = "idhalaman";
    protected $fillable = [
            'idhalaman',
            'jenis',
            'tahun',
            'nomor_rekening',
            'nama_bank',
            'nomor_sp2d',
            'tanggal_sp2d',
            'nama_skpd',
            'nama_sub_skpd',
            'nama_pihak_ketiga',
            'no_rek_pihak_ketiga',
            'nama_rek_pihak_ketiga',
            'bank_pihak_ketiga',
            'npwp_pihak_ketiga',
            'keterangan_sp2d',
            'nilai_sp2d',
            'nomor_spm',
            'tanggal_spm',
            'nama_ibu_kota',
            'nama_bud_kbud',
            'jabatan_bud_kbud',
            'nip_bud_kbud'
    ];
}
