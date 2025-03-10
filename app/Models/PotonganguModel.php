<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PotonganguModel extends Model
{
    use HasFactory;
    protected $table = "tb_potongangu";
    protected $primaryKey = "id";
    protected $fillable = [
        'nama_pajak_potongan',
        'id_billing',
        'nilai_tbp_pajak_potongan',
        'id_tbp',
        'status1',
        'status3',
        'status4'
    ];
}
