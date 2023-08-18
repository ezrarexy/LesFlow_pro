@extends("tmp.main")

@section('title',$pej->name)

@section('style')
@endsection

@section('sidemenu')

@endsection

@section('content')

    <div class="d-flex align-items-end justify-content-end pe-5">
        <button class="btn btn-secondary float-right me-5" id="addUser"><i class="material-icons opacity-10">person_add</i> Tambah</button>
    </div>
    <table class="table table-stripped" id="tableList">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Tanggal</th>
                <th>Agama</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $k => $v)
                <tr>
                    <td>{{$v->nama}}</td>
                    <td>{{ \Carbon\Carbon::parse($v->tanggal)->format('d M Y')}}</td>
                    <td class="text-capitalized">{{$v->agama}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>  


<!-- Modal Tambah Hari Raya-->
<div class="modal fade" id="modalTambahUser" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalTambahUserLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="modalTambahUserLabel">Tambah Hari Raya</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="form1">
            <div class="mb-3"><label for="iNama">Nama</label><input class="form-control border" type="text" name="nama" id="iNama"></div>
            <div class="mb-3">
                <label for="iAgama">Agama</label>
                <select class="form-select" name="id_agama" id="iAgama">
                    <option value="" selected disabled>=== Pilih Agama ===</option>
                    @foreach ($agama as $k => $v)
                        <option value="{{$v->id}}">{{$v->nama}}</option>                        
                    @endforeach
                </select>
            </div>
            <div class="mb-3"><label for="iTanggal"></label><input name="tanggal" type="date" id="iTanggal" class="form-control"  /></div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="button" class="btn btn-primary" onclick="submitRaya()" id="submitButton">Tambah</button>
        </div>
      </div>
    </div>
  </div>


@endsection

@section('script')

<script src="{{asset('assets/vendor/jquery/jquery.number.min.js')}}"></script>
<script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/toastr@2.1.4/build/toastr.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.8/ScrollMagic.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.9.1/gsap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.8/plugins/animation.gsap.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.7/dist/loadingoverlay.min.js"></script>

<script>

    $(function () {
        $('span.harga').number(true,0);

        $('.telp').number(true,0)

        $('#tableList').DataTable();

        function getTanggalHariIni() {
            var today = new Date();
            var dd = today.getDate();
            var mm = today.getMonth() + 1;
            var yyyy = today.getFullYear();

            if (dd < 10) {
                dd = '0' + dd;
            }
            if (mm < 10) {
                mm = '0' + mm;
            }

            return yyyy + '-' + mm + '-' + dd;
        }

        $('#iTanggal').attr('min', getTanggalHariIni());


    });

    $('#addUser').on('click', () => {
        $('#modalTambahUser').modal('show');
    });

    $('#modalTambahUser').on('hidden.bs.modal', function () {
        $('#form1')[0].reset();
        $('#submitButton').attr('disabled',true);
    })

    function submitRaya() {
        var form = $("#form1");
        var data = {};
        var status = true;

        // Ambil nilai dari input dan tambahkan ke dalam objek JSON
        $(form).find("input").each(function() {
            data[$(this).attr("name")] = $(this).val();
        });

        // Ambil nilai dari select option dan tambahkan ke dalam objek JSON
        $(form).find("select").each(function() {
            data[$(this).attr("name")] = $(this).val();
        });

        $.each(data, function (i, v) { 
            if (v=="" || v==null) {
                status = false;
            }
        });

        if (status) {
            $.LoadingOverlay("show");

            $.ajax({
                type: "POST",
                url: "/raya/add",
                data: data,
                dataType: "json",
                success: function (response) {
                    if (response.status=="success") {
                        toastr.success('Hari Raya Berhasil Ditambahkan!')
                        $.LoadingOverlay("hide");
                        location.reload();
                    } else {
                        $.LoadingOverlay("hide");
                        console.log(response.res);
                        toastr.error(response.res.errorInfo[2]);
                    }
                }
            });


        } else {
            toastr.error('Lengkapi form terlebih dahulu!');
        }




    }

</script>

@endsection