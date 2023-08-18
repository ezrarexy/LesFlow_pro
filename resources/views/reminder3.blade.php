@extends("tmp.main")

@section('title',$pej->name)

@section('style')
@endsection

@section('sidemenu')

@endsection

@section('content')


    @foreach ($data as $k => $v)
            
        <div class="card mb-3">
            <div class="card-body">
                @if(isset($v->nama_pemilik))
                    <h3 class="card-title">{{$v->merk." ".$v->nama}} <span class="badge bg-secondary">{{$v->nomor_polisi}}</span></h3>
                    <h4>{{$v->nama_pemilik}}</h4>

                    <p>Nomor Polisi : {{$v->nomor_polisi}}</p>
                    <p>Sisa Hari PKB : {{$v->sisa_hari_jt_pkb}} hari ( {{ \Carbon\Carbon::parse($v->jt_pkb)->format('d M Y') }} )</p>
                    <p>Sisa Hari STNK : {{$v->sisa_hari_jt_stnk}} hari ( {{ \Carbon\Carbon::parse($v->jt_stnk)->format('d M Y') }} )</p>

                    <p><b><u>Ingatkan !</u></b></p>
                    <a class="h5 p-3" href="tel:{{ substr_replace($v->telp,"+62",0,1) }}" target="_blank"><i class="fas fa-phone"></i></a>
                    <a class="h5 p-3" href="https://wa.me/{{ substr_replace($v->telp,"62",0,1)}}" target="_blank"><i class="fab fa-whatsapp" style="color: green"></i></a>
                    <a class="h5 p-3" href="https://instagram.com/{{$v->instagram}}" target="_blank"><i class="fab fa-instagram" style="color: red"></i></a>
                    <a class="h5 p-3" href="https://facebook.com/{{$v->facebook}}" target="_blank"><i class="fab fa-facebook" style="color: blue"></i></a>
                @else
                    <h3 class="card-title">{{$v->nama}}</h3>
                    <h4>Lestari Mobilindo</h4>
                    <p>Nomor Polisi : {{$v->nomor_polisi}}</p>
                    <p>Sisa Hari PKB : {{$v->sisa_hari_jt_pkb}} hari ( {{\Carbon\Carbon::parse($v->jt_pkb)->format('d M Y')}} ) </p>
                    <p>Sisa Hari STNK : {{$v->sisa_hari_jt_stnk}} hari ( {{\Carbon\Carbon::parse($v->jt_stnk)->format('d M Y')}} ) </p>
                @endif
            </div>
        </div>

    @endforeach
  

@endsection
