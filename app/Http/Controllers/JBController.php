<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Merk;
use App\Models\Mobil;
use App\Models\Kelengkapan;
use App\Models\transaksiBeli;
use App\Models\transaksiJual;

use Auth;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;


class JBController extends Controller
{
    public function Beli(Request $req) 
    {

        $getColumn = Schema::getColumnListing('kelengkapans');

        $slim = array('id','id_mobil','created_at','updated_at');

        $res = array_values(array_diff($getColumn, $slim));
        
        $kelengkapan = array();

        foreach ($res as $k => $v) {
            if ($req->$v == "on") {
                array_push($kelengkapan, $v);
            }
        }

        $lgk = new Kelengkapan;
        
        $id = 0;

        if (Auth::user()->id_role==2) {
            $id = DB::table('mobils')->insertGetId([
                'id_merk' => $req->merk,
                'id_jenis' => $req->jenis,
                'nama' => $req->type,
                'tahun' => $req->tahun,
                'warna' => $req->warna,
                'nomor_bpkb' => $req->noBPKB,
                'an_bpkb' => $req->nmBPKB,
                'alamat' => $req->alamat,
                'nomor_rangka' => $req->norang,
                'nomor_mesin' => $req->nomes,
                'nomor_polisi' => $req->nopol,
                'harga_beli' => str_replace(',','',$req->harga),
                'kondisi' => $req->kond,
                'node' => 2,
            ]);            
        } else {
            $id = DB::table('mobils')->insertGetId([
                'id_merk' => $req->merk,
                'id_jenis' => $req->jenis,
                'nama' => $req->type,
                'tahun' => $req->tahun,
                'warna' => $req->warna,
                'nomor_bpkb' => $req->noBPKB,
                'an_bpkb' => $req->nmBPKB,
                'alamat' => $req->alamat,
                'nomor_rangka' => $req->norang,
                'nomor_mesin' => $req->nomes,
                'nomor_polisi' => $req->nopol,
                'harga_beli' => str_replace(',','',$req->harga),
                'kondisi' => $req->kond
            ]);
        }

        $lgk->id_mobil = $id;

        foreach ($kelengkapan as $k => $v) {
            $lgk->$v = 1;
        }

        $lgk->save();

        $trans = new transaksiBeli;

        $trans->id_mobil = $id;
        $trans->id_user = Auth::user()->id;
        $trans->nama = $req->nama;
        $trans->harga = str_replace(',','',$req->harga);
        $trans->save();

        dd('Mantap');

    }

    public function KonfirmasiJ(Request $req) {
        $trans = transaksiJual::find($req->id);        
        $trans->node = $req->val;
        $trans->save();

        return redirect()->route('konfJual');
    }    

    public function KonfirmasiB(Request $req) {
        $trans = transaksiBeli::find($req->id);        
        $trans->node = $req->val;
        $trans->save();

        return redirect()->route('konfBeli');
    }


}
