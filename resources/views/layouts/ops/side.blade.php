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
  <a class="nav-link text-white {{ $pej->link=='/repair' ? 'active' : '' }}" href="{{ $pej->link=='/repair' ? '#' : route('repair') }}">
    
    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
      <i class="material-icons opacity-10">handyman</i>
    </div>

    <span class="nav-link-text ms-1 position-relative">Perbaikan</span>
  </a>
</li>

<li class="nav-item">
  <a class="nav-link text-white {{ $pej->link=='/deliveryList' ? 'active' : '' }}" href="{{ $pej->link=='/deliveryList' ? '#' : route('deliveryList') }}">
    
    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
      <i class="material-icons opacity-10">send</i>
    </div>

    <span class="nav-link-text ms-1 position-relative">Delivery Order</span>
  </a>
</li>