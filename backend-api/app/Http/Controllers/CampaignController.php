<?php

namespace App\Http\Controllers;

use App\Models\CampaignImageModel;
use App\Models\CampaignModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
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


    // ADMIN

    public function indexAdmin() {
        $campaignData = CampaignModel::get();

        $data = [
            'campaign' => $campaignData
        ];

        return view('campaign.index', $data);
    }

    public function detailAdmin($id) {
        $campaignData = CampaignModel::where('id_campaign', $id)->first();

        $data = [
            'campaign' => $campaignData
        ];

        // dd($data);

        return view('campaign.detail', $data);
    }

    public function edit($id) {
        $campaignData = CampaignModel::where('id_campaign', $id)->first();
        $campaignIMG = CampaignImageModel::where('id_campaign', $id)->get();

        $data = [
            'id' => $id,
            'campaign' => $campaignData,
            'image' => $campaignIMG
        ];

        return view('campaign.edit', $data);
    }

    public function update(Request $request, $id) {
        $inputan = $request->all();

        // dd($inputan);

        // $credentials = $request->only('email', 'password');

        //valid credential
        $validator = Validator::make($inputan, [
            'campaign_title' => 'required',
            'description' => 'required',
            // 'goal_amount' => 'required|integer',
            'always_open' => 'required|integer',
            'always_fund' => 'required|integer'
        ]);

        //Send failed response if request is not valid
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->getMessageBag());
        }

        $campaign = CampaignModel::where('id_campaign', $id)->first();

        if(!$campaign) {
            return redirect()->back()->withErrors('Campaign Not Found!');
        }

        $campaign->campaign_title = $request->campaign_title;
        $campaign->description = $request->description;

        // jika donasi selalu dibuka (tidak bergantung waktu)
        if($request->always_open == 1) {
           $campaign->always_open = 1;
           $campaign->target_day = NULL; 
        } else {
            // date
           $campaign->target_day = $request->target_day;
           $campaign->always_open = 0;
        }

        // jika donasi selalu menerima dana (tidak bergantung dana)
        if($request->always_fund == 1) {
            $campaign->always_fund = 1;
            $campaign->goal_amount = NULL;
        } else {
            $campaign->always_fund = 0;
            $campaign->goal_amount = $request->goal_amount;
        }

        $campaign->save();

        return redirect()->back()->with('success', 'Success Update Campaign!');

        // dd($inputan);
    }
    // END ADMIN
}
