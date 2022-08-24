<?php

namespace App\Http\Controllers;

use App\Models\BannerModel;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class BannerController extends Controller
{
    //
    public function getBanner()
    {
        $databanner = BannerModel::orderBy('sequence')->get();

        if($databanner) {
            foreach($databanner as $db) {
                $db->path = url('/' . $db->path);
            }
        }

        return format_response('success', Response::HTTP_OK, 'success fetch data banner', $databanner);
    }





    // DASHBOARD ADMIN
    public function index()
    {
        $banner = BannerModel::get();

        $data = [
            'banner' => $banner
        ];

        return view('banner.index', $data);
    }

    public function store(Request $request)
    {
        $inputan = $request->all();

        $validator = Validator::make($inputan, [
            'sequence' => 'required',
            'description' => 'required',
            'photo_banner' => 'required|image'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->getMessageBag());
        }

        $fileImage = $request->file('photo_banner');
        $file_name = 'banner_' . time() . '.' . $fileImage->getClientOriginalExtension();
        $fileImage->move(public_path('uploads/banner'), $file_name);

        $datainputan = [
            'description' => $request->description,
            'sequence' => $request->sequence,
            'path' => 'uploads/campaign_img/' . $file_name
        ];

        $newBanner = BannerModel::create($datainputan);

        return redirect()->back()->with('success', 'Sukses menambahkan banner!');
    }

    public function remove($id) {
        $banner = BannerModel::where('id_banner', $id)->first();

        if($banner) {
            $banner->delete();
            
            return redirect()->back()->with('success', 'Sukses menghapus banner!');
        } else {
            return redirect()->back()->withErrors('Gagal menghapus banner!');
        }
    }

    public function edit($id) {
        $banner = BannerModel::where('id_banner', $id)->first();

        $data = [
            'id' => $id,
            'banner' => $banner
        ];

        return view('banner.edit', $data);
    }

    public function update(Request $request, $id) {

        $banner = BannerModel::where('id_banner', $id)->first();

        if(!$banner) {
            return redirect()->back()->withErrors('Gagal melakukan update banner!');
        }

        if($request->file('photo_banner')) {
            $validator = Validator::make([
                'photo_banner' => $request->photo_banner
            ], [
                'photo_banner' => 'required|image'
            ]);
    
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator->getMessageBag());
            }

            $fileImage = $request->file('photo_banner');
            $file_name = 'banner_' . time() . '.' . $fileImage->getClientOriginalExtension();
            $fileImage->move(public_path('uploads/banner'), $file_name);

            $banner->path = 'uploads/banner/' + $file_name;
        }

        if($request->sequence) {
            $validator = Validator::make([
                'sequence' => $request->sequence
            ], [
                'sequence' => 'required|integer'
            ]);
    
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator->getMessageBag());
            }

            $banner->sequence = $request->sequence;
        }

        if($request->description) {
            $validator = Validator::make([
                'description' => $request->description
            ], [
                'description' => 'required'
            ]);
    
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator->getMessageBag());
            }

            $banner->description = $request->description;
        }

        $banner->save();
        

        return redirect()->back()->with('success', 'Sukses menambahkan banner!');
    }
    // ENDDASHBOARD
}
