<?php

namespace App\Http\Controllers;

use App\Models\BannerModel;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BannerController extends Controller
{
    //
    public function getBanner() {
        $databanner = BannerModel::orderBy('sequence')->get();

        return format_response('success', Response::HTTP_OK, 'success fetch data banner', $databanner);
    }





    // DASHBOARD ADMIN
    public function index() {
        $banner = BannerModel::get();

        $data = [
            'banner' => $banner
        ];

        return view('banner.index', $data);
    }
    // ENDDASHBOARD
}
