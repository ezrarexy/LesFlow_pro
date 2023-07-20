@extends("tmp.main")

@section('title',$pej->name)

@section('style')

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">

@endsection

@section('sidemenu')

@endsection

@section('content')

    @foreach ($data as $k => $v)

        <div class="card">
            <div class="card-header">
                <h4 class="card-title">{{ $v->merk." ".$v->nama }} <span class="badge bg-danger">{{$v->tahun}}</span></h4>
                <p class="card-text">{{$v->nomor_polisi}}</p>
            </div>
            <div class="card-body row">
                <div class="col-md-10">
                    <table>
                        <th>
                            <tr>
                                <td width="10%">Nama Pemakai</td>
                                <td>:</td>
                                <td width="90%" class="ps-3">{{$v->nama_pemakai}}</td>
                            </tr>
                            <tr>
                                <td width="10%">Alamat</td>
                                <td>:</td>
                                <td width="90%" class="ps-3">{{$v->alamat}}</td>
                            </tr>
                            <tr>
                                <td width="10%">Kontak</td>
                                <td>:</td>
                                <td width="90%" class="ps-3">
                                    <a href="https://wa.me/{{$v->telp}}" target="_blank" class="btn" style="background-color: #2cd46b; color: white"><i class="fa-brands fa-whatsapp fa-fade"></i> Whatsapp</a>
                                    <a href="tel:{{$v->telp}}" class="btn bg-secondary text-white">Telpon</a>
                                </td>
                            </tr>
                        </th>
                    </table>
                </div>
                <div class="col-md-2">
                    @if ($v->node == 7 && $v->id_bast == null)
                        <button class="btn text-white" style="background-color: #198754" onclick="reqBAST({{ json_encode($v) }})">Cetak BAST</button>
                    @else
                        <button class="btn text-white" style="background-color: #0d6efd" onclick="cetakBAST({{$v->id_bast}})">Cetak BAST</button>
                        <button class="btn text-white" style="background-color: #198754" onclick="selesaiDO({{$v->id_jual}})">Selesai Antar</button>
                    @endif
                </div>
            </div>
        </div>

    @endforeach


    <!-- Modal input BAST -->
    <div class="modal fade" id="modalBAST" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalBASTLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h1 class="modal-title fs-5" id="modalBASTLabel">Cetak BAST</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <form id="formBAST">
                <input type="text" name="id" id="idJual" hidden/>
                <div class="mb-3">
                    <label for="iKepada">Kepada</label>
                    <input type="text" class="form-control border" name="kepada" id="iKepada"/>
                </div>
                <h5>Perlengkapan</h5>
                <div class="form-check form-switch">
                    <input class="form-check-input" name="chSTNK" type="checkbox" role="switch" id="stnkAsli">
                    <label class="form-check-label" for="stnkAsli">STNK Asli</label>
                </div>
                <div class="form-check form-switch">
                    <input class="form-check-input" name="chBan" type="checkbox" role="switch" id="banSerep">
                    <label class="form-check-label" for="banSerep">Ban Serep</label>
                </div>
                <div class="form-check form-switch">
                    <input class="form-check-input" name="chDgrk" type="checkbox" role="switch" id="dongkrak">
                    <label class="form-check-label" for="dongkrak">Dongkrak</label>
                </div>
                <div class="form-check form-switch">
                    <input class="form-check-input" name="chKeyRod" type="checkbox" role="switch" id="kunciRoda">
                    <label class="form-check-label" for="kunciRoda">Kunci Roda</label>
                </div>
                <div class="mb-3">
                    <label for="iSyarat">Syarat Pembayaran</label>
                    <textarea type="text" class="form-control border" name="syarat" id="iSyarat"></textarea>
                </div>
            </form>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            <button type="button" class="btn btn-primary" onclick="submitBAST()">Proses</button>
            </div>
        </div>
        </div>
    </div>


    <!-- Modal Selesaikan DO -->
    <div class="modal fade" id="modalFinishDO" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalFinishDOLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h1 class="modal-title fs-5" id="modalFinishDOLabel">Selesaikan Pengantaran</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formFinishDO" class="text-center" enctype="multipart/form-data">
                    <input type="text" name="id" id="id_jual2" hidden />
                    <div>
                        <img src="{{asset('assets/img/upload.svg')}}" id="imgEle" class="w-80" alt="" srcset="">
                    </div>
                    <span id="buktiAntarLabel">Foto Bukti Antar</span>
                    <input type="file" name="foto" id="foto" accept="image/*" hidden/>
                </form>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            <button type="button" class="btn btn-primary" id="btnFinish" onclick="finishing()" disabled>Selesai</button>
            </div>
        </div>
        </div>
    </div>
    


@endsection



@section('script')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/locale/id.min.js"></script>
    <script src="{{asset('assets/js/print.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

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
        });

        function reqBAST(x) {
            $('#idJual').val(x.id_jual);


            $('#modalBAST').modal('show');
            
        }

        function submitBAST() {
            var formData = parseQueryString($('#formBAST').serialize());

            $.each(formData, function (i, v) { 
                if (v == "") {
                    toastr.error('Lenkapi Form!');
                    return false;
                }
            });

            var date = new Date();

            formData.tanggal = moment(date).locale('id').format('DD MMMM YYYY');

            console.log(formData);

            $.ajax({
                type: "POST",
                url: "/bast/input",
                data: formData,
                dataType: "json",
                success: function (response) {
                    if (response.status=='success') {
                        
                        var tanggalMoment = moment(response.res.tanggal, "DD MMMM YYYY").locale('id');
                        response.res.today = tanggalMoment.format("dddd")+", "+response.res.tanggal;

                        BAST(response.res);

                        location.reload()

                    } else {
                        console.log(response.res)
                    }
                }
            });



        }


        function cetakBAST(x) {
            $.LoadingOverlay("show");
            $.ajax({
                type: "POST",
                url: "/bast/cetak",
                data: {id:x},
                dataType: "json",
                success: function (response) {
                    if (response.status=='success') {
                        var tanggalMoment = moment(response.res.tanggal, "DD MMMM YYYY").locale('id');
                        response.res.today = tanggalMoment.format("dddd")+", "+response.res.tanggal;

                        $.LoadingOverlay("hide");

                        BAST(response.res);
                    } else {
                        console.log(response.res)
                    }
                }
            });
        }

        function selesaiDO(x) {
            $('#modalFinishDO').modal('show');
            $('#id_jual2').val(x);
            console.log(x);
        }


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

        function finishing() {
            $.LoadingOverlay("show");

            var formData = new FormData($("#formFinishDO")[0]); // Menggunakan FormData untuk mengumpulkan data form termasuk file

            $.ajax({
                type: "POST", 
                url: "/delivered",
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

        $('#modalFinishDO').on('hidden.bs.modal', function () {
            $("#imgEle").attr("src", '/assets/img/upload.svg');

            $('#buktiAntarLabel').removeClass('d-none');

            $('#btnFinish').prop('disabled',true);
        })

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
