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

    @include("layouts.".\Auth::user()->jabatan.".listSPK" )

@endsection

@section('script')

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

        });

    </script>

    



@endsection
