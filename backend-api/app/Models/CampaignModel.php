<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CampaignModel extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'tb_campaign';
    public $timestamps = true;
    protected $primaryKey = 'id_campaign';

    protected $fillable = ['id_campaign', 'campaign_title', 'description', 'always_open', 'always_fund', 'target_fund', 'target_day', 'slug', 'path', 'goal_amount'];


    public function getCampaigns()
    {
        $dataCampaign = CampaignModel::get();

        // foreach ($dataCampaign as $dc) {
        //     $dataImgCampaign = CampaignImageModel::where('id_campaign', $dc->id_campaign)->get();
        //     $dc->img = $dataImgCampaign;
        // }

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

    public function getCampaignWithSlug($slug)
    {
        try {
            $dataCampaign = CampaignModel::where('slug', $slug)->first();
            
            if($dataCampaign) {
                $dataCampaign->path = env('APP_URL') . $dataCampaign->path;
                $campaign_img = CampaignImageModel::where('id_campaign', $dataCampaign->id_campaign)->get();
                if($campaign_img) {
                    foreach($campaign_img as $ci) {
                        $ci->path = env('APP_URL') . $ci->path;
                    }
                }
                $dataCampaign->img = $campaign_img;
            }
    
            // backer
            $backer = DonasiModel::where([['status', 'approved'], ['tb_donasi.id_campaign', $dataCampaign->id_campaign]])->join('tb_user', 'tb_user.id_user', 'tb_donasi.id_user')->select('tb_donasi.*', 'tb_user.nama')->get();
            if($backer) {
                foreach($backer as $b) {
                    $doa = DoaModel::where('id_donasi', $b->id_donasi)->first();
                    $b->doa = $doa;
                }
            }
            $dataCampaign->backer = $backer;
    
            //backer count
            $backer_count = collect($backer)->unique('id_user')->count();
            $dataCampaign->backer_count = $backer_count;
    
            return $dataCampaign;
        } catch(Exception $exc) {
            return null;
        }
    }
}
