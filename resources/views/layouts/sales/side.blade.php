    <li class="nav-item">
      <a class="nav-link text-white {{ $pej->link=='' ? 'active' : '' }}" href="{{ $pej->link=='' ? '#' : '/' }}">
        
          <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="material-icons opacity-10">dashboard</i>
          </div>
        
        <span class="nav-link-text ms-1">Dashboard</span>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link text-white {{ $pej->link=='/mobil' ? 'active' : '' }}" href="{{ $pej->link=='/mobil' ? '#' : '/mobil' }}">
        
          <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="material-icons opacity-10">storefront</i>
          </div>
        
        <span class="nav-link-text ms-1">Mobil</span>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link text-white {{ $pej->link=='prospek' ? 'active' : '' }}" href="{{ $pej->link=='prospek' ? '#' : '/prospek' }}">
        
          <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="material-icons opacity-10">pending</i>
          </div>
        
        <span class="nav-link-text ms-1">Prospek</span>
      </a>
    </li>

      
    <li class="nav-item">
      <a class="nav-link text-white {{ $pej->link=='spk' ? 'active' : '' }}" href="{{ $pej->link=='spk' ? '#' : '/spk' }}">
        
          <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="material-icons opacity-10">table_view</i>
          </div>
        
        <span class="nav-link-text ms-1">SPK</span>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link text-white {{ $pej->link=='/transaksi/riwayat' ? 'active' : '' }}" href="{{ $pej->link=='/transaksi/riwayat' ? '#' : '/transaksi/riwayat' }}">
        
          <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="material-icons opacity-10">history_edu</i>
          </div>
        
        <span class="nav-link-text ms-1">Riwayat Transaksi</span>
      </a>
    </li>