<li class="nav-item">
      <a class="nav-link text-white {{ $pej->link=='' ? 'active' : '' }}" href="{{ $pej->link=='' ? '#' : '/' }}">
        
          <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="material-icons opacity-10">dashboard</i>
          </div>
        
        <span class="nav-link-text ms-1">Dashboard</span>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link text-white {{ $pej->link=='listspk' ? 'active' : '' }}" href="{{ $pej->link=='listspk' ? '#' : '/listspk' }}">
        
          <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="material-icons opacity-10">table_view</i>
          </div>
        
        <span class="nav-link-text ms-1">SPK</span>
      </a>
    </li>
      
    <li class="nav-item">
      <a class="nav-link text-white {{ $pej->link=='/finance/buy' ? 'active' : '' }}" href="{{ $pej->link=='/finance/buy' ? '#' : '/finance/buy' }}">
        
          <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="material-icons opacity-10">local_mall</i>
          </div>
        
        <span class="nav-link-text ms-1">Riwayat Pembelian</span>
      </a>
    </li>

      
    <li class="nav-item">
      <a class="nav-link text-white {{ $pej->link=='/finance/sell' ? 'active' : '' }}" href="{{ $pej->link=='/finance/sell' ? '#' : '/finance/sell' }}">
        
          <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="material-icons opacity-10">receipt_long</i>
          </div>
        
        <span class="nav-link-text ms-1">Riwayat Penjualan</span>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link text-white {{ $pej->link=='/finance/report' ? 'active' : '' }}" href="{{ $pej->link=='/finance/report' ? '#' : '/finance/report' }}">
        
          <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="material-icons opacity-10">receipt_long</i>
          </div>
        
        <span class="nav-link-text ms-1">Keuangan</span>
      </a>
    </li>
    