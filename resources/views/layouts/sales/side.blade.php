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

    <li class="nav-item mt-3">
      <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Reminder</h6>
    </li>

    <li class="nav-item">
      <a class="nav-link text-white {{ $pej->link=='/reminder/hut' ? 'active' : '' }}" href="{{ $pej->link=='/reminder/hut' ? '#' : '/reminder/hut' }}">
        
          <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="material-icons opacity-10">cake</i>
          </div>
        
        <span class="nav-link-text ms-1 position-relative">Ulang Tahun

          @if ($notif->reminder->hut>0)
            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">{{$notif->reminder->hut}}</span>
          @endif

        </span>
      </a>
    </li>
    
    <li class="nav-item">
      <a class="nav-link text-white {{ $pej->link=='/reminder/raya' ? 'active' : '' }}" href="{{ $pej->link=='/reminder/raya' ? '#' : '/reminder/raya' }}">
        
          <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="material-icons opacity-10">event</i>
          </div>
        
        <span class="nav-link-text ms-1 position-relative">Hari Raya

          @if ($notif->reminder->raya>0)
            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">{{$notif->reminder->raya}}</span>
          @endif

        </span>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link text-white {{ $pej->link=='/reminder/pajak' ? 'active' : '' }}" href="{{ $pej->link=='/reminder/pajak' ? '#' : '/reminder/pajak' }}">
        
          <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="material-icons opacity-10">receipt_long</i>
          </div>
        
        <span class="nav-link-text ms-1 position-relative">Pajak

          @if ($notif->reminder->pajak>0)
            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">{{$notif->reminder->pajak}}</span>
          @endif

        </span>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link text-white {{ $pej->link=='/reminder/kredit' ? 'active' : '' }}" href="{{ $pej->link=='/reminder/kredit' ? '#' : '/reminder/kredit' }}">
        
          <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="material-icons opacity-10">credit_score</i>
          </div>
        
        <span class="nav-link-text ms-1 position-relative">Kredit Selesai

          @if ($notif->reminder->kredit>0)
            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">{{$notif->reminder->kredit}}</span>
          @endif

        </span>
      </a>
    </li>