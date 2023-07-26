<?php

namespace App\Http\Controllers;

use App\Models\Asuransi;
use App\Models\Bengkel;
use App\Models\Customer;
use App\Models\DetailQc;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\User;
use App\Models\SPK;
use App\Models\Merk;
use App\Models\Jenis;
use App\Models\JenisBengkel;
use App\Models\Leasing;
use App\Models\Mobil;
use App\Models\PendukungDetailQc;
use App\Models\Qc;
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

    public function RiwayatTransaksi(Request $req) {
        $pej = $this->PageObj("Riwayat Transaksi","/transaksi/riwayat");
        $notif = $this->UserNotif();

        return view('riwayat')->with('pej',$pej)->with('notif',$notif);
    }

    public function ListMobil() {
        $pej = $this->PageObj("List Mobil","mobil");
        $notif = $this->UserNotif();

        $mobil = Mobil::select(
            'mobils.*', 
            'mobils.nama as type', 
            'merks.nama as merk')
            ->join('merks','mobils.id_merk','merks.id')
            ->where('mobils.state','>',2)
            ->where('mobils.state','<',7)
            ->get();

        $merk = Merk::all();

        $customer = Customer::all();

        return view('listMobil')->with('pej',$pej,)->with('notif',$notif)->with('mobil',$mobil)->with('merk',$merk)->with('customer',$customer);
    }


    // ================================== Sales ==================================

        public function Prospek() {
            $pej = $this->PageObj("Prospek","prospek");
            $notif = $this->UserNotif();

            $prospek = transaksiJual::select('transaksi_juals.*','customers.nama as pemesan','customers.telp as kontak','mobils.nama as type','merks.nama as merk')
            ->join('customers','transaksi_juals.id_customer','=','customers.id')
            ->join('mobils','transaksi_juals.id_mobil','=','mobils.id')
            ->join('merks','mobils.id_merk','=','merks.id')
            ->where('id_sales',Auth::user()->id)
            ->where(function($q) {
                $q->where('transaksi_juals.node','=',0)
                ->orWhere('transaksi_juals.node','=',1)
                ->orWhere('transaksi_juals.node','=',2)
                ->orWhere('transaksi_juals.node','=',3)
                ->orWhere('transaksi_juals.node','=',4);
            })
            ->get();

            return view('layouts.sales.prospek')->with('pej',$pej)->with('notif',$notif)->with('prospek',$prospek);
        }
    
    // ===========================================================================




    // ================================== Jual - Beli =============================


        public function SPK()
        {
            $pej = $this->PageObj("SPK","spk");
            $notif = $this->UserNotif();

            $spk = transaksiJual::select('transaksi_juals.*','customers.nama as pemesan','customers.telp as kontak','mobils.nama as type','merks.nama as merk')
            ->join('customers','transaksi_juals.id_customer','=','customers.id')
            ->join('mobils','transaksi_juals.id_mobil','=','mobils.id')
            ->join('merks','mobils.id_merk','=','merks.id')
            ->where('id_sales',Auth::user()->id)
            ->where('transaksi_juals.node','=',5)
            ->orwhere('transaksi_juals.node','=',6)
            ->orwhere('transaksi_juals.node','=',7)->get();

            return view('listSPK')->with('pej',$pej)->with('notif',$notif)->with('prospek',$spk);

        }

        public function listSPK()
        { 
            $pej = $this->PageObj("SPK","listspk");
            $notif = $this->UserNotif();

            $spk = transaksiJual::select('transaksi_juals.*','customers.nama as pemesan','customers.telp as kontak','mobils.nama as type','merks.nama as merk','spks.id_kwitansi_uang_spk')
            ->join('customers','transaksi_juals.id_customer','=','customers.id')
            ->join('mobils','transaksi_juals.id_mobil','=','mobils.id')
            ->join('merks','mobils.id_merk','=','merks.id')
            ->join('spks','transaksi_juals.id_spk','=','spks.id')
            ->where('id_sales',Auth::user()->id)
            ->where('transaksi_juals.node','=',5)
            ->orwhere('transaksi_juals.node','=',6)
            ->orwhere('transaksi_juals.node','=',7)->get();

            return view('layouts.keuangan.listSPK')->with('pej',$pej)->with('notif',$notif)->with('spk',$spk);

        }

        public function Jual()
        {
            $pej = $this->PageObj("Jual","jual");
            $notif = $this->UserNotif();

            $merk = Merk::orderBy('nama','ASC')->get();

            $customer = Customer::orderBy('nama','ASC')->get();

            return view('jual')->with('pej',$pej)->with('notif',$notif)->with('merk',$merk)->with('customer',$customer);
        }

        public function InputSPK(Request $req) {
            $pej = $this->PageObj("Input SPK","spk/input");
            $notif = $this->UserNotif();

            $jual = transaksiJual::select('transaksi_juals.*','customers.nama as pemesan','customers.alamat as domisili','customers.telp as kontak','mobils.nama as type','merks.nama as merk')
            ->join('customers','transaksi_juals.id_customer','=','customers.id')
            ->join('mobils','transaksi_juals.id_mobil','=','mobils.id')
            ->join('merks','mobils.id_merk','=','merks.id')
            ->where('transaksi_juals.id','=',$req->id_jual)->first();

            $spk = SPK::find($jual->id_spk);

            $asuransi = Asuransi::all();

            $leasing = Leasing::all();

            return view('SPK')->with('pej',$pej)->with('notif',$notif)->with('SPK',$spk)->with('jual',$jual)->with('asuransi',$asuransi)->with('leasing',$leasing);
        }

        public function Beli()
        {
            $pej = $this->PageObj("Beli","beli");
            $notif = $this->UserNotif();

            $merk = Merk::orderBy('nama', 'ASC')->get();
            $jenis = Jenis::orderBy('nama', 'ASC')->get();

            return view('beli')->with('pej',$pej)->with('merk',$merk)->with('jenis',$jenis)->with('notif',$notif);
        }    


    // ============================================================================




    // ================================== Keuangan ================================
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


    // ============================================================================
    



    // ================================= OPS ========================================
        public function PeriksaMasuk() {
            $pej = $this->PageObj("Periksa Mobil Masuk","/periksa/masuk");
            $notif = $this->UserNotif();

            $mobil = Mobil::select('mobils.*','merks.nama as merk')->join('merks','mobils.id_merk','=','merks.id')->where('state','=','1')->get();

            return view('layouts.ops.periksaMasuk')->with('pej',$pej)->with('notif',$notif)->with('mobil',$mobil);
        }

        public function PeriksaKeluar() {
            $pej = $this->PageObj("Periksa Mobil Keluar","/periksa/keluar");
            $notif = $this->UserNotif();

            $mobil = Mobil::select('mobils.*','merks.nama as merk')->join('merks','mobils.id_merk','=','merks.id')->where('state','=','7')->get();

            return view('layouts.ops.periksaKeluar')->with('pej',$pej)->with('notif',$notif)->with('mobil',$mobil);
        }

        public function Pemeriksaan() {
            $pej = $this->PageObj("Pemeriksaan Mobil","/pemeriksaan");
            $notif = $this->UserNotif();

            $mobil = Qc::select(
                'qcs.*',
                'mobils.nama',
                'merks.nama as merk',
                'mobils.tahun',
                'mobils.nomor_polisi',
                'mobils.kondisi',
                'mobils.odometer',
                'mobils.isi_silinder',
                'mobils.warna_interior',
                'mobils.pajak'
                )->join('mobils','qcs.id_mobil','=','mobils.id')
                ->join('merks','mobils.id_merk','=','merks.id')
                ->where('id_pdi','=',Auth::user()->id)
                ->where('node','=',0)
                ->orWhere('node','=',1)
                ->orderBy('updated_at', 'desc')->get();


            return view('layouts.ops.pemeriksaan')->with('pej',$pej)->with('notif',$notif)->with('mobil',$mobil);
        }

        public function Periksa(Request $req) {
            $notif = $this->UserNotif();

            $qc = Qc::find($req->id);
            $dqc = DetailQc::where('id_qc','=',$req->id)->first();
            $pdqc = PendukungDetailQc::where('id_qc','=',$req->id)->first();
            $mobil = Mobil::select('mobils.*','merks.nama as merk','jenis.nama as jenis')
            ->join('merks','mobils.id_merk','=','merks.id')
            ->join('jenis','mobils.id_jenis','=','jenis.id')
            ->where('mobils.id',$qc->id_mobil)->first();

            $dqc->ban_kiri_depan = explode('|',$dqc->ban_kiri_depan);
            $dqc->ban_kiri_belakang = explode('|',$dqc->ban_kiri_belakang);
            $dqc->ban_kanan_depan = explode('|',$dqc->ban_kanan_depan);
            $dqc->ban_kanan_belakang = explode('|',$dqc->ban_kanan_belakang);

            $pej = $this->PageObj("Pemeriksaan ". $mobil['merk'] ." ". $mobil['nama'],"/pemeriksaan");

            return view('layouts.ops.periksa')->with('pej',$pej)->with('notif',$notif)->with('qc',$qc)->with('dqc',$dqc)->with('pdqc',$pdqc)->with('mobil',$mobil);
        }

        public function DeliveryOrder(Request $req) {
            $pej = $this->PageObj("Delivery Order","/deliveryList");
            $notif = $this->UserNotif();


            $jual = transaksiJual::select(
                'transaksi_juals.*', 'transaksi_juals.id as id_jual', 
                'mobils.*',
                'mobils.nama as type', 
                'mobils.state as node_mobil',
                'mobils.nomor_polisi',
                'mobils.tahun',
                'merks.nama as merk',
                'spks.nama_pemakai',
                'spks.alamat',
                'spks.telp'
                )
                ->join('mobils','transaksi_juals.id_mobil','mobils.id')
                ->join('merks','mobils.id_merk','merks.id')
                ->join('spks','transaksi_juals.id_spk','spks.id')
                ->where('transaksi_juals.node','=',7)
                ->where('mobils.state',9)
                ->get();

                

            return view('layouts.ops.deliveryOrder')->with('pej',$pej)->with('notif',$notif)->with('data',$jual);
        }
    // ==============================================================================




    // =============================== Manager ==========================================

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

        public function User() {
            $pej = $this->PageObj("Manage Users","/user");
            $notif = $this->UserNotif();

            $user = User::select('users.*','roles.nama as jabatan')->join('roles','users.id_role','roles.id')->where('id_role','!=',1)->where('id_role','!=',2)->get();


            return view('layouts.manager.user')->with('pej',$pej)->with('notif',$notif)->with('data',$user);
        }

        public function Bengkel() {
            $pej = $this->PageObj("Manage Bengkel","/bengkel");
            $notif = $this->UserNotif();

            $bengkel = Bengkel::select('bengkels.*','jenis_bengkels.nama as jenis')->join('jenis_bengkels','bengkels.id_jenis_bengkel','jenis_bengkels.id')->get();

            $jenis = JenisBengkel::all();

            return view('layouts.manager.bengkel')->with('pej',$pej)->with('notif',$notif)->with('data',$bengkel)->with('jenis',$jenis);
        }

        public function Asuransi() {
            $pej = $this->PageObj("Manage Asuransi","/asuransi");
            $notif = $this->UserNotif();

            $asuransi = Asuransi::all();


            return view('layouts.manager.asuransi')->with('pej',$pej)->with('notif',$notif)->with('data',$asuransi);
        }

    // ==================================================================================



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
                    $notif = $this->notifOPS();
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

        public function notifOPS() {
            $n = Mobil::select('updated_at')->where('state','=','1')->orderBy('updated_at', 'desc')->get();
            $o = Mobil::select('updated_at')->where('state','=','7')->orderBy('updated_at', 'desc')->get();

            $not = app()->make('stdClass');

            if (count($n) > 0 || count($o) > 0) {
                $not->status = true;

                $notif = [];

                if ( count($n) > 0 && count($o) > 0) {
                    if ($n[0]->updated_at->gt($o[0]->updated_at)) {
                        $notif[0][0] = "masuk";
                        $notif[0][1] = Mobil::where('state','=','1')->orderBy('updated_at', 'desc')->get();
                        $notif[1][0] = "keluar";
                        $notif[1][1] = Mobil::where('state','=','7')->orderBy('updated_at', 'desc')->get();
                    } else {
                        $notif[0][0] = "keluar";
                        $notif[0][1] = Mobil::where('state','=','7')->orderBy('updated_at', 'desc')->get();
                        $notif[1][0] = "masuk";
                        $notif[1][1] = Mobil::where('state','=','1')->orderBy('updated_at', 'desc')->get();
                    }
                } else {
                    if (count($n) > 0) {
                        $notif[0][0] = "masuk";
                        $notif[0][1] = Mobil::where('state','=','1')->get();
                    }

                    if (count($o) > 0) {
                        $notif[0][0] = "keluar";
                        $notif[0][1] = Mobil::where('state','=','7')->get();
                    }
                }

                $not->notif = $notif;

            } else {
                $not->status = false;
                $not->notif = "";
            }

            $not->pemeriksaan = Qc::where('id_pdi','=',Auth::user()->id)->where('selesai','=',0)->count();

            return $not;
        }
    // ===================================================================================================================
}