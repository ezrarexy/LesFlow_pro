@foreach($notif->notif as $k => $v)
    <li class="mb-2">
        <a class="dropdown-item border-radius-md" href="/periksa/{{$v[0]}}">
            <div class="d-flex py-1">
                <div class="my-auto">
                    <i class="material-icons opacity-10 p-3">{{ $v[0]=="masuk" ? "arrow_downward" : "arrow_upward" }}</i>
                </div>
                <div class="d-flex flex-column justify-content-center">
                    <h6 class="text-sm font-weight-normal mb-1">
                        <span class="font-weight-bold">{{count($v[1])}} mobil <span class="text-capitalize">{{ $v[0] }}</span></span> menunggu pemeriksaan
                    </h6>
                    <p class="text-xs text-secondary mb-0">
                        <i class="fa fa-clock me-1"></i>
                        {{ $v[1][0]->updated_at->diffForHumans() }}
                    </p>
                </div>
            </div>
        </a>
    </li>
@endforeach