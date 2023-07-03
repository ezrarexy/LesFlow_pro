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
            <div class="card-header">
                <h3>{{ $v->merk." ".$v->type }}</h3>
            </div>
            <div class="card-body row d-flex align-items-center justify-content-center">
                <div class="col-md-10">
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
                <div class="col-md-2">
                    <form action="{{ $pej->link=='/konfirmasi/beli' ? route('konfirmasiB') : route('konfirmasiJ') }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <input type="text" name="id" value="{{$v->id}}" hidden>
                        <input type="text" name="val" value="2" hidden>
                        <button class="btn text-white" style="background-color: #0d6efd">Setuju</button>
                    </form>
                    <form action="{{ $pej->link=='/konfirmasi/beli' ? route('konfirmasiB') : route('konfirmasiJ') }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <input type="text" name="id" value="{{$v->id}}" hidden>
                        <input type="text" name="val" value="4" hidden>
                        <button class="btn btn-danger">Tolak</button>
                    </form>
                </div>
            </div>
        </div>
    @endforeach

</div>
  

@endsection

@section('script')

<script src="{{asset('assets/vendor/jquery/jquery.number.min.js')}}"></script>

<script>

    $(function () {
        $('span.harga').number(true,0);       
    });


</script>

@endsection