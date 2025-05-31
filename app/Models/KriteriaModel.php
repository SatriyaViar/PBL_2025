<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class KriteriaModel extends Model
{
    use HasFactory;

    protected $table = 'm_kriteria';
    protected $primaryKey = 'kriteria_id';

    //untuk mengizinkan mass assignment
    protected $fillable = ['user_id', 'kriteria_nama', 'kriteria_link'];

    function user(): BelongsTo
    {
        return $this->belongsTo(UserModel::class, 'user_id', 'user_id');
    }
}
