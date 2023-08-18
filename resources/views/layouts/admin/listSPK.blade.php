@php
    $status = ["Pengajuan Nego","Menunggu SPK","Menunggu SPK","Menunggu SPK","Pengajuan Nego Ditolak","Pengajuan Kredit Ditolak","Menunggu Pembayaran","QC Out","Delivery Order","Batal"];
@endphp

@extends("tmp.main")

@section('title',$pej->name)

@section('style')

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css">

@endsection

@section('sidemenu')

@endsection

@section('content')

    <div class="card">
        <div class="card-body" style="overflow-x: auto; white-space:nowrap">
            <h4 class="card-title"></h4>
            <table id="TdataT" class="table table-stripped justify-content-center">
                <thead>
                    <tr>
                        <th>Nama Pemesan</th>
                        <th>Mobil</th>
                        <th>Harga Jadi</th>
                        <th>Status</th>
                        <th>Tanggal</th>
                        <th>Tindakan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($spk as $k => $v)
                        <tr>
                            <td>{{$v->pemesan}}</td>
                            <td>{{$v->merk." ".$v->type}}</td>
                            <td>Rp<span class="harga">{{$v->harga}}</span></td>
                            <td>{{$status[$v->node]}}</td>
                            <td>{{$v->updated_at}}</td>
                            <td>
                                @if ($v->node==1 || $v->node==2 || $v->node==3)
                                    <form action="{{route('spkIn')}}" method="POST">
                                        @csrf
                                        <input type="text" name="id_jual" value="{{$v->id}}" hidden>
                                        <button class="btn btn-danger">SPK</button>
                                    </form>
                                @elseif ($v->node==4)
                                    <button class="btn btn-secondary">Ajukan Ulang</button>
                                    <button class="btn btn-primary">Batalkan</button>
                                @elseif ($v->node==6)
                                    @if ($v->id_kwitansi_uang_spk==null)
                                        <button class="btn btn-secondary" onclick="uangSPK({{$v->id}})">Terima Pembayaran SPK</button>
                                    @else
                                        @switch($v->id_jenis_pembayaran)
                                            @case(1)
                                                <button class="btn btn-info" onclick="accBayar({{$v->id}})">Terima Pembayaran Mobil</button>
                                                @break
                                            @case(2)
                                                <button class="btn btn-info" onclick="accBayar2({{$v->id}})">Terima Pembayaran Leasing</button>
                                                <button class="btn btn-warning" onclick="kreditDitolak({{$v->id}})">Pengajuan Kredit ditolak</button>
                                                @break
                                            @default
                                                
                                        @endswitch
                                    @endif
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>  

    <!-- Modal terima pembayaran SPK -->
    <div class="modal fade" id="uangSPK" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="uangSPKLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h1 class="modal-title fs-5" id="uangSPKLabel">Terima Pembayaran SPK</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formSPK">
                    <input type="text" class="d-none" name="id" id="id_jual"/>
                    <input type="text" class="d-none" name="untuk" value="Uang SPK">
                    <div class="mb-3">
                        <label for="terimaDari">Terima Dari</label>
                        <input type="text" class="form-control border" name="nama" id="terimaDari">
                    </div>
                    <div class="mb-3">
                        <label for="nilai">Sebesar</label>
                        <input type="text" class="form-control border senilai" name="harga" id="nilai">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            <button type="button" class="btn btn-primary" onclick="submitUangSPK()">Submit</button>
            </div>
        </div>
        </div>
    </div>


    <!-- Modal terima pembayaran Mobil -->
    <div class="modal fade" id="uangMobil" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="uangMobilLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h1 class="modal-title fs-5" id="uangMobilLabel">Terima Pembayaran Mobil</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formMobil">
                    <input type="text" class="d-none" name="id" id="id_jual2"/>
                    <div class="mb-3">
                        <label for="terimaDari2">Terima Dari</label>
                        <input type="text" class="form-control border" name="nama" id="terimaDari2">
                    </div>
                    <div class="mb-3">
                        <label for="nilai2">Sebesar</label>
                        <input type="text" class="form-control border senilai" name="harga" id="nilai2">
                    </div>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="sisaBayar" role="switch" id="sisaBayar" />
                        <label class="form-check-label" for="sisaBayar">Sisa</label>
                    </div>
                    <div class="mb-3 row d-none" id="divSisa">
                        <div class="col-md-6">
                            <label for="sisa">Jumlah Sisa</label>
                            <input type="text" class="form-control border senilai" name="sisa" id="sisa">
                        </div>
                        <div class="col-md-6">
                            <label for="tanggal_pelunasan">Tanggal Pelunasan</label>
                            <input type="date" name="pelunasan" id="tanggal_pelunasan" class="form-control">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            <button type="button" class="btn btn-primary" onclick="submitUangMobil()">Submit</button>
            </div>
        </div>
        </div>
    </div>


    <!-- Modal terima pembayaran Mobil Kredit-->
    <div class="modal fade" id="uangMobil2" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="uangMobil2Label" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h1 class="modal-title fs-5" id="uangMobil2Label">Terima Pembayaran Leasing</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formMobil2">
                    <input type="text" class="d-none" name="id" id="id_jual3"/>
                    <div class="mb-3">
                        <label for="terimaDari3">Terima Dari</label>
                        <input type="text" class="form-control border" name="nama" id="terimaDari3">
                    </div>
                    <div class="mb-3">
                        <label for="nilai2">Sebesar</label>
                        <input type="text" class="form-control border senilai" name="harga" id="nilai3">
                    </div>
                    <div class="mb-3">
                        <label for="iKontrak">Nomor Kontrak</label>
                        <input type="text" class="form-control border" name="nomor_kontrak_leasing" id="iKontrak">
                    </div>
                    <div class="mb-3">
                        <label for="iJTKon">Tanggal Jatuh Tempo</label>
                        <input type="date" class="form-control border" name="jt_pembayaran_kredit" id="iJTKredit">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            <button type="button" class="btn btn-primary" onclick="submitUangMobil2()">Submit</button>
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

    <script>

        $(document).ready(function() {
            // Token
            $.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#TdataT').DataTable();
            $('.harga').number(true, 0);

        });

        $('.senilai').on('keyup', function (e) {
            $(this).number(true,0);
        });
       

        function uangSPK(x) {
            $('#id_jual').val(x);
            $('#uangSPK').modal('show');
        }

        function accBayar(x) {
            $('#id_jual2').val(x);
            $('#uangMobil').modal('show');
        }

        function accBayar2(x) {
            $('#id_jual3').val(x);
            $('#uangMobil2').modal('show');
        }

        $('#uangSPK').on('hidden.bs.modal', function () {
            $('#formSPK')[0].reset();
        });

        $('#uangMobil').on('hidden.bs.modal', function () {
            $('#formMobil')[0].reset();
            $('#divSisa').removeClass('d-none');
            $('#divSisa').addClass('d-none');
        });

        $('#uangMobil2').on('hidden.bs.modal', function () {
            $('#formMobil2')[0].reset();
        });


        $('#sisaBayar').on('change', function() {
            if ($(this).is(':checked')) {
                $('#divSisa').removeClass('d-none');
            } else {
                $('#divSisa').addClass('d-none');
            }

        });

        function submitUangSPK() {
            if ($('#terimaDari').val() !== "" && $('#nilai').val() !== "") {
                var data = {};
                var today = new Date();
                var day = today.getDate();
                var month = today.getMonth() + 1;
                var year = today.getFullYear();

                // Menggunakan metode serializeArray() untuk mendapatkan semua input dalam formulir
                var formInputs = $('#formSPK').serializeArray();

                // Melakukan iterasi melalui setiap input dalam formulir
                $.each(formInputs, function(index, input) {
                    data[input.name] = input.value; // Menambahkan nilai input ke objek formData
                });

                data.tanggal = moment(today).locale('id').format('DD MMMM YYYY');

                console.log(data);


                $.ajax({
                    type: "POST",
                    url: "/spk/uangSPK",
                    data: data,
                    dataType: "json",
                    success: function (response) {
                        if (response.status == "success") {

                            today = moment(today).locale('id').format('dddd, DD MMMM YYYY');

                            console.log(response.data);

                            console.log('harga jadi : '+response.data.harga_jadi);

                            response.data.nama = $('#terimaDari').val();
                            response.data.untuk = "Pembayaran SPK";
                            response.data.terbilang = terbilang(response.data.harga_jadi);
                            response.data.jumlah_uang = response.data.uang_spk;
                            response.data.today = today;

                            kwitansi(response.data);

                            location.reload();
                        } else {
                            console.log(response.data);
                        }
                    }
                });




            } else {
                alert("Lengkapi form!");
            }


        }
        
        function submitUangMobil() {
            var data = {};
            var today = new Date();
            var day = today.getDate();
            var month = today.getMonth() + 1;
            var year = today.getFullYear();

            

            if ($('#terimaDari2').val() !== "" && $('#nilai2').val() !== "") {

                // Menggunakan metode serializeArray() untuk mendapatkan semua input dalam formulir
                var formInputs = $('#formMobil').serializeArray();

                // Melakukan iterasi melalui setiap input dalam formulir
                $.each(formInputs, function(index, input) {
                    data[input.name] = input.value; // Menambahkan nilai input ke objek formData
                });

                data.tanggal = moment(today).locale('id').format('DD MMMM YYYY');

                console.log(data);

            } else {
                alert("Lengkapi form!");
                return false;
            }

            if ($('#sisaBayar').is(':checked')) {
                if ($('#sisa').val() !== "" && $('#tanggal_pelunasan').val() !== "") {
                    data.sisa = $('#sisa').val();
                    data.pelunasan = $('#tanggal_pelunasan').val();
                }
            } 

            data.untuk = "Pembayaran Mobil";

                $.ajax({
                    type: "POST",
                    url: "/spk/uangMobil",
                    data: data,
                    dataType: "json",
                    success: function (response) {
                        if (response.status == "success") {

                            today = moment(today).locale('id').format('dddd, DD MMMM YYYY');

                            console.log(response.data);

                            console.log('harga jadi : '+response.data.harga_jadi);

                            response.data.nama = $('#terimaDari2').val();
                            response.data.untuk = "Pembayaran Mobil";
                            response.data.terbilang = terbilang(data.harga);
                            response.data.jumlah_uang = data.harga;
                            response.data.today = today;

                            if ($('#sisaBayar').is(':checked')) {
                                if ($('#sisa').val() !== "" && $('#tanggal_pelunasan').val() !== "") {
                                    response.data.sisa = $('#sisa').val();
                                    response.data.pelunasan = $('#tanggal_pelunasan').val();
                                }
                            } 

                            kwitansi(response.data);

                            location.reload();
                        } else {
                            console.log(response.data);
                        }
                    }
                });

        }


        function submitUangMobil2() {
            var data = {};
            var today = new Date();
            var day = today.getDate();
            var month = today.getMonth() + 1;
            var year = today.getFullYear();

            

            if ($('#terimaDari3').val() !== "" && $('#nilai3').val() !== "" && $('#iKontrak').val() !== "" && $('#iJTKredit').val() !== "") {

                // Menggunakan metode serializeArray() untuk mendapatkan semua input dalam formulir
                var formInputs = $('#formMobil2').serializeArray();

                // Melakukan iterasi melalui setiap input dalam formulir
                $.each(formInputs, function(index, input) {
                    data[input.name] = input.value; // Menambahkan nilai input ke objek formData
                });

                data.tanggal = moment(today).locale('id').format('DD MMMM YYYY');

                console.log(data);

            } else {
                alert("Lengkapi form!");
                return false;
            }

            data.untuk = "Pembayaran Mobil dari Leasing";

                $.ajax({
                    type: "POST",
                    url: "/spk/uangMobil2",
                    data: data,
                    dataType: "json",
                    success: function (response) {
                        if (response.status == "success") {

                            today = moment(today).locale('id').format('dddd, DD MMMM YYYY');

                            console.log(response.data);

                            console.log('harga jadi : '+response.data.harga_jadi);

                            response.data.nama = $('#terimaDari2').val();
                            response.data.untuk = "Pembayaran Mobil";
                            response.data.terbilang = terbilang(data.harga);
                            response.data.jumlah_uang = data.harga;
                            response.data.today = today;

                            kwitansi(response.data);

                            location.reload();
                        } else {
                            console.log(response.data);
                        }
                    }
                });

        }


    </script>

    



@endsection




