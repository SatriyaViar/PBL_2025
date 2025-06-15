<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TPenetapan extends Model
{
    protected $table = 't_penetapan';
    protected $primaryKey = 'penetapan_id';
    public $timestamps = true;

    protected $fillable = ['criteria_id', 'description', 'link', 'file_pendukung'];

    public function criteria() {
        return $this->belongsTo(TCriteria::class, 'criteria_id');
    }
}
