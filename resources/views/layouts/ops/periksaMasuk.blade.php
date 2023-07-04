@extends("tmp.main")

@section('title',$pej->name)

@section('style')
@endsection

@section('sidemenu')

@endsection

@section('content')

    @foreach($mobil as $k => $v)
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">{{ $v->merk." ".$v->nama }} <span class="badge bg-primary">{{ $v->tahun }}</span></h4>
                <h6 class="card-subtitle text-muted">{{ $v->nomor_polisi }}</h6>
            </div>
            <div class="card-body row">
                <div class="col-md-10">
                    <table>
                        <th>
                            <td width="10%">Kondisi</td>
                            <td>:</td>
                            <td width="90%" class="ps-3">{{$v->kondisi}}</td>
                        </th>
                    </table>
                </div>
                <div class="col-md-2">
                    <button class="btn btn-warning" onclick="ambil({{json_encode($v)}})">Ambil</button>
                </div>
            </div>
        </div>
    @endforeach
  

<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Ambil Tugas Pemeriksaan</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p>Ambil tugas untuk memeriksa <b><span id="mobil"></span></b> ?</p>
          <p>Setelah mengambil tugas, <b><span id="mobilx"></span></b> akan ada di menu <i><a href="{{route('pemeriksaan')}}" target="_blank">Pemeriksaan</a></i> hingga mobil selesai di periksa.</p>
        </div>
        <div class="modal-footer">
            <form action="{{ route('OPSambil' )}}" method="POST">
                @csrf
                <input type="text" id="iId" name="id" hidden>
                <input type="text" id="iState" name="state" hidden>

                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button class="btn btn-primary">Lanjutkan</button>
            </form>
        </div>
      </div>
    </div>
  </div>


@endsection

@section('script')

<script>
    $(function () {
    });

    function ambil(x) {
        $('#mobil').text(x.merk+" "+x.nama);
        $('#mobilx').text(x.merk+" "+x.nama);

        $('#iId').val(x.id);
        $('#iState').val(x.state);

        $('#staticBackdrop').modal('toggle');
    }

    $('#staticBackdrop').on('hidden.bs.modal', function () {
        $('#mobil').text("");
        $('#mobilx').text("");
        $('#iId').val("");
        $('#iState').val("");
    });

</script>

@endsection