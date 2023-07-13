@extends("tmp.main")

@section('title',$pej->name)

@section('style')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastr@2.1.4/build/toastr.min.css"/>
    
    <style>

        #info {
            height: 100vh;
            width: 100vw;
            display: flex;
            align-items: center;
            /* justify-content: center; */
            opacity: 1;
            transition: opacity 0.5s;
            position: fixed
        }

        #info.hidden {
            opacity: 0;
            pointer-events: none;
        }

        #form {
            height: 100vh;
            width: 100%;
            padding-top: 85px;
            /* display: flex; */
            align-items: center;
            /* justify-content: center; */
            opacity: 0;
            transition: opacity 0.5s;
            pointer-events: none;
        }

        #form.visible {
            opacity: 1;
            pointer-events: auto;
        }



        
    </style>

@endsection

@section('sidemenu')

@endsection

@section('content')

    <div id="info" class="">
        <div class="border border-3 rounded row p-3 w-100">
            <div class="col-md-6">
                <table>
                    <tr>
                        <td width="20%">No. Polisi</td>
                        <td>:</td>
                        <td class="ps-3">{{$mobil->nomor_polisi}}</td>
                    </tr>
                    <tr>
                        <td width="20%">Merk</td>
                        <td>:</td>
                        <td class="ps-3">{{$mobil->merk}}</td>
                    </tr>
                    <tr>
                        <td width="20%">Type</td>
                        <td>:</td>
                        <td class="ps-3">{{$mobil->nama}}</td>
                    </tr>
                    <tr>
                        <td width="20%">Transmisi</td>
                        <td>:</td>
                        <td class="ps-3">{{$mobil->transmisi}}</td>
                    </tr>
                    <tr>
                        <td width="20%">Tahun</td>
                        <td>:</td>
                        <td class="ps-3">{{$mobil->tahun}}</td>
                    </tr>
                    <tr>
                        <td width="20%">Isi Silinder</td>
                        <td>:</td>
                        <td class="ps-3"><span class="nomor">{{$mobil->isi_silinder}}</span> cc</td>
                    </tr>
                    <tr>
                        <td width="20%">No. Rangka</td>
                        <td>:</td>
                        <td class="ps-3">{{$mobil->nomor_rangka}}</td>
                    </tr>
                    <tr>
                        <td width="20%">No. Mesin</td>
                        <td>:</td>
                        <td class="ps-3">{{$mobil->nomor_mesin}}</td>
                    </tr>
                </table>
            </div>
            <div class="col-md-6">
                <table>
                    <tr>
                        <td width="50%">Warna Eksterior/Interior</td>
                        <td>:</td>
                        <td class="ps-3">{{$mobil->warna}} / {{$mobil->warna_interior}}</td>
                    </tr>
                    <tr>
                        <td width="50%">Bahan Bakar</td>
                        <td>:</td>
                        <td class="ps-3">{{$mobil->bahan_bakar}}</td>
                    </tr>
                    <tr>
                        <td width="50%">Odometer</td>
                        <td>:</td>
                        <td class="ps-3"><span class="nomor">{{$mobil->odometer}}</span> km</td>
                    </tr>
                    <tr>
                        <td width="50%">Pajak</td>
                        <td>:</td>
                        <td class="ps-3">{{$mobil->pajak}}</td>
                    </tr>
                </table>
            </div>

            <div class="col-md-4"></div>
            <div class="col-md-4">
                <form id="submitForm" action="{{ route('SubmitQC') }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <input type="text" name="id" value="{{$qc->id}}" hidden>
                </form>
                <button type="button" class="btn text-white" style="background-color: #f00505" data-bs-toggle="modal" data-bs-target="#confirm" > <i class="material-icons opacity-10">fact_check</i> Submit QC</button>
            </div>
            <div class="col-md-4"></div>



        </div>
    </div>

    <form id="QCForm">
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
                {{-- ===== DOKUMEN NAV ===== --}}
                <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
                    
                    {{-- Dokumen --}}
                    <div class="border row py-3 mb-3">
                        <div class="col-md-6">
                            <table>
                                <tr>
                                    <td>STNK</td>
                                    <td class="ps-5">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" {{ $dqc->stnk == 1 ? 'checked="checked"' : '' }} type="checkbox" name="stnk" onchange="qcClick(this,{{$dqc->id}})"   />
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>BPKB</td>
                                    <td class="ps-5">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" {{ $dqc->bpkb == 1 ? 'checked="checked"' : '' }} type="checkbox" name="bpkb" onchange="qcClick(this,{{$dqc->id}})" />
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Faktur</td>
                                    <td class="ps-5">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" {{ $dqc->faktur == 1 ? 'checked="checked"' : '' }} type="checkbox" name="faktur" onchange="qcClick(this,{{$dqc->id}})" />
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Cek Fisik</td>
                                    <td class="ps-5">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" {{ $dqc->cek_fisik == 1 ? 'checked="checked"' : '' }} type="checkbox" name="cek_fisik" onchange="qcClick(this,{{$dqc->id}})" />
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Surat Pelepasan Hak</td>
                                    <td class="ps-5">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" {{ $dqc->sph == 1 ? 'checked="checked"' : '' }} type="checkbox" name="sph" onchange="qcClick(this,{{$dqc->id}})" />
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <table>
                                <tr>
                                    <td>Buku Service</td>
                                    <td class="ps-5">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" {{ $dqc->buku_service == 1 ? 'checked="checked"' : '' }} type="checkbox" name="buku_service" onchange="qcClick(this,{{$dqc->id}})" />
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Kwitansi</td>
                                    <td class="ps-5">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" {{ $dqc->kwitansi_kosong == 1 ? 'checked="checked"' : '' }} type="checkbox" name="kwitansi_kosong" onchange="qcClick(this,{{$dqc->id}})" />
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Fotokopi KTP</td>
                                    <td class="ps-5">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" {{ $dqc->fotokopi_ktp == 1 ? 'checked="checked"' : '' }} type="checkbox" name="fotokopi_ktp" onchange="qcClick(this,{{$dqc->id}})" />
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Buku Manual</td>
                                    <td class="ps-5">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" {{ $dqc->buku_manual == 1 ? 'checked="checked"' : '' }} type="checkbox" name="buku_manual" onchange="qcClick(this,{{$dqc->id}})" />
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Catatan</td>
                                    <td class="ps-5">
                                        <textarea class="form-control border rounded" id="" cols="30" rows="5" name="catatan_dokumen" onchange="qcClick(this,{{$dqc->id}})">{{$dqc->catatan_dokumen!==null?$dqc->catatan_dokumen:""}}</textarea>
                                    </td>
                                </tr>
                            </table>
                        </div>

                    </div>

                    {{-- Kelengkapan --}}
                    <div class="border row py-3 mb-3">
                        <div class="col-md-6">
                            <table>
                                <tr>
                                    <td>Kunci Serep</td>
                                    <td class="ps-5">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" {{ $dqc->kunci_serep == 1 ? 'checked="checked"' : '' }} type="checkbox" name="kunci_serep" onchange="qcClick(this,{{$dqc->id}})" />
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Dongkrak</td>
                                    <td class="ps-5">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" {{ $dqc->dongkrak == 1 ? 'checked="checked"' : '' }} type="checkbox" name="dongkrak" onchange="qcClick(this,{{$dqc->id}})" />
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Kunci Roda</td>
                                    <td class="ps-5">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" {{ $dqc->kunci_roda == 1 ? 'checked="checked"' : '' }} type="checkbox" name="kunci_roda" onchange="qcClick(this,{{$dqc->id}})" />
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Catatan</td>
                                    <td class="ps-5">
                                        <textarea class="form-control border rounded" id="" cols="30" rows="5" name="catatan_kelengkapan" onchange="qcClick(this,{{$dqc->id}})">{{$dqc->catatan_kelengkapan!==null?$dqc->catatan_kelengkapan:""}}</textarea>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <table>
                                <tr>
                                    <td>Derek</td>
                                    <td class="ps-5">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" {{ $dqc->derek == 1 ? 'checked="checked"' : '' }} type="checkbox" name="derek" onchange="qcClick(this,{{$dqc->id}})" />
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Ban Serep</td>
                                    <td class="ps-5">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" {{ $dqc->ban_serep == 1 ? 'checked="checked"' : '' }} type="checkbox" name="ban_serep" onchange="qcClick(this,{{$dqc->id}})" />
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Putaran Dongkrak</td>
                                    <td class="ps-5">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" {{ $dqc->putaran_dongkrak == 1 ? 'checked="checked"' : '' }} type="checkbox" name="putaran_dongkrak" onchange="qcClick(this,{{$dqc->id}})" />
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>

                    </div>

                    {{-- Kaca & Lampu --}}
                    <div class="border row py-3 mb-3">
                        <div class="col-md-6">
                            <table>
                                <tr>
                                    <td>Kaca Depan</td>
                                    <td class="ps-5">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" {{ $dqc->kaca_depan == 1 ? 'checked="checked"' : '' }} type="checkbox" name="kaca_depan" onchange="qcClick(this,{{$dqc->id}})" />
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Pelipit Pintu</td>
                                    <td class="ps-5">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" {{ $dqc->pelipit_pintu == 1 ? 'checked="checked"' : '' }} type="checkbox" name="pelipit_pintu" onchange="qcClick(this,{{$dqc->id}})" />
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Catatan</td>
                                    <td class="ps-5">
                                        <textarea class="form-control border rounded" id="" cols="30" rows="5" name="catatan_kaca_lampu" onchange="qcClick(this,{{$dqc->id}})">{{$dqc->catatan_kaca_lampu!==null?$dqc->catatan_kaca_lampu:""}}</textarea>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <table>
                                <tr>
                                    <td>Daun Wiper Depan</td>
                                    <td class="ps-5">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" {{ $dqc->daun_wiper_depan == 1 ? 'checked="checked"' : '' }} type="checkbox" name="daun_wiper_depan" onchange="qcClick(this,{{$dqc->id}})" />
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Grill Depan</td>
                                    <td class="ps-5">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" {{ $dqc->grill_depan == 1 ? 'checked="checked"' : '' }} type="checkbox" name="grill_depan" onchange="qcClick(this,{{$dqc->id}})" />
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Daun Wiper Belakang</td>
                                    <td class="ps-5">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" {{ $dqc->daun_wiper_belakang == 1 ? 'checked="checked"' : '' }} type="checkbox" name="daun_wiper_belakang" onchange="qcClick(this,{{$dqc->id}})" />
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>

                    </div>

                </div>

                {{-- ===== UNDER BODY ===== --}}
                <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">

                    {{-- Ban & Baut --}}
                    <div class="border row py-3 mb-3">
                        <h4><u>Ban & Baut Roda</u></h4>
                        <div class="col-md-12">
                            <table class="table table-stripped">
                                <thead>
                                    <tr>
                                        <th>Sisi</th>
                                        <th>Merk</th>
                                        <th>Ukuran</th>
                                        <th>Velg</th>
                                        <th>Ketebalan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Kiri Depan</td>
                                        <td><input type="text" onchange="banQC({{$dqc->id}},'ban_kiri_depan','0',this.value)" value="{{ $dqc->ban_kiri_depan[0]=="" ? "" : $dqc->ban_kiri_depan[0] }}" class="form-control border" name="merk"></td>
                                        <td><input type="text" onchange="banQC({{$dqc->id}},'ban_kiri_depan','1',this.value)" value="{{ $dqc->ban_kiri_depan[1]=="" ? "" : $dqc->ban_kiri_depan[1] }}" class="form-control border" name="ukuran"></td>
                                        <td><input type="text" onchange="banQC({{$dqc->id}},'ban_kiri_depan','2',this.value)" value="{{ $dqc->ban_kiri_depan[2]=="" ? "" : $dqc->ban_kiri_depan[2] }}" class="form-control border" name="velg"></td>
                                        <td><input type="text" onchange="banQC({{$dqc->id}},'ban_kiri_depan','3',this.value)" value="{{ $dqc->ban_kiri_depan[3]=="" ? "" : $dqc->ban_kiri_depan[3] }}" class="form-control border" name="tebal"></td>
                                    </tr>
                                    <tr>
                                        <td>Kiri Belakang</td>
                                        <td><input type="text" onchange="banQC({{$dqc->id}},'ban_kiri_belakang','0',this.value)" value="{{ $dqc->ban_kiri_belakang[0]=="" ? "" : $dqc->ban_kiri_belakang[0] }}" class="form-control border" name="merk"></td>
                                        <td><input type="text" onchange="banQC({{$dqc->id}},'ban_kiri_belakang','1',this.value)" value="{{ $dqc->ban_kiri_belakang[1]=="" ? "" : $dqc->ban_kiri_belakang[1] }}" class="form-control border" name="ukuran"></td>
                                        <td><input type="text" onchange="banQC({{$dqc->id}},'ban_kiri_belakang','2',this.value)" value="{{ $dqc->ban_kiri_belakang[2]=="" ? "" : $dqc->ban_kiri_belakang[2] }}" class="form-control border" name="velg"></td>
                                        <td><input type="text" onchange="banQC({{$dqc->id}},'ban_kiri_belakang','3',this.value)" value="{{ $dqc->ban_kiri_belakang[3]=="" ? "" : $dqc->ban_kiri_belakang[3] }}" class="form-control border" name="tebal"></td>
                                    </tr>
                                    <tr>
                                        <td>Kanan Depan</td>
                                        <td><input type="text" onchange="banQC({{$dqc->id}},'ban_kanan_depan','0',this.value)" value="{{ $dqc->ban_kanan_depan[0]=="" ? "" : $dqc->ban_kanan_depan[0] }}" class="form-control border" name="merk"></td>
                                        <td><input type="text" onchange="banQC({{$dqc->id}},'ban_kanan_depan','1',this.value)" value="{{ $dqc->ban_kanan_depan[1]=="" ? "" : $dqc->ban_kanan_depan[1] }}" class="form-control border" name="ukuran"></td>
                                        <td><input type="text" onchange="banQC({{$dqc->id}},'ban_kanan_depan','2',this.value)" value="{{ $dqc->ban_kanan_depan[2]=="" ? "" : $dqc->ban_kanan_depan[2] }}" class="form-control border" name="velg"></td>
                                        <td><input type="text" onchange="banQC({{$dqc->id}},'ban_kanan_depan','3',this.value)" value="{{ $dqc->ban_kanan_depan[3]=="" ? "" : $dqc->ban_kanan_depan[3] }}" class="form-control border" name="tebal"></td>
                                    </tr>
                                    <tr>
                                        <td>Kanan Belakang</td>
                                        <td><input type="text" onchange="banQC({{$dqc->id}},'ban_kanan_belakang','0',this.value)" value="{{ $dqc->ban_kanan_belakang[0]=="" ? "" : $dqc->ban_kanan_belakang[0] }}" class="form-control border" name="merk"></td>
                                        <td><input type="text" onchange="banQC({{$dqc->id}},'ban_kanan_belakang','1',this.value)" value="{{ $dqc->ban_kanan_belakang[1]=="" ? "" : $dqc->ban_kanan_belakang[1] }}" class="form-control border" name="ukuran"></td>
                                        <td><input type="text" onchange="banQC({{$dqc->id}},'ban_kanan_belakang','2',this.value)" value="{{ $dqc->ban_kanan_belakang[2]=="" ? "" : $dqc->ban_kanan_belakang[2] }}" class="form-control border" name="velg"></td>
                                        <td><input type="text" onchange="banQC({{$dqc->id}},'ban_kanan_belakang','3',this.value)" value="{{ $dqc->ban_kanan_belakang[3]=="" ? "" : $dqc->ban_kanan_belakang[3] }}" class="form-control border" name="tebal"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <h4><u>Liner Fender & Talang Lumpur</u></h4>
                        <div class="col-md-6">
                            <table>
                                <tr>
                                    <td>Liner Fender Depan Kanan</td>
                                    <td class="ps-5">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" {{ $dqc->liner_fender_depan_kanan == 1 ? 'checked="checked"' : '' }} name="liner_fender_depan_kanan" onchange="qcClick(this,{{$dqc->id}})" type="checkbox"  />
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Liner Fender Depan Kiri</td>
                                    <td class="ps-5">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" {{ $dqc->liner_fender_depan_kiri == 1 ? 'checked="checked"' : '' }} type="checkbox" name="liner_fender_depan_kiri" onchange="qcClick(this,{{$dqc->id}})" />
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Liner Fender Belakang Kanan</td>
                                    <td class="ps-5">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" {{ $dqc->liner_fender_belakang_kanan == 1 ? 'checked="checked"' : '' }} type="checkbox" name="liner_fender_belakang_kanan" onchange="qcClick(this,{{$dqc->id}})" />
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Liner Fender Belakang Kiri</td>
                                    <td class="ps-5">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" {{ $dqc->liner_fender_belakang_kiri == 1 ? 'checked="checked"' : '' }} type="checkbox" name="liner_fender_belakang_kiri" onchange="qcClick(this,{{$dqc->id}})" />
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <table>
                                <tr>
                                    <td>Talang Lumpur Depan Kanan</td>
                                    <td class="ps-5">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" {{ $dqc->talang_lumpur_depan_kanan == 1 ? 'checked="checked"' : '' }} type="checkbox" name="talang_lumpur_depan_kanan" onchange="qcClick(this,{{$dqc->id}})" />
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Talang Lumpur Depan Kiri</td>
                                    <td class="ps-5">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" {{ $dqc->talang_lumpur_depan_kiri == 1 ? 'checked="checked"' : '' }} type="checkbox" name="talang_lumpur_depan_kiri" onchange="qcClick(this,{{$dqc->id}})" />
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Talang Lumpur Belakang Kanan</td>
                                    <td class="ps-5">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" {{ $dqc->talang_lumpur_belakang_kanan == 1 ? 'checked="checked"' : '' }} type="checkbox" name="talang_lumpur_belakang_kanan" onchange="qcClick(this,{{$dqc->id}})" />
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Talang Lumpur Belakang Kiri</td>
                                    <td class="ps-5">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" {{ $dqc->talang_lumpur_belakang_kiri == 1 ? 'checked="checked"' : '' }} type="checkbox" name="talang_lumpur_belakang_kiri" onchange="qcClick(this,{{$dqc->id}})" />
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>

                        <h4><u>Kolong Mobil</u></h4>
                        <div class="col-md-6">
                            <table>
                                <tr>
                                    <td>Bagian Bawah Mesin</td>
                                    <td class="ps-5">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" {{ $dqc->bagian_bawah_mesin == 1 ? 'checked="checked"' : '' }} type="checkbox" name="bagian_bawah_mesin" onchange="qcClick(this,{{$dqc->id}})" />
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Bagian Sasis Tengah</td>
                                    <td class="ps-5">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" {{ $dqc->bagian_sasis_tengah == 1 ? 'checked="checked"' : '' }} type="checkbox" name="bagian_sasis_tengah" onchange="qcClick(this,{{$dqc->id}})" />
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Catatan</td>
                                    <td class="ps-5">
                                        <textarea class="form-control border rounded" id="" cols="30" rows="5" name="catatan_under_body" onchange="qcClick(this,{{$dqc->id}})">{{$dqc->catatan_under_body!==null?$dqc->catatan_under_body:""}}</textarea>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <table>
                                <tr>
                                    <td>Bagian Sasis Depan</td>
                                    <td class="ps-5">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" {{ $dqc->bagian_sasis_depan == 1 ? 'checked="checked"' : '' }} type="checkbox" name="bagian_sasis_depan" onchange="qcClick(this,{{$dqc->id}})" />
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Bagian Sasis Belakang</td>
                                    <td class="ps-5">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" {{ $dqc->bagian_sasis_belakang == 1 ? 'checked="checked"' : '' }} type="checkbox" name="bagian_sasis_belakang" onchange="qcClick(this,{{$dqc->id}})" />
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>

                    </div>

                    {{-- Mesin --}}
                    <div class="border row py-3 mb-3">

                        {{-- OLI & CAIRAN --}}
                        <h4><u>Oli & Cairan</u></h4>
                        <div class="col-md-6">
                            <table>
                                <tr>
                                    <td>Oli Mesin</td>
                                    <td class="ps-5">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" {{ $dqc->oli_mesin == 1 ? 'checked="checked"' : '' }} type="checkbox" name="oli_mesin" onchange="qcClick(this,{{$dqc->id}})" />
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Minyak Rem</td>
                                    <td class="ps-5">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" {{ $dqc->minyak_rem == 1 ? 'checked="checked"' : '' }} type="checkbox" name="minyak_rem" onchange="qcClick(this,{{$dqc->id}})" />
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Air Radiator</td>
                                    <td class="ps-5">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" {{ $dqc->air_radiator == 1 ? 'checked="checked"' : '' }} type="checkbox" name="air_radiator" onchange="qcClick(this,{{$dqc->id}})" />
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <table>
                                <tr>
                                    <td>Oli Transmisi AT</td>
                                    <td class="ps-5">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" {{ $dqc->oli_transmisi_at == 1 ? 'checked="checked"' : '' }} type="checkbox" name="oli_transmisi_at" onchange="qcClick(this,{{$dqc->id}})" />
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Minyak Power Steering</td>
                                    <td class="ps-5">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" {{ $dqc->minyak_power_steering == 1 ? 'checked="checked"' : '' }} type="checkbox" name="minyak_power_steering" onchange="qcClick(this,{{$dqc->id}})" />
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Air Wiper</td>
                                    <td class="ps-5">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" {{ $dqc->air_wiper == 1 ? 'checked="checked"' : '' }} type="checkbox" name="air_wiper" onchange="qcClick(this,{{$dqc->id}})" />
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>

                        {{-- Ruang Mesin--}}
                        <h4><u>Ruang Mesin</u></h4>
                        <div class="col-md-6">
                            <table>
                                <tr>
                                    <td>Suara Mesin Normal</td>
                                    <td class="ps-5">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" {{ $dqc->suara_mesin_normal == 1 ? 'checked="checked"' : '' }} type="checkbox" name="suara_mesin_normal" onchange="qcClick(this,{{$dqc->id}})" />
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Belt</td>
                                    <td class="ps-5">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" {{ $dqc->belt == 1 ? 'checked="checked"' : '' }} type="checkbox" name="belt" onchange="qcClick(this,{{$dqc->id}})" />
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Accu</td>
                                    <td class="ps-5">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" {{ $dqc->accu == 1 ? 'checked="checked"' : '' }} type="checkbox" name="accu" onchange="qcClick(this,{{$dqc->id}})" />
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Radiator</td>
                                    <td class="ps-5">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" {{ $dqc->radiator == 1 ? 'checked="checked"' : '' }} type="checkbox" name="radiator" onchange="qcClick(this,{{$dqc->id}})" />
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Catatan</td>
                                    <td class="ps-5">
                                        <textarea class="form-control border rounded" id="" cols="30" rows="5" name="catatan_mesin" onchange="qcClick(this,{{$dqc->id}})">{{$dqc->catatan_mesin!==null?$dqc->catatan_mesin:""}}</textarea>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <table>
                                <tr>
                                    <td>Mesin Bebas Rembes</td>
                                    <td class="ps-5">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" {{ $dqc->mesin_bebas_rembes == 1 ? 'checked="checked"' : '' }} type="checkbox" name="mesin_bebas_rembes" onchange="qcClick(this,{{$dqc->id}})" />
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Selang-Selang</td>
                                    <td class="ps-5">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" {{ $dqc->selang_selang == 1 ? 'checked="checked"' : '' }} type="checkbox" name="selang_selang" onchange="qcClick(this,{{$dqc->id}})" />
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Asap dan Tutup Oli</td>
                                    <td class="ps-5">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" {{ $dqc->asap_dan_tutup_oli == 1 ? 'checked="checked"' : '' }} type="checkbox" name="asap_dan_tutup_oli" onchange="qcClick(this,{{$dqc->id}})" />
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Kompresor AC</td>
                                    <td class="ps-5">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" {{ $dqc->kompresor_ac == 1 ? 'checked="checked"' : '' }} type="checkbox" name="kompresor_ac" onchange="qcClick(this,{{$dqc->id}})" />
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>

                    </div>
                </div>

                {{-- ===== INTERIOR ===== --}}
                <div class="tab-pane fade" id="contact-tab-pane" role="tabpanel" aria-labelledby="contact-tab" tabindex="0">
                    <div class="border row py-3 mb-3">

                        {{-- INDIKATOR SENSOR --}}
                        <h4><u>Indikator Sensor</u></h4>
                        <div class="col-md-6">
                            <table>
                                <tr>
                                    <td>Engine Check</td>
                                    <td class="ps-5">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" {{ $dqc->stnk == 1 ? 'checked="checked"' : '' }} type="checkbox" name="sensor_engine_check" onchange="qcClick(this,{{$dqc->id}})" />
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>ABS</td>
                                    <td class="ps-5">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" {{ $dqc->stnk == 1 ? 'checked="checked"' : '' }} type="checkbox" name="sensor_abs" onchange="qcClick(this,{{$dqc->id}})" />
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Rem Tangan</td>
                                    <td class="ps-5">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" {{ $dqc->stnk == 1 ? 'checked="checked"' : '' }} type="checkbox" name="sensor_rem_tangan" onchange="qcClick(this,{{$dqc->id}})" />
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Tekanan Oli</td>
                                    <td class="ps-5">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" {{ $dqc->stnk == 1 ? 'checked="checked"' : '' }} type="checkbox" name="sensor_tekanan_oli" onchange="qcClick(this,{{$dqc->id}})" />
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Accu</td>
                                    <td class="ps-5">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" {{ $dqc->stnk == 1 ? 'checked="checked"' : '' }} type="checkbox" name="sensor_accu" onchange="qcClick(this,{{$dqc->id}})" />
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Catatan</td>
                                    <td class="ps-5">
                                        <textarea class="form-control border rounded" id="" cols="30" rows="5" name="catatan_sensor" onchange="qcClick(this,{{$dqc->id}})">{{$dqc->catatan_sensor!==null?$dqc->catatan_sensor:""}}</textarea>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <table>
                                <tr>
                                    <td>VSA</td>
                                    <td class="ps-5">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" {{ $dqc->sensor_vsa == 1 ? 'checked="checked"' : '' }} type="checkbox" name="sensor_vsa" onchange="qcClick(this,{{$dqc->id}})" />
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Airbag</td>
                                    <td class="ps-5">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" {{ $dqc->sensor_airbag == 1 ? 'checked="checked"' : '' }} type="checkbox" name="sensor_airbag" onchange="qcClick(this,{{$dqc->id}})" />
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Seat Belt</td>
                                    <td class="ps-5">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" {{ $dqc->sensor_seat_belt == 1 ? 'checked="checked"' : '' }} type="checkbox" name="sensor_seat_belt" onchange="qcClick(this,{{$dqc->id}})" />
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Suhu Mesin</td>
                                    <td class="ps-5">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" {{ $dqc->sensor_suhu_mesin == 1 ? 'checked="checked"' : '' }} type="checkbox" name="sensor_suhu_mesin" onchange="qcClick(this,{{$dqc->id}})" />
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Electric Power Steering</td>
                                    <td class="ps-5">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" {{ $dqc->sensor_electric_power_steering == 1 ? 'checked="checked"' : '' }} type="checkbox" name="sensor_electric_power_steering" onchange="qcClick(this,{{$dqc->id}})" />
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Door Lock</td>
                                    <td class="ps-5">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" {{ $dqc->sensor_door_lock == 1 ? 'checked="checked"' : '' }} type="checkbox" name="sensor_door_lock" onchange="qcClick(this,{{$dqc->id}})" />
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>

                        {{-- BAGIAN DEPAN--}}
                        <h4><u>Bagian Depan</u></h4>
                        <div class="col-md-6">
                            <table>
                                <tr>
                                    <td>Kondisi Stir</td>
                                    <td class="ps-5">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" {{ $dqc->kondisi_stir == 1 ? 'checked="checked"' : '' }} type="checkbox" name="kondisi_stir" onchange="qcClick(this,{{$dqc->id}})" />
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Tombol Stir</td>
                                    <td class="ps-5">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" {{ $dqc->tombol_stir == 1 ? 'checked="checked"' : '' }} type="checkbox" name="tombol_stir" onchange="qcClick(this,{{$dqc->id}})" />
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Lampu Depan</td>
                                    <td class="ps-5">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" {{ $dqc->lampu_depan == 1 ? 'checked="checked"' : '' }} type="checkbox" name="lampu_depan" onchange="qcClick(this,{{$dqc->id}})" />
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Lampu Atret</td>
                                    <td class="ps-5">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" {{ $dqc->lampu_atret == 1 ? 'checked="checked"' : '' }} type="checkbox" name="lampu_atret" onchange="qcClick(this,{{$dqc->id}})" />
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Konsol Box</td>
                                    <td class="ps-5">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" {{ $dqc->konsol_box == 1 ? 'checked="checked"' : '' }} type="checkbox" name="konsol_box" onchange="qcClick(this,{{$dqc->id}})" />
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Spion Kiri</td>
                                    <td class="ps-5">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" {{ $dqc->spion_kiri == 1 ? 'checked="checked"' : '' }} type="checkbox" name="spion_kiri" onchange="qcClick(this,{{$dqc->id}})" />
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Rem Tangan</td>
                                    <td class="ps-5">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" {{ $dqc->rem_tangan == 1 ? 'checked="checked"' : '' }} type="checkbox" name="rem_tangan" onchange="qcClick(this,{{$dqc->id}})" />
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Power Window Supir</td>
                                    <td class="ps-5">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" {{ $dqc->power_window_supir == 1 ? 'checked="checked"' : '' }} type="checkbox" name="power_window_supir" onchange="qcClick(this,{{$dqc->id}})" />
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Power Window Belakang Kanan</td>
                                    <td class="ps-5">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" {{ $dqc->power_window_belakang_kanan == 1 ? 'checked="checked"' : '' }} type="checkbox" name="power_window_belakang_kanan" onchange="qcClick(this,{{$dqc->id}})" />
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Pembuka Kap Mesin</td>
                                    <td class="ps-5">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" {{ $dqc->pembuka_kap_mesin == 1 ? 'checked="checked"' : '' }} type="checkbox" name="pembuka_kap_mesin" onchange="qcClick(this,{{$dqc->id}})" />
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Sabuk Pengaman Supir</td>
                                    <td class="ps-5">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" {{ $dqc->sabuk_pengaman_supir == 1 ? 'checked="checked"' : '' }} type="checkbox" name="sabuk_pengaman_supir" onchange="qcClick(this,{{$dqc->id}})" />
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Karpet Keping Supir</td>
                                    <td class="ps-5">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" {{ $dqc->karpet_keping_supir == 1 ? 'checked="checked"' : '' }} type="checkbox" name="karpet_keping_supir" onchange="qcClick(this,{{$dqc->id}})" />
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Spion Tengah</td>
                                    <td class="ps-5">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" {{ $dqc->spion_tengah == 1 ? 'checked="checked"' : '' }} type="checkbox" name="spion_tengah" onchange="qcClick(this,{{$dqc->id}})" />
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Lampu Plafon Depan</td>
                                    <td class="ps-5">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" {{ $dqc->lampu_plafon_depan == 1 ? 'checked="checked"' : '' }} type="checkbox" name="lampu_plafon_depan" onchange="qcClick(this,{{$dqc->id}})" />
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Catatan</td>
                                    <td class="ps-5">
                                        <textarea class="form-control border rounded" id="" cols="30" rows="5" name="catatan_interior_depan" onchange="qcClick(this,{{$dqc->id}})">{{$dqc->catatan_interior_depan!==null?$dqc->catatan_interior_depan:""}}</textarea>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <table>
                                <tr>
                                    <td>Klakson</td>
                                    <td class="ps-5">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" {{ $dqc->klakson == 1 ? 'checked="checked"' : '' }} type="checkbox" name="klakson" onchange="qcClick(this,{{$dqc->id}})" />
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Lampu Sen Spion</td>
                                    <td class="ps-5">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" {{ $dqc->lampu_sen_spion == 1 ? 'checked="checked"' : '' }} type="checkbox" name="lampu_sen_spion" onchange="qcClick(this,{{$dqc->id}})" />
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Lampu Hazzard</td>
                                    <td class="ps-5">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" {{ $dqc->lampu_hazzard == 1 ? 'checked="checked"' : '' }} type="checkbox" name="lampu_hazzard" onchange="qcClick(this,{{$dqc->id}})" />
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Handle Pintu</td>
                                    <td class="ps-5">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" {{ $dqc->handle_pintu == 1 ? 'checked="checked"' : '' }} type="checkbox" name="handle_pintu" onchange="qcClick(this,{{$dqc->id}})" />
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Spion Kanan</td>
                                    <td class="ps-5">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" {{ $dqc->spion_kanan == 1 ? 'checked="checked"' : '' }} type="checkbox" name="spion_kanan" onchange="qcClick(this,{{$dqc->id}})" />
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Sun Visor</td>
                                    <td class="ps-5">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" {{ $dqc->sun_visor == 1 ? 'checked="checked"' : '' }} type="checkbox" name="sun_visor" onchange="qcClick(this,{{$dqc->id}})" />
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Power Window Penumpang</td>
                                    <td class="ps-5">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" {{ $dqc->power_window_penumpang == 1 ? 'checked="checked"' : '' }} type="checkbox" name="power_window_penumpang" onchange="qcClick(this,{{$dqc->id}})" />
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Power Window Belakang Kiri</td>
                                    <td class="ps-5">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" {{ $dqc->power_window_belakang_kiri == 1 ? 'checked="checked"' : '' }} type="checkbox" name="power_window_belakang_kiri" onchange="qcClick(this,{{$dqc->id}})" />
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Pembuka Tangki Bensin</td>
                                    <td class="ps-5">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" {{ $dqc->pembuka_tangki_bensin == 1 ? 'checked="checked"' : '' }} type="checkbox" name="pembuka_tangki_bensin" onchange="qcClick(this,{{$dqc->id}})" />
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Sabuk Pengaman Penumpang</td>
                                    <td class="ps-5">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" {{ $dqc->sabuk_pengaman_penumpang == 1 ? 'checked="checked"' : '' }} type="checkbox" name="sabuk_pengaman_penumpang" onchange="qcClick(this,{{$dqc->id}})" />
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Karpet Keping Penumpang</td>
                                    <td class="ps-5">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" {{ $dqc->karpet_keping_penumpang == 1 ? 'checked="checked"' : '' }} type="checkbox" name="karpet_keping_penumpang" onchange="qcClick(this,{{$dqc->id}})" />
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Audio & Speaker</td>
                                    <td class="ps-5">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" {{ $dqc->audio_speaker == 1 ? 'checked="checked"' : '' }} type="checkbox" name="audio_speaker" onchange="qcClick(this,{{$dqc->id}})" />
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>

                        {{-- BAGIAN BELAKANG--}}
                        <h4><u>Bagian Belakang</u></h4>
                        <div class="col-md-6">
                            <table>
                                <tr>
                                    <td>Fungsi AC Belakang</td>
                                    <td class="ps-5">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" {{ $dqc->fungsi_ac_belakang == 1 ? 'checked="checked"' : '' }} type="checkbox" name="fungsi_ac_belakang" onchange="qcClick(this,{{$dqc->id}})" />
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Fungsi Kursi Baris Ke-2</td>
                                    <td class="ps-5">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" {{ $dqc->fungsi_kursi_baris_kedua == 1 ? 'checked="checked"' : '' }} type="checkbox" name="fungsi_kursi_baris_kedua" onchange="qcClick(this,{{$dqc->id}})" />
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Lampu Plafon Belakang</td>
                                    <td class="ps-5">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" {{ $dqc->lampu_plafon_belakang == 1 ? 'checked="checked"' : '' }} type="checkbox" name="lampu_plafon_belakang" onchange="qcClick(this,{{$dqc->id}})" />
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Catatan</td>
                                    <td class="ps-5">
                                        <textarea class="form-control border rounded" id="" cols="30" rows="5" name="catatan_interior_belakang" onchange="qcClick(this,{{$dqc->id}})">{{$dqc->catatan_interior_belakang!==null?$dqc->catatan_interior_belakang:""}}</textarea>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <table>
                                <tr>
                                    <td>Jok Baris Belakang</td>
                                    <td class="ps-5">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" {{ $dqc->jok_baris_belakang == 1 ? 'checked="checked"' : '' }} type="checkbox" name="jok_baris_belakang" onchange="qcClick(this,{{$dqc->id}})" />
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Fungsi Kursi Baris Ke-3</td>
                                    <td class="ps-5">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" {{ $dqc->fungsi_kursi_baris_ketiga == 1 ? 'checked="checked"' : '' }} type="checkbox" name="fungsi_kursi_baris_ketiga" onchange="qcClick(this,{{$dqc->id}})" />
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Karpet Keping Baris ke</td>
                                    <td class="ps-5">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" {{ $dqc->karpet_keping_baris_ke == 1 ? 'checked="checked"' : '' }} type="checkbox" name="karpet_keping_baris_ke" onchange="qcClick(this,{{$dqc->id}})" />
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </form>

<!-- Modal confirm -->
<div class="modal fade" id="confirm" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="staticBackdropLabel">Submit QC</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <span>Selesaikan pemeriksaan <b>{{$mobil->merk}} {{$mobil->nama}}</b>?</span>
          <br>
          <div>
            <input type="checkbox" class="form-check-control" name="notReady" form="submitForm" id="iBengkel">
            <label for="iBengkel" class="form-check-label">Belum siap jual</label>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn text-white" form="submitForm" style="background-color: #f00505">Selesaikan</button>
        </div>
      </div>
    </div>
  </div>


@endsection

@section('script')


<script src="https://cdn.jsdelivr.net/npm/toastr@2.1.4/build/toastr.min.js"></script>
<script src="{{asset('assets/vendor/jquery/jquery.number.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.8/ScrollMagic.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.9.1/gsap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.8/plugins/animation.gsap.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.7/dist/loadingoverlay.min.js"></script>




<script>
    $(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('span.nomor').number(true,0);

        var controller = new ScrollMagic.Controller();

        // Mengganti ke div form saat digulirkan ke bawah
        var formScene = new ScrollMagic.Scene({
            triggerElement: '#form',
            triggerHook: 0,
            duration: '100%'
        })
        .addTo(controller)
        .on('enter', function() {
            $('#info').addClass('hidden');
            $('#form').addClass('visible');
        })
        .on('leave', function() {
            $('#info').removeClass('hidden');
            $('#form').removeClass('visible');
        });

        // Mengatur opacity div info berdasarkan posisi pengguliran halaman
        $(window).scroll(function() {
            var scrollTop = $(window).scrollTop();
            var windowHeight = $(window).height();
            var infoSectionHeight = $('#info').outerHeight();

            var opacity = 1 - (scrollTop / (infoSectionHeight - windowHeight));

            $('#info').css('opacity', opacity);
        });
        
    });

    function qcClick(x, y) {
        var formData = parseQueryString($('#QCForm').serialize());

        var col = x.name;

        var val = 0;

        if (x.value=="on") {
            if (formData[col]) {
                val = 1;
            }
        } else {
            val = x.value;
        }

        $.LoadingOverlay("show");
        var data = {};

        data.id = {{$dqc->id}};
        data.col = col;
        data.val = val;

        $.ajax({
            type: "PATCH",
            url: '/qcClick',
            data: data,
            dataType: "json",
            success: function (response) {
                if (response.status=="success") {
                    $.LoadingOverlay("hide");
                    toastr.success('Data berhasil disimpan!');
                } else {
                    $.LoadingOverlay("hide");
                    toastr.error('Data gagal disimpan!')
                }
            }
        });
    }

    function banQC(w,x,y,z) {
        $.LoadingOverlay("show");

        var data = {};

        data.id = w;
        data.ban = x;
        data.col = y;
        data.val = z;

        $.ajax({
            type: "PATCH",
            url: "/banQC",
            data: data,
            dataType: "json",
            success: function (response) {
                if (response.status == "success") {
                    $.LoadingOverlay("hide");
                    toastr.success('Data sudah disimpan!');
                } else {
                    $.LoadingOverlay("hide");
                    toastr.error('Data gagal disimpan!');
                }
            }
        });

    }

    $('#QCForm').submit(function (e) { 
        e.preventDefault();
    });

    function parseQueryString(queryString) {
      var params = {};
      var queries = queryString.split("&");
      for (var i = 0; i < queries.length; i++) {
        var pair = queries[i].split("=");
        params[decodeURIComponent(pair[0])] = decodeURIComponent(pair[1]);
      }
      return params;
    }


</script>

@endsection