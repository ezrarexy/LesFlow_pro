<!DOCTYPE html>
<html lang="en">
  <head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


    <link rel="apple-touch-icon" sizes="57x57" href="{{asset('favicon/apple-icon-57x57.png')}}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{asset('favicon/apple-icon-60x60.png')}}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{asset('favicon/apple-icon-72x72.png')}}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{asset('favicon/apple-icon-76x76.png')}}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{asset('favicon/apple-icon-114x114.png')}}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{asset('favicon/apple-icon-120x120.png')}}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{asset('favicon/apple-icon-144x144.png')}}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{asset('favicon/apple-icon-152x152.png')}}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('favicon/apple-icon-180x180.png')}}">
    <link rel="icon" type="image/png" sizes="192x192"  href="{{asset('favicon/android-icon-192x192.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('favicon/favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{asset('favicon/favicon-96x96.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('favicon/favicon-16x16.png')}}">
    <link rel="manifest" href="{{asset('favicon/manifest.json')}}">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="{{asset('/ms-icon-144x144.png')}}">
    <meta name="theme-color" content="#ffffff">

    

    <title>@yield('title') - Lestari Mobilindo</title>



    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />

    <!-- Nucleo Icons -->
    <link href="{{ asset('assets/css/nucleo-icons.css')}}" rel="stylesheet" />
    <link href="{{ asset('assets/css/nucleo-svg.css')}}" rel="stylesheet" />



    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">

    <!-- CSS Files -->


    <link rel="stylesheet" href="{{ asset('assets/css/all.css') }}">
    
    <link id="pagestyle" href="{{ asset('assets/css/material-dashboard.css?v=3.0.5')}}" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" referrerpolicy="no-referrer" />


    <style>
        .scroll-container {
        height: 100vh;
        width: 100%;
        overflow-y: scroll;
        scrollbar-width: thin; /* Untuk browser modern */
        scrollbar-color: transparent transparent; /* Untuk browser modern */
        }

        /* Untuk browser WebKit seperti Chrome dan Safari */
        .scroll-container::-webkit-scrollbar {
        width: 6px;
        }

        .scroll-container::-webkit-scrollbar-track {
        background-color: transparent;
        }

        .scroll-container::-webkit-scrollbar-thumb {
        background-color: transparent;
        }
    </style>


    @yield('style')


    <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>

  </head>


  <body class="g-sidenav-show  bg-gray-100 scroll-container">
    
    @include('tmp.sidebar')

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">

        @include('tmp.topbar')

        <div class="container-fluid py-4 pt-5" style="overflow-x: auto; white-space:nowrap">        

            @yield('content')

            <!-- Change Password Modal -->
            <div class="modal fade" id="CPModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="ChangePasswordModal" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Ganti Password</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="FcPass">
                                <div class="col-12">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1"></i></span>
                                        </div>
                                        <input name="oldPass" type="password" value="" class="input form-control" id="password0" placeholder="Password Lama" required="true" aria-label="password" aria-describedby="basic-addon1" />
                                        <div class="input-group-append">
                                            <span class="input-group-text" onclick="password_show_hide('0')">
                                            <i class="fas fa-eye" id="show_eye0"></i>
                                            <i class="fas fa-eye-slash d-none" id="hide_eye0"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1"></span>
                                        </div>
                                        <input name="password" type="password" value="" class="input form-control" id="password1" placeholder="Password Baru" required="true" aria-label="password" aria-describedby="basic-addon1" />
                                        <div class="input-group-append">
                                            <span class="input-group-text" onclick="password_show_hide('1')">
                                            <i class="fas fa-eye" id="show_eye1"></i>
                                            <i class="fas fa-eye-slash d-none" id="hide_eye1"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1"></span>
                                        </div>
                                        <input name="password" type="password" value="" class="input form-control" id="password2" placeholder="Ulangi Password Baru" required="true" aria-label="password" aria-describedby="basic-addon1" />
                                        <div class="input-group-append">
                                            <span class="input-group-text" onclick="password_show_hide('2')">
                                            <i class="fas fa-eye" id="show_eye2"></i>
                                            <i class="fas fa-eye-slash d-none" id="hide_eye2"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="button" id="chPassGo" class="btn btn-primary" disabled>Ganti</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </main>


    @if(\Auth::user()->id_role==2 || \Auth::user()->id_role==4 || \Auth::user()->id_role==5)
        <div class="fixed-plugin">
            <a class="fixed-plugin-button text-dark position-fixed px-3 py-2">
            <i class="material-icons py-2">point_of_sales</i>
            </a>
            <div class="card shadow-lg">
                <div class="card-header pb-0 pt-3">
                    <div class="float-start">
                    <h5 class="mt-3 mb-0">Point of Sales</h5>
                    <p>Menu jual/beli</p>
                    </div>
                    <div class="float-end mt-4">
                    <button class="btn btn-link text-dark p-0 fixed-plugin-close-button">
                        <i class="material-icons">clear</i>
                    </button>
                    </div>
                    <!-- End Toggle Button -->
                </div>
                <hr class="horizontal dark my-1">
                
                @if (\Auth::user()->id_role!==2)
                    <a class="btn bg-gradient-info w-100" href="{{route('jual')}}">Jual</a>
                    
                    <hr class="horizontal dark my-1">
                @endif
                
                <a class="btn btn-outline-dark w-100" href="{{route('beli')}}">Beli</a>
            </div>
        </div>
    @endif


    <!--   Core JS Files   -->
    <script src="{{ asset('assets/js/core/popper.min.js') }} "></script>
    <script src="{{ asset('assets/js/core/bootstrap.min.js') }} "></script>
    <script src="{{ asset('assets/js/plugins/perfect-scrollbar.min.js') }}" ></script>
    <script src="{{ asset('assets/js/plugins/smooth-scrollbar.min.js') }}" ></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.js.map"></script>    
    <script src="{{ asset('assets/vendor/fontawesome-free/js/all.min.js') }}"></script>


    <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
        var options = {
        damping: '0.5'
        }
        Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }


        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#password1').on('keydown', function() {
            if ($('#password1').val() !== "") $('#chPassGo').attr('disabled',false) ;
            else $('#chPassGo').attr('disabled',true) ;
        });

        function password_show_hide(elem) {
            var x = document.getElementById("password"+elem);
            var show_eye = document.getElementById("show_eye"+elem);
            var hide_eye = document.getElementById("hide_eye"+elem);
            hide_eye.classList.remove("d-none");
            
            if (x.type === "password") {
                x.type = "text";
                show_eye.style.display = "none";
                hide_eye.style.display = "block";
            } else {
                x.type = "password";
                show_eye.style.display = "block";
                hide_eye.style.display = "none";
            }
        }

        $('#chPassGo').on('click', function() {
            var oldPass = $('#password0').val();
            var pass1 = $('#password1').val();
            var pass2 = $('#password2').val();

            if (pass1.length < 8) {
                toastr.error('Password harus berisikan minimum 8 karakter!');
                $('#password1').focus();
            } else {
                if (pass1 === pass2) {
                    
                    $.ajax({
                        type: "POST",
                        url: "{{ route('crPass') }}",
                        data: {oldPass:oldPass},
                        dataType: "json",
                        success: function (response) {
                            console.log(response);
                            if (response.status == 'ok') {
                                $.ajax({
                                    type: "PUT",
                                    url: "{{ route('chPass') }}",
                                    data: {password:pass1},
                                    dataType: "json",
                                    success: function (response) {
                                        if (response.status == 'ok') {
                                            toastr.success(response.msg);
                                            $('#CPModal').modal('hide');
                                        } else {
                                            toastr.error(response.msg);
                                        }
                                    }
                                });
                            } else {
                                toastr.error(response.msg);
                                $('#password0').focus();
                            }
                        }
                    });

                } else {
                    toastr.error('Password tidak sesuai!');
                    $('#password2').focus();
                }
            }
        });

        $('#CPModal').on('hidden.bs.modal', function () {
            $('#FcPass')[0].reset();
        });

        $(function () {
            $('[data-bs-toggle="tooltip"]').tooltip()
        })


    </script>

    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>


    <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="{{ asset('assets/js/material-dashboard.js?v=3.0.5')}}"></script>

    @yield('script')

  </body>

</html>
