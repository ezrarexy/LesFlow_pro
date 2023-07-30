<?php

namespace App\Http\Controllers;

use App\Models\Mobil;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function JatuhTempo(Request $req) {
        
        try {
            $id = $req->id;
            $x = $req->x;
            $y = $req->y;

            $mobil = Mobil::find($id);

        
            DB::beginTransaction();
                $mobil->jt_pkb = $x;
                $mobil->jt_stnk = $y;
                $mobil->save();
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            return response(['status'=>'fail','res'=>$e]);
        }

        return response(['status'=>'success']);
    }
}
