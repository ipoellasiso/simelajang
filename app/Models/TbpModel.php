<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TbpModel extends Model
{
    use HasFactory;
    // public $timestamps = false;
    protected $table = "tb_tbp";
    protected $primaryKey = "id";
    protected $fillable = [
            'no_spm',
            'tgl_spm',
            'nilai_spm',
            'no_spp',
            'tgl_spp',
            'nilai_spp',
            'nomor_tbp',
            'tanggal_tbp',
            'nilai_tbp',
            'npwp',
            'keterangan_tbp',
            'no_npd',
            'kode_rekening',
            'uraian',
            'jumlah',
            'nama_pajak_potongan',
            'id_billing',
            'nama_skpd'
    ];
}
