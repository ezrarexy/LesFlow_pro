@extends("tmp.main")

@section('title',$pej->name)

@section('style')
@endsection

@section('sidemenu')

@endsection

@section('content')


    @include("layouts.".\Auth::user()->jabatan.".index" )
  

@endsection
