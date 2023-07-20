    <li class="nav-item">
      <a class="nav-link text-white {{ $pej->link=='' ? 'active' : '' }}" href="{{ $pej->link=='' ? '#' : '/' }}">
        
          <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="material-icons opacity-10">dashboard</i>
          </div>
        
        <span class="nav-link-text ms-1">Dashboard</span>
      </a>
    </li>
      
    <li class="nav-item">
      <a class="nav-link text-white {{ $pej->link=='mobil' ? 'active' : '' }}" href="{{ route('inventory') }}">
        
          <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="material-icons opacity-10">storefront</i>
          </div>
        
        <span class="nav-link-text ms-1">Showroom</span>
      </a>
    </li>

      
    <li class="nav-item">
      <a class="nav-link text-white " href="./billing.html">
        
          <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="material-icons opacity-10">receipt_long</i>
          </div>
        
        <span class="nav-link-text ms-1">Keuangan</span>
      </a>
    </li>

    <li class="nav-item mt-3">
      <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Inventori</h6>
    </li>
      
    <li class="nav-item">
      <a class="nav-link text-white " href="./virtual-reality.html">
        
          <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="material-icons opacity-10">home_repair_service</i>
          </div>
        
        <span class="nav-link-text ms-1">Bengkel</span>
      </a>
    </li>
