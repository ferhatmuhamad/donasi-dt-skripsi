<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BannerModel extends Model
{
    use HasFactory;
    protected $table = 'tb_banner';
    public $timestamps = true;
    protected $primaryKey = 'id_banner';

    protected $fillable = ['id_banner', 'description', 'path', 'sequence', 'created_at', 'updated_at'];
}
