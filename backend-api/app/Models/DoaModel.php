<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DoaModel extends Model
{
    use HasFactory;
    protected $table = 'tb_doa';
    public $timestamps = true;
    protected $primaryKey = 'id_doa';

    protected $fillable = ['id_doa', 'id_user', 'id_campaign', 'anonym', 'doa_text', 'created_at', 'updated_at'];
}
