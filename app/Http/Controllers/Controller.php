<?php

namespace App\Http\Controllers;

use App\Models\bast;
use App\Models\Mobil;
use App\Models\transaksiJual;
use Exception;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;

class Controller extends BaseController
{
    function GetMobil(Request $req) {
        $mobil = Mobil::where('id_merk','=',$req->id)->get();

        return response(['status'=>'success','res'=>$mobil]);
    }

    public function CetakSPK(Request $req) {

        try {
            $data = transaksiJual::select(
                'transaksi_juals.*',
                'spks.*','spks.nama_pemakai as namaP','spks.alamat as alamatP','spks.telp as telP',
                'customers.*','customers.nama as pemesan',
                'mobils.*','mobils.nama as type',
                'merks.nama as merk',
                'asuransis.nama as perusahaan_asuransi',
                'jenis_asuransis.nama as jenis_asuransi'
                )
            ->join('spks','transaksi_juals.id_spk','=','spks.id')
            ->join('customers','transaksi_juals.id_customer','=','customers.id')
            ->join('mobils','transaksi_juals.id_mobil','=','mobils.id')
            ->join('merks','mobils.id_merk','=','merks.id')
            ->join('asuransis','spks.id_asuransi','=','asuransis.id')
            ->join('jenis_asuransis','spks.id_jenis_asuransi','=','jenis_asuransis.id')
            ->where('transaksi_juals.id','=',$req->id)->first();
        } catch (Exception $e) {
            return response(['status'=>'error','data'=>$e]);
        }
        
        return response(['status'=>'success','data'=>$data]);
    }

    public function CetakBAST(Request $req) {

        $bast = bast::find($req->id);

        return response(['status'=>'success','res'=>$bast]);
    }
}
