<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ForgotPasswordModel extends Model
{
    use HasFactory;
    protected $table = 'tb_forgot_password';
    public $timestamps = true;
    protected $primaryKey = 'id_forgot_password';

    protected $fillable = ['id_forgot_password', 'id_user', 'token', 'link', 'status', 'created_at', 'updated_at'];
}
