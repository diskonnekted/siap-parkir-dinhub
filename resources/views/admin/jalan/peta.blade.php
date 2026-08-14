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
            <div class="card-body">
              <div class="row" style="margin-bottom:10px;"><div class="col-sm-4 col-lg-4">Status Ruas Jalan</div><div class="col-sm-4 col-lg-5"><strong>{{ $row->status_ruas }}</strong></div></div>
              <div class="row" style="margin-bottom:10px;"><div class="col-sm-4 col-lg-4">Nomor Ruas Jalan</div><div class="col-sm-4 col-lg-5"><strong>{{ $row->nomor_ruas }}</strong></div></div>
              <div class="row" style="margin-bottom:10px;"><div class="col-sm-4 col-lg-4">Nama Ruas Jalan</div><div class="col-sm-4 col-lg-5"><strong>{{ $row->nama_ruas }}</strong></div></div>
              <div class="row" style="margin-bottom:10px;"><div class="col-sm-4 col-lg-4">Panjang Jalan</div><div class="col-sm-4 col-lg-5">{{ $row->panjang }} m</div></div>
              <div class="row" style="margin-bottom:10px;"><div class="col-sm-4 col-lg-4">Lebar Jalan</div><div class="col-sm-4 col-lg-5">{{ $row->lebar }} m</div></div>
              <div class="row" style="margin-bottom:10px;"><div class="col-sm-4 col-lg-4">Luas Jalan</div><div class="col-sm-4 col-lg-5">{{ $row->luas }} m<sup>2</sup></div></div>
              <div class="row" style="margin-bottom:10px;"><div class="col-sm-4 col-lg-4">Titik Ruas Awal</div><div class="col-sm-4 col-lg-5">{{ $row->titik_awal }}</div></div>
              <div class="row" style="margin-bottom:10px;"><div class="col-sm-4 col-lg-4">Titik Ruas Akhir</div><div class="col-sm-4 col-lg-5">{{ $row->titik_akhir }}</div></div>
              
              <div class="row" style="margin-top:20px;">
                <div class="col-12">
                  <div id="map" style="height:400px; width:100%; border: 1px solid #ccc; border-radius: 8px; box-shadow: 0 10px 25px rgba(0,0,0,0.05);"></div>
                </div>
              </div>
              
              <div class="row" style="margin-top:20px;">
                <div class="col-sm-4 col-lg-4">Koordinat Klik Map</div>
                <div class="col-sm-4 col-lg-5">
                  <input type="text" id="lat" name="lat" class="form-control mt-2" placeholder="Latitude Klik">
                  <input type="text" id="lng" name="lng" class="form-control mt-2" placeholder="Longitude Klik">
                </div>
              </div>
              
              <div class="row" style="margin-top:20px;">
                <div class="col-sm-4 col-lg-4"></div>
                <div class="col-sm-4 col-lg-5">
                  <a href="{{ route('admin.jalan.index') }}" class="btn btn-primary btn-sm"><i class="fa fa-arrow-left"></i> Kembali</a>
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

      // Fix for Leaflet default icons when using CDN
      delete L.Icon.Default.prototype._getIconUrl;
      L.Icon.Default.mergeOptions({
          iconRetinaUrl: 'https://unpkg.com/leaflet@1.9.4/dist/images/marker-icon-2x.png',
          iconUrl: 'https://unpkg.com/leaflet@1.9.4/dist/images/marker-icon.png',
          shadowUrl: 'https://unpkg.com/leaflet@1.9.4/dist/images/marker-shadow.png',
      });

      var currentMarker;
      map.on('click', function(e) {
          if(currentMarker) { currentMarker.setLatLng(e.latlng); }
          else { currentMarker = L.marker(e.latlng).addTo(map); }
          document.getElementById("lat").value = e.latlng.lat;
          document.getElementById("lng").value = e.latlng.lng;
      });

      L.Routing.control({
          waypoints: [L.latLng(fromLat, fromLng), L.latLng(toLat, toLng)],
          lineOptions: {styles: [{color: 'blue', opacity: 0.6, weight: 4}]},
          createMarker: function() { return null; },
          addWaypoints: false, routeWhileDragging: false, show: false
      }).addTo(map);
  });
  </script>
</div>
@endsection
