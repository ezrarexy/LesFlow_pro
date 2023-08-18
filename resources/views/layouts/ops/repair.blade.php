@extends("tmp.main")

@section('title',$pej->name)


@section('style')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection


@section('content')


    <div >
        @foreach ($data as $i => $v)
        
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{ $v->merk." ".$v->type }}</h4>
                </div>
                <div class="card-body row">

                    <div class="col-md-10">

                        <div class="mb-3">

                        </div>

                        <p>
                            <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                                Detail
                            </button>
                            @if ($v->node_perbaikan == 0 || $v->node_perbaikan == 2)
                                <button class="btn btn-info" type="button" onclick="perbaiki({{$v->id_perbaikan}})">
                                    <i class="material-icons opacity-10 me-2">add_circle</i>Perbaiki
                                </button>
                            @endif
                        </p>
                        <div class="collapse" id="collapseExample">
                            <div class="card card-body" style="overflow-x: auto; white-space:nowrap; overflow-y: auto">
                                <table class="table table-hover">
                                    <thead>
                                        <tr  class="text-center">
                                            <th>Bagian</th>
                                            <th>Bengkel</th>
                                            <th>Estimasi Biaya</th>
                                            <th>Estimasi Waktu</th>
                                            <th>Tanggal Masuk</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($v->detail_perbaikan as $k => $val)

                                        @php
                                            // Konversi tanggal_masuk menjadi objek DateTime
                                            $tanggalMasuk = new DateTime($val->tanggal_masuk);
                                    
                                            // Tanggal selesai adalah tanggal_masuk ditambah estimasi_selesai dalam satuan hari
                                            $tanggalSelesai = $tanggalMasuk->add(new DateInterval('P' . $val->est_waktu . 'D'));
                                    
                                            // Tanggal hari ini
                                            $hariIni = new DateTime();
                                    
                                            // Tentukan status berdasarkan perbandingan tanggal
                                            if ($tanggalSelesai > $hariIni) {
                                                $status = "Dalam Pengerjaan";
                                            } elseif ($tanggalSelesai->format('Y-m-d') == $hariIni->format('Y-m-d')) {
                                                $status = "Dijadwalkan selesai";
                                            } else {
                                                $status = "Terlambat";
                                            }
                                        @endphp

                                            <tr>
                                                <td>{{$val->bagian}}</td>
                                                <td class="text-center">{{$val->bengkel}}</td>
                                                <td class="text-center">{{$val->est_biaya}}</td>
                                                <td class="text-center">{{$val->est_waktu}} hari</td>
                                                <td class="text-center">{{$val->tanggal_masuk}}</td>
                                                <td class="text-center">{{ $val->node==0 ? $status : "Selesai"}}</td>
                                                <td class="text-center">
                                                    @if ($val->node==0)
                                                        <button class="btn btn-info" onclick="fixDone({{$val->id}})">Selesai</button>
                                                    @else
                                                        <a href="/assets/img/notaBengkel/{{$val->nota_bengkel}}" target="_blank" >Nota</a>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <button class="btn btn-success" onclick="hasilQC({{ $v->state==6 ? $v->id_qc_in : $v->id_qc_out }})">QC1</button>
                        @if ($v->node_perbaikan == 2)
                            <button class="btn btn-info selesai" data-id="{{$v->id}}" data-state="{{$v->state}}" data-mobil="{{$v->merk}} {{$v->type}}" data-nopol="{{$v->nomor_polisi}}">Selesai</button>
                        @endif
                    </div>
                </div>
            </div>
        
        @endforeach
    </div>



    <!-- Modal QC -->
    <div class="modal fade" id="hasilQC" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="hasilQCLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="hasilQCLabel">Hasil QC</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div id="form">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">Dokumen</button>
                            </li>
                            <li class="nav-item" role="presentation">
                            <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">Under Body</button>
                            </li>
                            <li class="nav-item" role="presentation">
                            <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact-tab-pane" type="button" role="tab" aria-controls="contact-tab-pane" aria-selected="false">Interior</button>
                            </li>
                        </ul>
                        

                        <div class="tab-content" id="myTabContent">
                            
                            <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0" style="overflow-x: auto">
                                
                                
                                <div class="border row py-3 mb-3">
                                    <div class="col-md-6">
                                        <table>
                                            <tbody><tr>
                                                <td>STNK</td>
                                                <td class="ps-5" id="stnk"></td>
                                            </tr>
                                            <tr>
                                                <td>BPKB</td>
                                                <td class="ps-5" id="bpkb"></td>
                                            </tr>
                                            <tr>
                                                <td>Faktur</td>
                                                <td class="ps-5" id="faktur"></td>
                                            </tr>
                                            <tr>
                                                <td>Cek Fisik</td>
                                                <td class="ps-5" id="cek_fisik"></td>
                                            </tr>
                                            <tr>
                                                <td>Surat Pelepasan Hak</td>
                                                <td class="ps-5" id="sph"></td>
                                            </tr>
                                        </tbody></table>
                                    </div>
                                    <div class="col-md-6">
                                        <table>
                                            <tbody><tr>
                                                <td>Buku Service</td>
                                                <td class="ps-5" id="buku_service"></td>
                                            </tr>
                                            <tr>
                                                <td>Kwitansi</td>
                                                <td class="ps-5" id="kwitansi_kosong"></td>
                                            </tr>
                                            <tr>
                                                <td>Fotokopi KTP</td>
                                                <td class="ps-5" id="fotokopi_ktp"></td>
                                            </tr>
                                            <tr>
                                                <td>Buku Manual</td>
                                                <td class="ps-5" id="buku_manual"></td>
                                            </tr>
                                            <tr>
                                                <td>Catatan</td>
                                                <td class="ps-5" id="catatan_dokumen"></td>
                                            </tr>
                                        </tbody></table>
                                    </div>
            
                                </div>
            
                                
                                <div class="border row py-3 mb-3">
                                    <div class="col-md-6">
                                        <table>
                                            <tbody><tr>
                                                <td>Kunci Serep</td>
                                                <td class="ps-5" id="kunci_serep"></td>
                                            </tr>
                                            <tr>
                                                <td>Dongkrak</td>
                                                <td class="ps-5" id="dongkrak"></td>
                                            </tr>
                                            <tr>
                                                <td>Kunci Roda</td>
                                                <td class="ps-5" id="kunci_roda"></td>
                                            </tr>
                                            <tr>
                                                <td>Catatan</td>
                                                <td class="ps-5" id="catatan_kelengkapan"></td>
                                            </tr>
                                        </tbody></table>
                                    </div>
                                    <div class="col-md-6">
                                        <table>
                                            <tbody><tr>
                                                <td>Derek</td>
                                                <td class="ps-5" id="derek"></td>
                                            </tr>
                                            <tr>
                                                <td>Ban Serep</td>
                                                <td class="ps-5" id="ban_serep"></td>
                                            </tr>
                                            <tr>
                                                <td>Putaran Dongkrak</td>
                                                <td class="ps-5" id="putaran_dongkrak"></td>
                                            </tr>
                                        </tbody></table>
                                    </div>
            
                                </div>
            
                                
                                <div class="border row py-3 mb-3">
                                    <div class="col-md-6">
                                        <table>
                                            <tbody><tr>
                                                <td>Kaca Depan</td>
                                                <td class="ps-5" id="kaca_depan"></td>
                                            </tr>
                                            <tr>
                                                <td>Pelipit Pintu</td>
                                                <td class="ps-5" id="pelipit_pintu"></td>
                                            </tr>
                                            <tr>
                                                <td>Catatan</td>
                                                <td class="ps-5" id="catatan_kaca_lampu"></td>
                                            </tr>
                                        </tbody></table>
                                    </div>
                                    <div class="col-md-6">
                                        <table>
                                            <tbody><tr>
                                                <td>Daun Wiper Depan</td>
                                                <td class="ps-5" id="daun_wiper_depan"></td>
                                            </tr>
                                            <tr>
                                                <td>Grill Depan</td>
                                                <td class="ps-5" id="grill_depan"></td>
                                            </tr>
                                            <tr>
                                                <td>Daun Wiper Belakang</td>
                                                <td class="ps-5" id="daun_wiper_belakang"></td>
                                            </tr>
                                        </tbody></table>
                                    </div>
            
                                </div>
            
                            </div>
             
                            <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0" style="overflow-x: auto">
            
                                
                                <div class="border row py-3 mb-3">
                                    <h4><u>Ban &amp; Baut Roda</u></h4>
                                    <div class="col-lg-12">
                                        <table class="table table-stripped">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">Sisi</th>
                                                    <th class="text-center">Merk</th>
                                                    <th class="text-center">Ukuran</th>
                                                    <th class="text-center">Velg</th>
                                                    <th class="text-center">Ketebalan</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>Kiri Depan</td>
                                                    <td class="text-center" id="bkid0"></td>
                                                    <td class="text-center" id="bkid1"></td>
                                                    <td class="text-center" id="bkid2"></td>
                                                    <td class="text-center" id="bkid3"></td>
                                                </tr>
                                                <tr>
                                                    <td>Kiri Belakang</td>
                                                    <td class="text-center" id="bkib0"></td>
                                                    <td class="text-center" id="bkib1"></td>
                                                    <td class="text-center" id="bkib2"></td>
                                                    <td class="text-center" id="bkib3"></td>
                                                </tr>
                                                <tr>
                                                    <td>Kanan Depan</td>
                                                    <td class="text-center" id="bkad0"></td>
                                                    <td class="text-center" id="bkad1"></td>
                                                    <td class="text-center" id="bkad2"></td>
                                                    <td class="text-center" id="bkad3"></td>
                                                </tr>
                                                <tr>
                                                    <td>Kanan Belakang</td>
                                                    <td class="text-center" id="bkab0"></td>
                                                    <td class="text-center" id="bkab1"></td>
                                                    <td class="text-center" id="bkab2"></td>
                                                    <td class="text-center" id="bkab3"></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
            
                                    <h4><u>Liner Fender &amp; Talang Lumpur</u></h4>
                                    <div class="col-lg-6">
                                        <table>
                                            <tbody><tr>
                                                <td>Liner Fender Depan Kanan</td>
                                                <td class="ps-5" id="liner_fender_depan_kanan"></td>
                                            </tr>
                                            <tr>
                                                <td>Liner Fender Depan Kiri</td>
                                                <td class="ps-5" id="liner_fender_depan_kiri"></td>
                                            </tr>
                                            <tr>
                                                <td>Liner Fender Belakang Kanan</td>
                                                <td class="ps-5" id="liner_fender_belakang_kanan"></td>
                                            </tr>
                                            <tr>
                                                <td>Liner Fender Belakang Kiri</td>
                                                <td class="ps-5" id="liner_fender_belakang_kiri"></td>
                                            </tr>
                                        </tbody></table>
                                    </div>
                                    <div class="col-lg-6">
                                        <table>
                                            <tbody><tr>
                                                <td>Talang Lumpur Depan Kanan</td>
                                                <td class="ps-5" id="talang_lumpur_depan_kanan"></td>
                                            </tr>
                                            <tr>
                                                <td>Talang Lumpur Depan Kiri</td>
                                                <td class="ps-5" id="talang_lumpur_depan_kiri"></td>
                                            </tr>
                                            <tr>
                                                <td>Talang Lumpur Belakang Kanan</td>
                                                <td class="ps-5" id="talang_lumpur_belakang_kanan"></td>
                                            </tr>
                                            <tr>
                                                <td>Talang Lumpur Belakang Kiri</td>
                                                <td class="ps-5" id="talang_lumpur_belakang_kiri"></td>
                                            </tr>
                                        </tbody></table>
                                    </div>
            
                                    <h4><u>Kolong Mobil</u></h4>
                                    <div class="col-lg-6">
                                        <table>
                                            <tbody><tr>
                                                <td>Bagian Bawah Mesin</td>
                                                <td class="ps-5" id="bagian_bawah_mesin"></td>
                                            </tr>
                                            <tr>
                                                <td>Bagian Sasis Tengah</td>
                                                <td class="ps-5" id="bagian_sasis_tengah"></td>
                                            </tr>
                                            <tr>
                                                <td>Catatan</td>
                                                <td class="ps-5" id="catatan_under_body"></td>
                                            </tr>
                                        </tbody></table>
                                    </div>
                                    <div class="col-lg-6">
                                        <table>
                                            <tbody><tr>
                                                <td>Bagian Sasis Depan</td>
                                                <td class="ps-5" id="bagian_sasis_depan"></td>
                                            </tr>
                                            <tr>
                                                <td>Bagian Sasis Belakang</td>
                                                <td class="ps-5" id="bagian_sasis_belakang"></td>
                                            </tr>
                                        </tbody></table>
                                    </div>
            
                                </div>
            
                                
                                <div class="border row py-3 mb-3">
            
                                    
                                    <h4><u>Oli &amp; Cairan</u></h4>
                                    <div class="col-lg-6">
                                        <table>
                                            <tbody><tr>
                                                <td>Oli Mesin</td>
                                                <td class="ps-5" id="oli_mesin"></td>
                                            </tr>
                                            <tr>
                                                <td>Minyak Rem</td>
                                                <td class="ps-5" id="minyak_rem"></td>
                                            </tr>
                                            <tr>
                                                <td>Air Radiator</td>
                                                <td class="ps-5" id="air_radiator"></td>
                                            </tr>
                                        </tbody></table>
                                    </div>
                                    <div class="col-lg-6">
                                        <table>
                                            <tbody><tr>
                                                <td>Oli Transmisi AT</td>
                                                <td class="ps-5" id="oli_transmisi_at"></td>
                                            </tr>
                                            <tr>
                                                <td>Minyak Power Steering</td>
                                                <td class="ps-5" id="minyak_power_steering"></td>
                                            </tr>
                                            <tr>
                                                <td>Air Wiper</td>
                                                <td class="ps-5" id="air_wiper"></td>
                                            </tr>
                                        </tbody></table>
                                    </div>
            
                                    
                                    <h4><u>Ruang Mesin</u></h4>
                                    <div class="col-lg-6">
                                        <table>
                                            <tbody><tr>
                                                <td>Suara Mesin Normal</td>
                                                <td class="ps-5" id="suara_mesin_normal"></td>
                                            </tr>
                                            <tr>
                                                <td>Belt</td>
                                                <td class="ps-5" id="belt"></td>
                                            </tr>
                                            <tr>
                                                <td>Accu</td>
                                                <td class="ps-5" id="accu"></td>
                                            </tr>
                                            <tr>
                                                <td>Radiator</td>
                                                <td class="ps-5" id="radiator"></td>
                                            </tr>
                                            <tr>
                                                <td>Catatan</td>
                                                <td class="ps-5" id="catatan_mesin"></td>
                                            </tr>
                                        </tbody></table>
                                    </div>
                                    <div class="col-lg-6">
                                        <table>
                                            <tbody><tr>
                                                <td>Mesin Bebas Rembes</td>
                                                <td class="ps-5" id="mesin_bebas_rembes"></td>
                                            </tr>
                                            <tr>
                                                <td>Selang-Selang</td>
                                                <td class="ps-5" id="selang_selang"></td>
                                            </tr>
                                            <tr>
                                                <td>Asap dan Tutup Oli</td>
                                                <td class="ps-5" id="asap_dan_tutup_oli"></td>
                                            </tr>
                                            <tr>
                                                <td>Kompresor AC</td>
                                                <td class="ps-5" id="kompresor_ac"></td>
                                            </tr>
                                        </tbody></table>
                                    </div>
            
                                </div>
                            </div>
                            
                            <div class="tab-pane fade" id="contact-tab-pane" role="tabpanel" aria-labelledby="contact-tab" tabindex="0" style="overflow-x: auto">
                                <div class="border row py-3 mb-3">
            
                                    
                                    <h4><u>Indikator Sensor</u></h4>
                                    <div class="col-lg-6">
                                        <table>
                                            <tbody><tr>
                                                <td>Engine Check</td>
                                                <td class="ps-5" id="sensor_engine_check"></td>
                                            </tr>
                                            <tr>
                                                <td>ABS</td>
                                                <td class="ps-5" id="sensor_abs"></td>
                                            </tr>
                                            <tr>
                                                <td>Rem Tangan</td>
                                                <td class="ps-5" id="sensor_rem_tangan"></td>
                                            </tr>
                                            <tr>
                                                <td>Tekanan Oli</td>
                                                <td class="ps-5" id="sensor_tekanan_oli"></td>
                                            </tr>
                                            <tr>
                                                <td>Accu</td>
                                                <td class="ps-5" id="sensor_accu"></td>
                                            </tr>
                                            <tr>
                                                <td>Catatan</td>
                                                <td class="ps-5" id="catatan_sensor"></td>
                                            </tr>
                                        </tbody></table>
                                    </div>
                                    <div class="col-lg-6">
                                        <table>
                                            <tbody><tr>
                                                <td>VSA</td>
                                                <td class="ps-5" id="sensor_vsa"></td>
                                            </tr>
                                            <tr>
                                                <td>Airbag</td>
                                                <td class="ps-5" id="sensor_airbag"></td>
                                            </tr>
                                            <tr>
                                                <td>Seat Belt</td>
                                                <td class="ps-5" id="sensor_seat_belt"></td>
                                            </tr>
                                            <tr>
                                                <td>Suhu Mesin</td>
                                                <td class="ps-5" id="sensor_suhu_mesin"></td>
                                            </tr>
                                            <tr>
                                                <td>Electric Power Steering</td>
                                                <td class="ps-5" id="sensor_electric_power_steering"></td>
                                            </tr>
                                            <tr>
                                                <td>Door Lock</td>
                                                <td class="ps-5" id="sensor_door_lock"></td>
                                            </tr>
                                        </tbody></table>
                                    </div>
            
                                    
                                    <h4><u>Bagian Depan</u></h4>
                                    <div class="col-lg-6">
                                        <table>
                                            <tbody><tr>
                                                <td>Kondisi Stir</td>
                                                <td class="ps-5" id="kondisi_stir"></td>
                                            </tr>
                                            <tr>
                                                <td>Tombol Stir</td>
                                                <td class="ps-5" id="tombol_stir"></td>
                                            </tr>
                                            <tr>
                                                <td>Lampu Depan</td>
                                                <td class="ps-5" id="lampu_depan"></td>
                                            </tr>
                                            <tr>
                                                <td>Lampu Atret</td>
                                                <td class="ps-5" id="lampu_atret"></td>
                                            </tr>
                                            <tr>
                                                <td>Konsol Box</td>
                                                <td class="ps-5" id="konsol_box"></td>
                                            </tr>
                                            <tr>
                                                <td>Spion Kiri</td>
                                                <td class="ps-5" id="spion_kiri"></td>
                                            </tr>
                                            <tr>
                                                <td>Rem Tangan</td>
                                                <td class="ps-5" id="rem_tangan"></td>
                                            </tr>
                                            <tr>
                                                <td>Power Window Supir</td>
                                                <td class="ps-5" id="power_window_supir"></td>
                                            </tr>
                                            <tr>
                                                <td>Power Window Belakang Kanan</td>
                                                <td class="ps-5" id="power_window_belakang_kanan"></td>
                                            </tr>
                                            <tr>
                                                <td>Pembuka Kap Mesin</td>
                                                <td class="ps-5" id="pembuka_kap_mesin"></td>
                                            </tr>
                                            <tr>
                                                <td>Sabuk Pengaman Supir</td>
                                                <td class="ps-5" id="sabuk_pengaman_supir"></td>
                                            </tr>
                                            <tr>
                                                <td>Karpet Keping Supir</td>
                                                <td class="ps-5" id="karpet_keping_supir"></td>
                                            </tr>
                                            <tr>
                                                <td>Spion Tengah</td>
                                                <td class="ps-5" id="spion_tengah"></td>
                                            </tr>
                                            <tr>
                                                <td>Lampu Plafon Depan</td>
                                                <td class="ps-5" id="lampu_plafon_depan"></td>
                                            </tr>
                                            <tr>
                                                <td>Catatan</td>
                                                <td class="ps-5" id="catatan_interior_depan"></td>
                                            </tr>
                                        </tbody></table>
                                    </div>
                                    <div class="col-lg-6">
                                        <table>
                                            <tbody><tr>
                                                <td>Klakson</td>
                                                <td class="ps-5" id="klakson"></td>
                                            </tr>
                                            <tr>
                                                <td>Lampu Sen Spion</td>
                                                <td class="ps-5" id="lampu_sen_spion"></td>
                                            </tr>
                                            <tr>
                                                <td>Lampu Hazzard</td>
                                                <td class="ps-5" id="lampu_hazzard"></td>
                                            </tr>
                                            <tr>
                                                <td>Handle Pintu</td>
                                                <td class="ps-5" id="handle_pintu"></td>
                                            </tr>
                                            <tr>
                                                <td>Spion Kanan</td>
                                                <td class="ps-5" id="spion_kanan"></td>
                                            </tr>
                                            <tr>
                                                <td>Sun Visor</td>
                                                <td class="ps-5" id="sun_visor"></td>
                                            </tr>
                                            <tr>
                                                <td>Power Window Penumpang</td>
                                                <td class="ps-5" id="power_window_penumpang"></td>
                                            </tr>
                                            <tr>
                                                <td>Power Window Belakang Kiri</td>
                                                <td class="ps-5" id="power_window_belakang_kiri"></td>
                                            </tr>
                                            <tr>
                                                <td>Pembuka Tangki Bensin</td>
                                                <td class="ps-5" id="pembuka_tangki_bensin"></td>
                                            </tr>
                                            <tr>
                                                <td>Sabuk Pengaman Penumpang</td>
                                                <td class="ps-5" id="sabuk_pengaman_penumpang"></td>
                                            </tr>
                                            <tr>
                                                <td>Karpet Keping Penumpang</td>
                                                <td class="ps-5" id="karpet_keping_penumpang"></td>
                                            </tr>
                                            <tr>
                                                <td>Audio &amp; Speaker</td>
                                                <td class="ps-5" id="audio_speaker"></td>
                                            </tr>
                                        </tbody></table>
                                    </div>
            
                                    
                                    <h4><u>Bagian Belakang</u></h4>
                                    <div class="col-lg-6">
                                        <table>
                                            <tbody><tr>
                                                <td>Fungsi AC Belakang</td>
                                                <td class="ps-5" id="fungsi_ac_belakang"></td>
                                            </tr>
                                            <tr>
                                                <td>Fungsi Kursi Baris Ke-2</td>
                                                <td class="ps-5" id="fungsi_kursi_baris_kedua"></td>
                                            </tr>
                                            <tr>
                                                <td>Lampu Plafon Belakang</td>
                                                <td class="ps-5" id="lampu_plafon_belakang"></td>
                                            </tr>
                                            <tr>
                                                <td>Catatan</td>
                                                <td class="ps-5" id="catatan_interior_belakang"></td>
                                            </tr>
                                        </tbody></table>
                                    </div>
                                    <div class="col-lg-6">
                                        <table>
                                            <tbody><tr>
                                                <td>Jok Baris Belakang</td>
                                                <td class="ps-5" id="jok_baris_belakang"></td>
                                            </tr>
                                            <tr>
                                                <td>Fungsi Kursi Baris Ke-3</td>
                                                <td class="ps-5" id="fungsi_kursi_baris_ketiga"></td>
                                            </tr>
                                            <tr>
                                                <td>Karpet Keping Baris ke</td>
                                                <td class="ps-5" id="karpet_keping_baris_ke"></td>
                                            </tr>
                                        </tbody></table>
                                    </div>
            
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Modal Body -->
    <div class="modal fade" id="addFix" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitleId">Form Perbaikan</h5>
                </div>
                <div class="modal-body">
                    <form id="formFix">
                        <input id="iId" name="id_perbaikan" class="d-none" />
                        <div class="mb-3">
                            <label for="iBagian">Bagian yang diperbaiki</label>
                            <input type="text" class="form-control border" id="iBagian" name="bagian">
                        </div>
                        <div class="mb-3">
                            <label for="iJenis">Jenis</label>
                            <select class="form-select border" id="iJenis">
                                <option value="" selected disabled>=== Pilih Jenis ===</option>
                                @foreach ($jenis_bengkel as $i => $v)
                                    <option value="{{$v->id}}">{{$v->nama}}</option>
                                @endforeach
                            </select>
                        </div>                    
                        <div class="mb-3">
                            <label for="iBengkel">Bengkel</label>
                            <select class="form-select border" name="id_bengkel" id="iBengkel" disabled>
                                <option value="" selected disabled>=== Pilih Jenis ===</option>
                            </select>
                        </div>                    
                        <div class="mb-3">
                            <label for="iWaktu">Estimasi Perbaikan (hari)</label>
                            <input type="text" class="form-control border" name="est_waktu" id="iWaktu">
                        </div>
                        <div class="mb-3">
                            <label for="iBiaya">Estimasi Biaya</label>
                            <input type="text" class="form-control border harga" name="est_biaya" id="iBiaya">
                        </div>
                        <div class="mb-3">
                            <label for="tanggal_masuk">Tanggal Masuk</label>
                            <input type="date" class="form-control border" name="tanggal_masuk" id="iTM">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="submitPerbaikan()">Save</button>
                </div>
            </div>
        </div>
    </div>

    
    <!-- Modal Selesaikan Perbaikan di detail perbaikan -->
    <div class="modal fade" id="modalFixDone" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitleId">Nota Bengkel</h5>
                </div>
                <div class="modal-body">
                    <form id="doneFixForm">
                        <input type="text" id="temp_id" name="id" class="d-none">
                        <div>
                            <img src="{{asset('assets/img/upload.svg')}}" data-stock="{{asset('assets/img/upload.svg')}}" id="imgEle" class="w-80" alt="" srcset="">
                        </div>
                        <span id="buktiAntarLabel">Nota Bengkel</span>
                        <input type="file" name="foto" id="foto" accept="image/*" hidden/>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-primary" onclick="BengkelSelesai()">Selesai</button>
                </div>
            </div>
        </div>
    </div>
    


    
    <!-- Modal Selesaikan Perbaikan Mobil -->
    <div class="modal fade" id="modalConfirm" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalConfirm" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitleId">Selesaikan Perbaikan <span id="nama_mobil"></span></h5>
                </div>
                <div class="modal-body">
                    <form id="submitDone">
                        <input type="text" id="id_confirm" name="id" class="d-none">
                        <input type="text" id="state_confirm" name="state" class="d-none">
                        <span id="text_confirm" class="text-wrap"></span>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-primary" onclick="SelesaiPerbaikan()">Lanjutkan</button>
                </div>
            </div>
        </div>
    </div>
    

    <div class="d-none">
        <form id="goQC" action="{{ route('periksa2') }}" method="POST">
            @csrf
            <input type="text" name="id" id="id_qc_go"/>
        </form>
    </div>


@endsection


@section('script')

    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.8/ScrollMagic.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.9.1/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.8/plugins/animation.gsap.min.js"></script>
    <script src="{{asset('assets/vendor/jquery/jquery.number.min.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.7/dist/loadingoverlay.min.js"></script>

    <script>
        $(function () {

            $.ajaxSetup({
                headers:
                { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
            });

            $('#table1').DataTable();

        });

        $('.harga').on('keyup', function () {
            $('.harga').number(true,0);
        });

        $('#iJenis').on('change',() => {
            $.LoadingOverlay('show');
            var id_jenis = $('#iJenis').find(':selected').val();

            $.ajax({
                type: "GET",
                url: "/bengkel/get",
                data: {id_jenis:id_jenis},
                dataType: "json",
                success: function (response) {
                    if (response.status=='success') {

                        $('#iBengkel').prop('disabled',false);
                        $('#iBengkel').empty();
                        $('#iBengkel').append('<option value="" selected disabled>=== Pilih Bengkel ===</option>');
                        $.each(response.res, function (i, v) { 
                            $('#iBengkel').append('<option value="'+v.id+'">'+v.nama+'</option>');
                        });

                        $.LoadingOverlay('hide');
                    }
                }
            });

        });

        function hasilQC(qc) {
            $.LoadingOverlay("show");
            console.log(qc);

            $.ajax({
                type: "GET",
                url: "/qc/res",
                data: {id_qc:qc},
                dataType: "json",
                success: function (response) {
                    if (response.status=="success") {
                        bkid = response.res.detail.ban_kiri_depan.split("|");
                        bkib = response.res.detail.ban_kiri_belakang.split("|");
                        bkad = response.res.detail.ban_kanan_depan.split("|");
                        bkab = response.res.detail.ban_kanan_belakang.split("|");

                        delete response.res.detail["id"];
                        delete response.res.detail["id_qc"];
                        delete response.res.detail["ban_kiri_depan"];
                        delete response.res.detail["ban_kiri_belakang"];
                        delete response.res.detail["ban_kanan_depan"];
                        delete response.res.detail["ban_kanan_belakang"];

                        $.each(bkid, function (i, v) { 
                            $('#bkid'+i).html('<span>'+v+'</span');
                        });

                        $.each(bkib, function (i, v) { 
                            $('#bkib'+i).html('<span>'+v+'</span');
                        });

                        $.each(bkad, function (i, v) { 
                            $('#bkad'+i).html('<span>'+v+'</span');
                        });

                        $.each(bkab, function (i, v) { 
                            $('#bkab'+i).html('<span>'+v+'</span');
                        });
                            
                        $.each(response.res.detail, function (i, v) { 
                            if (v == 0) $('#'+i).html('<i class="material-icons opacity-10" style="color: red">close</i>');
                            else if (v == 1) $('#'+i).html('<i class="material-icons opacity-10" style="color: green">check</i>');
                            else if (v == null) $('#'+i).html('');
                            else $('#'+i).html('<span>'+v+'</span>');
                        });

                        $.LoadingOverlay("hide");
                        $('#hasilQC').modal('show');
                    } else {
                        console.log(response.res);
                    }
                }
            });
        }

        function perbaiki(id) {
            $('#iId').val(id);

            $('#addFix').modal('show');
        }

        function submitPerbaikan() {

            var formDataArray = $('#formFix').serializeArray();

            var id_bengkel = $('#iBengkel').val();

            if (id_bengkel=="" || id_bengkel==null) {
                toastr.error('Lengkapi Semua data!');
                return false;
            }

            var data = {};
            $.each(formDataArray, function() {
                data[this.name] = this.value;

                if (this.value=="") {
                    toastr.error('Lengkapi Semua data!');

                    return false;
                }
            });

            $.ajax({
                type: "POST",
                url: "/repair/add",
                data: data,
                success: function (response) {
                    if (response.status=='success') {
                        $.LoadingOverlay('hide');
                        toastr.success('Data Berhasil Diinput!');
                        location.reload();
                    } else {
                        $.LoadingOverlay('hide');
                        toastr.error('Terjadi Kesalahan!');
                        console.log(response.res)
                    }
                },
                error: function (XMLHttpRequest, textStatus, errorThrown) {
                    toastr.error('Terjadi Kesalahan!');
                    console.log(errorThrown);
                }
            });

        }

        function fixDone(x) {
            $('#modalFixDone').modal('show');
            $('#temp_id').val(x);
        }

        $('#modalFixDone').on('hidden.bs.modal', function () {
            var a = $("#imgEle").data('stock');

            $("#imgEle").attr("src", a);

            $('#buktiAntarLabel').removeClass('d-none');
            $('#btnFinish').prop('disabled',true);
        })

        $('#imgEle').on('click', () => {
            $('#foto').trigger('click');
        });

        $('#foto').change( (e) => { 

            var file = e.target.files[0];
            var reader = new FileReader();

            reader.onload = function(e) {
                $("#imgEle").attr("src", e.target.result);
            };

            reader.readAsDataURL(file);

            $('#buktiAntarLabel').addClass('d-none');

            $('#btnFinish').prop('disabled',false);
        });

        function BengkelSelesai() {
            $.LoadingOverlay("show");

            var formData = new FormData($("#doneFixForm")[0]); // Menggunakan FormData untuk mengumpulkan data form termasuk file

            $.ajax({
                type: "POST",
                url: "/bengkel/selesai",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function(response) {
                    console.log(response);
                    $.LoadingOverlay("hide");
                    location.reload()
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        }

        $('.selesai').on('click', function(e) {
            var id = $(this).data('id');
            var state = $(this).data('state');
            var mobil = $(this).data('mobil');
            var nopol = $(this).data('nopol');

            $('#id_confirm').val(id);   
            $('#state_confirm').val(state);   

            $('#nama_mobil').text(mobil+" - "+nopol)

            if (state == 6) 
                $('#text_confirm').text('Sebelum mobil '+mobil+' ditandai untuk siap dijual, QC akan dilakukan 1x lagi. Lanjutkan?');
            else
                $('#text_confirm').text('Sebelum mobil '+mobil+' ditandai untuk siap diserahkan ke pembeli, QC akan dilakukan 1x lagi. Lanjutkan?');
            

            $('#modalConfirm').modal('show');

            console.log(id);
        });

        function SelesaiPerbaikan(x) {
            $.LoadingOverlay('show');
            var sa = $('#submitDone').serializeArray();
            var data = {};

            $.each(sa, function (i, v) { 
                 data[v.name] = v.value;
            });

            $.ajax({
                type: "POST",
                url: "/repair/done",
                data: data,
                success: function (response) {
                    $('#id_qc_go').val(response.res);
                    $.LoadingOverlay('hide'); 
                    toastr.success('QC akan segera dimulai!');
                    $('#goQC').submit();           
                },
                error (response) {
                    console.log(response);
                    $.LoadingOverlay('hide');
                    
                    
                }
                
            });
        }


    </script>

@endsection