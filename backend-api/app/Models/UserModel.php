<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserModel extends Model
{
    use HasFactory;
    protected $table = 'tb_user';
    public $timestamps = true;
    protected $primaryKey = 'id_user';

    protected $fillable = [
        'nama',
        'email',
        'password',
        'hp',
        'tgl_lahir',
        'alamat',
        'photo',
        'role',
        'created_at',
        'updated_at'
    ];
}
