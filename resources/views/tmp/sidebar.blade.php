<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3   bg-gradient-dark" id="sidenav-main">

  <div class="sidenav-header">
    <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
    <a class="navbar-brand m-0" href="https://www.lestarimobilindo.com/" target="_blank">
      <img src="{{ asset('assets/img/logo.png')}}" class="navbar-brand-img h-100" alt="main_logo">
    </a>
  </div>

  <hr class="horizontal light mt-0 mb-2">

  <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
    <ul class="navbar-nav">    
      @include("layouts.".\Auth::user()->jabatan.".side" )
    </ul>
  </div>

  <div class="sidenav-footer position-absolute w-100 bottom-0 ">
      <div class="mx-3">
        <a class="btn bg-dark mt-4 w-100" type="button">{{ \Auth::user()->jabatan }}</a>
      </div>
  </div>

</aside>