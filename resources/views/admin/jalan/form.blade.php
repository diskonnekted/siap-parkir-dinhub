@extends('layouts.admin')

@section('content')
<script>
  function hitung(){
    var in1 = document.getElementById("panjang").value;
    var in2 = document.getElementById("lebar").value;
    var result = parseFloat(in1)*parseFloat(in2);
    if (!isNaN(result)) {
         document.getElementById("luas").value = result;
    }
  }
</script>

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
              <h5 class="m-b-0">Form Ruas Jalan</h5>
            </div>
            <div class="card-body">
              <form action="{{ $action }}" method="post" enctype="multipart/form-data">
                @csrf
                @if(isset($id_ruas_jalan) && $id_ruas_jalan)
                  @method('POST')
                @endif
                <div class="form-body">
                  <div class="form-group row">
                    <label class="control-label text-right col-md-3">Status Ruas Jalan</label>
                    <div class="col-md-9">
                      <select name="status_ruas" class="form-control">
                        <option value="Kabupaten" {{ $status_ruas == 'Kabupaten' ? 'selected' : '' }}>Kabupaten</option>
                        <option value="Provinsi" {{ $status_ruas == 'Provinsi' ? 'selected' : '' }}>Provinsi</option>
                        <option value="Nasional" {{ $status_ruas == 'Nasional' ? 'selected' : '' }}>Nasional</option>
                      </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="control-label text-right col-md-3">Nomor Ruas Jalan</label>
                    <div class="col-md-9">
                      <input type="text" class="form-control" name="nomor_ruas" value="{{ $nomor_ruas }}" >
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="control-label text-right col-md-3">Nama Ruas Jalan @error('nama_ruas') <span class="text-danger">{{ $message }}</span> @enderror</label>
                    <div class="col-md-9">
                      <input type="text" class="form-control" name="nama_ruas" value="{{ $nama_ruas }}" required>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="control-label text-right col-md-3">Panjang</label>
                    <div class="col-md-9">
                      <input type="text" class="form-control" id="panjang" name="panjang" value="{{ $panjang }}" >
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="control-label text-right col-md-3">Lebar</label>
                    <div class="col-md-9">
                      <input type="text" class="form-control" id="lebar" name="lebar" onkeyup="hitung()" value="{{ $lebar }}" >
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="control-label text-right col-md-3">Luas</label>
                    <div class="col-md-9">
                      <input type="text" class="form-control" id="luas" name="luas" value="{{ $luas }}" >
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="control-label text-right col-md-3">Titik Awal Ruas</label>
                    <div class="col-md-9">
                      <input type="text" class="form-control" name="titik_awal" value="{{ $titik_awal }}" >
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="control-label text-right col-md-3">Titik Akhir Ruas</label>
                    <div class="col-md-9">
                      <input type="text" class="form-control" name="titik_akhir" value="{{ $titik_akhir }}" >
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="control-label text-right col-md-3">Koordinat Awal </label>
                    <div class="col-md-9">
                      <div id="map1" style="height:300px; margin-bottom:10px; border:1px solid #ccc; border-radius:4px;"></div>
                      <input type="text" class="form-control" style="width: 48%; display: inline-block;" id="from_lat" name="from_lat" value="{{ $from_lat }}" placeholder="Latitude">
                      <input type="text" class="form-control" style="width: 48%; display: inline-block; float: right;" id="from_lng" name="from_lng" value="{{ $from_lng }}" placeholder="Longitude">
                    </div>
                  </div>
                  <div class="form-group row" style="margin-top:20px;">
                    <label class="control-label text-right col-md-3">Koordinat Akhir </label>
                    <div class="col-md-9">
                      <div id="map2" style="height:300px; margin-bottom:10px; border:1px solid #ccc; border-radius:4px;"></div>
                      <input type="text" class="form-control" style="width: 48%; display: inline-block;" id="to_lat" name="to_lat" value="{{ $to_lat }}" placeholder="Latitude">
                      <input type="text" class="form-control" style="width: 48%; display: inline-block; float: right;" id="to_lng" name="to_lng" value="{{ $to_lng }}" placeholder="Longitude">
                    </div>
                  </div>

                  <div class="form-actions" style="margin-top:20px;">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="row">
                          <div class="offset-sm-3 col-md-9">
                            <input type="hidden" name="id_ruas_jalan" value="{{ $id_ruas_jalan }}">
                            <button type="submit" class="btn btn-success">{{ $button }}</button>
                            <a href="{{ route('admin.jalan.index') }}" class="btn btn-inverse">Cancel</a>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
  </div>

  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
  <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
  <script type="text/javascript">
  document.addEventListener("DOMContentLoaded", function() {
      var initialLat = -7.3932652;
      var initialLng = 109.7097441;

      // Map 1 (Koordinat Awal)
      var map1 = L.map('map1').setView([initialLat, initialLng], 15);
      L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map1);

      var marker1;
      function setMarker1(lat, lng) {
          if (marker1) {
              marker1.setLatLng([lat, lng]);
          } else {
              marker1 = L.marker([lat, lng], {draggable: true}).addTo(map1);
              marker1.on('dragend', function(e) {
                  var pos = marker1.getLatLng();
                  document.getElementById("from_lat").value = pos.lat;
                  document.getElementById("from_lng").value = pos.lng;
              });
          }
          document.getElementById("from_lat").value = lat;
          document.getElementById("from_lng").value = lng;
      }

      map1.on('click', function(e) {
          setMarker1(e.latlng.lat, e.latlng.lng);
      });

      // Map 2 (Koordinat Akhir)
      var map2 = L.map('map2').setView([initialLat, initialLng], 15);
      L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map2);

      var marker2;
      function setMarker2(lat, lng) {
          if (marker2) {
              marker2.setLatLng([lat, lng]);
          } else {
              marker2 = L.marker([lat, lng], {draggable: true}).addTo(map2);
              marker2.on('dragend', function(e) {
                  var pos = marker2.getLatLng();
                  document.getElementById("to_lat").value = pos.lat;
                  document.getElementById("to_lng").value = pos.lng;
              });
          }
          document.getElementById("to_lat").value = lat;
          document.getElementById("to_lng").value = lng;
      }

      map2.on('click', function(e) {
          setMarker2(e.latlng.lat, e.latlng.lng);
      });

      // Load existing values if any
      var exLat1 = "{{ $from_lat }}";
      var exLng1 = "{{ $from_lng }}";
      if(exLat1 && exLng1) {
          setMarker1(exLat1, exLng1);
          map1.setView([exLat1, exLng1], 15);
      }

      var exLat2 = "{{ $to_lat }}";
      var exLng2 = "{{ $to_lng }}";
      if(exLat2 && exLng2) {
          setMarker2(exLat2, exLng2);
          map2.setView([exLat2, exLng2], 15);
      }
  });
  </script>
</div>
@endsection
