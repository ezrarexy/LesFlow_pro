<main class="main-content border-radius-lg ">
        <!-- Navbar -->

          <nav class="navbar navbar-main navbar-expand-lg ps-2 ms-4 shadow-none border-radius-xl position-fixed w-80" style="z-index: 100" id="navbarBlur" data-scroll="true">
            <div class="container-fluid py-1 px-3">
              <!-- Left navbar menu -->
              <nav aria-label="breadcrumb">
                

                <h6 class="font-weight-bolder mb-0">{{$pej->name}}</h6>

                
              </nav>

              <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
                <div class="ms-md-auto pe-md-3 d-flex align-items-center">                    
                </div>

                <!-- Right navbar menu -->
                <ul class="navbar-nav  justify-content-end">


                  <!-- Notifikasi -->
                  <li class="nav-item dropdown d-flex align-items-center me-3">
                    <a href="javascript:;" class="nav-link text-body p-0" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                      <i class="fa fa-bell cursor-pointer"></i>
                    </a>

                    <ul class="dropdown-menu  dropdown-menu-end  px-2 py-3 me-sm-n4" aria-labelledby="dropdownMenuButton">
                      @if(isset($notif) && $notif->status == true)
                        @include("layouts.".\Auth::user()->jabatan.".notif" )
                      @else
                        <li class="mb-2 ">
                            <a class="dropdown-item border-radius-md" href="javascript:;">
                                <div class="d-flex py-1">
                                    <span>Tidak ada pemberitahuan</span>
                                </div>
                            </a>
                        </li>
                      @endif

                    </ul>

                    @if(isset($notif) && $notif->status == true)
                      <span class="position-absolute top-0 start-80 translate-middle p-2 bg-danger border border-light rounded-circle">
                        <span class="visually-hidden">New alerts</span>
                      </span>
                    @endif

                  </li>

                  <!-- Profile -->
                  <li class="nav-item dropdown d-flex align-items-center">
                    <a href="javascript:;" class="nav-link text-body p-0" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa fa-user me-sm-1"></i>
                    </a>

                    <ul class="dropdown-menu  dropdown-menu-end  px-2 py-3 me-sm-n4" aria-labelledby="dropdownMenuButton">

                        <!-- Menu drop down -->
                      <li class="mb-2">
                        <a href="/profile"> <i class="fa fa-user"></i> Profile</a>
                      </li>
                      <li class="mb-2">
                        <a href="#" data-bs-toggle="modal" data-bs-target="#CPModal"> <i class="fas fa-key"></i> Ganti Password</a>
                      </li>
                      <li class="mb-2">
                        <a href="{{ route('out') }}"> <i class="fas fa-sign-out-alt"></i> Keluar</a>
                      </li>
                      

                    </ul>
                  </li>
              

                  <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
                    <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                      <div class="sidenav-toggler-inner">
                        <i class="sidenav-toggler-line"></i>
                        <i class="sidenav-toggler-line"></i>
                        <i class="sidenav-toggler-line"></i>
                      </div>
                    </a>
                  </li>

                
                </ul>

              </div>
            </div>
          </nav>

         
       </main>