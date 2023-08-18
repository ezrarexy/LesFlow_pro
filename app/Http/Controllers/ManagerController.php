<?php

namespace App\Http\Controllers;

use App\Models\Asuransi;
use App\Models\Bengkel;
use App\Models\HariRaya;
use App\Models\Mobil;
use Illuminate\Http\Request;
use App\Models\User;

use Auth;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ManagerController extends Controller
{
    public function UserAdd(Request $req) {
        
        $user = new User;

        $user->nama = $req->nama;
        $user->id_role = $req->id_role;
        $user->email = $req->email;
        $user->telp = $req->telp;
        $user->password = Hash::make('Lestari123');
        

        try {
            DB::beginTransaction();
                $user->save();
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            return response(['status'=>'fail','res'=>$e]);
        }

        return response(['status'=>'success']);
    }

    public function RayaAdd(Request $req) {
        
        $raya = new HariRaya();

        $raya->nama = $req->nama;
        $raya->id_agama = $req->id_agama;
        $raya->tanggal = $req->tanggal;
        

        try {
            DB::beginTransaction();
                $raya->save();
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            return response(['status'=>'fail','res'=>$e]);
        }

        return response(['status'=>'success']);
    }

    public function SetBottom(Request $req) {
        $mobil = Mobil::find($req->id);
        $mobil->harga_bottom = $req->harga_bottom;

        try {
            DB::beginTransaction();
                $mobil->save();
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            return response(['status'=>'success','res'=>$e]);
        }


        return response(['status'=>'success']);
    }

    public function SetHarga(Request $req) {
        $mobil = Mobil::find($req->id);
        $mobil->harga_jual = $req->harga_jual;

        try {
            DB::beginTransaction();
                $mobil->save();
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            return response(['status'=>'success','res'=>$e]);
        }


        return response(['status'=>'success']);
    }

    public function BengkelAdd(Request $req) {
        $bengkel = new Bengkel;

        try {
            foreach ($req->all() as $k => $v) {
                $bengkel->$k = $v;
            }

            $bengkel->save();
        } catch (Exception $e) {
            return response(['status'=>'fail','res'=>$e]);    
        }

        return response(['status'=>'success']);
    }

    public function AsuransiAdd(Request $req) {
        $asuransi = new Asuransi;

        try {
            foreach ($req->all() as $k => $v) {
                $asuransi->$k = $v;
            }

            $asuransi->save();
        } catch (Exception $e) {
            return response(['status'=>'fail','res'=>$e]); 
        }

        return response(['status'=>'success']);
    }

}
