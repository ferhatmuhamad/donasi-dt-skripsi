<?php

namespace App\Http\Controllers;

use App\Models\DoaModel;
use App\Models\DonasiModel;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Facades\JWTAuth;

class DonasiController extends Controller
{
    //
    protected $donasi_model;
    protected $doa_model;
    public function __construct()
    {
        $this->donasi_model = new DonasiModel();
        $this->doa_model = new DoaModel();
    }

    public function prosesDonasi($id, Request $request) {
        $user = JWTAuth::user();

        $dataDonasi = [
            'id_campaign' => $id,
            'id_user' => $user->id_user,
            'amount' => $request->amount,
            'status' => 'pending'
        ];

        $credentials = $request->only('id_user', 'amount');

        //valid credential
        $validator = Validator::make($credentials, [
            'id_user' => 'required',
            'amount' => 'required|int'
        ]);

        //Send failed response if request is not valid
        if ($validator->fails()) {
            return format_response('error', 200, 'error validation', $validator->getMessageBag());
        }

        try {
            $this->donasi_model::create($dataDonasi);
        } catch(Exception $e) {
            return format_response('error', Response::HTTP_INTERNAL_SERVER_ERROR, 'failed create funding transaction', $e);
        }

        if($request->doa) {
            $dataDoa = [
                'id_user' => $user->id_user,
                'id_campaign' => $id,
                'anonym' => isset($request->anonym) ? 1 : 0,
                'doa_text' => $request->doa
            ];

            try {
                $this->doa_model::create($dataDoa);
            } catch(Exception $e) {
                return format_response('error', Response::HTTP_INTERNAL_SERVER_ERROR, 'failed create doa', $e);
            }
        }

        return format_response('success', Response::HTTP_OK, 'success funding campaign', $dataDonasi);
    }

    public function myDonation(Request $request) {
        $user = JWTAuth::user();

        try {
            $donation = DonasiModel::where('id_user', $user->id_user)->orderBy('created_at', 'desc')->get();
        } catch(Exception $e) {
            return format_response('error', Response::HTTP_INTERNAL_SERVER_ERROR, 'failed get all funding', $e);
        }
        

        return format_response('success', Response::HTTP_OK, 'success get all donation', $donation);
    }

    public function myDonationDetail(Request $request) {
        $user = JWTAuth::user();

        try {
            $donation = DonasiModel::where('id_user', $user->id_user)->first();
        } catch(Exception $e) {
            return format_response('error', Response::HTTP_INTERNAL_SERVER_ERROR, 'failed get funding detail', $e);
        }
        

        return format_response('success', Response::HTTP_OK, 'success get detail donation', $donation);
    }

    public function getKonfirmasiDonasi(Request $request, $id) {
        $user = JWTAuth::user();

        try {
            $donation = DonasiModel::where('id_donasi', $id)->first();
        } catch(Exception $e) {
            return format_response('error', Response::HTTP_INTERNAL_SERVER_ERROR, 'failed get funding detail', $e);
        }

        return format_response('success', Response::HTTP_OK, 'success get detail funding transaction', $donation);
    }

    public function konfirmasiDonasi(Request $request, $id) {
        $user = JWTAuth::user();

        $datainput = [
            'file' => $request->file('file')
        ];

        $fileImg = $request->file('file');

        $credentials = $request->only('file');

        //valid credential
        $validator = Validator::make($credentials, [
            'file' => 'required|image',
        ]);

        //Send failed response if request is not valid
        if ($validator->fails()) {
            return format_response('error', 200, 'error validation', $validator->getMessageBag());
        }

        $dataDonasiUpdate = DonasiModel::where('id_donasi', $id)->first();
        
        if($dataDonasiUpdate->id_user != $user->id_user) {
            return format_response('error', 401, 'error, unauthorized user!', null);
        }

        if($dataDonasiUpdate->status == 'success') {
            return format_response('error', 401, 'error, unauthorized user!', null);
        }

        // put img to public path
        $pathImage = 'receipts/' . time() . '-' . md5($fileImg->getClientOriginalName()) . '.' . $fileImg->getClientOriginalExtension();
        $fileImg->move(public_path('uploads/receipts'), $pathImage);
        $datainput['path'] = $pathImage;

        
        $dataDonasiUpdate->status = 'success';
        $dataDonasiUpdate->bukti_transfer = 'upload/' . $pathImage;
        $dataDonasiUpdate->save();

        return format_response('success', Response::HTTP_OK, 'success post konfirmasi donasi', $datainput);
    }
}
