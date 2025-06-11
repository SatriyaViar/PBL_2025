<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class LecturerResearchModel extends Model
{
    use HasFactory;

    protected $table = 't_lecturer_research';
    protected $primaryKey = 'lecturer_research_id';

    protected $fillable = [
        'user_id',
        'penelitian_id',
        'status',
    ];

    public function dosen()
    {
        return $this->belongsTo(UserModel::class, 'user_id');
    }

    public function research()
    {
        return $this->hasMany(ResearchModel::class, 'research_id');
    }
}
