@extends("tmp.main")

@section('title',$pej->name)

@section('style')
@endsection

@section('sidemenu')

@endsection

@section('content')


<div class="containder-fluid">

    <h3 class="text-center">Pembelian Mobil</h3>

    <form class="row" method="POST" action="/beli" enctype="multipart/form-data">
        @csrf

        <div class="col-md-12 border rounded p-3 mb-3">
            <div class="mb-3">
                <label for="iNama" class="form-label">Nama</label>
                <input type="text" name="nama" id="iNama" class="form-control border" placeholder="Nama Penjual" required />
            </div>
        </div>

        <!-- Base -->
        <div class="col-md-6 border rounded-3 p-3 mb-3">
            <h5 class="text-center">Data Kendaraan</h5>
            <div class="mb-3">
                <label for="imerk" class="form-label">Merk</label>
                <select name="merk" id="imerk" class="form-select" required>
                    <option value="">=== Pilih Merk ===</option>
                    @foreach($merk as $v => $k)
                        <option value="{{$k->id}}">{{$k->nama}}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="itype" class="form-label">Type</label>
                <input type="text" name="type" id="itype" class="form-control border" placeholder="Type" required/>
            </div>

            <div class="mb-3">
                <label for="iJenis">Jenis</label>
                <select name="jenis" class="form-select" id="iJenis">
                    <option value="">=== Pilih Jenis ===</option>
                    @foreach($jenis as $v => $k)
                        <option value="{{$k->id}}">{{$k->nama}}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="iwarna" class="form-label">Warna</label>
                <input type="text" name="warna" id="iwarna" class="form-control border" placeholder="Warna" required/>
            </div>

            <div class="mb-3">
                <label for="itahun" class="form-label">Tahun</label>
                <input  name="tahun" id="itahun" class="form-control border" placeholder="Tahun" required/>
            </div>            

            <div class="mb-3">
                <label for="inopol" class="form-label">Nomor Polisi</label>
                <input type="text" name="nopol" id="inopol" class="form-control border" placeholder="Nomor Polisi" required/>
            </div>

            <div class="mb-3">
                <label for="inomes" class="form-label">Nomor Mesin</label>
                <input type="text" name="nomes" id="inomes" class="form-control border" placeholder="Nomor Mesin" required/>
            </div>

            <div class="mb-3">
                <label for="inorang" class="form-label">Nomor Rangka</label>
                <input type="text" name="norang" id="inorang" class="form-control border" placeholder="Nomor Rangka" required/>
            </div>
        </div>

        
        <div class="col-md-6">
            <h5 class="text-center">BPKB</h5>

            <!-- BPKB -->
            <div class="border rounded-3 p-3 mb-3">
                <div class="mb-3">
                    <label for="inoBPKB" class="form-label">Nomor BPKB</label>
                    <input type="text" name="noBPKB" id="inoBPKB" class="form-control border" placeholder="Nomor BPKB" required/>
                </div>

                <div class="mb-3">
                    <label for="inmBPKB" class="form-label">Nama di BPKB</label>
                    <input type="text" name="nmBPKB" id="inmBPKB" class="form-control border" placeholder="Nama di BPKB" required/>
                </div>

                <div class="mb-3">
                    <label for="iAlamat" class="form-label">Alamat</label>
                    <input type="text" name="alamat" id="iAlamat" class="form-control border" placeholder="Alamat" required />
                </div>

            </div>


            <h5 class="text-center">Kelengkapan</h5>
            
            <!-- Kelengkapan -->
            <div class="border rounded-3 p-3 mb-3 row">
                
                <div class="col-md-6">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="chSTNK" name="chSTNK"/>
                        <label class="form-check-label" for="chSTNK">STNK Asli</label>
                    </div>

                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="chKTPbpkb" name="chKTPbpkb"/>
                        <label class="form-check-label" for="chKTPbpkb">KTP a/n BPKB</label>
                    </div>

                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="chKW" name="chKW"/>
                        <label class="form-check-label" for="chKW">Kwitansi Blanko a/n di BPKB</label>
                    </div>

                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="chFA" name="chFA"/>
                        <label class="form-check-label" for="chFA">Faktur Asli</label>
                    </div>

                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="chForm" name="chForm"/>
                        <label class="form-check-label" for="chForm">Form</label>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="chKeyS" name="chKeyS"/>
                        <label class="form-check-label" for="chKeyS">Kunci Serep</label>
                    </div>

                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="chBan" name="chBan"/>
                        <label class="form-check-label" for="chBan">Ban Serep</label>
                    </div>

                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="chKeyRod" name="chKeyRod"/>
                        <label class="form-check-label" for="chKeyRod">Kunci Roda</label>
                    </div>

                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="chDgrk" name="chDgrk"/>
                        <label class="form-check-label" for="chDgrk">Dongkrak</label>
                    </div>

                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="chSPH" name="chSPH"/>
                        <label class="form-check-label" for="chSPH">Surat Pelepasan Hak</label>
                    </div>
                </div>

            </div>

            <div class="mb-3">
                <label for="iharga">Harga Beli</label>
                <input type="text" name="harga" id="iharga" class="form-control border" placeholder="Rp.">
            </div>

            <div class="mb-3">
                <label for="ikond">Kondisi</label>
                <textarea name="kond" id="ikond" class="form-control border"></textarea>
            </div>


        </div>

        
    <button class="btn" style="background-color:#0d6efd; color:white">
        Proses
        <i class="material-icons opacity-10">arrow_forward_ios</i>
    </button>


    </form>

</div>
<i class="fas fa-check"></i>


@endsection

@section('script')

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css" rel="stylesheet"/>
<script src="{{asset('assets/vendor/jquery/jquery.number.min.js')}}"></script>




<script>

    $(function () {
        $("#itahun").datepicker({
            format: " yyyy",
            viewMode: "years", 
            minViewMode: "years",
            startDate: '-50y',
            endDate: '+0d',
            autoClose: true
        });
        
        $('#iharga').number(true,0);
    });


    
</script>

@endsection