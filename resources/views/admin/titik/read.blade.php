@extends('layouts.admin')

@section('content')
<div class="content-wrapper">
  <div class="content-header sty-one">
    <h1>Titik Parkir</h1>
    <ol class="breadcrumb">
      <li><a href="{{ route('admin.home') }}">Home</a></li>
      <li><i class="fa fa-angle-right"></i> Titik Parkir</li>
    </ol>
  </div>
  <div class="content">
     <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header bg-blue"><h5 class="m-b-0">Detail Titik Parkir</h5></div>
            <div class="card-body">
                <div class="row m-b-10"><div class="text-right col-md-3"><strong>Jenis Fasilitas Parkir :</strong></div><div class="col-md-9">{{ $row->jenis_fasilitas=='dalam'?'Di Dalam Ruang Milik Jalan':'Di Luar Ruang Milik Jalan' }}</div></div>
                <div class="row m-b-10"><div class="text-right col-md-3"><strong>Jenis Parkir Luar :</strong></div><div class="col-md-9">@if($row->jenis_parkir_luar=='tkp') Tempat Khusus Parkir @elseif($row->jenis_parkir_luar=='tpk') Tempat Parkir Khusus @else - @endif</div></div>
                <div class="row m-b-10"><div class="text-right col-md-3"><strong>Nama Lokasi :</strong></div><div class="col-md-9">{{ $row->nama_lokasi }}</div></div>
                <div class="row m-b-10"><div class="text-right col-md-3"><strong>Panjang :</strong></div><div class="col-md-9">{{ $row->panjang_lokasi }} m</div></div>
                <div class="row m-b-10"><div class="text-right col-md-3"><strong>Lebar :</strong></div><div class="col-md-9">{{ $row->lebar_lokasi }} m</div></div>
                <div class="row m-b-10"><div class="text-right col-md-3"><strong>Luas :</strong></div><div class="col-md-9">{{ $row->luas_lokasi }} m<sup>2</sup></div></div>
                <div class="row m-b-10"><div class="text-right col-md-3"><strong>SRP Motor:</strong></div><div class="col-md-9">{{ $row->srp_motor }}</div></div>
                <div class="row m-b-10"><div class="text-right col-md-3"><strong>SRP Mobil:</strong></div><div class="col-md-9">{{ $row->srp_mobil }}</div></div>
                <div class="row m-b-10"><div class="text-right col-md-3"><strong>Kecamatan :</strong></div><div class="col-md-9">{{ $row->kec }}</div></div>
                <div class="row m-b-10"><div class="text-right col-md-3"><strong>Kelurahan/Desa :</strong></div><div class="col-md-9">{{ $row->desa }}</div></div>
                <div class="row m-b-10"><div class="text-right col-md-3"><strong>Ruas Jalan :</strong></div><div class="col-md-9">{{ $row->nama_ruas }}</div></div>
                <div class="row m-b-10"><div class="text-right col-md-3"><strong>Peta :</strong></div><div class="col-md-9"><div id="map" style="height:400px; border-radius:8px;"></div></div></div>
                <div class="row m-b-10"><div class="text-right col-md-3"><strong>Koordinat :</strong></div><div class="col-md-9">{{ $row->titik_lat }}, {{ $row->titik_lng }}</div></div>
                <div class="row m-b-10"><div class="text-right col-md-3"><strong>Foto Lokasi :</strong></div><div class="col-md-9">
                  @if($row->foto_lokasi)
                    <a href="{{ asset($row->foto_lokasi) }}" target="_blank"><img src="{{ asset($row->foto_lokasi) }}" width="80px" style="border-radius:4px;"></a>
                  @else
                    -
                  @endif
                </div></div>
                <div class="row m-t-20"><div class="text-right col-md-3"></div><div class="col-md-9"><a href="{{ route('admin.titik.index') }}" class="btn btn-primary btn-sm"><i class="fa fa-arrow-left"></i> Kembali</a></div></div>
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
      var titikLat = {{ !empty($row->titik_lat) ? $row->titik_lat : -7.3932652 }};
      var titikLng = {{ !empty($row->titik_lng) ? $row->titik_lng : 109.7097441 }};

      var map = L.map('map').setView([titikLat, titikLng], 15);
      L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);

      // Fix for Leaflet default icons when using CDN
      delete L.Icon.Default.prototype._getIconUrl;
      L.Icon.Default.mergeOptions({
          iconRetinaUrl: 'https://unpkg.com/leaflet@1.9.4/dist/images/marker-icon-2x.png',
          iconUrl: 'https://unpkg.com/leaflet@1.9.4/dist/images/marker-icon.png',
          shadowUrl: 'https://unpkg.com/leaflet@1.9.4/dist/images/marker-shadow.png',
      });

      L.marker([titikLat, titikLng]).addTo(map).bindPopup("<b>{{ addslashes($row->nama_lokasi) }}</b>").openPopup();

      L.Routing.control({
          waypoints: [L.latLng(fromLat, fromLng), L.latLng(toLat, toLng)],
          lineOptions: {styles: [{color: 'blue', opacity: 0.6, weight: 4}]},
          createMarker: function() { return null; },
          addWaypoints: false, 
          routeWhileDragging: false, 
          show: false,
          fitSelectedRoutes: false
      }).addTo(map);
  });
  </script>
</div>
@endsection
