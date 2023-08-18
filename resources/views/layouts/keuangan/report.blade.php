@extends("tmp.main")

@section('title',$pej->name)

@section('style')

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css">

@endsection

@section('sidemenu')

@endsection

@section('content')

    <div class="card text-start">
      <div class="card-body">
        <h4 class="card-title">Title</h4>
        <div>
            <tr>
                <td class="align-middle">Periode</td>
                <td class="align-middle">:</td>
                <td class="align-middle"> Awal <input type="date" id="date1" class="datepicker" max="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"> - Akhir <input type="date" id="date2" class="datepicker" max="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" disabled /> </td>
                <td class="align-middle"><button class="btn btn-info btn-sm" onclick="getReport()">Tampilkan</button></td>
            </tr>
        </div>
        <div class="collapse" id="reportPart" >
            <table class="table">
                <tr>
                    <td>Penjualan</td>
                    <td>:</td>
                    <td>Rp<span class="nilai" id="dz"></span></td>
                </tr>
                <tr>
                    <td>Pembelian</td>
                    <td>:</td>
                    <td>Rp<span class="nilai" id="dx"></span></td>
                </tr>
                <tr>
                    <td>Perbaikan</td>
                    <td>:</td>
                    <td>Rp<span class="nilai" id="dy"></span></td>
                </tr>
            </table>
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

        $('#date1').on('change', function (e) {
            var x = $(this).val()
            $('#date2').attr('min',x);
            $('#date2').prop('disabled',false);
        });


        function getReport() {
            $.LoadingOverlay("show");

            data = {};
            data.x = $('#date1').val();
            data.y = $('#date2').val();


            $.ajax({
                type: "GET",
                url: "/finance/report/get",
                data: data,
                success: function (response) {
                    if (response.status=='success') {
                        $('#dx').text(response.res.expenses.beli);
                        $('#dy').text(response.res.expenses.bengkel);
                        $('#dz').text(response.res.income.jual);

                        $('.nilai').number(true,0);

                        $('#reportPart').collapse('show');

                        $.LoadingOverlay("hide");
                        console.log(response.res);
                    } else {
                        $.LoadingOverlay("hide");
                        console.log(response.res);
                    }
                },
                error: function (response) {
                    $.LoadingOverlay("hide");
                    console.log(response);
                }
            });

            
        }


    </script>

    



@endsection




