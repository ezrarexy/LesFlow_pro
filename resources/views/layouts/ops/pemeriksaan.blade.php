@extends("tmp.main")

@section('title',$pej->name)

@section('style')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastr@2.1.4/build/toastr.min.css">
@endsection

@section('sidemenu')

@endsection

@section('content')

        @foreach ($mobil as $k => $v)


            @php
                $status = $v->state==9 ? '<span data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="QC Keluar"><i class="material-icons opacity-10">arrow_upward</i></span>' : '<span data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="QC Masuk"><i class="material-icons opacity-10">arrow_downward</i></span>'
            @endphp

            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{ $v->merk." ".$v->nama }} <span class="badge bg-danger">{{$v->tahun}}</span> {!! $status !!} </h4>
                    <p class="card-text">{{$v->nomor_polisi}}</p>
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
                        @if ($v->node == 0)
                            <button class="btn text-white" style="background-color: #198754" onclick="mulai({{ json_encode($v) }})">Mulai</button>
                        @else
                            <form action="{{ $v->status=="reQC" ? route('periksa2') : route('periksa') }}" method="POST">
                                @csrf
                                <input name="id" type="text" value="{{$v->id}}" hidden>
                                <button class="btn text-white" style="background-color: #0d6efd">Lanjutkan</button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>

        @endforeach
    







@endsection


    <!-- Modal -->
    <div class="modal fade" id="inputSisa" tabindex="-1" aria-labelledby="inputSisaLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="inputSisaLabel">Mulai Pemeriksaan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formLengkap">
                        @csrf
                        <input name="id" id="iId" type="text" hidden/>
                        <input name="id_mobil" id="iIdMobil" type="text" hidden/>
                        <div class="mb-3">
                            <label for="iIsiSilinder">Isi Silinder</label>
                            <input type="number" name="isi_silinder" id="iIsiSilinder" class="form-control isian" required/>
                        </div>
                        <div class="mb-3">
                            <label for="iWarnaInterior">Warna Interior</label>
                            <input type="text" name="warna_interior" id="iWarnaInterior" class="form-control isian" required/>
                        </div>
                        <div class="mb-3">
                            <label for="iOdometer">Odometer</label>
                            <input type="number" name="odometer" id="iOdoMeter" class="form-control isian" required/>
                        </div>
                        <div class="mb-3">
                            <label for="iPajak">Pajak</label>
                            <input type="date" name="pajak" id="iPajak" class="form-select isian" required/>
                        </div>
                    </form>
                    <form id="goNext" action="{{route('periksa')}}" method="POST">
                        @csrf
                        <input name="id" type="text" id="iQcId" hidden>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" id="submitForm" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </div>
    </div>


@section('script')

<script src="https://cdn.jsdelivr.net/npm/toastr@2.1.4/build/toastr.min.js"></script>

<script>
    $(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    });

    function mulai(x) {
        $('#iId').val(x.id);
        $('#iQcId').val(x.id);
        $('#iIdMobil').val(x.id_mobil);

        if (x.isi_silinder != null) {
            $('#iIsiSilinder').val(x.isi_silinder);
            $('#iIsiSilinder').prop('readonly', true);
        }
        if (x.warna_interior != null) {
            $('#iWarnaInterior').val(x.warna_interior);
            $('#iWarnaInterior').prop('readonly', true);
        }
        if (x.odometer != null) {
            $('#iOdoMeter').val(x.odometer);
        }
        if (x.pajak != null) {
            $('#iPajak').val(x.pajak);
            $('#iPajak').prop('readonly', true);
        }

        $('#inputSisa').modal('toggle');
        console.log(x);
    }

    $('#inputSisa').on('hidden.bs.modal', function () {
        $('#iId').val("");
        $('#iIdMobil').val("");
        $('#iIsiSilinder').val("");
        $('#iWarnaInterior').val("");
        $('#iOdometer').val("");
        $('#iPajak').val("");
        $("#formLengkap :input").prop("readonly", false);
    })

    $('#submitForm').on('click', function () {
       var allFilled = true;

        $('.isian').each(function() {
            if ($(this).val() === '') {
                allFilled = false;
                return false; // Berhenti dari loop jika ada inputan yang kosong
            }
        });

        if (allFilled) {
            var formData = parseQueryString($('#formLengkap').serialize());

            $.ajax({
                type: "POST",
                url: "{{ route('startPeriksa') }}",
                data: formData,
                dataType: "json",
                success: function (response) {
                    if(response.status == "success") {
                        $('#goNext').submit();
                        toastr.success('Memulai Pemeriksaan . . .')
                    } else {
                        toastr.error(response.err);
                    }
                }
            });
        } else {
            toastr.error('Isi Semua Field!')
        }
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