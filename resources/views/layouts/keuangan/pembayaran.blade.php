@extends("tmp.main")

@section('title',$pej->name)

@section('style')
@endsection

@section('sidemenu')

@endsection

@section('content')



<div class="containder-fluid">

    @foreach($data as $k => $v)
        <div class="card mb-3">
            <div class="card-header row d-flex align-items-center justify-content-center">
                <div class="col-md-8">
                    <h3>{{ $v->merk." ".$v->type }}</h3>
                    <span>{{ $v->tahun }}</span>
                </div>
                <div class="col-md-4 text-center">
                    
                </div>                
            </div>
            <div class="card-body row d-flex align-items-center justify-content-center">
                <div class="col-md-8">
                    <table>
                        <tr>
                            <td>Kondisi</td>
                            <td>:</td>
                            <td>{{ $v->kondisi }}</td>
                        </tr>
                        <tr>
                            <td>Harga</td>
                            <td>:</td>
                            <td>Rp.<span class="harga">{{ $v->harga }}</span></td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-4 text-center">
                    <div class="">
                        <button class="btn btn-primary" onclick="{{ $v->id_kwitansi==null ? 'cetakKwitansi('.json_encode($v).',0)' : 'cetakKwitansi('.json_encode($v).',1)' }}">{{ $v->id_kwitansi==null ? 'Kwitansi' : 'Kwitansi (copy)' }}</button>
                        <button class="btn btn-warning" onclick="{{ $v->id_ttBPKB==null ? 'cetakTTbpkb('.json_encode($v).',0)' : 'cetakTTbpkb('.json_encode($v).',1)' }}" >{{ $v->id_ttBPKB==null ? 'TT BPKB' : 'TT BPKB (copy)' }}</button>
                        <button class="btn btn-warning" onclick="{{ $v->id_BAST==null ? 'cetakBAST('.json_encode($v).',0)' : 'cetakBAST('.json_encode($v).',1)' }}" >{{ $v->id_BAST==null ? 'BAST' : 'BAST (copy)' }}</button>
                    </div>
                    @if($v->id_kwitansi!=null && $v->id_ttBPKB!=null && $v->id_BAST!=null)
                        <div class="row">
                            <form action="{{route('bayarBeli')}}" method="post">
                                @csrf
                                @method('PATCH')
                                <input name="id" type="text" value="{{$v->id}}" hidden>
                                <button class="btn text-white" style="background-color: #0d6efd"><i class="material-icons opacity-10 p-3 text-lg">credit_score</i>Selesaikan pembayaran</button>
                            </form>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    @endforeach

</div>
  

@endsection

@section('script')

<script src="{{asset('assets/vendor/jquery/jquery.number.min.js')}}"></script>
<!-- Library Print BAST Kwitansi SPK dll -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/locale/id.min.js"></script>
<script src="{{asset('assets/js/print.js')}}"></script>
<script src="{{asset('assets/js/terbilang.min.js')}}"></script>
<script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>

<script>

    $(function () {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('span.harga').number(true,0);
        
    });

    function cetakKwitansi(x,y) {
        var today = new Date();
        var day = today.getDate();
        var month = today.getMonth() + 1;
        var year = today.getFullYear();

        x.today = moment(today).locale('id').format('DD MMMM YYYY');
        x.untuk = "Pembayaran Mobil";


        if(y==1) {

            $.ajax({
                type: "POST",
                url: "/kwitansi/cetak",
                data: {id:x.id_kwitansi},
                dataType: "json",
                success: function (response) {
                    if(response.status == "success") {

                        console.log(response.res);

                        response.res.nama = "Lestari Mobilindo";
                        response.res.untuk = x.untuk;
                        response.res.terbilang = terbilang(response.res.harga);
                        response.res.jumlah_uang = response.res.harga;
                        response.res.today = x.today;
                        response.res.copy = true;

                        kwitansi(response.res);
                        
                    } else {
                        console.log(response.res);
                    }
                }
            });

        } else {
            $.ajax({
                type: "PATCH",
                url: "{{ route('InKwitansi') }}",
                data: x,
                dataType: "json",
                success: function (response) {
                    if(response.status == "success") {

                        console.log(response.res);

                        response.res.nama = "Lestari Mobilindo";
                        response.res.untuk = x.untuk;
                        response.res.terbilang = terbilang(response.res.harga_beli);
                        response.res.jumlah_uang = response.res.harga_beli;
                        response.res.today = x.today;

                        kwitansi(response.res);

                        location.reload();
                    } else {
                        console.log(response.res);
                    }
                }
            });
        }


    }

    function cetakTTbpkb(x,y) {
        var today = new Date();
        var day = today.getDate();
        var month = today.getMonth() + 1;
        var year = today.getFullYear();

        x.today = moment(today).locale('id').format('DD MMMM YYYY');
        
        if(y==1) {
            $.ajax({
                type: "PATCH",
                url: "{{ route('InTTbpkb') }}",
                data: x,
                dataType: "json",
                success: function (response) {
                    if(response.status == "success") {
                        response.res.tanggal = moment(today).locale('id').format('dddd, DD MMMM YYYY');
                        response.res.copy = true;
                        ttBPKB(response.res);
                    }
                }
            });
        } else {
            $.ajax({
                type: "PATCH",
                url: "{{ route('InTTbpkb') }}",
                data: x,
                dataType: "json",
                success: function (response) {
                    if(response.status == "success") {
                        response.res.today = moment(today).locale('id').format('dddd, DD MMMM YYYY');
                        location.reload();
                        ttBPKB(response.res);
                    }
                }
            });
        }



    }

    function cetakBAST(x,y) {
        var obj = {};

        var today = new Date();
        var day = today.getDate();
        var month = today.getMonth() + 1;
        var year = today.getFullYear();

        x.today = moment(today).locale('id').format('DD MMMM YYYY');
        x.kepada = "Lestari Mobilindo";

        if(y==1) {
            x.copy = true;

            $.ajax({
                type: "POST",
                url: "/bast/cetak",
                data: {id:x.id_BAST},
                dataType: "json",
                success: function (response) {
                    if(response.status == "success") {
                        response.res.today = moment(today).locale('id').format('dddd, DD MMMM YYYY');
                        response.res.copy = true;


                        BAST(response.res);
                    }
                }
            });


        } else {
            $.ajax({
                type: "PATCH",
                url: "{{ route('InBAST') }}",
                data: x,
                dataType: "json",
                success: function (response) {
                    if(response.status == "success") {
                        location.reload();
                    }
                }
            });

            BAST(x);
        }

        
        

    }

</script>

@endsection