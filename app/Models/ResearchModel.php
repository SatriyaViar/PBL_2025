<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class ResearchModel extends Model
{
    use HasFactory;

    protected $table = 'm_penelitian';
    protected $primaryKey = 'id_penelitian';

    protected $fillable = [
        'no_surat_tugas',
        'judul_penelitian',
        'pendanaan_internal',
        'pendanaan_eksternal',
        'link_penelitian',
    ];

    public function penelitian()
    {
        return $this->hasMany(LecturerResearchModel::class, 'penelitian_id');
    }
}
