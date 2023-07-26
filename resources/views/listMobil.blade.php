@extends("tmp.main")

@section('title',$pej->name)


@section('sidemenu')

@endsection



@include("layouts.".\Auth::user()->jabatan.".mobil" )
  


