<?php

namespace App\Http\Controllers;

use App\Models\DoaModel;
use App\Models\DonasiModel;
use Exception;
use Illuminate\Http\Request;
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

        return format_response('success', Response::HTTP_OK, 'success funding campaign', $user->id_user);
    }
}
