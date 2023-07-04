<li class="nav-item">
      <a class="nav-link text-white {{ $pej->link=='' ? 'active' : '' }}" href="{{ $pej->link=='' ? '#' : '/' }}">
        
          <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="material-icons opacity-10">dashboard</i>
          </div>
        
        <span class="nav-link-text ms-1">Dashboard</span>
      </a>
    </li>

      
    <li class="nav-item">
      <a class="nav-link text-white {{ $pej->link=='/pemeriksaan' ? 'active' : '' }}" href="{{ $pej->link=='/pemeriksaan' ? '#' : route('pemeriksaan') }}">
        
        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
          <i class="material-icons opacity-10">task</i>
        </div>

        <span class="nav-link-text ms-1 position-relative">Pemeriksaan

          @if ($notif->pemeriksaan>0)
            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">{{$notif->pemeriksaan}}</span>
          @endif

        </span>
      </a>
    </li>

      
    <li class="nav-item">
      <a class="nav-link text-white " href="./billing.html">
        
          <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="material-icons opacity-10">receipt_long</i>
          </div>
        
        <span class="nav-link-text ms-1">Billing</span>
      </a>
    </li>

      
    <li class="nav-item">
      <a class="nav-link text-white " href="./virtual-reality.html">
        
          <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="material-icons opacity-10">view_in_ar</i>
          </div>
        
        <span class="nav-link-text ms-1">Virtual Reality</span>
      </a>
    </li>

      
    <li class="nav-item">
      <a class="nav-link text-white " href="./rtl.html">
        
          <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="material-icons opacity-10">format_textdirection_r_to_l</i>
          </div>
        
        <span class="nav-link-text ms-1">RTL</span>
      </a>
    </li>

      
    <li class="nav-item">
      <a class="nav-link text-white " href="./notifications.html">
        
          <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="material-icons opacity-10">notifications</i>
          </div>
        
        <span class="nav-link-text ms-1">Notifications</span>
      </a>
    </li>