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
          <div class="card-header bg-blue">
            <h5 class="m-b-0">Form Titik Parkir</h5>
          </div>
          <div class="card-body">
            <form action="{{ $action }}" method="post" enctype="multipart/form-data">
              @csrf
              @if(isset($id_titik_parkir) && $id_titik_parkir)
                @method('POST')
                <input type="hidden" name="id_titik_parkir" value="{{ $id_titik_parkir }}">
              @endif

              <div class="form-body">

                <div class="form-group row">
                  <label class="control-label text-right col-md-3">Jenis Fasilitas</label>
                  <div class="col-md-9">
                    <select name="jenis_fasilitas" id="jenis_fasilitas" class="form-control">
                      <option value="luar" {{ $jenis_fasilitas == 'luar' ? 'selected' : '' }}>Di Luar Ruang Milik Jalan</option>
                      <option value="dalam" {{ $jenis_fasilitas == 'dalam' ? 'selected' : '' }}>Di Dalam Ruang Milik Jalan</option>
                    </select>
                  </div>
                </div>

                <div class="form-group row" id="row_jenis_parkir">
                  <label class="control-label text-right col-md-3">Jenis Parkir (Luar)</label>
                  <div class="col-md-9">
                    <select name="jenis_parkir_luar" id="jenis_parkir_luar" class="form-control">
                      <option value="tpk" {{ $jenis_parkir_luar == 'tpk' ? 'selected' : '' }}>Tempat Parkir Khusus (TPK)</option>
                      <option value="tkp" {{ $jenis_parkir_luar == 'tkp' ? 'selected' : '' }}>Tempat Khusus Parkir (TKP)</option>
                    </select>
                  </div>
                </div>

                <div class="form-group row">
                  <label class="control-label text-right col-md-3">Nama Lokasi @error('nama_lokasi') <span class="text-danger">{{ $message }}</span> @enderror</label>
                  <div class="col-md-9">
                    <input type="text" class="form-control" name="nama_lokasi" value="{{ $nama_lokasi }}" required placeholder="Contoh: Depan Pasar Wanadadi">
                  </div>
                </div>

                <div class="form-group row">
                  <label class="control-label text-right col-md-3">Kecamatan</label>
                  <div class="col-md-9">
                    <select name="id_kecamatan" id="id_kecamatan" class="form-control" required>
                      <option value="">-- Pilih Kecamatan --</option>
                      @foreach($kecamatan as $k)
                        <option value="{{ $k->id }}" {{ $id_kecamatan == $k->id ? 'selected' : '' }}>{{ trim($k->nama) }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>

                <div class="form-group row">
                  <label class="control-label text-right col-md-3">Desa / Kelurahan</label>
                  <div class="col-md-9">
                    <select name="id_desa" id="id_desa" class="form-control" required>
                      <option value="">-- Pilih Desa --</option>
                    </select>
                  </div>
                </div>

                <div class="form-group row">
                  <label class="control-label text-right col-md-3">Jenis Desa</label>
                  <div class="col-md-9">
                    <select name="jenis_desa" class="form-control">
                      <option value="Desa" {{ $jenis_desa == 'Desa' ? 'selected' : '' }}>Desa</option>
                      <option value="Kelurahan" {{ $jenis_desa == 'Kelurahan' ? 'selected' : '' }}>Kelurahan</option>
                    </select>
                  </div>
                </div>

                <div class="form-group row">
                  <label class="control-label text-right col-md-3">Ruas Jalan</label>
                  <div class="col-md-9">
                    <select name="id_ruas_jalan" class="form-control">
                      <option value="">-- Pilih Ruas Jalan --</option>
                      @foreach($ruas_jalan as $rj)
                        <option value="{{ $rj->id_ruas_jalan }}" {{ $id_ruas_jalan == $rj->id_ruas_jalan ? 'selected' : '' }}>{{ $rj->nama_ruas }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>

                <div class="form-group row">
                  <label class="control-label text-right col-md-3">Panjang Lokasi (m)</label>
                  <div class="col-md-9">
                    <input type="number" step="0.01" class="form-control" id="panjang_lokasi" name="panjang_lokasi" value="{{ $panjang_lokasi }}">
                  </div>
                </div>

                <div class="form-group row">
                  <label class="control-label text-right col-md-3">Lebar Lokasi (m)</label>
                  <div class="col-md-9">
                    <input type="number" step="0.01" class="form-control" id="lebar_lokasi" name="lebar_lokasi" value="{{ $lebar_lokasi }}">
                  </div>
                </div>

                <div class="form-group row">
                  <label class="control-label text-right col-md-3">Luas Lokasi (m²)</label>
                  <div class="col-md-9">
                    <input type="number" step="0.01" class="form-control" id="luas_lokasi" name="luas_lokasi" value="{{ $luas_lokasi }}" readonly>
                  </div>
                </div>

                <div class="form-group row">
                  <label class="control-label text-right col-md-3">SRP Motor</label>
                  <div class="col-md-9">
                    <input type="number" class="form-control" name="srp_motor" value="{{ $srp_motor }}" placeholder="Slot Parkir Motor">
                  </div>
                </div>

                <div class="form-group row">
                  <label class="control-label text-right col-md-3">SRP Mobil</label>
                  <div class="col-md-9">
                    <input type="number" class="form-control" name="srp_mobil" value="{{ $srp_mobil }}" placeholder="Slot Parkir Mobil">
                  </div>
                </div>

                {{-- Map for coordinate input --}}
                <div class="form-group row">
                  <label class="control-label text-right col-md-3">
                    Koordinat Lokasi
                    <br><small class="text-muted">Klik peta atau drag marker</small>
                  </label>
                  <div class="col-md-9">
                    <div id="map" style="height:400px; margin-bottom:10px; border:1px solid #ccc; border-radius:8px;"></div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="input-group">
                          <span class="input-group-text">Lat</span>
                          <input type="text" class="form-control" id="titik_lat" name="titik_lat" value="{{ $titik_lat }}" placeholder="Latitude">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="input-group">
                          <span class="input-group-text">Lng</span>
                          <input type="text" class="form-control" id="titik_lng" name="titik_lng" value="{{ $titik_lng }}" placeholder="Longitude">
                        </div>
                      </div>
                    </div>
                    <div style="margin-top:8px;">
                      <button type="button" class="btn btn-info btn-sm" id="btn-cari-lokasi">
                        <i class="fa fa-search"></i> Cari Nama Lokasi
                      </button>
                      <span class="text-muted" style="margin-left:8px; font-size:12px;">Gunakan untuk mencari alamat secara otomatis</span>
                    </div>
                  </div>
                </div>

                <div class="form-group row">
                  <label class="control-label text-right col-md-3">Foto Lokasi</label>
                  <div class="col-md-9">
                    <input type="file" class="form-control" name="foto_lokasi" accept="image/*">
                    @if($foto_lokasi)
                      <div style="margin-top:8px;">
                        <img src="{{ asset($foto_lokasi) }}" style="max-width:200px; border-radius:8px;">
                        <p class="text-muted" style="font-size:12px;">Kosongkan jika tidak ingin mengubah foto</p>
                      </div>
                    @endif
                  </div>
                </div>

                <div class="form-actions" style="margin-top:20px;">
                  <div class="row">
                    <div class="offset-sm-3 col-md-9">
                      <button type="submit" class="btn btn-success">{{ $button }}</button>
                      <a href="{{ route('admin.titik.index') }}" class="btn btn-inverse">Cancel</a>
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

  <script type="text/javascript">
  $(function() {

    // ---- Helper functions ----
    function hitung() {
      var p = parseFloat($("#panjang_lokasi").val()) || 0;
      var l = parseFloat($("#lebar_lokasi").val()) || 0;
      $("#luas_lokasi").val((p * l).toFixed(2));
    }

    var savedDesa = "{{ $id_desa }}";

    function loadDesa(idKec) {
      var sel = document.getElementById("id_desa");
      sel.innerHTML = '<option value="">-- Pilih Desa --</option>';
      if(!idKec) return;
      fetch("{{ url('admin/titik/desa_json') }}/" + idKec)
        .then(function(r) { return r.json(); })
        .then(function(data) {
          data.forEach(function(d) {
            var opt = document.createElement("option");
            opt.value = d.id;
            opt.text = d.nama;
            sel.appendChild(opt);
          });
          if(savedDesa) { sel.value = savedDesa; }
        })
        .catch(function(e) { console.error('loadDesa error:', e); });
    }

    // ---- Event bindings (PJAX-safe) ----
    $("#panjang_lokasi, #lebar_lokasi").on('keyup change', hitung);
    $("#id_kecamatan").on('change', function() { loadDesa(this.value); });

    // Show/hide jenis_parkir_luar
    function toggleJenisParkir() {
      var jf = $("#jenis_fasilitas").val();
      $("#row_jenis_parkir").css('display', (jf === 'luar') ? '' : 'none');
    }
    $("#jenis_fasilitas").on('change', toggleJenisParkir);
    toggleJenisParkir();

    // Load desa if editing
    var savedKec = "{{ $id_kecamatan }}";
    if(savedKec) {
      loadDesa(savedKec);
    }

    // ---- Leaflet Map ----
    var container = document.getElementById('map');
    if(!container) return;

    if(container._leaflet_id) {
      container._leaflet_id = null;
    }

    var defLat = -7.3942;
    var defLng = 109.5258;
    var zoom = 13;

    var savedLat = "{{ $titik_lat }}";
    var savedLng = "{{ $titik_lng }}";

    if(savedLat && parseFloat(savedLat) !== 0) {
      defLat = parseFloat(savedLat);
      defLng = parseFloat(savedLng);
      zoom = 16;
    }

    var map = L.map('map').setView([defLat, defLng], zoom);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      attribution: '&copy; OpenStreetMap'
    }).addTo(map);

    // Fix default icon
    delete L.Icon.Default.prototype._getIconUrl;
    L.Icon.Default.mergeOptions({
      iconRetinaUrl: 'https://unpkg.com/leaflet@1.9.4/dist/images/marker-icon-2x.png',
      iconUrl: 'https://unpkg.com/leaflet@1.9.4/dist/images/marker-icon.png',
      shadowUrl: 'https://unpkg.com/leaflet@1.9.4/dist/images/marker-shadow.png'
    });

    var marker = null;

    function setMarker(lat, lng) {
      if(marker) {
        marker.setLatLng([lat, lng]);
      } else {
        marker = L.marker([lat, lng], {draggable: true}).addTo(map);
        marker.on('dragend', function(e) {
          var pos = marker.getLatLng();
          $("#titik_lat").val(pos.lat.toFixed(14));
          $("#titik_lng").val(pos.lng.toFixed(14));
        });
      }
      $("#titik_lat").val(lat.toFixed(14));
      $("#titik_lng").val(lng.toFixed(14));
    }

    map.on('click', function(e) {
      setMarker(e.latlng.lat, e.latlng.lng);
    });

    if(savedLat && parseFloat(savedLat) !== 0) {
      setMarker(parseFloat(savedLat), parseFloat(savedLng));
    }

    // Search location by name (Nominatim)
    $("#btn-cari-lokasi").on('click', function() {
      var nama = $("#nama_lokasi").val();
      var kecEl = document.getElementById("id_kecamatan");
      var kecName = kecEl.options[kecEl.selectedIndex] ? kecEl.options[kecEl.selectedIndex].text.trim() : '';
      if(!nama) {
        alert("Isi nama lokasi terlebih dahulu");
        return;
      }
      var query = nama + ", " + kecName + ", Banjarnegara, Jawa Tengah, Indonesia";
      var url = "https://nominatim.openstreetmap.org/search?q=" + encodeURIComponent(query) + "&format=json&limit=1&countrycodes=id";

      fetch(url, {headers: {"User-Agent": "SIAP-Parkir-Dinhub"}})
        .then(function(r) { return r.json(); })
        .then(function(data) {
          if(data && data.length > 0) {
            var lat = parseFloat(data[0].lat);
            var lng = parseFloat(data[0].lon);
            setMarker(lat, lng);
            map.setView([lat, lng], 16);
          } else {
            alert("Lokasi tidak ditemukan di peta. Silakan klik manual pada peta.");
          }
        })
        .catch(function(err) {
          alert("Error mencari lokasi: " + err);
        });
    });

    // Manual lat/lng input
    $("#titik_lat").on('change', function() {
      var lat = parseFloat($(this).val());
      var lng = parseFloat($("#titik_lng").val());
      if(!isNaN(lat) && !isNaN(lng)) {
        setMarker(lat, lng);
        map.setView([lat, lng], 16);
      }
    });
    $("#titik_lng").on('change', function() {
      var lat = parseFloat($("#titik_lat").val());
      var lng = parseFloat($(this).val());
      if(!isNaN(lat) && !isNaN(lng)) {
        setMarker(lat, lng);
        map.setView([lat, lng], 16);
      }
    });

    // Fix map size after render
    setTimeout(function() { map.invalidateSize(); }, 300);
  });
  </script>
</div>
@endsection
