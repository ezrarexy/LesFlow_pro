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
        <div class="card-body">
            <h4 class="card-title"></h4>
            <table id="TdataT" class="table table-stripped justify-content-center">
                <thead>
                    <tr>
                        <th>Nama Pemesan</th>
                        <th>Mobil</th>
                        <th>Harga</th>
                        <th>Status</th>
                        <th>Tanggal</th>
                        <th>Tindakan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($prospek as $k => $v)
                        <tr>
                            <td>{{$v->pemesan}}</td>
                            <td>{{$v->merk." ".$v->type}}</td>
                            <td>{{$v->harga}}</td>
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
                                @elseif ($v->node==5)
                                    <button class="btn btn-secondary">Ganti Metode Bayar</button>
                                    <button class="btn btn-primary">Batalkan</button>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>        



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
