@extends('layouts.admin')

@section('content')
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
  <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
  <script>
    var mapAdd;
    var markerAdd;
    var lineAdd;

    function ensureLeafletIcons() {
      delete L.Icon.Default.prototype._getIconUrl;
      L.Icon.Default.mergeOptions({
        iconRetinaUrl: 'https://unpkg.com/leaflet@1.9.4/dist/images/marker-icon-2x.png',
        iconUrl: 'https://unpkg.com/leaflet@1.9.4/dist/images/marker-icon.png',
        shadowUrl: 'https://unpkg.com/leaflet@1.9.4/dist/images/marker-shadow.png',
      });
    }

    function initMapAdd() {
      var defaultLat = -7.3932652;
      var defaultLng = 109.7097441;

      ensureLeafletIcons();

      mapAdd = L.map('googleMap', { scrollWheelZoom: false }).setView([defaultLat, defaultLng], 13);
      L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(mapAdd);

      markerAdd = L.marker([defaultLat, defaultLng], { opacity: 0 }).addTo(mapAdd);
      lineAdd = L.polyline([], { color: 'blue', opacity: 0.6, weight: 4 }).addTo(mapAdd);
    }

    function updateMapAdd(data) {
      var titikLat = data.titik_lat ? parseFloat(data.titik_lat) : (data.from_lat ? parseFloat(data.from_lat) : null);
      var titikLng = data.titik_lng ? parseFloat(data.titik_lng) : (data.from_lng ? parseFloat(data.from_lng) : null);
      if (!Number.isFinite(titikLat) || !Number.isFinite(titikLng)) return;

      markerAdd.setLatLng([titikLat, titikLng]).setOpacity(1).bindPopup('<b>' + (data.nama_lokasi || '') + '</b>');
      mapAdd.setView([titikLat, titikLng], 15);

      var fromLat = data.from_lat ? parseFloat(data.from_lat) : null;
      var fromLng = data.from_lng ? parseFloat(data.from_lng) : null;
      var toLat = data.to_lat ? parseFloat(data.to_lat) : null;
      var toLng = data.to_lng ? parseFloat(data.to_lng) : null;

      if (Number.isFinite(fromLat) && Number.isFinite(fromLng) && Number.isFinite(toLat) && Number.isFinite(toLng)) {
        lineAdd.setLatLngs([[fromLat, fromLng], [toLat, toLng]]);
      } else {
        lineAdd.setLatLngs([]);
      }
    }

    function titik() {
      var opt = document.getElementById('titik_parkir').value;
      if (!opt) return;

      var url = "{{ route('admin.titikjukir.titik_json', ':id') }}";
      url = url.replace(':id', opt);

      $.getJSON(url)
        .done(function (data) {
          updateMapAdd(data);
        });
    }

    $(function () {
      initMapAdd();
      var initial = $('#titik_parkir').val();
      if (initial) {
        titik();
      }
    });
  </script>

  <div class="content-wrapper"> 
    <div class="content-header sty-one">
      <h1>Titik Juru Parkir</h1>
      <ol class="breadcrumb">
        <li><a href="{{ route('admin.home') }}">Home</a></li>
        <li><i class="fa fa-angle-right"></i> <a href="{{ route('admin.titikjukir.index') }}">Titik Juru Parkir</a></li>
        <li><i class="fa fa-angle-right"></i> Form</li>
      </ol>
    </div>
    
    <div class="content"> 
       <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header bg-blue">
                <h5 class="m-b-0">Form Titik Juru Parkir</h5>
              </div>
              <div class="card-body">
                <form action="{{ $action }}" method="post" enctype="multipart/form-data">
                  @csrf
                  <div class="form-body">
                    <div class="form-group row">
                      <label class="control-label text-right col-md-3">Tahun Pengelolaan @error('tahun_pengelolaan') <span class="text-danger">{{ $message }}</span> @enderror</label>
                      <div class="col-md-9">
                        <input type="text" class="form-control" name="tahun_pengelolaan" value="{{ $tahun_pengelolaan }}" >
                      </div>
                    </div>
                    
                    <div class="form-group row">
                      <label class="control-label text-right col-md-3">Nama Lokasi Parkir @error('id_titik_parkir') <span class="text-danger">{{ $message }}</span> @enderror</label>
                      <div class="col-md-9">
                        <select class="form-control select2" name="id_titik_parkir" id="titik_parkir" onchange="titik()">
                          <option value="">Pilih Titik Parkir</option>
                          @foreach($arr_titik as $t)
                            <option value="{{ $t->id_titik_parkir }}" {{ $t->id_titik_parkir == $id_titik_parkir ? 'selected' : '' }}>{{ $t->nama_lokasi }}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                    
                    <div class="form-group row">
                      <label class="control-label text-right col-md-3">Juru Parkir @error('id_juru_parkir') <span class="text-danger">{{ $message }}</span> @enderror</label>
                      <div class="col-md-9">
                        <select class="form-control select2" name="id_juru_parkir" id="jukir">
                          <option value="">Pilih Juru Parkir</option>
                          @foreach($arr_jukir as $j)
                            <option value="{{ $j->id_juru_parkir }}" {{ $j->id_juru_parkir == $id_juru_parkir ? 'selected' : '' }}>{{ $j->nama }} - {{ $j->desa ?? 'N/A' }}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="control-label text-right col-md-3">Jam Kerja Awal @error('jam_kerja_awal') <span class="text-danger">{{ $message }}</span> @enderror</label>
                      <div class="col-md-9">
                        <input type="text" class="form-control" name="jam_kerja_awal" id="jam_kerja_awal" value="{{ $jam_kerja_awal }}" >
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="control-label text-right col-md-3">Jam Kerja Akhir @error('jam_kerja_akhir') <span class="text-danger">{{ $message }}</span> @enderror</label>
                      <div class="col-md-9">
                        <input type="text" class="form-control" name="jam_kerja_akhir" id="jam_kerja_akhir" value="{{ $jam_kerja_akhir }}" >
                      </div>
                    </div>

                    <div class="form-group row">
                      <div class="col-md-3"></div>
                      <div class="col-md-9">
                        <div id="googleMap" style="height:260px; border-radius:14px; overflow:hidden; border:1px solid rgba(15,23,42,.10);"></div>
                      </div>
                    </div>
                    
                    <div class="form-actions">
                      <div class="row">
                        <div class="col-md-12">
                          <div class="row">
                            <div class="offset-sm-3 col-md-9">
                              <input type="hidden" name="id_titik_jukir" value="{{ $id_titik_jukir }}">
                              <button type="submit" class="btn btn-success">{{ $button }}</button>
                              <a href="{{ route('admin.titikjukir.index') }}" class="btn btn-inverse">Batal</a>
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
  </div>
@endsection
