@extends("tmp.main")

@section('title',$pej->name)

@section('style')
@endsection

@section('sidemenu')

@endsection

@section('content')

{{-- Form pilih mobil --}}
<div id="step1" class="step">

  <div class="col-md-12">
    <h2>Detail Mobil</h2>
    <form id="formDetailBarang">
      <div class="mb-3">
        <select name="merk" id="iMerk" class="form-select" required>
          <option selected disabled>=== Pilih Merk ===</option> 
          @foreach ($merk as $k => $v)
            <option value="{{$v->id}}">{{$v->nama}}</option>      
          @endforeach
        </select>
      </div>
      <div class="mb-3">
        <select name="type" id="iType" class="form-select" disabled required>
          <option selected disabled>=== Pilih Merk ===</option>
        </select>
      </div>
      <div class="mb-3 d-none p-3 border border-3 -circle" id="divHargaJ">
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
      <button type="button" class="btn btn-primary" id="nextButton" disabled onclick="nextStep()">Next</button>
    </form>
  </div>
</div>


{{-- Form data pembeli --}}
<div id="step2" class="step" style="display: none;">
  <h2>Data Pembeli</h2>
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
    <button type="button" class="btn btn-secondary" onclick="previousStep()">Kembali</button>
    <button type="button" class="btn btn-primary" id="submitButton" disabled onclick="submitForm()">Submit</button>
  </form>
</div>



{{-- Modal menuju SPK --}}
<div class="modal fade" id="modal1" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal1Label" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="modal1Label">Lanjutkan ke SPK</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
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
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Harga nego akan diajukan kepada <b>Manager</b>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button type="button" class="btn btn-primary">Prses</button>
      </div>
    </div>
  </div>
</div>


@endsection

@section('script')

  <script src="{{asset('assets/vendor/jquery/jquery.number.min.js')}}"></script>

  <script>

    var BellowBottom = false;

    $(document).ready(function() {
      // Token
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

      $('#iHarga').number(true,0);

    });


      // ========================== Listener ==============================
    $("#iType").on("change", function(x) {

      $('#harga').text($("#iType").find(':selected').data('harga'));

      $('#warna').text($("#iType").find(':selected').data('warna'));

      $('#transmisi').text($("#iType").find(':selected').data('transmisi'));

      $('#tahun').text($("#iType").find(':selected').data('tahun'));

      $('#bottom').text($("#iType").find(':selected').data('bottom'));

      $('#sBottom').val($("#iType").find(':selected').data('bottom'));

      $('#harga').number(true,0);

      $('#bottom').number(true,0);

      $('#divHargaJ').removeClass('d-none');

      validateFormDetailBarang();
    });

    $("#namaPembeli, #alamatPembeli, #kontakPembeli").on("input", function() {
    validateFormDataPembeli();
    });

    $("#customerLamaSelect").on("change", function() {
    validateFormDataPembeli();
    });


    $('#iMerk').on('change',() => {
      $('#divHargaJ').addClass('d-none');
      $('#Nego').prop('checked',false);
      $("#divNego").addClass('d-none');
      $('#divHarga').hide();
      $('#iHarga').val("");

      var id = $('#iMerk').val();

      var data = {};
      data.id = id;

      $.ajax({
        type: "POST",
        url: "/getMobil",
        data: data,
        dataType: "json",
        success: function (response) {
          if (response.status=="success") {
            $('#iType').empty();
            if (response.res.length > 0) {
              $('#iType').append("<option selected disabled>=== Pilih Type ===</option>");
              $.each(response.res, function (i, v) { 
                $('#iType').append("<option value='"+v.id+"' data-bottom='"+v.harga_bottom+"' data-harga='"+v.harga_jual+"' data-warna='"+v.warna+"' data-tahun='"+v.tahun+"' data-transmisi='"+v.transmisi+"' >"+v.nama+" - "+v.nomor_polisi+"</option>");
              });
              $('#iType').attr('disabled',false);
            } else {
              $('#iType').append("<option value=''>=== Tidak ada stock mobil ===</option>");
              $('#iType').attr('disabled',true);
              validateFormDetailBarang();
            }
          }
        }
      });

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
      var merk = $("#iMerk").val();
      var type = $("#iType").val();

      if (merk && type) {
        if ($("#Nego").is(":checked")) {
          if ($('#iHarga').val()) {
            $("#nextButton").prop("disabled", false);
          } else {
            $("#nextButton").prop("disabled", true);
          }
        } else {
          $("#nextButton").prop("disabled", false);
        }
        
      } else {
        $("#nextButton").prop("disabled", true);
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
      $("#step1").hide();
      $("#step2").show();
    }

    function previousStep() {
      $("#step2").hide();
      $("#step1").show();
    }

    function submitForm() {

      if (BellowBottom) {
        $('#modal2').modal('show');
      } else {
        $('#modal1').modal('show');
      }

    }

    function goSPK() {
      var data = {};
      data.id_mobil = $("#iType").val();
      data.nego = $("#iHarga").val();

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
          if (response.status) {
            toastr.success(response.res);
            $('#idSPK').val(response.res.id_spk);
            $('#idJual').val(response.res.id_jual);
            $('#formSPK').submit();
          } else {
            toastr.error(response.res);
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
            toastr.success("   ");
          } else {
            toastr.error(response.res);
          }
        }
      });
    }

  </script>


@endsection
