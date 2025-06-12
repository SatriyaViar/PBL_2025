<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class LecturerResearchModel extends Model
{
    use HasFactory;

    protected $table = 't_penelitian_dosen';
    protected $primaryKey = 'id_penelitian_dosen';

    protected $fillable = [
        'user_id',
        'penelitian_id',
        'status',
    ];

    public function dosen()
    {
        return $this->belongsTo(UserModel::class, 'user_id');
    }

    public function penelitian()
    {
        return $this->belongsTo(ResearchModel::class, 'penelitian_id');
    }
}
