<?php

namespace App\Http\Controllers;

use App\Models\transaksiBeli;
use App\Models\Mobil;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FinanceController extends Controller
{
    public function InKwitansi(Request $req) {

        $id = DB::table('kwitansis')->insertGetId([
            'nama'=>$req->nama,
            'harga'=>$req->harga,
            'merk'=>$req->merk,
            'tahun'=>$req->tahun,
            'warna'=>$req->warna,
            'bahan_bakar'=>$req->bahan_bakar,
            'an_bpkb'=>$req->an_bpkb,
            'alamat'=>$req->alamat,
            'nomor_polisi'=>$req->nomor_polisi,
            'nomor_rangka'=>$req->nomor_rangka,
            'nomor_mesin'=>$req->nomor_mesin,
            'nomor_bpkb'=>$req->nomor_bpkb,
            'tanggal'=>$req->today,
            'created_at' =>  Carbon::now(),
            'updated_at' => Carbon::now(), 
        ]);

        $transBeli = new transaksiBeli;
        $trans = $transBeli::find($req->id);
        $trans->id_kwitansi = $id;
        $trans->save();

        return response(['status'=>'success']);
    }

    public function InTTbpkb(Request $req) {
        $id = DB::table('tt_bpkbs')->insertGetId([
            'merk_tipe'=>$req->merk." ".$req->type,
            'tahun'=>$req->tahun,
            'warna'=>$req->warna,
            'an_bpkb'=>$req->an_bpkb,
            'alamat'=>$req->alamat,
            'nomor_polisi'=>$req->nomor_polisi,
            'nomor_rangka'=>$req->nomor_rangka,
            'nomor_mesin'=>$req->nomor_mesin,
            'nomor_bpkb'=>$req->nomor_bpkb,
            'chFA'=>$req->chFA,
            'csKTPbpkb'=>$req->csKTPbpkb,
            'chForm'=>$req->chForm,
            'chKW'=>$req->chKW,
            'chKeyS'=>$req->chKeyS,
            'chSPH'=>$req->chSPH,
            'created_at' =>  Carbon::now(),
            'updated_at' => Carbon::now(), 
        ]);

        $transBeli = new transaksiBeli;
        $trans = $transBeli::find($req->id);
        $trans->id_ttBPKB = $id;
        $trans->save();

        return response(['status'=>'success','res'=>$req->all()]);
    }

    public function InBAST(Request $req) {

        $id = DB::table('basts')->insertGetId([
            'tanggal'=>$req->today,
            'kepada'=>$req->kepada,
            'merk'=>$req->merk,
            'type'=>$req->type,
            'nomor_polisi'=>$req->nomor_polisi,
            'tahun'=>$req->tahun,
            'warna'=>$req->warna,
            'kondisi'=>$req->kondisi,
            'nomor_mesin'=>$req->nomor_mesin,
            'nomor_rangka'=>$req->nomor_rangka,
            'chSTNK'=>$req->chSTNK,
            'chBan'=>$req->chBan,
            'chDgrk'=>$req->chDgrk,
            'chKeyRod'=>$req->chKeyRod,
            'created_at' =>  Carbon::now(),
            'updated_at' => Carbon::now(), 
        ]);

        $transBeli = new transaksiBeli;
        $trans = $transBeli::find($req->id);
        $trans->id_BAST = $id;
        $trans->save();

        return response(['status'=>'success', 'res'=>$req->all()]);      
    }

    public function BayarBeli(Request $req) {        
        $q = transaksiBeli::find($req->id);

        $id_mobil = $q->id_mobil;

        $q->node = 3;
        $q->save();

        $c = Mobil::find($id_mobil);

        $c->state = 1;
        $c->save();
        

        return redirect()->route('pembayaranB');
    }

}
