<?php

namespace App\Http\Controllers;

use App\Models\CampaignModel;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CampaignController extends Controller
{
    //
    protected $campaign_model;

    public function __construct()
    {
        $this->campaign_model = new CampaignModel();
    }

    public function index()
    {
        $campaign_data = $this->campaign_model->getCampaigns();

        return format_response('success', Response::HTTP_OK, 'success fetch data campaigns', $campaign_data);
    }

    public function detail($id, Request $request) {
        $campaign_data = $this->campaign_model->getCampaign($id);

        return format_response('success', Response::HTTP_OK, 'success fetch data camapign', $campaign_data);
    }
}
