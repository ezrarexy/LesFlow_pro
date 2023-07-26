@extends("tmp.main")

@section('title',$pej->name)


@section('style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection


@section('content')


    
    <div class="p-3 md-col-12">
        <div class="d-flex align-items-end justify-content-end pe-5">
            <button class="btn btn-secondary float-right me-5" id="adds"><i class="material-icons opacity-10">add_circle</i> Tambah</button>
        </div>
        <table class="table table-stripped" id="table1">
            <thead>
                <tr class="text-center">
                    <th>Nama</th>
                    <th>PIC</th>
                    <th>Telpon</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $k => $v)
                    <tr>
                        <td>{{$v->nama}}</td>
                        <td class="text-center">{{$v->pic}}</td>
                        <td class="text-center">{{$v->telp}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    


    <!-- Modal -->
    <div class="modal fade" id="modalAdd" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalAddLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modalAddLabel">Tambah Perusahaan Asuransi</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="form1">
                        <div class="mb-3">
                            <label for="iNama">Nama</label>
                            <input type="text" class="form-control border" name="nama" id="iNama"/>
                        </div>
                        <div class="mb-3">
                            <label for="iPIC">PIC</label>
                            <input type="text" class="form-control border" name="pic" id="iPIC"/>
                        </div>
                        <div class="mb-3">
                            <label for="iTelp">Telpon</label>
                            <input type="text" class="form-control border" name="telp" id="iTelp"/>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-primary" onclick="simpan()"><i class="material-icons opacity-10">save</i> Simpan</button>
                </div>
            </div>
        </div>
    </div>


@endsection


@section('script')

    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


    <script>
        $(function () {

            $.ajaxSetup({
                headers:
                { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
            });

            $('#table1').DataTable();
            
        });

        $('#adds').on('click', () => {
            $('#modalAdd').modal('show');
        });

        function simpan() {
            var data = $('#form1').serializeArray();
            var status = true;

            $.each(data, function (i, v) { 
                
                 if (v.value=="") {
                    status = false;
                    toastr.error('Lengkapi semua data!');
                    return false;
                 }

            });

            if (status) {
                $.ajax({
                    type: "POST",
                    url: "/asuransi/add",
                    data: data,
                    dataType: "json",
                    success: function (response) {
                        if (response.status=="success") {
                            location.reload();
                        } else {
                            console.log(response.res);
                        }
                    }
                });
            }
        }

    </script>
@endsection