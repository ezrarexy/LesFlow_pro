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
                    <th>Harga Beli</th>
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
                        <td class="text-center">Rp<span class="harga">{{$v->harga_beli}}</span></td>
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
                            <button class="btn btn-success" onclick="hasilQC({{$v->id_qc_in}})">QC</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    
    
    <!-- Modal bottom -->
    <div class="modal fade" id="bottomSet" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="bottomSetLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h1 class="modal-title fs-5" id="bottomSetLabel">Set Harga Bottom</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="setBottom">
                    <input type="text" hidden id="id_mobil" />
                    <div class="mb-3">
                        <label for="iBottom">Harga Bottom</label>
                        <input type="text" class="form-control border" id="iBottom" class="harga" placeholder="Rp" />
                    </div>
                </form>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            <button type="button" class="btn btn-primary" onclick="submitBottom()" id="submitBottom">Simpan</button>
            </div>
        </div>
        </div>
    </div>


    <!-- Modal Harga Jual -->
    <div class="modal fade" id="hJualSet" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="hJualSetLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h1 class="modal-title fs-5" id="hJualSetLabel">Set Harga Jual</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="setHjual">
                    <input type="text" hidden id="id_mobil2" />
                    <div class="mb-3">
                        <label for="iHjual">Harga Jual</label>
                        <input type="text" class="form-control border" id="iHjual" class="harga" placeholder="Rp" />
                    </div>
                </form>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            <button type="button" class="btn btn-primary" onclick="submitHjual()" id="submitHjual">Simpan</button>
            </div>
        </div>
        </div>
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


    <!-- Modal -->
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

        });

        $('#iBottom, iHjual').on('keyup', function (e) {
            $(this).number(true,0);
        });

        $(document).on('click', '[data-toggle="lightbox"]', function(event) {
            event.preventDefault();
            $(this).ekkoLightbox();
        });

        $('.bottom').on('click', (e) => {
            const x = e.currentTarget;
            const id = $(x).data('id');

            $('#id_mobil').val(id);
            
            $('#submitBottom').attr('disabled',true);

            $('#bottomSet').modal('show');
        });

        $('.hJual').on('click', (e) => {
            const x = e.currentTarget;
            const id = $(x).data('id');

            $('#id_mobil2').val(id);
            
            $('#submitHjual').attr('disabled',true);

            $('#hJualSet').modal('show');
        });

        function submitBottom() {
            var y = $('#id_mobil').val();
            var x = $('#iBottom').val();

            console.log(x);

            if (x!=="") {

                $.ajax({
                    type: "POST",
                    url: "/bottom/set",
                    data: {id:y, harga_bottom:x},
                    dataType: "json",
                    success: function (response) {
                        if (response.status=="success") {
                            location.reload();
                        } else {
                            console.log(response.res);
                            toastr.error('Gagal Menyimpan harga!');
                        }
                    }
                });

            } else {
                toastr.error('Isi Harga Bottom!');
            }
        }


        function submitHjual() {
            var y = $('#id_mobil2').val();
            var x = $('#iHjual').val();

            console.log(x);

            if (x!=="") {

                $.ajax({
                    type: "POST",
                    url: "/harga/set",
                    data: {id:y, harga_jual:x},
                    dataType: "json",
                    success: function (response) {
                        if (response.status=="success") {
                            location.reload();
                        } else {
                            console.log(response.res);
                            toastr.error('Gagal Menyimpan harga!');
                        }
                    }
                });

            } else {
                toastr.error('Isi Harga Jual!');
            }
        }


        $('#iBottom').on('keyup', () => {
            var x = $('#iBottom').val();

            if (x!=="") {
                $('#submitBottom').attr('disabled',false);
            } else {
                $('#submitBottom').attr('disabled',true);
            }
        });

        $('#iHjual').on('keyup', () => {
            var x = $('#iHjual').val();

            if (x!=="") {
                $('#submitHjual').attr('disabled',false);
            } else {
                $('#submitHjual').attr('disabled',true);
            }
        });

        $('#bottomSet').on('hidden.bs.modal', function () {
            $('#setBottom')[0].reset();
            $('#submitBottom').attr('disabled',true);
        })

        $('#hJualSet').on('hidden.bs.modal', function () {
            $('#setHjual')[0].reset();
            $('#submitHjual').attr('disabled',true);
        })

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

        function getDoc(x) {
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
                            $('#'+i).empty();
                            if (v !== null) $('#'+i).append('<a href="assets/img/'+i+'/'+v+'" target="_blank"><i class="material-icons opacity-10">image</i></a>');
                            else $('#'+i).append('<span><i class="material-icons opacity-10" style="color:red">close</i></span>')
                        });

                        $('#documents').modal('show');
                    } else {
                        console.log(response.res);
                    }
                }
            });
        }

    </script>
    
@endsection