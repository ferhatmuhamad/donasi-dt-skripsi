<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CampaignModel extends Model
{
    use HasFactory;
    protected $table = 'tb_campaign';
    public $timestamps = true;
    protected $primaryKey = 'id_campaign';

    protected $fillable = ['id_campaign', 'campaign_title', 'description', 'always_open', 'always_fund', 'target_fund', 'target_day', 'slug', 'path'];


    public function getCampaigns()
    {
        $dataCampaign = CampaignModel::get();

        foreach ($dataCampaign as $dc) {
            $dataImgCampaign = CampaignImageModel::where('id_campaign', $dc->id_campaign)->get();
            $dc->img = $dataImgCampaign;
        }

        return $dataCampaign;
    }

    public function getCampaign($id)
    {
        $dataCampaign = CampaignModel::where('id_campaign', $id)->first();
        $campaign_img = CampaignImageModel::where('id_campaign', $id)->get();
        $dataCampaign->img = $campaign_img;

        // backer
        $backer = DonasiModel::where([['status', 'approved'], ['id_campaign', $id]])->get();
        $dataCampaign->backer = $backer;

        //backer count
        $backer_count = collect($backer)->unique('id_user')->count();
        $dataCampaign->backer_count = $backer_count;

        return $dataCampaign;
    }
}
