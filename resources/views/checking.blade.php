<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <title>Document</title>
</head>
<body>
    <h3 class="ms-3 mt-2"></h3>
    <h5 class="ms-3">Tanggal masuk :</h5>
    <br>

    {{-- progress bar --}}
    @include('components.progressbar')

    {{-- container --}}
    <form method="POST" action="/show">
        {{-- CSRF Token --}}
        @csrf 
        <div id="page1" class="page">
            {{-- DOKUMEN --}}
            <div class="container" style="margin-top: 100px">
                <div class="row">
                    <div class="col-6 fw-bold py-2">DOKUMEN</div>
                    <div class="col-3 fw-bold text-center py-2">ADA</div>
                    <div class="col-3 fw-bold text-center py-2">TIDAK ADA</div>
                </div>
                {{-- STNK --}}
                <div class="row">
                    <div class="col-6 py-2 bg-danger text-white">STNK</div>
                    <div class="col-3 text-center py-2 bg-danger">
                        <input class="form-check-input" type="radio" name="stnk" value="ada">
                    </div>
                    <div class="col-3 text-center py-2 bg-danger">
                        <input class="form-check-input" type="radio" name="stnk" value="tidak">
                    </div>
                </div>
                {{-- BPKB --}}
                <div class="row">
                    <div class="col-6 py-2">BPKB</div>
                    <div class="col-3 text-center py-2">
                        <input class="form-check-input" type="radio" name="bpkb" value="ada">
                    </div>
                    <div class="col-3 text-center py-2">
                        <input class="form-check-input" type="radio" name="bpkb" value="tidak">
                    </div>
                </div>
                {{-- FAKTUR --}}
                <div class="row">
                    <div class="col-6 py-2 bg-danger text-white">FAKTUR</div>
                    <div class="col-3 text-center py-2 bg-danger">
                        <input class="form-check-input" type="radio" name="faktur" value="ada">
                    </div>
                    <div class="col-3 text-center py-2 bg-danger">
                        <input class="form-check-input" type="radio" name="faktur" value="tidak">
                    </div>
                </div>
                {{-- CEK FISI --}}
                <div class="row">
                    <div class="col-6 py-2">CEK FISI</div>
                    <div class="col-3 text-center py-2">
                        <input class="form-check-input" type="radio" name="cekFisi" value="ada">
                    </div>
                    <div class="col-3 text-center py-2">
                        <input class="form-check-input" type="radio" name="cekFisi" value="tidak">
                    </div>
                </div>
                {{-- BUKU MANUAL --}}
                <div class="row">
                    <div class="col-6 py-2 bg-danger text-white">BUKU MANUAL</div>
                    <div class="col-3 text-center py-2 bg-danger">
                        <input class="form-check-input" type="radio" name="bukuManual" value="ada">
                    </div>
                    <div class="col-3 text-center py-2 bg-danger">
                        <input class="form-check-input" type="radio" name="bukuManual" value="tidak">
                    </div>
                </div>
                {{-- CATATAN --}}
                <div class="row">
                    <div class="col-6 py-2">CATATAN</div>
                    <div class="col-6 text-center pt-1">
                        <input class="form-control form-control-sm" type="text" placeholder="isi disini" name="catatanDokumen">
                    </div>
                </div>
            </div>

            {{-- KELENGKAPAN --}}
            <div class="container" style="margin-top: 50px">
                <div class="row">
                    <div class="col-6 fw-bold py-2">KELENGKAPAN</div>
                    <div class="col-3 fw-bold text-center py-2">ADA</div>
                    <div class="col-3 fw-bold text-center py-2">TIDAK ADA</div>
                </div>
                {{-- KUNCI SEREP --}}
                <div class="row">
                    <div class="col-6 py-2 bg-danger text-white">KUNCI SEREP</div>
                    <div class="col-3 text-center py-2 bg-danger">
                        <input class="form-check-input" type="radio" name="kunciSerep" value="ada">
                    </div>
                    <div class="col-3 text-center py-2 bg-danger">
                        <input class="form-check-input" type="radio" name="kunciSerep" value="tidak">
                    </div>
                </div>
                {{-- DONGKRAK --}}
                <div class="row">
                    <div class="col-6 py-2">DONGKRAK</div>
                    <div class="col-3 text-center py-2">
                        <input class="form-check-input" type="radio" name="dongkrak" value="ada">
                    </div>
                    <div class="col-3 text-center py-2">
                        <input class="form-check-input" type="radio" name="dongkrak" value="tidak">
                    </div>
                </div>
                {{-- KUNCI RODA --}}
                <div class="row">
                    <div class="col-6 py-2 bg-danger text-white">KUNCI RODA</div>
                    <div class="col-3 text-center py-2 bg-danger">
                        <input class="form-check-input" type="radio" name="kunciRoda" value="ada">
                    </div>
                    <div class="col-3 text-center py-2 bg-danger">
                        <input class="form-check-input" type="radio" name="kunciRoda" value="tidak">
                    </div>
                </div>
                {{-- DEREK --}}
                <div class="row">
                    <div class="col-6 py-2">DEREK</div>
                    <div class="col-3 text-center py-2">
                        <input class="form-check-input" type="radio" name="derek" value="ada">
                    </div>
                    <div class="col-3 text-center py-2">
                        <input class="form-check-input" type="radio" name="derek" value="tidak">
                    </div>
                </div>
                {{-- BAN SEREP --}}
                <div class="row">
                    <div class="col-6 py-2 bg-danger text-white">BAN SEREP</div>
                    <div class="col-3 text-center py-2 bg-danger">
                        <input class="form-check-input" type="radio" name="banSerep" value="ada">
                    </div>
                    <div class="col-3 text-center py-2 bg-danger">
                        <input class="form-check-input" type="radio" name="banSerep" value="tidak">
                    </div>
                </div>
                {{-- PUTARAN DONGKRAK --}}
                <div class="row">
                    <div class="col-6 py-2">PUTARAN DONGKRAK</div>
                    <div class="col-3 text-center py-2">
                        <input class="form-check-input" type="radio" name="putaranDongkrak" value="ada">
                    </div>
                    <div class="col-3 text-center py-2">
                        <input class="form-check-input" type="radio" name="putaranDongkrak" value="tidak">
                    </div>
                </div>
                {{-- CATATAN --}}
                <div class="row">
                    <div class="col-6 py-2 bg-danger text-white">CATATAN</div>
                    <div class="col-6 text-center pt-1 bg-danger">
                        <input class="form-control form-control-sm" type="text" placeholder="isi disini" name="catatanKelengkapan">
                    </div>
                </div>
            </div>
            
            {{-- KACA DAN LAMPU --}}
            <div class="container" style="margin-top: 50px">
                <div class="row">
                    <div class="col-5 fw-bold py-2">KACA DAN LAMPU</div>
                    <div class="col-2 fw-bold text-center py-2">ADA</div>
                    <div class="col-2 fw-bold text-center py-2">TIDAK ADA</div>
                    <div class="col-3 fw-bold text-center py-2">FILE</div>
                </div>
                {{-- KACA DEPAN --}}
                <div class="row">
                    <div class="col-5 py-2 bg-danger text-white">KACA DEPAN</div>
                    <div class="col-2 text-center py-2 bg-danger">
                        <input type="radio" class="form-check-input inputFile" name="kacaDepan" value="ada">
                    </div>
                    <div class="col-2 text-center py-2 bg-danger">
                        <input type="radio" class="form-check-input inputFile" name="kacaDepan" value="tidak">
                    </div>
                    <div class="col-3 text-center pt-1 bg-danger">
                        <input class="form-control form-control-sm" type="file" name="kacaDepanFile" id="kacaDepanFile" hidden>
                    </div>
                </div>
                {{-- PELIPIT PINTU --}}
                <div class="row">
                    <div class="col-5 py-2">PELIPIT PINTU</div>
                    <div class="col-2 text-center py-2">
                        <input type="radio" class="form-check-input inputFile" name="pelipitPintu" value="ada">
                    </div>
                    <div class="col-2 text-center py-2">
                        <input type="radio" class="form-check-input inputFile" name="pelipitPintu" value="tidak">
                    </div>
                    <div class="col-3 text-center pt-1">
                        <input class="form-control form-control-sm" type="file" name="pelipitPintuFile" id="pelipitPintuFile" hidden>
                    </div>
                </div>
                {{-- DAUN WIPER DEPAN --}}
                <div class="row">
                    <div class="col-5 py-2 bg-danger text-white">DAUN WIPER DEPAN</div>
                    <div class="col-2 text-center py-2 bg-danger">
                        <input type="radio" class="form-check-input inputFile" name="daunWiperDepan" value="ada">
                    </div>
                    <div class="col-2 text-center py-2 bg-danger">
                        <input type="radio" class="form-check-input inputFile" name="daunWiperDepan" value="tidak">
                    </div>
                    <div class="col-3 text-center pt-1 bg-danger">
                        <input class="form-control form-control-sm" type="file" name="daunWiperDepanFile" id="daunWiperDepanFile" hidden>
                    </div>
                </div>
                {{-- GRILL DEPAN --}}
                <div class="row">
                    <div class="col-5 py-2">GRILL DEPAN</div>
                    <div class="col-2 text-center py-2">
                        <input type="radio" class="form-check-input inputFile" name="grillDepan" value="ada">
                    </div>
                    <div class="col-2 text-center py-2">
                        <input type="radio" class="form-check-input inputFile" name="grillDepan" value="tidak">
                    </div>
                    <div class="col-3 text-center pt-1">
                        <input class="form-control form-control-sm" type="file" name="grillDepanFile" id="grillDepanFile" hidden>
                    </div>
                </div>
                {{-- DAUN WIPER BELAKANG --}}
                <div class="row">
                    <div class="col-5 py-2 bg-danger text-white">DAUN WIPER BELAKANG</div>
                    <div class="col-2 text-center py-2 bg-danger">
                        <input type="radio" class="form-check-input inputFile" name="daunWiperBelakang" value="ada">
                    </div>
                    <div class="col-2 text-center py-2 bg-danger">
                        <input type="radio" class="form-check-input inputFile" name="daunWiperBelakang" value="tidak">
                    </div>
                    <div class="col-3 text-center pt-1 bg-danger">
                        <input class="form-control form-control-sm" type="file" name="daunWiperBelakangFile" id="daunWiperBelakangFile" hidden>
                    </div>
                </div>
                {{-- CATATAN --}}
                <div class="row">
                    <div class="col-5 py-2">CATATAN</div>
                    <div class="col-7 text-center py-2">
                        <input class="form-control form-control-sm" type="text" placeholder="isi disini" name="catatanKacaDanLampu">
                    </div>
                </div>
            </div>
        </div>

        <div id="page2" class="page" hidden>
            {{-- LINER FENDER & TALANG LUMPUR --}}
            <div class="container" style="margin-top: 100px">
                <div class="row">
                    <div class="col-5 fw-bold py-2">LINER FENDER & TALANG LUMPUR</div>
                    <div class="col-2 fw-bold text-center py-2">ADA</div>
                    <div class="col-2 fw-bold text-center py-2">TIDAK ADA</div>
                    <div class="col-3 fw-bold text-center py-2">FILE</div>
                </div>
                {{-- LINER FENDER DEPAN KANAN --}}
                <div class="row">
                    <div class="col-5 py-2 bg-danger text-white">LINER FENDER DEPAN KANAN</div>
                    <div class="col-2 text-center py-2 bg-danger">
                        <input class="form-check-input inputFile" type="radio" name="linerFenderDepanKanan" value="ada">
                    </div>
                    <div class="col-2 text-center py-2 bg-danger">
                        <input class="form-check-input inputFile" type="radio" name="linerFenderDepanKanan" value="tidak">
                    </div>
                    <div class="col-3 text-center pt-1 bg-danger">
                        <input class="form-control form-control-sm" type="file" name="linerFenderDepanKananFile" id="linerFenderDepanKananFile" hidden>
                    </div>
                </div>
                {{-- LINER FENDER DEPAN KIRI --}}
                <div class="row">
                    <div class="col-5 py-2">LINER FENDER DEPAN KIRI</div>
                    <div class="col-2 text-center py-2">
                        <input class="form-check-input inputFile" type="radio" name="linerFenderDepanKiri" value="ada">
                    </div>
                    <div class="col-2 text-center py-2">
                        <input class="form-check-input inputFile" type="radio" name="linerFenderDepanKiri" value="tidak">
                    </div>
                    <div class="col-3 text-center pt-1">
                        <input class="form-control form-control-sm" type="file" name="linerFenderDepanKiriFile" id="linerFenderDepanKiriFile" hidden>
                    </div>
                </div>
                {{-- LINER FENDER BELAKANG KANAN --}}
                <div class="row">
                    <div class="col-5 py-2 bg-danger text-white">LINER FENDER BELAKANG KANAN</div>
                    <div class="col-2 text-center py-2 bg-danger">
                        <input class="form-check-input inputFile" type="radio" name="linerFenderBelakangKanan" value="ada">
                    </div>
                    <div class="col-2 text-center py-2 bg-danger">
                        <input class="form-check-input inputFile" type="radio" name="linerFenderBelakangKanan" value="tidak">
                    </div>
                    <div class="col-3 text-center pt-1 bg-danger">
                        <input class="form-control form-control-sm" type="file" name="linerFenderBelakangKananFile" id="linerFenderBelakangKananFile" hidden>
                    </div>
                </div>
                {{-- LINER FENDER BELAKANG KIRI --}}
                <div class="row">
                    <div class="col-5 py-2">LINER FENDER BELAKANG KIRI</div>
                    <div class="col-2 text-center py-2">
                        <input class="form-check-input inputFile" type="radio" name="linerFenderBelakangKiri" value="ada">
                    </div>
                    <div class="col-2 text-center py-2">
                        <input class="form-check-input inputFile" type="radio" name="linerFenderBelakangKiri" value="tidak">
                    </div>
                    <div class="col-3 text-center pt-1">
                        <input class="form-control form-control-sm" type="file" name="linerFenderBelakangKiriFile" id="linerFenderBelakangKiriFile" hidden>
                    </div>
                </div>
                {{-- TALANG LUMPUR DEPAN KANAN --}}
                <div class="row">
                    <div class="col-5 py-2 bg-danger text-white">TALANG LUMPUR DEPAN KANAN</div>
                    <div class="col-2 text-center py-2 bg-danger">
                        <input class="form-check-input inputFile" type="radio" name="talangLumpurDepanKanan" value="ada">
                    </div>
                    <div class="col-2 text-center py-2 bg-danger">
                        <input class="form-check-input inputFile" type="radio" name="talangLumpurDepanKanan" value="tidak">
                    </div>
                    <div class="col-3 text-center pt-1 bg-danger">
                        <input class="form-control form-control-sm" type="file" name="talangLumpurDepanKananFile" id="talangLumpurDepanKananFile" hidden>
                    </div>
                </div>
                {{-- TALANG LUMPUR DEPAN KIRI --}}
                <div class="row">
                    <div class="col-5 py-2">TALANG LUMPUR DEPAN KIRI</div>
                    <div class="col-2 text-center py-2">
                        <input class="form-check-input inputFile" type="radio" name="talangLumpurDepanKiri" value="ada">
                    </div>
                    <div class="col-2 text-center py-2">
                        <input class="form-check-input inputFile" type="radio" name="talangLumpurDepanKiri" value="tidak">
                    </div>
                    <div class="col-3 text-center pt-1">
                        <input class="form-control form-control-sm" type="file" name="talangLumpurDepanKiriFile" id="talangLumpurDepanKiriFile" hidden>
                    </div>
                </div>
                {{-- TALANG LUMPUR BELAKANG KANAN --}}
                <div class="row">
                    <div class="col-5 py-2 bg-danger text-white">TALANG LUMPUR BELAKANG KANAN</div>
                    <div class="col-2 text-center py-2 bg-danger">
                        <input class="form-check-input inputFile" type="radio" name="talangLumpurBelakangKanan" value="ada">
                    </div>
                    <div class="col-2 text-center py-2 bg-danger">
                        <input class="form-check-input inputFile" type="radio" name="talangLumpurBelakangKanan" value="tidak">
                    </div>
                    <div class="col-3 text-center pt-1 bg-danger">
                        <input class="form-control form-control-sm" type="file" name="talangLumpurBelakangKananFile" id="talangLumpurBelakangKananFile" hidden>
                    </div>
                </div>
                {{-- TALANG LUMPUR BELAKANG KIRI --}}
                <div class="row">
                    <div class="col-5 py-2">TALANG LUMPUR BELAKANG KIRI</div>
                    <div class="col-2 text-center py-2">
                        <input class="form-check-input inputFile" type="radio" name="talangLumpurBelakangKiri" value="ada">
                    </div>
                    <div class="col-2 text-center py-2">
                        <input class="form-check-input inputFile" type="radio" name="talangLumpurBelakangKiri" value="tidak">
                    </div>
                    <div class="col-3 text-center pt-1">
                        <input class="form-control form-control-sm" type="file" name="talangLumpurBelakangKiriFile" id="talangLumpurBelakangKiriFile" hidden>
                    </div>
                </div>
                {{-- CATATAN --}}
                <div class="row">
                    <div class="col-6 py-2 bg-danger text-white">CATATAN</div>
                    <div class="col-6 text-center pt-1 bg-danger">
                        <input class="form-control form-control-sm" type="text" placeholder="isi disini" name="catatanLinerFenderTalangLumpur">
                    </div>
                </div>
            </div>

            {{-- KOLONG MOBIL --}}
            <div class="container" style="margin-top: 50px">
                <div class="row">
                    <div class="col-5 fw-bold py-2">KOLONG MOBIL</div>
                    <div class="col-2 fw-bold text-center py-2">ADA</div>
                    <div class="col-2 fw-bold text-center py-2">TIDAK ADA</div>
                    <div class="col-3 fw-bold text-center py-2">FILE</div>
                </div>
                {{-- BAGIAN BAWAH MESIN --}}
                <div class="row">
                    <div class="col-5 py-2 bg-danger text-white">BAGIAN BAWAH MESIN</div>
                    <div class="col-2 text-center py-2 bg-danger">
                        <input class="form-check-input inputFile" type="radio" name="bagianBawahMesin" value="ada">
                    </div>
                    <div class="col-2 text-center py-2 bg-danger">
                        <input class="form-check-input inputFile" type="radio" name="bagianBawahMesin" value="tidak">
                    </div>
                    <div class="col-3 text-center pt-1 bg-danger">
                        <input class="form-control form-control-sm" type="file" name="bagianBawahMesinFile" id="bagianBawahMesinFile" hidden>
                    </div>
                </div>
                {{-- BAGIAN SASIS TENGAH --}}
                <div class="row">
                    <div class="col-5 py-2">BAGIAN SASIS TENGAH</div>
                    <div class="col-2 text-center py-2">
                        <input class="form-check-input inputFile" type="radio" name="bagianSasisTengah" value="ada">
                    </div>
                    <div class="col-2 text-center py-2">
                        <input class="form-check-input inputFile" type="radio" name="bagianSasisTengah" value="tidak">
                    </div>
                    <div class="col-3 text-center pt-1">
                        <input class="form-control form-control-sm" type="file" name="bagianSasisTengahFile" id="bagianSasisTengahFile" hidden>
                    </div>
                </div>
                {{-- BAGIAN SASIS DEPAN --}}
                <div class="row">
                    <div class="col-5 py-2 bg-danger text-white">BAGIAN SASIS DEPAN</div>
                    <div class="col-2 text-center py-2 bg-danger">
                        <input class="form-check-input inputFile" type="radio" name="bagianSasisDepan" value="ada">
                    </div>
                    <div class="col-2 text-center py-2 bg-danger">
                        <input class="form-check-input inputFile" type="radio" name="bagianSasisDepan" value="tidak">
                    </div>
                    <div class="col-3 text-center pt-1 bg-danger">
                        <input class="form-control form-control-sm" type="file" name="bagianSasisDepanFile" id="bagianSasisDepanFile" hidden>
                    </div>
                </div>
                {{-- BAGIAN SASIS BELAKANG --}}
                <div class="row">
                    <div class="col-5 py-2">BAGIAN SASIS BELAKANG</div>
                    <div class="col-2 text-center py-2">
                        <input class="form-check-input inputFile" type="radio" name="bagianSasisBelakang" value="ada">
                    </div>
                    <div class="col-2 text-center py-2">
                        <input class="form-check-input inputFile" type="radio" name="bagianSasisBelakang" value="tidak">
                    </div>
                    <div class="col-3 text-center pt-1">
                        <input class="form-control form-control-sm" type="file" name="bagianSasisBelakangFile" id="bagianSasisBelakangFile" hidden>
                    </div>
                </div>
                {{-- CATATAN --}}
                <div class="row">
                    <div class="col-6 py-2 bg-danger text-white">CATATAN</div>
                    <div class="col-6 text-center pt-1 bg-danger">
                        <input class="form-control form-control-sm" type="text" placeholder="isi disini" name="catatanKolongMobil">
                    </div>
                </div>
            </div>
            
            {{-- OLI & CAIRAN --}}
            <div class="container" style="margin-top: 50px">
                <div class="row">
                    <div class="col-6 fw-bold py-2">OLI & CAIRAN</div>
                    <div class="col-3 fw-bold text-center py-2">ADA</div>
                    <div class="col-3 fw-bold text-center py-2">TIDAK ADA</div>
                </div>
                {{-- OLI MESIN --}}
                <div class="row">
                    <div class="col-6 py-2 bg-danger text-white">OLI MESIN</div>
                    <div class="col-3 text-center py-2 bg-danger">
                        <input class="form-check-input" type="radio" name="oliMesin" value="ada">
                    </div>
                    <div class="col-3 text-center py-2 bg-danger">
                        <input class="form-check-input" type="radio" name="oliMesin" value="tidak">
                    </div>
                </div>
                {{-- MINYAK REM --}}
                <div class="row">
                    <div class="col-6 py-2">MINYAK REM</div>
                    <div class="col-3 text-center py-2">
                        <input class="form-check-input" type="radio" name="minyakRem" value="ada">
                    </div>
                    <div class="col-3 text-center py-2">
                        <input class="form-check-input" type="radio" name="minyakRem" value="tidak">
                    </div>
                </div>
                {{-- AIR RADIATOR --}}
                <div class="row">
                    <div class="col-6 py-2 bg-danger text-white">AIR RADIATOR</div>
                    <div class="col-3 text-center py-2 bg-danger">
                        <input class="form-check-input" type="radio" name="airRadiator" value="ada">
                    </div>
                    <div class="col-3 text-center py-2 bg-danger">
                        <input class="form-check-input" type="radio" name="airRadiator" value="tidak">
                    </div>
                </div>
                {{-- OLI TRANSMISI AT --}}
                <div class="row">
                    <div class="col-6 py-2">OLI TRANSMISI AT</div>
                    <div class="col-3 text-center py-2">
                        <input class="form-check-input" type="radio" name="oliTransmisiAt" value="ada">
                    </div>
                    <div class="col-3 text-center py-2">
                        <input class="form-check-input" type="radio" name="oliTransmisiAt" value="tidak">
                    </div>
                </div>
                {{-- MINYAK POWER STEERING --}}
                <div class="row">
                    <div class="col-6 py-2 bg-danger text-white">MINYAK POWER STEERING</div>
                    <div class="col-3 text-center py-2 bg-danger">
                        <input class="form-check-input" type="radio" name="minyakPowerSteering" value="ada">
                    </div>
                    <div class="col-3 text-center py-2 bg-danger">
                        <input class="form-check-input" type="radio" name="minyakPowerSteering" value="tidak">
                    </div>
                </div>
                {{-- AIR WIPER --}}
                <div class="row">
                    <div class="col-6 py-2">AIR WIPER</div>
                    <div class="col-3 text-center py-2">
                        <input class="form-check-input" type="radio" name="airWiper" value="ada">
                    </div>
                    <div class="col-3 text-center py-2">
                        <input class="form-check-input" type="radio" name="airWiper" value="tidak">
                    </div>
                </div>
                {{-- CATATAN --}}
                <div class="row">
                    <div class="col-6 py-2 bg-danger text-white">CATATAN</div>
                    <div class="col-6 text-center pt-1 bg-danger">
                        <input class="form-control form-control-sm" type="text" placeholder="isi disini" name="catatanOliCairan">
                    </div>
                </div>
            </div>

            {{-- RUANG MESIN --}}
            <div class="container" style="margin-top: 100px">
                <div class="row">
                    <div class="col-5 fw-bold py-2">RUANG MESIN</div>
                    <div class="col-2 fw-bold text-center py-2">ADA</div>
                    <div class="col-2 fw-bold text-center py-2">TIDAK ADA</div>
                    <div class="col-3 fw-bold text-center py-2">FILE</div>
                </div>
                {{-- SUARA MESIN NORMAL --}}
                <div class="row">
                    <div class="col-5 py-2 bg-danger text-white">SUARA MESIN NORMAL</div>
                    <div class="col-2 text-center py-2 bg-danger">
                        <input class="form-check-input" type="radio" name="suaraMesinNormal" value="ada">
                    </div>
                    <div class="col-2 text-center py-2 bg-danger">
                        <input class="form-check-input" type="radio" name="suaraMesinNormal" value="tidak">
                    </div>
                    <div class="col-3 text-center pt-1 bg-danger">
                        {{-- <input class="form-control form-control-sm" type="file" name="linerFenderDepanKananFile" id="linerFenderDepanKananFile" hidden> --}}
                    </div>
                </div>
                {{-- BELT --}}
                <div class="row">
                    <div class="col-5 py-2">BELT</div>
                    <div class="col-2 text-center py-2">
                        <input class="form-check-input" type="radio" name="belt" value="ada">
                    </div>
                    <div class="col-2 text-center py-2">
                        <input class="form-check-input" type="radio" name="belt" value="tidak">
                    </div>
                    <div class="col-3 text-center pt-1">
                        {{-- <input class="form-control form-control-sm" type="file" name="linerFenderDepanKiriFile" id="linerFenderDepanKiriFile" hidden> --}}
                    </div>
                </div>
                {{-- ACCU --}}
                <div class="row">
                    <div class="col-5 py-2 bg-danger text-white">ACCU</div>
                    <div class="col-2 text-center py-2 bg-danger">
                        <input class="form-check-input" type="radio" name="accu" value="ada">
                    </div>
                    <div class="col-2 text-center py-2 bg-danger">
                        <input class="form-check-input" type="radio" name="accu" value="tidak">
                    </div>
                    <div class="col-3 text-center pt-1 bg-danger">
                        {{-- <input class="form-control form-control-sm" type="file" name="linerFenderBelakangKananFile" id="linerFenderBelakangKananFile" hidden> --}}
                    </div>
                </div>
                {{-- RADIATOR --}}
                <div class="row">
                    <div class="col-5 py-2">RADIATOR</div>
                    <div class="col-2 text-center py-2">
                        <input class="form-check-input" type="radio" name="radiator" value="ada">
                    </div>
                    <div class="col-2 text-center py-2">
                        <input class="form-check-input" type="radio" name="radiator" value="tidak">
                    </div>
                    <div class="col-3 text-center pt-1">
                        {{-- <input class="form-control form-control-sm" type="file" name="linerFenderBelakangKiriFile" id="linerFenderBelakangKiriFile" hidden> --}}
                    </div>
                </div>
                {{-- MESIN BEBAS REMBES --}}
                <div class="row">
                    <div class="col-5 py-2 bg-danger text-white">MESIN BEBAS REMBES</div>
                    <div class="col-2 text-center py-2 bg-danger">
                        <input class="form-check-input inputFile" type="radio" name="mesinBebasRembes" value="ada">
                    </div>
                    <div class="col-2 text-center py-2 bg-danger">
                        <input class="form-check-input inputFile" type="radio" name="mesinBebasRembes" value="tidak">
                    </div>
                    <div class="col-3 text-center pt-1 bg-danger">
                        <input class="form-control form-control-sm" type="file" name="mesinBebasRembesFile" id="mesinBebasRembesFile" hidden>
                    </div>
                </div>
                {{-- SELANG-SELANG --}}
                <div class="row">
                    <div class="col-5 py-2">SELANG-SELANG</div>
                    <div class="col-2 text-center py-2">
                        <input class="form-check-input inputFile" type="radio" name="selang" value="ada">
                    </div>
                    <div class="col-2 text-center py-2">
                        <input class="form-check-input inputFile" type="radio" name="selang" value="tidak">
                    </div>
                    <div class="col-3 text-center pt-1">
                        <input class="form-control form-control-sm" type="file" name="selangFile" id="selangFile" hidden>
                    </div>
                </div>
                {{-- ASAP & TUTUP OLI --}}
                <div class="row">
                    <div class="col-5 py-2 bg-danger text-white">ASAP & TUTUP OLI</div>
                    <div class="col-2 text-center py-2 bg-danger">
                        <input class="form-check-input inputFile" type="radio" name="asapTutupOli" value="ada">
                    </div>
                    <div class="col-2 text-center py-2 bg-danger">
                        <input class="form-check-input inputFile" type="radio" name="asapTutupOli" value="tidak">
                    </div>
                    <div class="col-3 text-center pt-1 bg-danger">
                        <input class="form-control form-control-sm" type="file" name="asapTutupOliFile" id="asapTutupOliFile" hidden>
                    </div>
                </div>
                {{-- KOMPRESOR AC --}}
                <div class="row">
                    <div class="col-5 py-2">KOMPRESOR AC</div>
                    <div class="col-2 text-center py-2">
                        <input class="form-check-input inputFile" type="radio" name="kompresorAc" value="ada">
                    </div>
                    <div class="col-2 text-center py-2">
                        <input class="form-check-input inputFile" type="radio" name="kompresorAc" value="tidak">
                    </div>
                    <div class="col-3 text-center pt-1">
                        <input class="form-control form-control-sm" type="file" name="kompresorAcFile" id="kompresorAcFile" hidden>
                    </div>
                </div>
                {{-- CATATAN --}}
                <div class="row">
                    <div class="col-6 py-2 bg-danger text-white">CATATAN</div>
                    <div class="col-6 text-center pt-1 bg-danger">
                        <input class="form-control form-control-sm" type="text" placeholder="isi disini" name="catatanRuangMesin">
                    </div>
                </div>
            </div>

            {{-- BAN & BAUT RODA --}}
            <div class="container" style="margin-top: 100px">
                <div class="row">
                    <div class="col-4 fw-bold py-2">BAN & BAUT RODA</div>
                    <div class="col-2 fw-bold text-center py-2">MERK</div>
                    <div class="col-2 fw-bold text-center py-2">UKURAN BAN</div>
                    <div class="col-2 fw-bold text-center py-2">VELG</div>
                    <div class="col-2 fw-bold text-md-center py-2">KETEBALAN BAN</div>
                </div>
                {{-- KIRI DEPAN --}}
                <div class="row">
                    <div class="col-4 py-2 bg-danger text-white">KIRI DEPAN</div>
                    <div class="col-2 text-center py-2 bg-danger">
                        <input class="form-control form-control-sm" type="text" placeholder="isi disini" name="banMerkKiriDepan">
                    </div>
                    <div class="col-2 text-center py-2 bg-danger">
                        <input class="form-control form-control-sm" type="text" placeholder="isi disini" name="banUkuranKiriDepan">
                    </div>
                    <div class="col-2 text-center pt-1 bg-danger">
                        <input class="form-control form-control-sm" type="text" placeholder="isi disini" name="banVelgKiriDepan">
                    </div>
                    <div class="col-2 text-center pt-1 bg-danger">
                        <input class="form-control form-control-sm" type="text" placeholder="isi disini" name="banKetebalanKiriDepan">
                    </div>
                </div>
                {{-- KIRI BELAKANG --}}
                <div class="row">
                    <div class="col-4 py-2">KIRI BELAKANG</div>
                    <div class="col-2 text-center py-2">
                        <input class="form-control form-control-sm" type="text" placeholder="isi disini" name="banMerkKiriBelakang">
                    </div>
                    <div class="col-2 text-center py-2">
                        <input class="form-control form-control-sm" type="text" placeholder="isi disini" name="banUkuranKiriBelakang">
                    </div>
                    <div class="col-2 text-center pt-1">
                        <input class="form-control form-control-sm" type="text" placeholder="isi disini" name="banVelgKiriBelakang">
                    </div>
                    <div class="col-2 text-center pt-1">
                        <input class="form-control form-control-sm" type="text" placeholder="isi disini" name="banKetebalanKiriBelakang">
                    </div>
                </div>
                {{-- KANAN DEPAN --}}
                <div class="row">
                    <div class="col-4 py-2 bg-danger text-white">KANAN DEPAN</div>
                    <div class="col-2 text-center py-2 bg-danger">
                        <input class="form-control form-control-sm" type="text" placeholder="isi disini" name="banMerkKananDepan">
                    </div>
                    <div class="col-2 text-center py-2 bg-danger">
                        <input class="form-control form-control-sm" type="text" placeholder="isi disini" name="banUkuranKananDepan">
                    </div>
                    <div class="col-2 text-center pt-1 bg-danger">
                        <input class="form-control form-control-sm" type="text" placeholder="isi disini" name="banVelgKananDepan">
                    </div>
                    <div class="col-2 text-center pt-1 bg-danger">
                        <input class="form-control form-control-sm" type="text" placeholder="isi disini" name="banKetebalanKananDepan">
                    </div>
                </div>
                {{-- KANAN BELAKANG --}}
                <div class="row">
                    <div class="col-4 py-2">KANAN BELAKANG</div>
                    <div class="col-2 text-center py-2">
                        <input class="form-control form-control-sm" type="text" placeholder="isi disini" name="banMerkKananBelakang">
                    </div>
                    <div class="col-2 text-center py-2">
                        <input class="form-control form-control-sm" type="text" placeholder="isi disini" name="banUkuranKananBelakang">
                    </div>
                    <div class="col-2 text-center pt-1">
                        <input class="form-control form-control-sm" type="text" placeholder="isi disini" name="banVelgKananBelakang">
                    </div>
                    <div class="col-2 text-center pt-1">
                        <input class="form-control form-control-sm" type="text" placeholder="isi disini" name="banKetebalanKananBelakang">
                    </div>
                </div>
                {{-- CATATAN --}}
                <div class="row">
                    <div class="col-6 py-2 bg-danger text-white">CATATAN</div>
                    <div class="col-6 text-center pt-1 bg-danger">
                        <input class="form-control form-control-sm" type="text" placeholder="isi disini" name="catatanBanBautRoda">
                    </div>
                </div>
            </div>
        </div>

        <div id="page3" class="page" hidden>
            {{-- INDIKATOR SENSOR --}}
            <div class="container" style="margin-top: 100px">
                <div class="row">
                    <div class="col-6 fw-bold py-2">INDIKATOR SENSOR</div>
                    <div class="col-3 fw-bold text-center py-2">ADA</div>
                    <div class="col-3 fw-bold text-center py-2">TIDAK ADA</div>
                </div>
                {{-- ENGINE CHECK --}}
                <div class="row">
                    <div class="col-6 py-2 bg-danger text-white">ENGINE CHECK</div>
                    <div class="col-3 text-center py-2 bg-danger">
                        <input class="form-check-input" type="radio" name="engineCheck" value="ada">
                    </div>
                    <div class="col-3 text-center py-2 bg-danger">
                        <input class="form-check-input" type="radio" name="engineCheck" value="tidak">
                    </div>
                </div>
                {{-- ABS --}}
                <div class="row">
                    <div class="col-6 py-2">ABS</div>
                    <div class="col-3 text-center py-2">
                        <input class="form-check-input" type="radio" name="abs" value="ada">
                    </div>
                    <div class="col-3 text-center py-2">
                        <input class="form-check-input" type="radio" name="abs" value="tidak">
                    </div>
                </div>
                {{-- REM TANGAN --}}
                <div class="row">
                    <div class="col-6 py-2 bg-danger text-white">REM TANGAN</div>
                    <div class="col-3 text-center py-2 bg-danger">
                        <input class="form-check-input" type="radio" name="remTangan" value="ada">
                    </div>
                    <div class="col-3 text-center py-2 bg-danger">
                        <input class="form-check-input" type="radio" name="remTangan" value="tidak">
                    </div>
                </div>
                {{-- TEKANAN OLI --}}
                <div class="row">
                    <div class="col-6 py-2">TEKANAN OLI</div>
                    <div class="col-3 text-center py-2">
                        <input class="form-check-input" type="radio" name="tekananOli" value="ada">
                    </div>
                    <div class="col-3 text-center py-2">
                        <input class="form-check-input" type="radio" name="tekananOli" value="tidak">
                    </div>
                </div>
                {{-- ACCU --}}
                <div class="row">
                    <div class="col-6 py-2 bg-danger text-white">ACCU</div>
                    <div class="col-3 text-center py-2 bg-danger">
                        <input class="form-check-input" type="radio" name="accuIndikator" value="ada">
                    </div>
                    <div class="col-3 text-center py-2 bg-danger">
                        <input class="form-check-input" type="radio" name="accuIndikator" value="tidak">
                    </div>
                </div>
                {{-- VSA --}}
                <div class="row">
                    <div class="col-6 py-2">VSA</div>
                    <div class="col-3 text-center py-2">
                        <input class="form-check-input" type="radio" name="vsa" value="ada">
                    </div>
                    <div class="col-3 text-center py-2">
                        <input class="form-check-input" type="radio" name="vsa" value="tidak">
                    </div>
                </div>
                {{-- AIRBAG --}}
                <div class="row">
                    <div class="col-6 py-2 bg-danger text-white">AIRBAG</div>
                    <div class="col-3 text-center py-2 bg-danger">
                        <input class="form-check-input" type="radio" name="airbag" value="ada">
                    </div>
                    <div class="col-3 text-center py-2 bg-danger">
                        <input class="form-check-input" type="radio" name="airbag" value="tidak">
                    </div>
                </div>
                {{-- SEAT BELT --}}
                <div class="row">
                    <div class="col-6 py-2">SEAT BELT</div>
                    <div class="col-3 text-center py-2">
                        <input class="form-check-input" type="radio" name="seatBelt" value="ada">
                    </div>
                    <div class="col-3 text-center py-2">
                        <input class="form-check-input" type="radio" name="seatBelt" value="tidak">
                    </div>
                </div>
                {{-- SUHU MESIN --}}
                <div class="row">
                    <div class="col-6 py-2 bg-danger text-white">SUHU MESIN</div>
                    <div class="col-3 text-center py-2 bg-danger">
                        <input class="form-check-input" type="radio" name="suhuMesin" value="ada">
                    </div>
                    <div class="col-3 text-center py-2 bg-danger">
                        <input class="form-check-input" type="radio" name="suhuMesin" value="tidak">
                    </div>
                </div>
                {{-- ELECTRIC POWER STEERING --}}
                <div class="row">
                    <div class="col-6 py-2">ELECTRIC POWER STEERING</div>
                    <div class="col-3 text-center py-2">
                        <input class="form-check-input" type="radio" name="electricPowerSteering" value="ada">
                    </div>
                    <div class="col-3 text-center py-2">
                        <input class="form-check-input" type="radio" name="electricPowerSteering" value="tidak">
                    </div>
                </div>
                {{-- DOOR LOCK --}}
                <div class="row">
                    <div class="col-6 py-2 bg-danger text-white">DOOR LOCK</div>
                    <div class="col-3 text-center py-2 bg-danger">
                        <input class="form-check-input" type="radio" name="doorLock" value="ada">
                    </div>
                    <div class="col-3 text-center py-2 bg-danger">
                        <input class="form-check-input" type="radio" name="doorLock" value="tidak">
                    </div>
                </div>
                {{-- CATATAN --}}
                <div class="row">
                    <div class="col-6 py-2">CATATAN</div>
                    <div class="col-6 text-center pt-1">
                        <input class="form-control form-control-sm" type="text" placeholder="isi disini" name="catatanIndikatorSensor">
                    </div>
                </div>
            </div>

            {{-- BAGIAN DEPAN --}}
            <div class="container" style="margin-top: 50px">
                <div class="row">
                    <div class="col-5 fw-bold py-2">BAGIAN DEPAN</div>
                    <div class="col-2 fw-bold text-center py-2">ADA</div>
                    <div class="col-2 fw-bold text-center py-2">TIDAK ADA</div>
                    <div class="col-3 fw-bold text-center py-2">FILE</div>
                </div>
                {{-- KONDISI STIR --}}
                <div class="row">
                    <div class="col-5 py-2 bg-danger text-white">KONDISI STIR</div>
                    <div class="col-2 text-center py-2 bg-danger">
                        <input class="form-check-input" type="radio" name="kondisiStir" value="ada">
                    </div>
                    <div class="col-2 text-center py-2 bg-danger">
                        <input class="form-check-input" type="radio" name="kondisiStir" value="tidak">
                    </div>
                    <div class="col-3 text-center pt-1 bg-danger">
                        {{-- <input class="form-control form-control-sm" type="file" name="bagianBawahMesinFile" id="bagianBawahMesinFile" hidden> --}}
                    </div>
                </div>
                {{-- KLAKSON --}}
                <div class="row">
                    <div class="col-5 py-2">KLAKSON</div>
                    <div class="col-2 text-center py-2">
                        <input class="form-check-input" type="radio" name="klakson" value="ada">
                    </div>
                    <div class="col-2 text-center py-2">
                        <input class="form-check-input" type="radio" name="klakson" value="tidak">
                    </div>
                    <div class="col-3 text-center pt-1">
                        {{-- <input class="form-control form-control-sm" type="file" name="bagianSasisTengahFile" id="bagianSasisTengahFile" hidden> --}}
                    </div>
                </div>
                {{-- TOMBOL STIR --}}
                <div class="row">
                    <div class="col-5 py-2 bg-danger text-white">TOMBOL STIR</div>
                    <div class="col-2 text-center py-2 bg-danger">
                        <input class="form-check-input inputFile" type="radio" name="tombolStir" value="ada">
                    </div>
                    <div class="col-2 text-center py-2 bg-danger">
                        <input class="form-check-input inputFile" type="radio" name="tombolStir" value="tidak">
                    </div>
                    <div class="col-3 text-center pt-1 bg-danger">
                        {{-- <input class="form-control form-control-sm" type="file" name="lampuDepanFile" id="lampuDepanFile" hidden> --}}
                    </div>
                </div>
                {{-- LAMPU SEN SPION --}}
                <div class="row">
                    <div class="col-5 py-2">LAMPU SEN SPION</div>
                    <div class="col-2 text-center py-2">
                        <input class="form-check-input inputFile" type="radio" name="lampuSenSpion" value="ada">
                    </div>
                    <div class="col-2 text-center py-2">
                        <input class="form-check-input inputFile" type="radio" name="lampuSenSpion" value="tidak">
                    </div>
                    <div class="col-3 text-center pt-1">
                        <input class="form-control form-control-sm" type="file" name="lampuSenSpionFile" id="lampuSenSpionFile" hidden>
                    </div>
                </div>
                {{-- LAMPU DEPAN --}}
                <div class="row">
                    <div class="col-5 py-2 bg-danger text-white">LAMPU DEPAN</div>
                    <div class="col-2 text-center py-2 bg-danger">
                        <input class="form-check-input inputFile" type="radio" name="lampuDepan" value="ada">
                    </div>
                    <div class="col-2 text-center py-2 bg-danger">
                        <input class="form-check-input inputFile" type="radio" name="lampuDepan" value="tidak">
                    </div>
                    <div class="col-3 text-center pt-1 bg-danger">
                        <input class="form-control form-control-sm" type="file" name="lampuDepanFile" id="lampuDepanFile" hidden>
                    </div>
                </div>
                {{-- LAMPU HAZZAR --}}
                <div class="row">
                    <div class="col-5 py-2">LAMPU HAZZAR</div>
                    <div class="col-2 text-center py-2">
                        <input class="form-check-input inputFile" type="radio" name="lampuHazzar" value="ada">
                    </div>
                    <div class="col-2 text-center py-2">
                        <input class="form-check-input inputFile" type="radio" name="lampuHazzar" value="tidak">
                    </div>
                    <div class="col-3 text-center pt-1">
                        <input class="form-control form-control-sm" type="file" name="lampuHazzarFile" id="lampuHazzarFile" hidden>
                    </div>
                </div>
                {{-- LAMPU ATRET --}}
                <div class="row">
                    <div class="col-5 py-2 bg-danger text-white">LAMPU ATRET</div>
                    <div class="col-2 text-center py-2 bg-danger">
                        <input class="form-check-input inputFile" type="radio" name="lampuAtret" value="ada">
                    </div>
                    <div class="col-2 text-center py-2 bg-danger">
                        <input class="form-check-input inputFile" type="radio" name="lampuAtret" value="tidak">
                    </div>
                    <div class="col-3 text-center pt-1 bg-danger">
                        <input class="form-control form-control-sm" type="file" name="lampuAtretFile" id="lampuAtretFile" hidden>
                    </div>
                </div>
                {{-- HANDLE PINTU --}}
                <div class="row">
                    <div class="col-5 py-2">HANDLE PINTU</div>
                    <div class="col-2 text-center py-2">
                        <input class="form-check-input inputFile" type="radio" name="handlePintu" value="ada">
                    </div>
                    <div class="col-2 text-center py-2">
                        <input class="form-check-input inputFile" type="radio" name="handlePintu" value="tidak">
                    </div>
                    <div class="col-3 text-center pt-1">
                        <input class="form-control form-control-sm" type="file" name="handlePintuFile" id="handlePintuFile" hidden>
                    </div>
                </div>
                {{-- KONSOL BOX --}}
                <div class="row">
                    <div class="col-5 py-2 bg-danger text-white">KONSOL BOX</div>
                    <div class="col-2 text-center py-2 bg-danger">
                        <input class="form-check-input inputFile" type="radio" name="konsolBox" value="ada">
                    </div>
                    <div class="col-2 text-center py-2 bg-danger">
                        <input class="form-check-input inputFile" type="radio" name="konsolBox" value="tidak">
                    </div>
                    <div class="col-3 text-center pt-1 bg-danger">
                        <input class="form-control form-control-sm" type="file" name="konsolBoxFile" id="konsolBoxFile" hidden>
                    </div>
                </div>
                {{-- SPION KANAN --}}
                <div class="row">
                    <div class="col-5 py-2">SPION KANAN</div>
                    <div class="col-2 text-center py-2">
                        <input class="form-check-input inputFile" type="radio" name="spionKanan" value="ada">
                    </div>
                    <div class="col-2 text-center py-2">
                        <input class="form-check-input inputFile" type="radio" name="spionKanan" value="tidak">
                    </div>
                    <div class="col-3 text-center pt-1">
                        <input class="form-control form-control-sm" type="file" name="spionKananFile" id="spionKananFile" hidden>
                    </div>
                </div>
                {{-- SPION KIRI --}}
                <div class="row">
                    <div class="col-5 py-2 bg-danger text-white">SPION KIRI</div>
                    <div class="col-2 text-center py-2 bg-danger">
                        <input class="form-check-input inputFile" type="radio" name="spionKiri" value="ada">
                    </div>
                    <div class="col-2 text-center py-2 bg-danger">
                        <input class="form-check-input inputFile" type="radio" name="spionKiri" value="tidak">
                    </div>
                    <div class="col-3 text-center pt-1 bg-danger">
                        <input class="form-control form-control-sm" type="file" name="spionKiriFile" id="spionKiriFile" hidden>
                    </div>
                </div>
                {{-- SUN VISOR --}}
                <div class="row">
                    <div class="col-5 py-2">SUN VISOR</div>
                    <div class="col-2 text-center py-2">
                        <input class="form-check-input inputFile" type="radio" name="sunVisor" value="ada">
                    </div>
                    <div class="col-2 text-center py-2">
                        <input class="form-check-input inputFile" type="radio" name="sunVisor" value="tidak">
                    </div>
                    <div class="col-3 text-center pt-1">
                        <input class="form-control form-control-sm" type="file" name="sunVisorFile" id="sunVisorFile" hidden>
                    </div>
                </div>
                {{-- REM TANGAN --}}
                <div class="row">
                    <div class="col-5 py-2 bg-danger text-white">REM TANGAN</div>
                    <div class="col-2 text-center py-2 bg-danger">
                        <input class="form-check-input inputFile" type="radio" name="remTangan" value="ada">
                    </div>
                    <div class="col-2 text-center py-2 bg-danger">
                        <input class="form-check-input inputFile" type="radio" name="remTangan" value="tidak">
                    </div>
                    <div class="col-3 text-center pt-1 bg-danger">
                        <input class="form-control form-control-sm" type="file" name="remTanganFile" id="remTanganFile" hidden>
                    </div>
                </div>
                {{-- POWER WINDOW PENUMPANG --}}
                <div class="row">
                    <div class="col-5 py-2">POWER WINDOW PENUMPANG</div>
                    <div class="col-2 text-center py-2">
                        <input class="form-check-input inputFile" type="radio" name="powerWindowPenumpang" value="ada">
                    </div>
                    <div class="col-2 text-center py-2">
                        <input class="form-check-input inputFile" type="radio" name="powerWindowPenumpang" value="tidak">
                    </div>
                    <div class="col-3 text-center pt-1">
                        <input class="form-control form-control-sm" type="file" name="powerWindowPenumpangFile" id="powerWindowPenumpangFile" hidden>
                    </div>
                </div>
                {{-- POWER WINDOW SUPIR --}}
                <div class="row">
                    <div class="col-5 py-2 bg-danger text-white">POWER WINDOW SUPIR</div>
                    <div class="col-2 text-center py-2 bg-danger">
                        <input class="form-check-input inputFile" type="radio" name="powerWindowSupir" value="ada">
                    </div>
                    <div class="col-2 text-center py-2 bg-danger">
                        <input class="form-check-input inputFile" type="radio" name="powerWindowSupir" value="tidak">
                    </div>
                    <div class="col-3 text-center pt-1 bg-danger">
                        <input class="form-control form-control-sm" type="file" name="powerWindowSupirFile" id="powerWindowSupirFile" hidden>
                    </div>
                </div>
                {{-- P.WINDOW BELAKANG KIRI --}}
                <div class="row">
                    <div class="col-5 py-2">P.WINDOW BELAKANG KIRI</div>
                    <div class="col-2 text-center py-2">
                        <input class="form-check-input inputFile" type="radio" name="pWindowBelakangKiri" value="ada">
                    </div>
                    <div class="col-2 text-center py-2">
                        <input class="form-check-input inputFile" type="radio" name="pWindowBelakangKiri" value="tidak">
                    </div>
                    <div class="col-3 text-center pt-1">
                        <input class="form-control form-control-sm" type="file" name="pWindowBelakangKiriFile" id="pWindowBelakangKiriFile" hidden>
                    </div>
                </div>
                {{-- P.WINDOW BELAKANG KANAN --}}
                <div class="row">
                    <div class="col-5 py-2 bg-danger text-white">P.WINDOW BELAKANG KANAN</div>
                    <div class="col-2 text-center py-2 bg-danger">
                        <input class="form-check-input inputFile" type="radio" name="pWindowBelakangKanan" value="ada">
                    </div>
                    <div class="col-2 text-center py-2 bg-danger">
                        <input class="form-check-input inputFile" type="radio" name="pWindowBelakangKanan" value="tidak">
                    </div>
                    <div class="col-3 text-center pt-1 bg-danger">
                        <input class="form-control form-control-sm" type="file" name="pWindowBelakangKananFile" id="pWindowBelakangKananFile" hidden>
                    </div>
                </div>
                {{-- PEMBUKA TANGKI BENSIN --}}
                <div class="row">
                    <div class="col-5 py-2">PEMBUKA TANGKI BENSIN</div>
                    <div class="col-2 text-center py-2">
                        <input class="form-check-input inputFile" type="radio" name="pembukaTangkiBensin" value="ada">
                    </div>
                    <div class="col-2 text-center py-2">
                        <input class="form-check-input inputFile" type="radio" name="pembukaTangkiBensin" value="tidak">
                    </div>
                    <div class="col-3 text-center pt-1">
                        <input class="form-control form-control-sm" type="file" name="pembukaTangkiBensinFile" id="pembukaTangkiBensinFile" hidden>
                    </div>
                </div>
                {{-- PEMBUKA KAP MESIN --}}
                <div class="row">
                    <div class="col-5 py-2 bg-danger text-white">PEMBUKA KAP MESIN</div>
                    <div class="col-2 text-center py-2 bg-danger">
                        <input class="form-check-input inputFile" type="radio" name="pembukaKapMesin" value="ada">
                    </div>
                    <div class="col-2 text-center py-2 bg-danger">
                        <input class="form-check-input inputFile" type="radio" name="pembukaKapMesin" value="tidak">
                    </div>
                    <div class="col-3 text-center pt-1 bg-danger">
                        <input class="form-control form-control-sm" type="file" name="pembukaKapMesinFile" id="pembukaKapMesinFile" hidden>
                    </div>
                </div>
                {{-- SABUK PENGAMAN PENUMPANG --}}
                <div class="row">
                    <div class="col-5 py-2">SABUK PENGAMAN PENUMPANG</div>
                    <div class="col-2 text-center py-2">
                        <input class="form-check-input inputFile" type="radio" name="sabukPengamanPenumpang" value="ada">
                    </div>
                    <div class="col-2 text-center py-2">
                        <input class="form-check-input inputFile" type="radio" name="sabukPengamanPenumpang" value="tidak">
                    </div>
                    <div class="col-3 text-center pt-1">
                        <input class="form-control form-control-sm" type="file" name="sabukPengamanPenumpangFile" id="sabukPengamanPenumpangFile" hidden>
                    </div>
                </div>
                {{-- SABUK PENGAMAN SUPIR --}}
                <div class="row">
                    <div class="col-5 py-2 bg-danger text-white">SABUK PENGAMAN SUPIR</div>
                    <div class="col-2 text-center py-2 bg-danger">
                        <input class="form-check-input inputFile" type="radio" name="sabukPengamanSupir" value="ada">
                    </div>
                    <div class="col-2 text-center py-2 bg-danger">
                        <input class="form-check-input inputFile" type="radio" name="sabukPengamanSupir" value="tidak">
                    </div>
                    <div class="col-3 text-center pt-1 bg-danger">
                        <input class="form-control form-control-sm" type="file" name="sabukPengamanSupirFile" id="sabukPengamanSupirFile" hidden>
                    </div>
                </div>
                {{-- KARPET KEPING PENUMPANG --}}
                <div class="row">
                    <div class="col-5 py-2">KARPET KEPING PENUMPANG</div>
                    <div class="col-2 text-center py-2">
                        <input class="form-check-input inputFile" type="radio" name="karpetKepingPenumpang" value="ada">
                    </div>
                    <div class="col-2 text-center py-2">
                        <input class="form-check-input inputFile" type="radio" name="karpetKepingPenumpang" value="tidak">
                    </div>
                    <div class="col-3 text-center pt-1">
                        <input class="form-control form-control-sm" type="file" name="karpetKepingPenumpangFile" id="karpetKepingPenumpangFile" hidden>
                    </div>
                </div>
                {{-- KARPET KEPING SUPIR --}}
                <div class="row">
                    <div class="col-5 py-2 bg-danger text-white">KARPET KEPING SUPIR</div>
                    <div class="col-2 text-center py-2 bg-danger">
                        <input class="form-check-input inputFile" type="radio" name="karpetKepingSupir" value="ada">
                    </div>
                    <div class="col-2 text-center py-2 bg-danger">
                        <input class="form-check-input inputFile" type="radio" name="karpetKepingSupir" value="tidak">
                    </div>
                    <div class="col-3 text-center pt-1 bg-danger">
                        <input class="form-control form-control-sm" type="file" name="karpetKepingSupirFile" id="karpetKepingSupirFile" hidden>
                    </div>
                </div>
                {{-- AUDIO & SPEAKER --}}
                <div class="row">
                    <div class="col-5 py-2">AUDIO & SPEAKER</div>
                    <div class="col-2 text-center py-2">
                        <input class="form-check-input inputFile" type="radio" name="audioSpeaker" value="ada">
                    </div>
                    <div class="col-2 text-center py-2">
                        <input class="form-check-input inputFile" type="radio" name="audioSpeaker" value="tidak">
                    </div>
                    <div class="col-3 text-center pt-1">
                        <input class="form-control form-control-sm" type="file" name="audioSpeakerFile" id="audioSpeakerFile" hidden>
                    </div>
                </div>
                {{-- SPION TENGAH --}}
                <div class="row">
                    <div class="col-5 py-2 bg-danger text-white">SPION TENGAH</div>
                    <div class="col-2 text-center py-2 bg-danger">
                        <input class="form-check-input inputFile" type="radio" name="spionTengah" value="ada">
                    </div>
                    <div class="col-2 text-center py-2 bg-danger">
                        <input class="form-check-input inputFile" type="radio" name="spionTengah" value="tidak">
                    </div>
                    <div class="col-3 text-center pt-1 bg-danger">
                        <input class="form-control form-control-sm" type="file" name="spionTengahFile" id="spionTengahFile" hidden>
                    </div>
                </div>
                {{-- LAMPU PLAFON DEPAN --}}
                <div class="row">
                    <div class="col-5 py-2">LAMPU PLAFON DEPAN</div>
                    <div class="col-2 text-center py-2">
                        <input class="form-check-input inputFile" type="radio" name="lampuPlafonDepan" value="ada">
                    </div>
                    <div class="col-2 text-center py-2">
                        <input class="form-check-input inputFile" type="radio" name="lampuPlafonDepan" value="tidak">
                    </div>
                    <div class="col-3 text-center pt-1">
                        <input class="form-control form-control-sm" type="file" name="lampuPlafonDepanFile" id="lampuPlafonDepanFile" hidden>
                    </div>
                </div>
                {{-- CATATAN --}}
                <div class="row">
                    <div class="col-6 py-2 bg-danger text-white">CATATAN</div>
                    <div class="col-6 text-center pt-1 bg-danger">
                        <input class="form-control form-control-sm" type="text" placeholder="isi disini" name="catatanBagianDepanMobil">
                    </div>
                </div>
            </div>
            
            {{-- BAGIAN BELAKANG --}}
            <div class="container" style="margin-top: 50px">
                <div class="row">
                    <div class="col-5 fw-bold py-2">BAGIAN BELAKANG</div>
                    <div class="col-2 fw-bold text-center py-2">ADA</div>
                    <div class="col-2 fw-bold text-center py-2">TIDAK ADA</div>
                    <div class="col-3 fw-bold text-center py-2">FILE</div>
                </div>
                {{-- FUNGSI AC BELAKANG --}}
                <div class="row">
                    <div class="col-5 py-2 bg-danger text-white">FUNGSI AC BELAKANG</div>
                    <div class="col-2 text-center py-2 bg-danger">
                        <input class="form-check-input inputFile" type="radio" name="fungsiAcBelakang" value="ada">
                    </div>
                    <div class="col-2 text-center py-2 bg-danger">
                        <input class="form-check-input inputFile" type="radio" name="fungsiAcBelakang" value="tidak">
                    </div>
                    <div class="col-3 text-center pt-1 bg-danger">
                        <input class="form-control form-control-sm" type="file" name="fungsiAcBelakangFile" id="fungsiAcBelakangFile" hidden>
                    </div>
                </div>
                {{-- JOK BARIS BELAKANG --}}
                <div class="row">
                    <div class="col-5 py-2">JOK BARIS BELAKANG</div>
                    <div class="col-2 text-center py-2">
                        <input class="form-check-input inputFile" type="radio" name="jokBarisBelakang" value="ada">
                    </div>
                    <div class="col-2 text-center py-2">
                        <input class="form-check-input inputFile" type="radio" name="jokBarisBelakang" value="tidak">
                    </div>
                    <div class="col-3 text-center pt-1">
                        <input class="form-control form-control-sm" type="file" name="jokBarisBelakangFile" id="jokBarisBelakangFile" hidden>
                    </div>
                </div>
                {{-- FUNGSI KURSI BARIS KEDUA --}}
                <div class="row">
                    <div class="col-5 py-2 bg-danger text-white">FUNGSI KURSI BARIS KEDUA</div>
                    <div class="col-2 text-center py-2 bg-danger">
                        <input class="form-check-input inputFile" type="radio" name="fungsiKursiBarisKedua" value="ada">
                    </div>
                    <div class="col-2 text-center py-2 bg-danger">
                        <input class="form-check-input inputFile" type="radio" name="fungsiKursiBarisKedua" value="tidak">
                    </div>
                    <div class="col-3 text-center pt-1 bg-danger">
                        <input class="form-control form-control-sm" type="file" name="fungsiKursiBarisKeduaFile" id="fungsiKursiBarisKeduaFile" hidden>
                    </div>
                </div>
                {{-- FUNGSI KURSI BARIS KETIGA --}}
                <div class="row">
                    <div class="col-5 py-2">FUNGSI KURSI BARIS KETIGA</div>
                    <div class="col-2 text-center py-2">
                        <input class="form-check-input inputFile" type="radio" name="fungsiKursiBarisKetiga" value="ada">
                    </div>
                    <div class="col-2 text-center py-2">
                        <input class="form-check-input inputFile" type="radio" name="fungsiKursiBarisKetiga" value="tidak">
                    </div>
                    <div class="col-3 text-center pt-1">
                        <input class="form-control form-control-sm" type="file" name="fungsiKursiBarisKetigaFile" id="fungsiKursiBarisKetigaFile" hidden>
                    </div>
                </div>
                {{-- LAMPU PLAFON BELAKANG --}}
                <div class="row">
                    <div class="col-5 py-2 bg-danger text-white">LAMPU PLAFON BELAKANG</div>
                    <div class="col-2 text-center py-2 bg-danger">
                        <input class="form-check-input inputFile" type="radio" name="lampuPlafonBelakang" value="ada">
                    </div>
                    <div class="col-2 text-center py-2 bg-danger">
                        <input class="form-check-input inputFile" type="radio" name="lampuPlafonBelakang" value="tidak">
                    </div>
                    <div class="col-3 text-center pt-1 bg-danger">
                        <input class="form-control form-control-sm" type="file" name="lampuPlafonBelakangFile" id="lampuPlafonBelakangFile" hidden>
                    </div>
                </div>
                {{-- KARPET KEPING BELAKANG --}}
                <div class="row">
                    <div class="col-5 py-2">KARPET KEPING BELAKANG</div>
                    <div class="col-2 text-center py-2">
                        <input class="form-check-input inputFile" type="radio" name="karpetKepingBelakang" value="ada">
                    </div>
                    <div class="col-2 text-center py-2">
                        <input class="form-check-input inputFile" type="radio" name="karpetKepingBelakang" value="tidak">
                    </div>
                    <div class="col-3 text-center pt-1">
                        <input class="form-control form-control-sm" type="file" name="karpetKepingBelakangFile" id="karpetKepingBelakangFile" hidden>
                    </div>
                </div>
                {{-- CATATAN --}}
                <div class="row">
                    <div class="col-6 py-2 bg-danger text-white">CATATAN</div>
                    <div class="col-6 text-center pt-1 bg-danger">
                        <input class="form-control form-control-sm" type="text" placeholder="isi disini" name="catatanBagianBelakangMobil">
                    </div>
                </div>
            </div>
        </div>

        <button type="button" class="btn btn-primary mt-5 position-absolute" style="margin-left: 100px; width: 100px" id="btnPrev" hidden>Prev</button>

        <button type="button" class="btn btn-primary mt-5 position-absolute end-0" style="margin-right: 100px; width: 100px" id="btnNext">Next</button>

        <button type="submit" class="btn btn-primary mt-5 position-absolute end-0" style="margin-right: 100px; width: 100px" id="btnProcess" hidden>Process</button>
    </form>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="{{ asset('assets/js/checkingHelper.js') }}"></script>
</body>
</html>