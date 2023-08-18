@php
    $status = [
        "",
        "",
        "QC Masuk",
        "",
        "Tidak Siap Jual",
        "Siap Jual",
        "Bengkel",
        "QC Keluar",
        "",
        "Proses QC Keluar"
    ];
@endphp

@section('style')

@endsection


@section('content')


    <div class="p-3 md-col-12">
        <table class="table table-stripped" id="tableMobil">
            <thead>
                <tr class="text-center">
                    <th>Type</th>
                    <th>Merk</th>
                    <th>Tahun</th>
                    <th>Nomor Polisi</th>
                    <th>Status</th>
                    <th>Bottom</th>
                    <th>Harga Jual</th>
                    <th>Tindakan</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($mobil as $k => $v)
                    <tr>
                        <td>{{$v->type}}</td>
                        <td class="text-center">{{$v->merk}}</td>
                        <td class="text-center">{{$v->tahun}}</td>
                        <td class="text-center">{{$v->nomor_polisi}}</td>
                        <td class="text-center">{{$status[$v->state]}}</td>
                        @if ($v->harga_bottom==null)
                            <td class="text-center"><a href="#" class="bottom" data-id="{{$v->id}}">(Belum ditentukan)</a></td>
                        @else
                            <td class="text-center">Rp<span class="harga">{{$v->harga_bottom}}</span></td>
                        @endif
                        @if ($v->harga_jual==null)
                            <td class="text-center"><a href="#" class="hJual" data-id="{{$v->id}}">(Belum ditentukan)</a></td>
                        @else
                            <td class="text-center">Rp<span class="harga">{{$v->harga_jual}}</span></td>
                        @endif
                        <td class="text-center">
                            <button class="btn btn-info" onclick="getDoc({{$v->id}})">Dokumen</button>
                            <button class="btn btn-warning" onclick="hasilQC({{$v->id_qc_in}})">QC</button>
                            <button class="btn btn-success" onclick="jual('{{$v->id}}','{{$v->warna}}','{{$v->transmisi}}','{{$v->tahun}}','{{$v->harga_jual}}','{{$v->harga_bottom}}')">Jual</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
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

    <!-- Modal Dokumen-->
    <div class="modal fade" id="documents" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="documentsLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="documentsLabel">Foto Dokumen</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="text-center">KTP a/n BPKB</th>
                                <th class="text-center">BPKB</th>
                                <th class="text-center">STNK</th>
                                <th class="text-center">PKB</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-center" id="ktp_an_bpkb"></td>
                                <td class="text-center" id="photo_bpkb"></td>
                                <td class="text-center" id="photo_stnk"></td>
                                <td class="text-center" id="photo_pkb"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Jual-->
    <div class="modal fade" id="modalJual" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalJualLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modalJualLabel">Detail Mobil</h1>
                </div>
                <div class="modal-body">

                    
                    {{-- Form pilih mobil --}}
                    <div id="step1" class="step">

                        <div class="col-md-12">
                        <form id="formDetailBarang">
                            <input type="text" id="iType" class="d-none">
                            <input type="text" id="iTypeHarga" class="d-none">
                            <div class="mb-3 p-3 border border-3 -circle" id="divHargaJ">
                                <table class="table">
                                    <tr>
                                    <td>Warna</td>
                                    <td>:</td>
                                    <td><span id="warna"></span></td>
                                    </tr>
                                    <tr>
                                    <td>Transmisi</td>
                                    <td>:</td>
                                    <td><span class="text-uppercase" id="transmisi"></span></td>
                                    </tr>
                                    <tr>
                                    <td>Tahun</td>
                                    <td>:</td>
                                    <td><span id="tahun"></span></td>
                                    </tr>
                                    <tr>
                                    <td>Harga Jual</td>
                                    <td>:</td>
                                    <td>Rp<span id="harga"></span></td>
                                    </tr>
                                </table>
                            </div>
                            <div class="mb-3 form-check">
                                <input type="checkbox" class="form-check-input" name="nego" id="Nego" onchange="toggleNego()">
                                <label class="form-check-label" for="Nego">Nego</label>
                            </div>
                            <div class="mb-3 d-none" id="divNego">
                                <input type="number" class="form-control border" id="sBottom" hidden/>
                                <table class="table">
                                    <tr>
                                    <td>Harga Bottom</td>
                                    <td>:</td>
                                    <td>Rp<span id="bottom"></span></td>
                                    </tr>
                                </table>
                            </div>
                            <div class="mb-3" id="divHarga" style="display: none">
                                <label for="iHarga" class="form-label">Harga Nego</label>
                                <input type="text" name="hargaNego" class="form-control border" id="iHarga" >
                            </div>
                            
                        </form>
                        </div>
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-primary" id="nextButton" onclick="nextStep()">Next</button>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal Jual 2-->
    <div class="modal fade" id="modalJual2" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalJualLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modalJualLabel">Data Pembeli</h1>
                </div>
                <div class="modal-body">
                    
                    {{-- Form data pembeli --}}
                    <div id="step2" class="step" >
                        <form id="formDataPembeli">
                            <div class="mb-3 form-check">
                                <input type="checkbox" class="form-check-input" id="customerLamaCheck" onchange="toggleCustomerLama()">
                                <label class="form-check-label" for="customerLamaCheck">Customer Lama</label>
                            </div>
                            <div id="customerBaru">
                                <div class="mb-3">
                                <label for="namaPembeli" class="form-label">Nama Pembeli:</label>
                                <input type="text" class="form-control border" id="namaPembeli" required>
                                </div>
                                <div class="mb-3">
                                <label for="alamatPembeli" class="form-label">Alamat Pembeli:</label>
                                <input type="text" class="form-control border" id="alamatPembeli" required>
                                </div>
                                <div class="mb-3">
                                <label for="kontakPembeli" class="form-label">Nomor Telpon Pembeli:</label>
                                <input type="text" class="form-control border" id="kontakPembeli" required>
                                </div>
                            </div>
                            <div id="customerLama" style="display: none;">
                                <div class="mb-3">
                                <label for="customerLamaSelect" class="form-label">Customer Lama:</label>
                                <select class="form-select" id="customerLamaSelect">
                                    <option selected disabled>Pilih Customer Lama</option>
                                    @foreach ($customer as $k => $v)
                                    <option value="{{$v->id}}">{{$v->nama}}</option>              
                                    @endforeach
                                </select>
                                </div>
                            </div>
                        
                        </form>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="previousStep()">Kembali</button>
                    <button type="button" class="btn btn-primary" id="submitButton" disabled onclick="submitForm()">Submit</button>
                </div>
            </div>
        </div>
    </div>


    {{-- Modal menuju SPK --}}
    <div class="modal fade" id="modal1" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal1Label" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modal1Label">Lanjutkan ke SPK</h1>
                    <button type="button" class="btn-close" data-bs-target="#modalJual2" data-bs-toggle="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <span>Lanjutkan proses untuk membuat <b data-bs-toggle="tooltip" data-bs-placement="top" title="Surat Pemesanan Kendaraan">SPK</b>?</span>
                </div>
                <form action="{{route('spkIn')}}" method="POST" id="formSPK" class="d-none">
                    @csrf
                    <input type="text" name="id_spk" id="idSPK"/>
                    <input type="text" name="id_jual" id="idJual"/>
                </form>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-target="#modalJual2" data-bs-toggle="modal">Batal</button>
                    <button type="button" class="btn btn-primary" onclick="goSPK()">Proses</button>
                </div>
            </div>
        </div>
    </div>
  
    {{-- Modal menuju konfirmasi manager --}}
    <div class="modal fade" id="modal2" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal2Label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="modal2Label">Harga Nego dibawah Harga Bottom</h1>
            <button type="button" class="btn-close" data-bs-target="#modalJual2" data-bs-toggle="modal"aria-label="Close"></button>
        </div>
        <div class="modal-body">
            Harga nego akan diajukan kepada <b>Manager</b>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-target="#modalJual2" data-bs-toggle="modal">Batal</button>
            <button type="button" class="btn btn-primary" onclick="askBottom()">Proses</button>
        </div>
        </div>
    </div>
    </div>


@endsection




@section('script')


    <script src="{{asset('assets/js/terbilang.min.js')}}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/locale/id.min.js"></script>
    <script src="{{asset('assets/js/print.js')}}"></script>

    <script src="{{asset('assets/vendor/jquery/jquery.number.min.js')}}"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.8/ScrollMagic.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.9.1/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.8/plugins/animation.gsap.min.js"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.7/dist/loadingoverlay.min.js"></script>




    <script>

        $(function () {

            $.ajaxSetup({
                headers:
                { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
            });


            $('#tableMobil').DataTable(); 
            $('.harga').number(true,0);
            $('#iBottom').number(true,0);
            $('#iHjual').number(true,0);
            $('#iHarga').number(true,0);
            

        });

        $('.iHarga, #iBottom, iHjual').on('keyup', function (e) {
            $(this).number(true,0);
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
                        $.LoadingOverlay("hide");
                        console.log(response.res);
                    }
                }
            });
        }

        function getDoc(x) {
            $.LoadingOverlay("show");
            const id = x;

            $.ajax({
                type: "GET",
                url: "/dokumen/get",
                data: {id:id},
                dataType: "json",
                success: function (response) {
                    if (response.status=="success") {
                        console.log(response.res);

                        $.each(response.res, function (i, v) { 
                            $('#'+i).empty();0
                            if (v !== null) $('#'+i).append('<a href="assets/img/'+i+'/'+v+'" target="_blank"><i class="material-icons opacity-10">image</i></a>');
                            else $('#'+i).append('<span><i class="material-icons opacity-10" style="color:red">close</i></span>')
                            $.LoadingOverlay("hide");
                        });

                        $('#documents').modal('show');
                    } else {
                        $.LoadingOverlay("hide");
                        console.log(response.res);
                    }
                }
            });
        }

        function jual(a,b,c,d,e,f) {
            $('#iType').val(a);

            $('#iTypeHarga').val(e);

            $('#harga').text(e);

            $('#warna').text(b);

            $('#transmisi').text(c);

            $('#tahun').text(d);

            $('#bottom').text(f);

            $('#sBottom').val(f);

            $('#harga').number(true,0);

            $('#bottom').number(true,0);

            $('#modalJual').modal('show');
        }


        // =================================================== Jual Mobil ========================================
            var BellowBottom = false;

            // ========================== Listener ==============================


            $("#namaPembeli, #alamatPembeli, #kontakPembeli").on("input", function() {
                validateFormDataPembeli();
            });

            $("#customerLamaSelect").on("change", function() {
                validateFormDataPembeli();
            });


            $('#iHarga').keyup(function () {
                const hargaNego = BigInt($('#iHarga').val()); 

                const bottom = BigInt($('#sBottom').val());

                if (hargaNego < bottom) {
                    BellowBottom = true;
                } else {
                    BellowBottom = false;
                }

                validateFormDetailBarang();
            });



            // =========================== Function ================================
            function toggleCustomerLama() {
                if ($("#customerLamaCheck").is(":checked")) {
                    $("#customerBaru").hide();
                    $("#customerLama").show();
                    $("#submitButton").prop("disabled", true);
                    $("#namaPembeli").val("");
                    $("#alamatPembeli").val("");
                } else {
                    $("#customerLama").hide();
                    $("#customerBaru").show();
                    $("#submitButton").prop("disabled", true);
                    $('#customerLamaSelect>option:eq(0)').prop('selected', true);
                }
            }

            function toggleNego() {
                if ($("#Nego").is(":checked")) {
                    $("#divHarga").show();
                    $("#nextButton").prop("disabled", true);
                    $("#divNego").removeClass('d-none');
                } else {
                    $("#divHarga").hide();
                    validateFormDetailBarang();
                    $("#divNego").addClass('d-none');
                }
            }

            function validateFormDetailBarang() {


                if ($("#Nego").is(":checked")) {
                    if ($('#iHarga').val()) {
                        $("#nextButton").prop("disabled", false);
                    } else {
                        $("#nextButton").prop("disabled", true);
                    }
                } else {
                    $("#nextButton").prop("disabled", false);
                }
                    

            }

            function validateFormDataPembeli() {
                if ($("#customerLamaCheck").is(":checked")) {
                    var customerLamaSelect = $("#customerLamaSelect").val();

                    if (customerLamaSelect) {
                    $("#submitButton").prop("disabled", false);
                    } else {
                    $("#submitButton").prop("disabled", true);
                    }
                } else {
                    var namaPembeli = $("#namaPembeli").val();
                    var alamatPembeli = $("#alamatPembeli").val();
                    var kontakPembeli = $("#kontakPembeli").val();

                    if (namaPembeli && alamatPembeli && kontakPembeli) {
                    $("#submitButton").prop("disabled", false);
                    } else {
                    $("#submitButton").prop("disabled", true);
                    }
                }
            }

            function nextStep() {
                $("#modalJual").modal('toggle');
                $("#modalJual2").modal('toggle');
            }

            function previousStep() {
                $("#modalJual2").modal('toggle');
                $("#modalJual").modal('toggle');
            }

            function submitForm() {

                if (BellowBottom) {
                    $('#modalJual2').modal('toggle');
                    $('#modal2').modal('toggle');
                } else {
                    $('#modalJual2').modal('toggle');
                    $('#modal1').modal('toggle');
                }

            }

            function goSPK() {
                var data = {};
                data.id_mobil = $("#iType").val();
                data.nego = $("#iHarga").val();
                data.harga = $("#iTypeHarga").val();

                if ($("#customerLamaCheck").is(":checked")) {
                    data.id_customer = $("#customerLamaSelect").val();
                } else {
                    data.namaCustomer = $("#namaPembeli").val();
                    data.alamatCustomer = $("#alamatPembeli").val();
                    data.kontakCustomer = $("#kontakPembeli").val();
                }

                $.ajax({
                    type: "POST",
                    url: "/jual/upperBottom",
                    data: data,
                    dataType: "json",
                    success: function (response) {
                    if (response.status=="success") {
                        toastr.success(response.res);
                        $('#idSPK').val(response.res.id_spk);
                        $('#idJual').val(response.res.id_jual);
                        $('#formSPK').submit();
                        
                    } else {
                        toastr.error(response.res);
                        console.log(response.res);
                    }
                    }
                });

            }

            function askBottom() {
                var data = {};
                data.id_mobil = $("#iType").val();
                data.nego = $("#iHarga").val();
                data.harga = $("#iType").find(':selected').data('harga');

                if ($("#customerLamaCheck").is(":checked")) {
                    data.id_customer = $("#customerLamaSelect").val();
                } else {
                    data.namaCustomer = $("#namaPembeli").val();
                    data.alamatCustomer = $("#alamatPembeli").val();
                    data.kontakCustomer = $("#kontakPembeli").val();
                }

                $.ajax({
                    type: "POST",
                    url: "/jual/bellowBottom",
                    data: data,
                    dataType: "json",
                    success: function (response) {
                    if (response.status) {
                        toastr.success("Transaksi telah diajukan!");
                        $(".modal").modal("hide");
                    } else {
                        toastr.error(response.res);
                    }
                    }
                });
            }

        // ===========================================================================================

    </script>
    
@endsection