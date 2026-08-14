@extends('layouts.admin')

@section('content')
<div class="content-wrapper">
  <div class="content-header sty-one">
    <h1>Ruas Jalan</h1>
    <ol class="breadcrumb">
      <li><a href="{{ route('admin.home') }}">Home</a></li>
      <li><i class="fa fa-angle-right"></i> Ruas Jalan</li>
    </ol>
  </div>
  <div class="content">
     <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header bg-blue">
            <h5 class="m-b-0">Detail Ruas Jalan</h5>
            </div>
            <div class="card-body">
              <style>
                .jalan-grid{margin-left:-10px;margin-right:-10px}
                .jalan-grid>[class*="col-"]{padding-left:10px;padding-right:10px}
                .jalan-map-wrap{width:100%;max-width:520px}
                .jalan-map-sq{position:relative;width:100%;padding-top:100%;border-radius:12px;overflow:hidden;border:1px solid rgba(15,23,42,.10);box-shadow:0 14px 30px rgba(15,23,42,.08)}
                .jalan-map-sq #map{position:absolute;inset:0}
                .jalan-info{border:1px solid rgba(15,23,42,.08);border-radius:12px;padding:14px;background:#fff;box-shadow:0 10px 24px rgba(15,23,42,.05)}
                .jalan-kv{display:flex;justify-content:space-between;gap:12px;padding:8px 0;border-bottom:1px dashed rgba(15,23,42,.10)}
                .jalan-kv:last-child{border-bottom:0}
                .jalan-k{color:rgba(15,23,42,.70)}
                .jalan-v{font-weight:600;color:#0f172a;text-align:right}
                @media (max-width:991px){.jalan-map-wrap{max-width:none}.jalan-v{text-align:left}}
              </style>

              <div class="row jalan-grid">
                <div class="col-lg-6 m-b-20">
                  <div class="jalan-map-wrap">
                    <div class="jalan-map-sq">
                      <div id="map"></div>
                    </div>
                  </div>
                </div>

                <div class="col-lg-6 m-b-20">
                  <div class="jalan-info">
                    <div class="jalan-kv"><div class="jalan-k">Status Ruas</div><div class="jalan-v">{{ $row->status_ruas }}</div></div>
                    <div class="jalan-kv"><div class="jalan-k">Nomor Ruas</div><div class="jalan-v">{{ $row->nomor_ruas }}</div></div>
                    <div class="jalan-kv"><div class="jalan-k">Nama Ruas</div><div class="jalan-v">{{ $row->nama_ruas }}</div></div>
                    <div class="jalan-kv"><div class="jalan-k">Panjang</div><div class="jalan-v">{{ $row->panjang }} m</div></div>
                    <div class="jalan-kv"><div class="jalan-k">Lebar</div><div class="jalan-v">{{ $row->lebar }} m</div></div>
                    <div class="jalan-kv"><div class="jalan-k">Luas</div><div class="jalan-v">{{ $row->luas }} m<sup>2</sup></div></div>
                    <div class="jalan-kv"><div class="jalan-k">Titik Awal</div><div class="jalan-v">{{ $row->titik_awal }}</div></div>
                    <div class="jalan-kv"><div class="jalan-k">Titik Akhir</div><div class="jalan-v">{{ $row->titik_akhir }}</div></div>
                    <div class="jalan-kv"><div class="jalan-k">Koordinat Awal</div><div class="jalan-v">{{ $row->from_lat }}, {{ $row->from_lng }}</div></div>
                    <div class="jalan-kv"><div class="jalan-k">Koordinat Akhir</div><div class="jalan-v">{{ $row->to_lat }}, {{ $row->to_lng }}</div></div>

                    <div style="margin-top:12px;">
                      <a href="{{ route('admin.jalan.index') }}" class="btn btn-primary btn-sm"><i class="fa fa-arrow-left"></i> Kembali</a>
                      <a href="{{ route('admin.jalan.peta', $row->id_ruas_jalan) }}" class="btn btn-info btn-sm"><i class="fa fa-map"></i> Lihat Peta</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
  </div>
  
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
  <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@3.2.12/dist/leaflet-routing-machine.css" />
  <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
  <script src="https://unpkg.com/leaflet-routing-machine@3.2.12/dist/leaflet-routing-machine.js"></script>
  <script type="text/javascript">
  document.addEventListener("DOMContentLoaded", function() {
      var fromLat = {{ !empty($row->from_lat) ? $row->from_lat : -7.3932652 }};
      var fromLng = {{ !empty($row->from_lng) ? $row->from_lng : 109.7097441 }};
      var toLat = {{ !empty($row->to_lat) ? $row->to_lat : -7.3932652 }};
      var toLng = {{ !empty($row->to_lng) ? $row->to_lng : 109.7097441 }};
      var map = L.map('map').setView([fromLat, fromLng], 14);
      L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);
      L.Routing.control({
          waypoints: [L.latLng(fromLat, fromLng), L.latLng(toLat, toLng)],
          lineOptions: {styles: [{color: 'blue', opacity: 0.7, weight: 5}]},
          createMarker: function(i, wp) { return L.marker(wp.latLng).bindPopup(i === 0 ? "Awal" : "Akhir"); },
          addWaypoints: false, routeWhileDragging: false, show: false, fitSelectedRoutes: false
      }).addTo(map);
  });
  </script>
</div>
@endsection
