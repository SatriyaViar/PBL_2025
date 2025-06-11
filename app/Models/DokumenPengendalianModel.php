<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DokumenPengendalianModel extends Model
{
    use HasFactory;

    protected $table = 't_pengendalian';
    protected $primaryKey = 'pengendalian_id';

    protected $fillable = [
        'kriteria_id',
        'description',
        'link',
        'file_pendukung',
    ];

    public $timestamps = true;

    public function kriteria()
    {
        return $this->belongsTo(KriteriaModel::class, 'kriteria_id', 'kriteria_id');
    }
}
