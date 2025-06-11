<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    public function research()
    {
        return $this->hasMany(t_lecturer_research::class, 'id_research');
    }
}
