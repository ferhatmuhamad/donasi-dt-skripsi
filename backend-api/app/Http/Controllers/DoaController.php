<?php

namespace App\Http\Controllers;

use App\Models\DoaModel;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class DoaController extends Controller
{
    //
    public function getAllDoa() {
        $doadata = DoaModel::join('tb_user', 'tb_user.id_user', 'tb_doa.id_user')
                            ->select('tb_doa.*', 'tb_user.nama')
                            ->get();
        
        foreach($doadata as $d) {
            if($d->anonym == 1) {
                $d->nama = null;
            }
        }

        return format_response('success', Response::HTTP_OK, 'success fetch data campaigns', $doadata);
    }
}
