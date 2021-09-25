<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CampaignImageModel extends Model
{
    use HasFactory;
    protected $table = 'tb_campaign_img';
    public $timestamps = true;
    protected $primaryKey = 'id_campaign_img';

    protected $fillable = ['id_campaign_img', 'id_campaign', 'path', 'sequence'];

}
