<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TPeningkatan extends Model
{
    protected $table = 't_peningkatan';
    protected $primaryKey = 'peningkatan_id';
    public $timestamps = true;

    protected $fillable = ['criteria_id', 'description', 'link', 'file_pendukung'];

    public function criteria() {
        return $this->belongsTo(TCriteria::class, 'criteria_id');
    }
}
