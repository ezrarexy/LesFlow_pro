<?php

namespace App\Http\Controllers;

use App\Models\bast;
use App\Models\Customer;
use App\Models\DetailQc;
use App\Models\Mobil;
use App\Models\PendukungDetailQc;
use App\Models\Qc;
use App\Models\transaksiJual;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Intervention\Image\Facades\Image;

class OPSController extends Controller
{
    public function Ambil(Request $req) {

        $mobil = Mobil::find($req->id);
        $mobil->state = (($req->state==1) ? '2' : '7');
        

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

        $mobil->id_qc_out = $id;
        $mobil->save();

        return redirect()->route('periksaMasuk');
    }

    public function StartPeriksa(Request $req) {

        try {
            $qc = Qc::find($req->id);
                $qc->node = 1;
            $qc->save();

            $mobil = Mobil::find($req->id_mobil);
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

    public function QCClick(Request $req) {
        $col = $req->col;

        try {
            $dqc = DetailQc::find($req->id);
            $dqc->$col = $req->val;
            $dqc->save();
        } catch (\Throwable $th) {
            return response(['status'=>'fail','res'=>$th]);
        }

        return response(['status'=>'success']);
    }
    
    public function BanQC(Request $req) {

        try {
            $dqc = DetailQc::find($req->id);
            $ban = $req->ban;
    
            $temp = explode('|',$dqc->$ban);
            $temp[$req->col] = $req->val;
    
            $dqc->$ban = $temp[0]."|".$temp[1]."|".$temp[2]."|".$temp[3];

            $dqc->save();

        } catch (\Throwable $th) {
            return response(['status'=>'fail','res'=>$th]);    
        }

        

        return response(['status'=>'success']);
    }

    public function SubmitQC(Request $req) {
        $qc = Qc::find($req->id);
        $mobil = Mobil::find($qc->id_mobil);

        

        if (isset($req->notReady)) {
            $qc->node = 5;

            $mobil->state = 6;
            $mobil->status = 'repair';

            $qc->save();
            $mobil->save();
        } else {
            $qc->node = 8;
            $qc->selesai = 1;

            if ($mobil->state == 7) {
                $mobil->status = 'ready';
            } else {
                $mobil->state = 5;
                $mobil->status = 'ready';
            }

            $qc->save();
            $mobil->save();
        }

        return redirect()->route('home');
    }


    public function InputBAST(Request $req) {
        $data = "";
        $id = "";

        try {
            $data = transaksiJual::select(
            'transaksi_juals.*',
            'mobils.*', 'mobils.nama as type',
            'merks.nama as merk'
            )
            ->join('mobils','transaksi_juals.id_mobil','=','mobils.id',)
            ->join('merks','mobils.id_merk','=','merks.id')
            ->where('transaksi_juals.id',$req->id)->first();
            $data->kepada = $req->kepada;
            $data->tanggal = $req->tanggal;
        } catch (Exception $e) {
            return response(['status'=>'fail','res'=>$e]);
        }

        try {
            DB::beginTransaction();
                $id = DB::table('basts')->insertGetId([
                    'tanggal'=>$req->tanggal,
                    'kepada'=>$req->kepada,
                    'merk'=>$data->merk,
                    'type'=>$data->type,
                    'nomor_polisi'=>$data->nomor_polisi,
                    'tahun'=>$data->tahun,
                    'warna'=>$data->warna,
                    'kondisi'=>$data->kondisi,
                    'nomor_mesin'=>$data->nomor_mesin,
                    'nomor_rangka'=>$data->nomor_rangka,
                    'syarat'=>$req->syarat,
                    'chSTNK'=>(isset($req->chSTNK) ? 1 : 0),
                    'chBan'=>(isset($req->chBan) ? 1 : 0),
                    'chDgrk'=>(isset($req->chDgrk) ? 1 : 0),
                    'chKeyRod'=>(isset($req->chKeyRod) ? 1 : 0)
                ]);


                $tj = transaksiJual::find($req->id);
                $tj->id_bast = $id;
                $tj->save();

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            return response(['status'=>'fail','res'=>$e]);
        }

        $bast = bast::find($id);

        return response(['status'=>'success','res'=>$bast]);
    }

    public function Delivered(Request $req) {
        $imageName = "";

        $jual = transaksiJual::find($req->input('id'));
        $bast = bast::find($jual->id_bast);
        $cust = Customer::find($jual->id_customer);

        // Mengambil file gambar
        if ($req->hasFile('foto')) {
            $fileKTP = $req->file('foto');

            $ext = $fileKTP->getClientOriginalExtension();

            $imageName = $bast->id . '.' . $ext;

            try {
                Image::make($fileKTP)->save(public_path('assets/img/DO/').$imageName,80,$ext);
            } catch (Exception $e) {
                return response(['status'=>'fail','res'=>$e]);
            }
        }

        $bast->foto = $imageName;
        $jual->node = 8;

        

        if ($cust->state==0) {
            $cust->state = 1;
        } else {
            $cust->state = 2;
        }

        try {
            DB::beginTransaction();
                $bast->save();
                $jual->save();
                $cust->save();
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            return response(['status'=>'fail','res'=>$e]);
        }


        return response(['status'=>'success','res'=>$req->all()]);
    }
}
