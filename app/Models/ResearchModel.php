<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class ResearchModel extends Model
{
    use HasFactory;

    protected $table = 'm_research';
    protected $primaryKey = 'research_id';

    protected $fillable = [
        'letter_no',
        'reserach_title',
        'internal_funding',
        'external_funding',
        'research_link'
    ];

    public function research()
    {
        return $this->hasMany(LecturerResearchModel::class, 'id_research');
    }
}
