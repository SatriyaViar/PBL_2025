<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TEvaluasi extends Model
{
    protected $table = 't_evaluasi';
    protected $primaryKey = 'evaluasi_id';
    public $timestamps = true;

    protected $fillable = ['criteria_id', 'description', 'link', 'file_pendukung'];

    public function criteria() {
        return $this->belongsTo(TCriteria::class, 'criteria_id');
    }
}
