<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\DokumenPengendalianModel; // Corrected use statement
use App\Models\DokumenPenetapan; // Added use statement
use App\Models\DokumenPelaksanaanModel; // Added use statement
use App\Models\DokumenEvaluasiModel; // Added use statement
use App\Models\DokumenPeningkatanModel; // Added use statement
use App\Models\KomenModel; // Added use statement
use App\Models\KriteriaModel; // Added use statement

class DetailKriteriaModel extends Model
{
    use HasFactory;

    // Tentukan nama tabel jika berbeda
    protected $table = 't_detail_criteria';

    // Relasi ke m_kriteria
    public function kriteria()
    {
        return $this->belongsTo(KriteriaModel::class, 'kriteria_id', 'kriteria_id');
    }

    // Relasi ke t_penetapan
    public function penetapan()
    {
        return $this->belongsTo(DokumenPenetapan::class, 'penetapan_id', 'penetapan_id');
    }

    // Relasi ke t_pelaksanaan
    public function pelaksanaan()
    {
        return $this->belongsTo(DokumenPelaksanaanModel::class, 'pelaksanaan_id', 'pelaksanaan_id');
    }

    // Relasi ke t_evaluasi
    public function evaluasi()
    {
        return $this->belongsTo(DokumenEvaluasiModel::class, 'evaluasi_id', 'evaluasi_id');
    }

    // Relasi ke t_pengendalian
    public function pengendalian()
    {
        return $this->belongsTo(DokumenPengendalianModel::class, 'pengendalian_id', 'pengendalian_id'); // Corrected model name
    }

    // Relasi ke t_peningkatan
    public function peningkatan()
    {
        return $this->belongsTo(DokumenPeningkatanModel::class, 'peningkatan_id', 'peningkatan_id');
    }

    // Relasi ke t_comment
    public function comment()
    {
        return $this->belongsTo(KomenModel::class, 'comment_id', 'comment_id');
    }
}
