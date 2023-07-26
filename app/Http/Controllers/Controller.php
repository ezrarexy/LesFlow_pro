<?php

namespace App\Http\Controllers;

use App\Models\bast;
use App\Models\DetailQc;
use App\Models\kwitansi;
use App\Models\Mobil;
use App\Models\Qc;
use App\Models\transaksiJual;
use Exception;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;

class Controller extends BaseController
{
    function GetMobil(Request $req) {
        $mobil = Mobil::where('id_merk','=',$req->id)
        ->where(function ($q) {
            $q->where('state',4)
            ->orWhere('state',5)
            ->orWhere('state',6);
        })
        ->get();

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
            ->leftjoin('asuransis','spks.id_asuransi','=','asuransis.id')
            ->leftjoin('jenis_asuransis','spks.id_jenis_asuransi','=','jenis_asuransis.id')
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

    public function CetakKwitansi(Request $req) {

        $kwitansi = kwitansi::find($req->id);

        return response(['status'=>'success','res'=>$kwitansi]);
    }


    public function HasilQC(Request $req) {
        $qc = app()->make('stdClass');
        $x = Qc::find($req->id_qc);
        $y = DetailQc::where('id_qc',$req->id_qc)->first();
        $qc->qc = $x;
        $qc->detail = $y;

        return response(['status'=>'success','res'=>$qc]);
    }

    public function GetDokumen(Request $req) {

        $doc = Mobil::select('ktp_an_bpkb','photo_bpkb','photo_pkb','photo_stnk')->where('id',$req->id)->first();

        return response(['status'=>'success','res'=>$doc]);
    }

    public function PutDokumen(Request $req) {

        $mobil = Mobil::find($req->input('id'));
        $imageName = "";
        $col = $req->input('col');

        if ($req->hasFile('file')) {

            $file = $req->file('file');

            $ext = $file->getClientOriginalExtension();

            $imageName = $mobil->id . '.' . $ext;

            try {
                Image::make($file)->save(public_path('assets/img/'.$col.'/').$imageName,80,$ext);
            } catch (Exception $e) {
                return response(['status'=>'fail','res'=>$e]);
            }

        } else {
            return response(['status'=>'fail','res'=>'Error!']);
        }

        $mobil->$col = $imageName;
        
        try {
            DB::beginTransaction();
                $mobil->save();
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            return response(['status'=>'fail','res'=>$e]);
        }

        return response(['status'=>'success']);
    }

}
