<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TCriteria extends Model
{
    protected $table = 't_criteria';
    protected $primaryKey = 'criteria_id';
    public $timestamps = true;

    // Contoh relasi
    public function penetapan() {
        return $this->hasMany(TPenetapan::class, 'criteria_id');
    }
}
