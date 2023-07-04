@extends("tmp.main")

@section('title',$pej->name)

@section('style')
    <script src="https://cdn.jsdelivr.net/npm/toastr@2.1.4/build/toastr.min.js"></script>
@endsection

@section('sidemenu')

@endsection

@section('content')

    <div class="section border row p-3">
        <div class="col-md-6">
            <table>
                <tr>
                    <td width="20%">No. Polisi</td>
                    <td>:</td>
                    <td class="ps-3">{{$mobil->nomor_polisi}}</td>
                </tr>
                <tr>
                    <td width="20%">Merk</td>
                    <td>:</td>
                    <td class="ps-3">{{$mobil->merk}}</td>
                </tr>
                <tr>
                    <td width="20%">Type</td>
                    <td>:</td>
                    <td class="ps-3">{{$mobil->nama}}</td>
                </tr>
                <tr>
                    <td width="20%">Transmisi</td>
                    <td>:</td>
                    <td class="ps-3">{{$mobil->transmisi}}</td>
                </tr>
                <tr>
                    <td width="20%">Tahun</td>
                    <td>:</td>
                    <td class="ps-3">{{$mobil->tahun}}</td>
                </tr>
                <tr>
                    <td width="20%">Isi Silinder</td>
                    <td>:</td>
                    <td class="ps-3">{{$mobil->isi_silinder}}</td>
                </tr>
                <tr>
                    <td width="20%">No. Rangka</td>
                    <td>:</td>
                    <td class="ps-3">{{$mobil->nomor_rangka}}</td>
                </tr>
                <tr>
                    <td width="20%">No. Mesin</td>
                    <td>:</td>
                    <td class="ps-3">{{$mobil->nomor_mesin}}</td>
                </tr>
            </table>
        </div>
        <div class="col-md-6">
            <table>
                <tr>
                    <td width="50%">Warna Eksterior/Interior</td>
                    <td>:</td>
                    <td class="ps-3">{{$mobil->warna}} / {{$mobil->warna_interior}}</td>
                </tr>
                <tr>
                    <td width="50%">Bahan Bakar</td>
                    <td>:</td>
                    <td class="ps-3">{{$mobil->bahan_bakar}}</td>
                </tr>
                <tr>
                    <td width="50%">Odometer</td>
                    <td>:</td>
                    <td class="ps-3">{{$mobil->odometer}}</td>
                </tr>
                <tr>
                    <td width="50%">Pajak</td>
                    <td>:</td>
                    <td class="ps-3">{{$mobil->pajak}}</td>
                </tr>
            </table>
        </div>
    </div>

@endsection

@section('script')

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastr@2.1.4/build/toastr.min.css">

<script>
    $(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    });

</script>

@endsection