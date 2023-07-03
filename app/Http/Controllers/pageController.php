<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\User;
use App\Models\SPK;
use App\Models\Merk;
use App\Models\Jenis;
use App\Models\transaksiBeli;
use App\Models\transaksiJual;

use Auth;

class pageController extends Controller
{
    public function Index()
    {
        $pej = $this->PageObj("Index","");

        $notif = $this->UserNotif();

        return view('index')->with('pej',$pej)->with('notif',$notif);
        // $res = $j[0]->updated_at->gt($b[0]->updated_at);
        // dd($res);
    }

    public function Login()
    {
        $pej = $this->PageObj("Login","login");

        return view('auth.login')->with('pej',$pej);
    }

    public function SPK()
    {
        $pej = $this->PageObj("SPK","spk");
        $notif = $this->UserNotif();

        return view('index')->with('pej',$pej)->with('notif',$notif);
    }

    public function Jual()
    {
        $pej = $this->PageObj("Jual","jual");
        $notif = $this->UserNotif();

        return view('jual')->with('pej',$pej)->with('notif',$notif);
    }

    public function Beli()
    {
        $pej = $this->PageObj("Beli","beli");
        $notif = $this->UserNotif();

        $merk = Merk::orderBy('nama', 'ASC')->get();
        $jenis = Jenis::orderBy('nama', 'ASC')->get();

        return view('beli')->with('pej',$pej)->with('merk',$merk)->with('jenis',$jenis)->with('notif',$notif);
    }

    public function KonfJual() {

        $pej = $this->PageObj("Konfirmasi Jual","/konfirmasi/jual");
        $notif = $this->UserNotif();

        $data = transaksiJual::select('transaksi_juals.*','mobils.nama as type','merks.nama as merk','mobils.harga_jual')->join('mobils','transaksi_juals.id_mobil','=','mobils.id')->join('merks','mobils.id_merk','=','merks.id')->where('node','=','0')->get();

        return view('layouts.manager.konfirmasi')->with('pej',$pej)->with('notif',$notif)->with('data',$data);
    }

    public function KonfBeli() {

        $pej = $this->PageObj("Konfirmasi Beli","/konfirmasi/beli");
        $notif = $this->UserNotif();

        $data = transaksiBeli::select('transaksi_belis.*','mobils.nama as type','merks.nama as merk','mobils.kondisi','mobils.harga_jual')->join('mobils','transaksi_belis.id_mobil','=','mobils.id')->join('merks','mobils.id_merk','=','merks.id')->where('node','=','0')->get();

        return view('layouts.manager.konfirmasi')->with('pej',$pej)->with('notif',$notif)->with('data',$data);
    }

    public function PayB() {

        $pej = $this->PageObj("Pembayaran Beli","/pembayaran/beli");
        $notif = $this->UserNotif();

        $data = transaksiBeli::select(
            'transaksi_belis.*',
            'mobils.nama as type',
            'merks.nama as merk',
            'mobils.kondisi',
            'mobils.harga_jual',
            'mobils.tahun',
            'mobils.warna',
            'mobils.bahan_bakar',
            'mobils.nomor_bpkb',
            'mobils.an_bpkb',
            'mobils.alamat',
            'mobils.nomor_polisi',
            'mobils.nomor_rangka',
            'mobils.nomor_mesin',
            'kelengkapans.csKTPbpkb',
            'kelengkapans.chKW',
            'kelengkapans.chFA',
            'kelengkapans.chForm',
            'kelengkapans.chKeyS',
            'kelengkapans.chSPH',
            'kelengkapans.chSTNK',
            'kelengkapans.chKeyRod',
            'kelengkapans.chBan',
            'kelengkapans.chDgrk',
            )->join('mobils','transaksi_belis.id_mobil','=','mobils.id')->join('merks','mobils.id_merk','=','merks.id')->join('kelengkapans','mobils.id','=','kelengkapans.id_mobil')->where('node','=','2')->get();

        return view('layouts.keuangan.pembayaran')->with('pej',$pej)->with('notif',$notif)->with('data',$data);
    }

    //================================ Mengatur Notifikasi untuk masing masing user ======================================
    public function UserNotif() {
        $notif = app()->make('stdClass');
        $notif->status = false;

        switch (Auth::user()->id_role) {
            case 1:
                # code...
                break;
            
            case 2:
                $notif = $this->notifManager();
                break;

            case 3:
                $notif = $this->notifFinance();
                break;
            case 4:
                # code...
                break;
            case 5:
                # code...
                break;
            case 6:
                # code...
                break;
        }

        return $notif;
    }

    public function PageObj($name, $link) {
        $pej = app()->make('stdClass');

        $pej->name = $name;
        $pej->link = $link;

        return $pej;
    }

    public function notifManager() {
        $j = transaksiJual::select('updated_at')->where('node','=','0')->orderBy('updated_at', 'desc')->get();
        $b = transaksiBeli::select('updated_at')->where('node','=','0')->orderBy('updated_at', 'desc')->get();

        $not = app()->make('stdClass');

        if (count($j) > 0 || count($b) > 0) {
            $not->status = true;

            $notif = [];

            if ( count($j) > 0 && count($b) > 0) {
                if ($j[0]->updated_at->gt($b[0]->updated_at)) {
                    $notif[0][0] = "jual";
                    $notif[0][1] = transaksiJual::where('node','=','0')->orderBy('updated_at', 'desc')->get();
                    $notif[1][0] = "beli";
                    $notif[1][1] = transaksiBeli::where('node','=','0')->orderBy('updated_at', 'desc')->get();
                } else {
                    $notif[0][0] = "beli";
                    $notif[0][1] = transaksiBeli::where('node','=','0')->orderBy('updated_at', 'desc')->get();
                    $notif[1][0] = "jual";
                    $notif[1][1] = transaksiJual::where('node','=','0')->orderBy('updated_at', 'desc')->get();
                }
            } else {
                if (count($j) > 0) {
                    $notif[0][0] = "jual";
                    $notif[0][1] = transaksiJual::where('node','=','0')->get();
                }

                if (count($b) > 0) {
                    $notif[0][0] = "beli";
                    $notif[0][1] = transaksiBeli::where('node','=','0')->get();
                }
            }

            $not->notif = $notif;

        } else {
            $not->status = false;
            $not->notif = "";
        }

        return $not;
    }

    public function notifFinance() {
        $b = transaksiBeli::select('updated_at')->where('node','=','2')->orderBy('updated_at', 'desc')->get();

        $not = app()->make('stdClass');

        if (count($b) > 0) {
            $not->status = true;

            $notif = [];

            $notif[0][0] = "beli";
            $notif[0][1] = transaksiBeli::where('node','=','2')->orderBy('updated_at', 'desc')->get();

            $not->notif = $notif;

        } else {
            $not->status = false;
            $not->notif = "";
        }

        return $not;        
    }
}