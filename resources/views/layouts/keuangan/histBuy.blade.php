@extends("tmp.main")

@section('title',$pej->name)

@section('style')

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css">

@endsection

@section('sidemenu')

@endsection

@section('content')

  <table class="table" id="tblData">
    <thead>
      <th>Penjual</th>
      <th>Merk</th>
      <th>Type</th>
      <th>Harga</th>
      <th>Kondisi</th>
      <th>Tanggal</th>
    </thead>
    <tbody>
      @foreach ($data as $k => $v)
        <tr>
          <td>{{$v->penjual}}</td>
          <td>{{$v->merk}}</td>
          <td>{{$v->type}}</td>
          <td>Rp<span class="harga">{{$v->harga_beli}}</span></td>
          <td>{{$v->kondisi}}</td>
          <td>{{date('d M Y',strtotime($v->tanggal_beli))}}</td>
        </tr>          
      @endforeach
    </tbody>
  </table>

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
      $(function () {
        $('#tblData').dataTable();

        $('.harga').number(true,0);
      });


    </script>

    



@endsection




