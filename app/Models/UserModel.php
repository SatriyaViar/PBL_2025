<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserModel extends Model
{
    use HasFactory;

    protected $table = 'm_users';
    protected $primaryKey = 'user_id';

    protected $fillable = [
        'username',
        'nidn',
        'email',
        'name',
        'password',
        'level_id'
    ];

    protected $hidden = ['password'];

    public function getAuthIdentifierName()
    {
        return 'username'; // login menggunakan username
    }

    public function level()
    {
        return $this->belongsTo(LevelModel::class, 'level_id');
    }
}
