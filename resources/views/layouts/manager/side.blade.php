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
      <a class="nav-link text-white {{ $pej->link=='/user' ? 'active' : '' }}" href="{{ $pej->link=='/user' ? '#' : '/user' }}">
        
          <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="material-icons opacity-10">manage_accounts</i>
          </div>
        
        <span class="nav-link-text ms-1">Users</span>
      </a>
    </li>

    <li class="nav-item mt-3">
      <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Master Data</h6>
    </li>

    <li class="nav-item">
      <a class="nav-link text-white {{ $pej->link=='/bengkel' ? 'active' : '' }}" href="{{ $pej->link=='/bengkel' ? '#' : '/bengkel' }}">
        
          <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="material-icons opacity-10">handyman</i>
          </div>
        
        <span class="nav-link-text ms-1">Bengkel</span>
      </a>
    </li>


    <li class="nav-item">
      <a class="nav-link text-white {{ $pej->link=='/asuransi' ? 'active' : '' }}" href="{{ $pej->link=='/asuransi' ? '#' : '/asuransi' }}">
        
          <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="material-icons opacity-10">health_and_safety</i>
          </div>
        
        <span class="nav-link-text ms-1">Asuransi</span>
      </a>
    </li>