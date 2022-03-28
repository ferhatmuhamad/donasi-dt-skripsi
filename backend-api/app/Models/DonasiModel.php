<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DonasiModel extends Model
{
    use HasFactory;
    protected $table = 'tb_donasi';
    public $timestamps = true;
    protected $primaryKey = 'id_donasi';

    protected $fillable = ['id_donasi', 'id_campaign', 'kode_donasi','id_user', 'amount', 'bukti_transfer', 'status'];
}
