@extends("tmp.main")

@section('title',$pej->name)

@section('style')
@endsection

@section('sidemenu')

@endsection

@section('content')

    <div>
        <h3>Surat Pemesanan Kendaraan</h3>
        <form id="formSPK" enctype="multipart/form-data">

            <div class="mb-3">
                <label for="namaPemesan">Nama Pemesan</label>
                <input type="text" id="namaPemesan" class="form-control border" value="{{$jual->pemesan}}" readonly/>
            </div>
            <div class="row">
                <div class="mb-3 col-md-6">
                    <label for="jenisKelamin">Jenis Kelamin</label>
                    <select name="jenis_kelamin" id="jenisKelamin" data-phd="Jenis Kelamin" class="form-select">
                        <option selected disabled>=== Pilih Jenis Kelamin</Option>
                        <option value="L">Laki-laki</option>
                        <option value="P">Perempuan</option>
                    </select>
                </div>
                <div class="mb-3 col-md-6">
                    <label for="tanggal_lahir">Tanggal Lahir</label><br>
                    <input type="date" name="tanggal_lahir" id="tanggal_lahir" data-phd="Tanggal Lahir" class="form-control">
                </div>
            </div>
            <div class="row">
                <div class="mb-3 col-md-6">
                    <label for="noKTP">Nomor KTP / KITAS</label>
                    <input type="text" name="nomor_ktp" id="noKTP" data-phd="Nomor KTP" class="form-control border nomor" placeholder="Nomor KITAS" />
                </div>
                <div class="mb-3 col-md-6">
                    <label for="fileKTP">Foto KTP</label><br>
                    <input type="file" name="photo_ktp" id="fileKTP">
                </div>
            </div>
            <div class="mb-3">
                <label for="alamat">Alamat Domisili / Usaha</label>
                <input type="text" id="alamat" data-phd="Alamat" class="form-control border" value="{{$jual->domisili}}" readonly/>
            </div>
            <div class="row"> 
                <div class="mb-3 col-md-6">
                    <label for="telpon">No.Hp/Telp</label>
                    <input type="text" id="telpon" data-phd="Nomor HP/Telp" class="form-control border nomor" value="{{$jual->kontak}}" readonly/>
                </div>
                <div class="mb-3 col-md-6">
                    <label for="agama">Agama</label>
                    <select name="agama" id="agama" data-phd="Agama" class="form-select">
                        <option selected disabled>=== Pilih Agama ===</option>
                        <option value="1">Budha</option>
                        <option value="2">Hindu</option>
                        <option value="3">Islam</option>
                        <option value="4">Katolik</option>
                        <option value="5">Konghucu</option>
                        <option value="6">Kristen</option>
                    </select>
                </div>
            </div>


            <div class="row mb-3">
                <div class="col-md-6">
                    <div class="mb-3 pt-4 pb-3">
                        <h5>Media Sosial</h5>
                    </div>
                    <div class="mb-3">
                        <label for="instagram">Instagram <i class="fab fa-instagram"></i></label>
                        <input type="text" id="instagram" data-phd="Instagram" name="instagram" class="form-control border" placeholder="Username" aria-label="Username" />
                    </div>
                    <div class="mb-3">
                        <label for="facebook">Facebook <i class="fab fa-facebook"></i></label>
                        <input type="text" id="facebook" data-phd="Facebook" name="facebook" class="form-control border" placeholder="Username" aria-label="Username" />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="namaP">Nama Pemakai</label>
                        <input type="text" id="namaP" data-phd="Nama Pemakai" name="namaP" class="form-control border" placeholder="Nama" aria-label="Nama" />
                    </div>
                    <div class="mb-3">
                        <label for="alamatP">Alamat Domisili</label>
                        <input type="text" id="alamatP" data-phd="Alamat Pemakai" name="alamatP" class="form-control border" placeholder="Alamat" aria-label="Alamat" />
                    </div>
                    <div class="mb-3">
                        <label for="telpP">No.Hp/Telp</label>
                        <input type="text" id="telpP" data-phd="Nomor HP/Telpon" name="telP" class="form-control border nomor" placeholder="Telpon" aria-label="Telpon" />
                    </div>
                </div>
            </div>

            <div class="row">

                <div class="mb-3 col-md-6">
                    <h3>Cara Pembayaran</h3>
                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="jenis_pembayaran" id="bayarTunai" value="1" checked>
                            <label class="form-check-label" for="bayarTunai">
                            Tunai
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="jenis_pembayaran" id="bayarKredit" value="2">
                            <label class="form-check-label" for="bayarKredit">
                            Kredit
                            </label>
                        </div>
                    </div>
                    <div id="divKredit" class="d-none">
                        <div class="mb-3">
                            <label for="leasing">Leasing</label>
                            <select name="leasing" id="leasing" data-phd="Leasing" class="form-select">
                                <option selected disabled>=== Pilih Leasing</option>
                                @foreach ($leasing as $k => $v)
                                    <option value="{{$v->id}}">{{$v->nama}}</option>                                
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="downPayment">Total DP</label>
                            <input type="text" name="total_dp" id="downPayment" data-phd="Total DP" class="form-control border uangs" placeholder="Rp . . . . ." />
                        </div>
                        <div class="mb-3">
                            <label for="angsuran">Angsuran</label>
                            <input type="text" name="angsuran" id="angsuran" data-phd="Angsuran Kredit" class="form-control border uangs" placeholder="Rp . . . . ." />
                        </div>
                        <div class="mb-3">
                            <label for="tenor">Jangka Waktu</label>
                            <input type="text" name="tenor" id="tenor" data-phd="Tenor Kredit" class="form-control border" placeholder=" . . bulan" />
                        </div>
                    </div>
                </div>

                <div class="mb-3 col-md-6">
                    <h3>Asuransi</h3>

                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="asuransi" id="pakaiAsuransi" value="1">
                            <label class="form-check-label" for="pakaiAsuransi">
                            Ya
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="asuransi" id="tanpaAsuansi" value="0" checked>
                            <label class="form-check-label" for="tanpaAsuansi">
                            Tidak
                            </label>
                        </div>

                    </div>
                    <div id="divAsuransi" class="d-none">
                        <div class="mb-3">
                            <label for="id_asuransi">Asuransi</label>
                            <select name="id_asuransi" id="id_asuransi" data-phd="Asuransi" class="form-select">
                                <option selected disabled>=== Pilih Asuransi ===</option>
                                @foreach ($asuransi as $k => $v)
                                    <option value="{{$v->id}}">{{$v->nama}}</option>                                
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <h5>Jenis Asuransi</h5>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="jenisAsuransi" id="asuransi1" value="0" >
                                <label class="form-check-label" for="asuransi1">
                                TLO
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="jenisAsuransi" id="asuransi2" value="1" >
                                <label class="form-check-label" for="asuransi2">
                                Kombinasi
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="jenisAsuransi" id="asuransi3" value="2" >
                                <label class="form-check-label" for="asuransi3">
                                All Risk
                                </label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="biayaAsuransi">Biaya Asuransi</label>
                            <input type="text" class="form-control border uangs" name="biayaAsuransi" id="biayaAsuransi" data-phd="Biaya Asuransi" placeholder="Rp . . . . ."/>
                        </div>
                        <div class="mb-3 form-check form-switch">
                            <input class="form-check-input" type="checkbox" role="switch" id="tjh3switch">
                            <label class="form-check-label" for="tjh3switch">Tanggung Jawab Pihak ke-3 (TJH 3)</label>
                        </div>
                        <div class="mb-3 d-none" id="tjh3div">
                            <input type="text" class="form-control border uangs" name="tjh3" id="biayaTjh3" data-phd="Tanggung Jawab Pihak ke-3" placeholder="Rp . . . . ."/>
                        </div>
                        <div class="mb-3 form-check form-switch">
                            <input class="form-check-input" name="asuransi_jiwa" type="checkbox" role="switch" id="asJiwa">
                            <label class="form-check-label" for="asJiwa">Asuransi Jiwa</label>
                        </div>
                        <div class="mb-3 form-check form-switch">
                            <input class="form-check-input" name="asuransi_kebakaran" type="checkbox" role="switch" id="asTeror">
                            <label class="form-check-label" for="asTeror">Asuransi Kebakaran, Terorisme, Bencana Alam</label>
                        </div>

                    </div>

                </div>



            </div>

            <div class="mb-3 text-center">
                <button type="button" class="btn btn-primary" onclick="submitFungsi()">Submit</button>
            </div>

        </form>


    </div>


    {{-- Modal after input SPK --}}
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header text-center">
                
            </div>
            <div class="modal-body text-center">
                <h1 class="modal-title fs-5 w-100" id="staticBackdropLabel">SPK Berhasil Diinput! <i class="material-icons opacity-10">verified</i></h1>
            </div>
            <div class="modal-footer">
                <a class="btn btn-secondary" href="{{route('prospek')}}">Kaluar</a>
                <button type="button" class="btn btn-primary" onclick="SPKcetak({{$jual->id}})">Cetak SPK</button>
            </div>
            </div>
        </div>
    </div>

@endsection

@section('script')

    <script src="{{asset('assets/vendor/jquery/jquery.number.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/locale/id.min.js"></script>
    <script src="{{asset('assets/js/print.js')}}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.8/ScrollMagic.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.9.1/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.8/plugins/animation.gsap.min.js"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.7/dist/loadingoverlay.min.js"></script>

    <script>

        $(document).ready(function() {
            // Token
            $.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('.uangs').number(true,0);

            $('.nomor').number(true, 0, '', '', '', { aNeg: false });

            // $('#staticBackdrop').modal('show');
        });

        $('input:radio[name="jenis_pembayaran"]').on('change', function () {
            if ($(this).val() == 1) {
                $('#divKredit').addClass('d-none');
                $('#leasing').prop('selectedIndex',0);
                $('#downPayment,#angsuran,#tenor').val("");
            } else {
                $('#divKredit').removeClass('d-none');
                $('#pakaiAsuransi').prop("checked", true);
                $('#divAsuransi').removeClass('d-none');
            }
        });

        $('input:radio[name="asuransi"]').on('change', function () {
            if ($(this).val() == 0) {
                $('#divAsuransi').addClass('d-none');
                $('#id_asuransi').prop('selectedIndex',0);
                $('input:radio[name="jenisAsuransi"]').prop('checked', false);
                $('#biayaAsuransi').val("");
                $('#tjh3switch').prop('checked', false);
                $('#myCheckbox').val('');
                $('#tjh3div').addClass(['d-none']);
                $('#asJiwa').prop('checked', false);
                $('#asTeror').prop('checked', false);
            } else {
                $('#divAsuransi').removeClass('d-none');
            }
        });

        $('#tjh3switch').on('change', function() {
            if ($(this).is(':checked')) {
                $('#tjh3div').removeClass(['d-none']);
            } else {
                $('#tjh3div').addClass(['d-none']);
                $('#biayaTjh3').val("");
            }
            
        });


        function submitFungsi() {
            var isFormValid = true;
            var data = {};

            $('#jenisKelamin, #fileKTP, #noKTP, #tanggal_lahir, #agama, #namaP, #alamatP, #telpP, input:radio[name="jenis_pembayaran"]:checked, input:radio[name="asuransi"]:checked').each(function() {
                var input = $(this);
                
                try {
                    var value = input.val().trim();
                    var id = input.attr('name');                    
                } catch (error) {

                }

                if (value === '' || value === null) {
                    isFormValid = false;
                    alert('Isi '+input.data("phd")+' sebelum mengirimkan formulir.');
                    console.log(input.data('phd'));
                    $(this).focus();
                    return false; 
                }
                
                
                data[id] = value;
            });

            if(data.jenis_pembayaran==2) {
                $('#leasing, #downPayment, #angsuran, #tenor').each(function() {
                    var input = $(this);
                
                    try {
                        var value = input.val().trim();
                        var id = input.attr('name');                    
                    } catch (error) {

                    }

                    if (value === '' || value === null) {
                        isFormValid = false;
                        alert('Isi '+input.data("phd")+' sebelum mengirimkan formulir.');
                        $(this).focus();
                        return false; 
                    }
                    
                    
                    data[id] = value;
                });
            }


            if(data.asuransi==1) {
                $('#id_asuransi, input:radio[name="jenisAsuransi"]:checked, #biayaAsuransi').each(function() {
                    var input = $(this);
                
                    try {
                        var value = input.val().trim();
                        var id = input.attr('name');                    
                    } catch (error) {

                    }

                    if (value === '' || value === null) {
                        isFormValid = false;
                        alert('Isi '+input.data("phd")+' sebelum mengirimkan formulir.');
                        $(this).focus();
                        return false; 
                    }
                    
                    
                    data[id] = value;
                });
            }

            
            if (isFormValid) {
                try {
                    var formData = new FormData($('#formSPK')[0]);

                    // Mengambil data dari form menggunakan serializeArray
                    var formArray = $('#formSPK').serializeArray();

                    // Menambahkan setiap pasangan nama-nilai ke dalam objek FormData
                    $.each(formArray, function(index, field) {
                        formData.append(field.name, field.value);
                    });

                    // Menambahkan file gambar ke dalam objek FormData
                    formData.append('image', $('#fileKTP')[0].files[0]);

                    formData.append('id',{{$jual->id}});

                    if ($('#asJiwa').is(':checked')) {
                        formData.append('asuransi_jiwa',1);
                    }

                    if ($('#asTeror').is(':checked')) {
                        formData.append('asuransi_kebakaran',1);
                    }

                    console.log(data);

                    $.ajax({
                        type: "POST",
                        url: "/spk/submit",
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function (response) {
                            if (response.status=="success") {
                                console.log(response.res);
                                $('#staticBackdrop').modal('show');
                            } else {
                                console.log(response.res);
                            }
                        },
                        error: function (response) {
                            console.log(response);
                        }
                    });
                } catch (error) {
                    console.log(error);
                }
            
            }
            
            
            return false;
        }


        function SPKcetak(id) {
            console.log(id);

            $.ajax({
                type: "POST",
                url: "/spk/cetak",
                data: {id:id},
                dataType: "json",
                success: function (response) {
                    if (response.status=="success") {
                        console.log(response.data);

                        var today = new Date();
                        var day = today.getDate();
                        var month = today.getMonth() + 1;
                        var year = today.getFullYear();

                        response.data.tanggal = moment(today).locale('id').format('DD MMMM YYYY');

                        SPK(response.data);
                    } else {
                        console.log(response.data);
                    }
                }
            });
        }

        


    </script>

    



@endsection
