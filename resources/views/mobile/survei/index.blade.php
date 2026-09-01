@extends('layouts.mobile')

@section('title', 'Daftar Survei')

@section('content')

  {{-- Peta ringkas semua titik --}}
  <div class="m-card" style="padding:0; overflow:hidden">
    <div id="mapIndex" class="map-box" style="height:240px; border:0"></div>
    <div style="padding:10px 14px; display:flex; align-items:center; gap:8px">
      <span class="m-chip ok"><i class="fa fa-map-marker"></i> {{ count($rows) }} penugasan</span>
      <span class="m-chip"><i class="fa fa-check-circle"></i> {{ $rows->where('verifikasi',1)->count() }} terverifikasi</span>
      <button class="m-btn m-btn-ghost" id="btnMyLoc" style="margin-left:auto; padding:7px 12px; font-size:12px">
        <i class="fa fa-crosshairs"></i> Lokasi Saya
      </button>
    </div>
  </div>

  {{-- Pencarian --}}
  <form method="get" action="{{ route('mobile.survei.index') }}" style="margin-bottom:14px">
    <div style="display:flex; gap:8px">
      <input type="text" name="q" value="{{ $q }}" class="m-input" placeholder="Cari titik / jukir / ruas jalan..." style="flex:1">
      <button class="m-btn m-btn-pri" type="submit"><i class="fa fa-search"></i></button>
    </div>
  </form>

  {{-- Daftar penugasan --}}
  @forelse($rows as $r)
    @php
      $fotoJukir = $r->foto_jukir ? asset(ltrim($r->foto_jukir, './')) : null;
      $sudahVerif = (int) $r->verifikasi === 1;
    @endphp
    <a href="{{ route('mobile.survei.read', $r->id_titik_jukir) }}" class="m-item">
      @if($fotoJukir)
        <img class="avatar" src="{{ $fotoJukir }}" alt="">
      @else
        <div class="avatar" style="display:flex;align-items:center;justify-content:center;color:var(--muted)">
          <i class="fa fa-user"></i>
        </div>
      @endif
      <div class="meta">
        <b>{{ $r->nama_jukir }}</b>
        <span><i class="fa fa-map-marker"></i> {{ $r->nama_lokasi }} &middot; Kec. {{ $r->kec }}</span>
        <span style="margin-top:4px; display:flex; gap:6px">
          <span class="m-chip {{ $sudahVerif ? 'ok' : 'warn' }}" style="padding:2px 8px; font-size:10px">
            <i class="fa {{ $sudahVerif ? 'fa-check-circle' : 'fa-clock-o' }}"></i>
            {{ $sudahVerif ? 'Terverifikasi' : 'Belum verifikasi' }}
          </span>
          @if($r->nama_ruas)
            <span class="m-chip" style="padding:2px 8px; font-size:10px">{{ \Illuminate\Support\Str::limit($r->nama_ruas, 22) }}</span>
          @endif
        </span>
      </div>
      <i class="fa fa-chevron-right"></i>
    </a>
  @empty
    <div class="m-empty">
      <i class="fa fa-inbox"></i>
      <p>Belum ada data penugasan.<br>Mulai dengan menambah titik atau jukir baru.</p>
    </div>
  @endforelse

@endsection

@section('js')
<script>
(function(){
  var el = document.getElementById('mapIndex');
  if(!el || typeof L === 'undefined') return;

  var map = L.map('mapIndex', { zoomControl:false, attributionControl:false }).setView([-7.3942, 109.5258], 12);
  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', { maxZoom:19 }).addTo(map);

@php
  $mapPts = $rows->map(function($r){
      return [
        'id'    => $r->id_titik_jukir,
        'nama'  => $r->nama_lokasi,
        'lat'   => $r->titik_lat,
        'lng'   => $r->titik_lng,
        'verif' => (int) $r->verifikasi,
      ];
  })->values();
@endphp
  var pts = @json($mapPts);

  var bounds = [];
  pts.forEach(function(p){
    var lat = parseFloat(p.lat), lng = parseFloat(p.lng);
    if(!isFinite(lat) || !isFinite(lng)) return;
    var color = p.verif === 1 ? '#23c483' : '#ffb020';
    var mk = L.circleMarker([lat,lng], { radius:7, color:'#fff', weight:2, fillColor:color, fillOpacity:1 }).addTo(map);
    mk.bindPopup('<b>'+ (p.nama||'Titik') +'</b>');
    mk.on('click', function(){ window.location.href = "{{ url('m/survei/read') }}/" + p.id; });
    bounds.push([lat,lng]);
  });
  if(bounds.length){ map.fitBounds(bounds, { padding:[24,24] }); }

  document.getElementById('btnMyLoc').addEventListener('click', function(){
    if(!navigator.geolocation){ mtoast('GPS tidak didukung perangkat','err'); return; }
    mtoast('Mencari lokasi...');
    navigator.geolocation.getCurrentPosition(function(pos){
      var lat=pos.coords.latitude, lng=pos.coords.longitude;
      map.setView([lat,lng], 16);
      L.circleMarker([lat,lng], { radius:9, color:'#fff', weight:2, fillColor:'#2f7bff', fillOpacity:1 }).addTo(map)
        .bindPopup('Lokasi Anda').openPopup();
    }, function(){ mtoast('Gagal mendapatkan lokasi','err'); }, { enableHighAccuracy:true, timeout:10000 });
  });

  setTimeout(function(){ map.invalidateSize(); }, 300);
})();
</script>
@endsection
