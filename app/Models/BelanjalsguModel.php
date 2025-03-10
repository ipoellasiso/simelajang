<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BelanjalsguModel extends Model
{
    use HasFactory;
    protected $table = "belanja1";
    protected $primaryKey = "id";
    protected $fillable = [
        'id',
        'norekening',
        'uraian',
        'nilai',
        'id_sp2d',
    ];
}
