@extends('layouts.mobile')

@section('title', 'Peta Titik Parkir')

@section('css')
<style>
  /* Peta utama memenuhi area konten */
  #petaFull{
    position:sticky; top:64px;
    height:calc(100vh - 190px);
    min-height:380px;
    border-radius:14px;border:1px solid var(--line);overflow:hidden;
    z-index:1;
  }
  .peta-toolbar{position:relative;z-index:2;margin-bottom:10px}
  .peta-stats{display:flex;gap:8px;flex-wrap:wrap;margin-bottom:10px}
  .legend{display:flex;gap:12px;flex-wrap:wrap;font-size:11px;color:var(--muted);margin-top:8px}
  .legend span{display:inline-flex;align-items:center;gap:6px}
  .lg-dot{width:11px;height:11px;border-radius:50%;display:inline-block;border:2px solid #fff}
  /* Popup Leaflet disesuaikan tema gelap */
  .leaflet-popup-content-wrapper{background:#0f1930;color:#e6edf7;border:1px solid rgba(148,163,184,.2);border-radius:12px}
  .leaflet-popup-tip{background:#0f1930}
  .leaflet-popup-content{margin:10px 12px;font-family:inherit;font-size:12px;line-height:1.5}
  .leaflet-popup-content b{font-size:13px}
  .leaflet-popup a{color:#7db2ff}
  .pp-photo{width:100%;height:110px;object-fit:cover;border-radius:8px;margin:6px 0}
  .pp-row{display:flex;justify-content:space-between;gap:8px;padding:2px 0}
  .pp-row span{color:#93a3bd}
  .pp-badge{display:inline-block;padding:1px 8px;border-radius:99px;font-size:10px;margin-left:4px}
  .pp-badge.ok{background:rgba(35,196,131,.15);color:#23c483}
  .pp-badge.warn{background:rgba(255,176,32,.15);color:#ffb020}
</style>
@endsection

@section('content')
  <div class="peta-toolbar">
    <form method="get" action="{{ route('mobile.survei.peta') }}" class="m-row2" style="grid-template-columns:1fr auto;gap:8px">
      <input type="text" name="q" value="{{ $q }}" class="m-input" placeholder="Cari nama lokasi / ruas / desa..." autocomplete="off">
      <button type="submit" class="m-btn m-btn-pri" style="padding:12px 16px"><i class="fa fa-search"></i></button>
    </form>
    <form method="get" action="{{ route('mobile.survei.peta') }}" style="margin-top:8px">
      <input type="hidden" name="q" value="{{ $q }}">
      <select name="kec" class="m-select" onchange="this.form.submit()">
        <option value="">Semua Kecamatan</option>
        @foreach($kecamatan as $k)
          <option value="{{ $k->id }}" {{ (string)$kec === (string)$k->id ? 'selected' : '' }}>{{ trim($k->nama) }}</option>
        @endforeach
      </select>
    </form>
  </div>

  <div class="peta-stats">
    <span class="m-chip"><i class="fa fa-map-marker"></i> {{ $titik->count() }} titik</span>
    @if($q !== '')<span class="m-chip warn">Cari: "{{ $q }}"</span>@endif
    <button type="button" class="m-btn m-btn-ghost" id="btnMyLoc" style="padding:6px 12px;font-size:12px;margin-left:auto">
      <i class="fa fa-crosshairs"></i> Lokasi Saya
    </button>
  </div>

  <div id="petaFull"></div>

  <div class="legend">
    <span><i class="lg-dot" style="background:#23c483"></i> Ada jukir (terverifikasi)</span>
    <span><i class="lg-dot" style="background:#ffb020"></i> Ada jukir (belum verifikasi)</span>
    <span><i class="lg-dot" style="background:#2f7bff"></i> Belum ada jukir</span>
  </div>
@endsection

@section('js')
<script>
(function(){
  var titik = @json($titik);
  var center = @json($center);

  var map = L.map('petaFull').setView([center.lat, center.lng], 12);
  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19, attribution: '&copy; OpenStreetMap'
  }).addTo(map);

  function colorOf(t){
    if (t.jukir) return t.jukir_verif ? '#23c483' : '#ffb020';
    return '#2f7bff';
  }
  function esc(s){ return (s==null?'':String(s)).replace(/[&<>"']/g, function(c){return {'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;'}[c];}); }

  function popupHtml(t){
    var h = '<b>'+esc(t.nama)+'</b>';
    if (t.jenis) h += '<span class="pp-badge warn">'+esc(t.jenis)+'</span>';
    if (t.foto) h += '<img class="pp-photo" src="/'+esc(t.foto)+'" alt="" onerror="this.style.display=\'none\'">';
    h += '<div class="pp-row"><span>Kecamatan</span><span>'+esc(t.kec||'-')+'</span></div>';
    h += '<div class="pp-row"><span>Desa</span><span>'+esc(t.desa||'-')+'</span></div>';
    if (t.ruas) h += '<div class="pp-row"><span>Ruas</span><span>'+esc(t.ruas)+'</span></div>';
    if (t.luas) h += '<div class="pp-row"><span>Luas</span><span>'+esc(t.luas)+' m&sup2;</span></div>';
    if (t.srp_motor) h += '<div class="pp-row"><span>Motor</span><span>Rp '+Number(t.srp_motor).toLocaleString('id-ID')+'</span></div>';
    if (t.srp_mobil) h += '<div class="pp-row"><span>Mobil</span><span>Rp '+Number(t.srp_mobil).toLocaleString('id-ID')+'</span></div>';
    if (t.jukir){
      h += '<div class="pp-row"><span>Jukir</span><span>'+esc(t.jukir)
        + (t.jukir_verif ? ' <span class="pp-badge ok">terverifikasi</span>' : ' <span class="pp-badge warn">belum</span>')
        + '</span></div>';
      if (t.jukir_telp) h += '<div class="pp-row"><span>Telp</span><span><a href="tel:'+esc(t.jukir_telp)+'">'+esc(t.jukir_telp)+'</a></span></div>';
    } else {
      h += '<div class="pp-row"><span>Jukir</span><span style="color:#93a3bd">Belum ada</span></div>';
    }
    h += '<div style="margin-top:6px;display:flex;gap:6px">'
      + '<a href="https://www.google.com/maps/dir/?api=1&destination='+t.lat+','+t.lng+'" target="_blank" rel="noopener">Rute</a>'
      + '<a href="{{ url('m/survei/titik/edit') }}/'+t.id+'">Edit Titik</a>'
      + '</div>';
    return h;
  }

  var bounds = [];
  titik.forEach(function(t){
    if(!isFinite(t.lat) || !isFinite(t.lng)) return;
    var m = L.circleMarker([t.lat, t.lng], {
      radius: 8, color:'#fff', weight:2,
      fillColor: colorOf(t), fillOpacity: 1
    }).addTo(map);
    m.bindPopup(popupHtml(t));
    bounds.push([t.lat, t.lng]);
  });
  if (bounds.length > 1) { map.fitBounds(bounds, {padding:[24,24]}); }

  // Marker lokasi saya
  var meMarker=null, meCircle=null;
  document.getElementById('btnMyLoc').addEventListener('click', function(){
    if(!navigator.geolocation){ mtoast('GPS tidak didukung perangkat','err'); return; }
    mtoast('Mengambil lokasi...');
    navigator.geolocation.getCurrentPosition(function(pos){
      var lat=pos.coords.latitude, lng=pos.coords.longitude, acc=pos.coords.accuracy;
      if(meMarker){ map.removeLayer(meMarker); }
      if(meCircle){ map.removeLayer(meCircle); }
      meCircle = L.circle([lat,lng], {radius:acc, color:'#2f7bff', weight:1, fillColor:'#2f7bff', fillOpacity:.12}).addTo(map);
      meMarker = L.circleMarker([lat,lng], {radius:7,color:'#fff',weight:2,fillColor:'#2f7bff',fillOpacity:1})
        .addTo(map).bindPopup('Lokasi Anda (±'+Math.round(acc)+' m)').openPopup();
      map.setView([lat,lng], 16);
    }, function(err){ mtoast('Gagal mengambil lokasi: '+err.message,'err'); },
    {enableHighAccuracy:true, timeout:12000, maximumAge:0});
  });
})();
</script>
@endsection
