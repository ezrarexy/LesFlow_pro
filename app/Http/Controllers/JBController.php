<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Models\Merk;
use App\Models\Mobil;
use App\Models\Kelengkapan;
use App\Models\Spk;
use App\Models\transaksiBeli;
use App\Models\transaksiJual;


use Auth;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Laravel\Ui\Presets\React;
use Intervention\Image\Facades\Image;

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
                'transmisi'=>$req->transmisi,
                'bahan_bakar'=>$req->bahan_bakar,
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
                'transmisi'=>$req->transmisi,
                'bahan_bakar'=>$req->bahan_bakar,
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

        return redirect()->route('home');

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

    public function JualA(Request $req) {

        $id_customer = "";
        $id_SPK = "";
        $id_jual = "";

        if (isset($req->id_customer)) {
            $id_customer = $req->id_customer;
        } else {
            $id_customer = DB::table('customers')->insertGetId([
                'nama' => $req->namaCustomer,
                'alamat' => $req->alamatCustomer,
                'telp' => $req->kontakCustomer,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
        }

        $id_SPK = DB::table('spks')->insertGetId([
            'id_customer' => $id_customer,
            'id_mobil' => $req->id_mobil,
            'harga_jadi' => isset($req->nego) ? $req->nego : $req->harga,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        $id_jual = DB::table('transaksi_juals')->insertGetId([
            'id_sales' => Auth::user()->id,
            'id_customer' => $id_customer,
            'id_mobil' => $req->id_mobil,
            'harga' => isset($req->nego) ? $req->nego : $req->harga,
            'id_spk' => $id_SPK,
            'node' => isset($req->nego) ? 1 : 2
        ]);


        return response(['status'=>'success','res'=>['id_spk'=>$id_SPK,'id_jual'=>$id_jual]]);
    }

    public function JualB(Request $req) {
        
    }

    public function InputSPK(Request $req) {
        $fileKTPnama = "";

        // $jual = transaksiJual::find($req->input('id'));

        // $cust = Customer::find($jual->id_customer);

        // $spk = Spk::find($jual->id_spk);

        // $cust->nik = $req->input('nomor_ktp');
        // $cust->jk = $req->input('jenis_kelamin');
        // $cust->dob = $req->input('tanggal_lahir');
        // $cust->id_agama = $req->input('agama');
        // $cust->instagram = $req->input('instagram');
        // $cust->facebook = $req->input('facebook');

        // $spk->nama_pemakai = $req->input('namaP');
        // $spk->alamat = $req->input('alamatP');
        // $spk->telp = $req->input('telP');
        // $spk->id_jenis_pembayaran = $req->input('jenis_pembayaran');
        // if ($req->input('jenis_pembayaran')==2) {
        //     $spk->id_leasing = $req->input('leasing');
        //     $spk->DP = $req->input('total_dp');
        //     $spk->cicilan = $req->input('angsuran');
        //     $spk->tenor = $req->input('tenor');
        // }
        // if ($req->input('asuransi')==1) {
        //     $spk->id_asuransi = $req->input('id_asuransi');
        //     $spk->id_jenis_asuransi = $req->input('jenisAsuransi');
        //     $spk->biaya_asuransi = $req->input('biayaAsuransi');
        // }
        // $spk->node = 1;

        // $jual->id_jenis_pembayaran = $req->input('jenis_pembayaran');
        // $jual->node = 6;

        // // Mengambil file gambar
        // if ($req->hasFile('photo_ktp')) {
        //     $fileKTP = $req->file('photo_ktp');

        //     $ext = $fileKTP->getClientOriginalExtension();

        //     $imageName = $req->input('nomor_ktp') . '.' . $ext;

        //     $cust->photo_ktp = $imageName;

        //     try {
        //         Image::make($fileKTP)->save(public_path('assets/img/ktp/customers/').$imageName,80,$ext);
        //     } catch (Exception $e) {
        //         return response(['status'=>'fail','res'=>$e]);
        //     }
        // }


        // // Simpan
        // try {
        //     DB::beginTransaction();
        //         $cust->save();
        //         $spk->save();
        //         $jual->save();
        //     DB::commit();
        // } catch (\Throwable $th) {
        //     DB::rollBack();
        //     return response(['status'=>'fail','res'=>$th]);
        // }




        return response(['status'=>'success']);
    }



}
