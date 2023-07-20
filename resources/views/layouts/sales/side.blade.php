    <li class="nav-item">
      <a class="nav-link text-white {{ $pej->link=='' ? 'active' : '' }}" href="{{ $pej->link=='' ? '#' : '/' }}">
        
          <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="material-icons opacity-10">dashboard</i>
          </div>
        
        <span class="nav-link-text ms-1">Dashboard</span>
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

      
