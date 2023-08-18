@extends("tmp.main")

@section('title',$pej->name)

@section('style')
@endsection

@section('sidemenu')

@endsection

@section('content')


    @foreach ($data as $k => $v)

        <div class="card">
            <div class="card-body">
                <h4 class="card-title">{{$v->nama}} <span class="badge bg-info">{{$v->umur}} tahun</span></h4>
                <p><b><u>Berikan Ucapan!</u></b></p>
                <a class="h5 p-3" href="tel:{{ substr_replace($v->telp,"+62",0,1) }}" target="_blank"><i class="fas fa-phone"></i></a>
                <a class="h5 p-3" href="https://wa.me/{{ substr_replace($v->telp,"62",0,1)}}" target="_blank"><i class="fab fa-whatsapp" style="color: green"></i></a>
                <a class="h5 p-3" href="https://instagram.com/{{$v->instagram}}" target="_blank"><i class="fab fa-instagram" style="color: red"></i></a>
                <a class="h5 p-3" href="https://facebook.com/{{$v->facebook}}" target="_blank"><i class="fab fa-facebook" style="color: blue"></i></a>

            </div>
        </div>

    @endforeach

  

@endsection
