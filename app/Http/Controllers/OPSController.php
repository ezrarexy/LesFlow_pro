<?php

namespace App\Http\Controllers;

use App\Models\DetailQc;
use App\Models\Mobil;
use App\Models\PendukungDetailQc;
use App\Models\Qc;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class OPSController extends Controller
{
    public function Ambil(Request $req) {

        $mobil = Mobil::find($req->id);
        $mobil->state = (($req->state==1) ? '6' : '7');
        $mobil->save();

        $id = DB::table('qcs')->insertGetId([
            'id_mobil' => $req->id,
            'id_pdi' => Auth::user()->id,
            'created_at' =>  Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        $dqc = new DetailQc;
        $dqc->id_qc = $id;
        $dqc->save();

        $pdqc = new PendukungDetailQc;
        $pdqc->id_qc = $id;
        $pdqc->save();

        return redirect()->route('periksaMasuk');
    }

    public function StartPeriksa(Request $req) {

        try {
            $qc = Qc::find($req->id);
                $qc->node = 1;
            $qc->save();

            $mobil = Mobil::find($req->id_mobil);
                $mobil->transmisi = $req->transmisi;
                $mobil->isi_silinder = $req->isi_silinder;
                $mobil->warna_interior = $req->warna_interior;
                $mobil->odometer = $req->odometer;
                $mobil->pajak = $req->pajak;
            $mobil->save();
        } catch (\Throwable $th) {
            return response(['status'=>'fail','err'=>$th]);    
        }


        return response(['status'=>'success']);
    }

}
