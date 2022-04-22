<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BannerModel extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'tb_banner';
    public $timestamps = true;
    protected $primaryKey = 'id_banner';

    protected $fillable = ['id_banner', 'description', 'path', 'sequence', 'created_at', 'updated_at'];
}
