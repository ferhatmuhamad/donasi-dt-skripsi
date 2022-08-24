<?php

namespace App\Http\Controllers;

use App\Models\CampaignImageModel;
use App\Models\CampaignModel;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Facades\JWTAuth;

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

        if($campaign_data) {
            foreach($campaign_data as $cd) {
                $cd->path = url($cd->path);
            }
        }

        return format_response('success', Response::HTTP_OK, 'success fetch data campaigns', $campaign_data);
    }

    public function detail($id, Request $request) {
        $campaign_data = $this->campaign_model->getCampaign($id);

        return format_response('success', Response::HTTP_OK, 'success fetch data camapign', $campaign_data);
    }

    public function detailWithSlug($slug, Request $request) {
        $campaign_data = $this->campaign_model->getCampaignWithSlug($slug);

        if($campaign_data == null) {
            return format_response('failed', Response::HTTP_NOT_FOUND, 'failed fetch data camapign', $campaign_data);
        }

        try {
            $user = JWTAuth::parseToken()->authenticate();
            $campaign_data->user = $user;
        } catch(Exception $ex) {
            $campaign_data->user = null;
        }

        if($campaign_data == null) {
            return format_response('failed', Response::HTTP_NOT_FOUND, 'failed fetch data camapign', $campaign_data);
        }

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

        // donasi image
        if($request->file('file-image-campaign')) {
            $fileImage = $request->file('file-image-campaign');
            $file_name = 'campaign_img_' . time() . '.' . $fileImage->getClientOriginalExtension();
            $fileImage->move(public_path('uploads/campaign_img'), $file_name);

            $campaign->path = 'uploads/campaign_img/' . $file_name;
        }

        $campaign->save();

        return redirect()->back()->with('success', 'Success Update Campaign!');

        // dd($inputan);
    }

    public function store(Request $request) {
        $inputan = $request->all();

        $validator = Validator::make($inputan, [
            'campaign_title' => 'required',
            'description' => 'required',
            'always_open' => 'required|integer',
            'always_fund' => 'required|integer',
            'photo_campaign' => 'required|image'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->getMessageBag());
        }

        $datainputan = [
            'campaign_title' => $request->campaign_title,
            'description' => $request->description,
            'always_open' => $request->always_open,
            'always_fund' => $request->always_fund,
        ];

        if($request->always_open == 0) {
            $datainputan['target_day'] = $request->target_day;
        }

        if($request->always_fund == 0) {
            $datainputan['goal_amount'] = $request->goal_amount;
        }

        // dd($datainputan);

        $fileImage = $request->file('photo_campaign');
        $file_name = 'campaign_img_' . time() . '.' . $fileImage->getClientOriginalExtension();
        $fileImage->move(public_path('uploads/campaign_img'), $file_name);
        $datainputan['path'] = 'uploads/campaign_img/' . $file_name;

        $newCampaign = CampaignModel::create($datainputan);

        // make slug
        $slug = strtolower($request->campaign_title);
        $slug = str_replace(" ", "-", $slug);
        $newCampaign->slug = $slug . '-' . $newCampaign->id_campaign;
        $newCampaign->save();

        return redirect()->back()->with('success', 'Sukses menambahkan campaign');
    }

    public function remove($id) {
        $dataHasDelete = CampaignModel::where('id_campaign', $id)->first();
        
        if($dataHasDelete) {
            $dataHasDelete->delete();
            return redirect()->back()->with('success', 'Sukses menghapus campaign!'); 
        } else {
            return redirect()->back()->withErrors('Gagal menghapus campaign!'); 
        }
    }

    public function tambahGambar(Request $request, $id) {
        $inputan = $request->all();

        $validator = Validator::make($inputan, [
            'file-image' => 'required|image',
        ]);

        //Send failed response if request is not valid
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->getMessageBag());
        }

        $fileImage = $request->file('file-image');
        $file_name = 'campaign_img_' . time() . '.' . $fileImage->getClientOriginalExtension();
        $fileImage->move(public_path('uploads/campaign_img'), $file_name);

        $countImg = CampaignImageModel::where('id_campaign', $id)->count();

        $dataInput = [
            'path' => 'uploads/campaign_img/' . $file_name,
            'id_campaign' => $id,
            'sequence' => $request->sequence ? $request->sequence : $countImg + 1
        ];

        $imgInsert = CampaignImageModel::create($dataInput);

        return redirect()->back()->with('success', 'Sukses Add Campaign Image');
    } 

    public function editGambar($id, $id_gambar) {
        $datacampaign = CampaignModel::where('id_campaign', $id)->first();

        if(!$datacampaign) {
            return redirect()->back()->withErrors('Campaign Not Found!');
        }

        $campaignIMG = CampaignImageModel::where('id_campaign_img', $id_gambar)->first();
        if(!$campaignIMG) {
            return redirect()->back()->withErrors('Campaign Image Not Found!');
        }

        $data = [
            'campaign' => $datacampaign,
            'image' => $campaignIMG
        ];

        // dd($campaignIMG);
        return view('campaign.editimage', $data);

    }

    public function hapusGambar($id) {
        $imgCampaign = CampaignImageModel::where('id_campaign_img', $id)->first();

        if(!$imgCampaign) {
            return redirect()->back()->withErrors('Campaign Image Not Found!');
        }

        $imgCampaign->delete();

        return redirect()->back()->with('success', 'Sukses Delete Campaign Image');
    }
    // END ADMIN
}
