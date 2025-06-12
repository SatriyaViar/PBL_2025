<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KomenModel extends Model
{
    use HasFactory;

    // Tentukan nama tabel jika berbeda
    protected $table = 't_comment';

    // Tentukan kolom yang bisa diisi massal
    protected $fillable = [
        'user_id',
        'status',
        'comment',
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
}
