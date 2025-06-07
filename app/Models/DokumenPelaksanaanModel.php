<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DokumenPelaksanaanModel extends Model
{
    use HasFactory;

    protected $table = 't_pelaksanaan';
    protected $primaryKey = 'pelaksanaan_id';
    
    protected $fillable = [
        'pelaksanaan_id',
        'kriteria_id',
        'description',
        'link',
        'file_pendukung',
    ];

    function kriteria() {
        return $this->belongsTo(KriteriaModel::class, 'kriteria_id', 'kriteria_id');
    }
}
