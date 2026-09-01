@extends('layouts.mobile')

@section('title', $mode === 'edit' ? 'Edit Titik Parkir' : 'Titik Parkir Baru')

@section('content')

<form id="formTitik" action="{{ $action }}" method="post" enctype="multipart/form-data">
  @csrf
  @if($mode === 'edit')
    <input type="hidden" name="id_titik_parkir" value="{{ $titik->id_titik_parkir }}">
  @endif

  {{-- Marking lokasi --}}
  <div class="m-card" style="padding:0; overflow:hidden">
    <div id="mapTitik" class="map-box map-tall" style="border:0"></div>
    <div style="padding:12px 14px">
      <button type="button" class="m-btn m-btn-pri m-btn-block" id="btnGps">
        <i class="fa fa-crosshairs"></i> Gunakan Lokasi Saya (GPS)
      </button>
      <div class="m-help" style="margin-top:8px">Ketuk peta atau geser marker untuk menandai titik parkir.</div>

      <div class="m-row2" style="margin-top:10px">
        <div class="m-field">
          <label class="m-label">Latitude</label>
          <input type="text" name="titik_lat" id="titik_lat" class="m-input" value="{{ old('titik_lat', $titik->titik_lat ?? '') }}" placeholder="-7.xxxx">
        </div>
        <div class="m-field">
          <label class="m-label">Longitude</label>
          <input type="text" name="titik_lng" id="titik_lng" class="m-input" value="{{ old('titik_lng', $titik->titik_lng ?? '') }}" placeholder="109.xxxx">
        </div>
      </div>
    </div>
  </div>

  {{-- Penamaan --}}
  <div class="m-card">
    <h3><i class="fa fa-tag"></i> Penamaan Titik</h3>
    <div style="height:10px"></div>

    <div class="m-field">
      <label class="m-label">Nama Lokasi *</label>
      <input type="text" name="nama_lokasi" id="nama_lokasi" class="m-input" required value="{{ old('nama_lokasi', $titik->nama_lokasi ?? '') }}" placeholder="Contoh: Depan Pasar Wanadadi">
    </div>

    <button type="button" class="m-btn m-btn-ghost m-btn-block" id="btnCari" style="margin-bottom:14px">
      <i class="fa fa-search"></i> Cari Lokasi Otomatis (Nominatim)
    </button>

    <div class="m-row2">
      <div class="m-field">
        <label class="m-label">Jenis Fasilitas</label>
        <select name="jenis_fasilitas" id="jenis_fasilitas" class="m-select">
          <option value="luar" {{ old('jenis_fasilitas', $titik->jenis_fasilitas ?? 'luar') == 'luar' ? 'selected' : '' }}>Di Luar Rumaja</option>
          <option value="dalam" {{ old('jenis_fasilitas', $titik->jenis_fasilitas ?? '') == 'dalam' ? 'selected' : '' }}>Di Dalam Rumaja</option>
        </select>
      </div>
      <div class="m-field" id="rowJenisLuar">
        <label class="m-label">Jenis Parkir (Luar)</label>
        <select name="jenis_parkir_luar" class="m-select">
          <option value="tpk" {{ old('jenis_parkir_luar', $titik->jenis_parkir_luar ?? 'tpk') == 'tpk' ? 'selected' : '' }}>TPK</option>
          <option value="tkp" {{ old('jenis_parkir_luar', $titik->jenis_parkir_luar ?? '') == 'tkp' ? 'selected' : '' }}>TKP</option>
        </select>
      </div>
    </div>

    <div class="m-row2">
      <div class="m-field">
        <label class="m-label">Kecamatan *</label>
        <select name="id_kecamatan" id="id_kecamatan" class="m-select" required>
          <option value="">-- Pilih --</option>
          @foreach($kecamatan as $k)
            <option value="{{ $k->id }}" {{ old('id_kecamatan', $titik->id_kecamatan ?? '') == $k->id ? 'selected' : '' }}>{{ trim($k->nama) }}</option>
          @endforeach
        </select>
      </div>
      <div class="m-field">
        <label class="m-label">Desa / Kelurahan *</label>
        <select name="id_desa" id="id_desa" class="m-select" required>
          <option value="">-- Pilih --</option>
        </select>
      </div>
    </div>

    <div class="m-row2">
      <div class="m-field">
        <label class="m-label">Jenis Desa</label>
        <select name="jenis_desa" class="m-select">
          <option value="Desa" {{ old('jenis_desa', $titik->jenis_desa ?? 'Desa') == 'Desa' ? 'selected' : '' }}>Desa</option>
          <option value="Kelurahan" {{ old('jenis_desa', $titik->jenis_desa ?? '') == 'Kelurahan' ? 'selected' : '' }}>Kelurahan</option>
        </select>
      </div>
      <div class="m-field">
        <label class="m-label">Ruas Jalan</label>
        <select name="id_ruas_jalan" class="m-select">
          <option value="">-- Pilih --</option>
          @foreach($ruas_jalan as $rj)
            <option value="{{ $rj->id_ruas_jalan }}" {{ old('id_ruas_jalan', $titik->id_ruas_jalan ?? '') == $rj->id_ruas_jalan ? 'selected' : '' }}>{{ $rj->nama_ruas }}</option>
          @endforeach
        </select>
      </div>
    </div>
  </div>

  {{-- Dimensi & kapasitas --}}
  <div class="m-card">
    <h3><i class="fa fa-arrows-alt"></i> Dimensi &amp; Kapasitas</h3>
    <div style="height:10px"></div>
    <div class="m-row2">
      <div class="m-field">
        <label class="m-label">Panjang (m)</label>
        <input type="number" step="0.01" name="panjang_lokasi" id="panjang_lokasi" class="m-input" value="{{ old('panjang_lokasi', $titik->panjang_lokasi ?? '') }}">
      </div>
      <div class="m-field">
        <label class="m-label">Lebar (m)</label>
        <input type="number" step="0.01" name="lebar_lokasi" id="lebar_lokasi" class="m-input" value="{{ old('lebar_lokasi', $titik->lebar_lokasi ?? '') }}">
      </div>
    </div>
    <div class="m-field">
      <label class="m-label">Luas (m&sup2;)</label>
      <input type="number" step="0.01" name="luas_lokasi" id="luas_lokasi" class="m-input" value="{{ old('luas_lokasi', $titik->luas_lokasi ?? '') }}" readonly>
    </div>
    <div class="m-row2">
      <div class="m-field">
        <label class="m-label">SRP Motor</label>
        <input type="number" name="srp_motor" class="m-input" value="{{ old('srp_motor', $titik->srp_motor ?? '') }}">
      </div>
      <div class="m-field">
        <label class="m-label">SRP Mobil</label>
        <input type="number" name="srp_mobil" class="m-input" value="{{ old('srp_mobil', $titik->srp_mobil ?? '') }}">
      </div>
    </div>
  </div>

  {{-- Foto lokasi --}}
  <div class="m-card">
    <h3><i class="fa fa-photo"></i> Foto Lokasi</h3>
    <div style="height:10px"></div>
    <div class="cam-box" style="aspect-ratio:4/3">
      <div class="cam-empty" id="camEmpty">
        @if($mode === 'edit' && $titik->foto_lokasi)
          <img src="{{ asset(ltrim($titik->foto_lokasi, './')) }}" style="width:100%;height:100%;object-fit:cover">
        @else
          <i class="fa fa-camera" style="font-size:34px"></i>
          <span>Belum ada foto</span>
        @endif
      </div>
      <video id="camVideo" autoplay playsinline style="display:none"></video>
      <img id="camPreview" style="display:none" alt="">
    </div>
    <canvas id="camCanvas" style="display:none"></canvas>
    <div class="cam-actions">
      <button type="button" class="m-btn m-btn-ghost" id="btnCamOpen" style="flex:1"><i class="fa fa-camera"></i> Kamera</button>
      <button type="button" class="m-btn m-btn-pri" id="btnCamShot" style="flex:1; display:none"><i class="fa fa-circle"></i> Ambil</button>
      <label class="m-btn m-btn-ghost" style="flex:1; margin:0">
        <i class="fa fa-image"></i> Galeri
        <input type="file" id="fileFoto" accept="image/*" capture="environment" style="display:none">
      </label>
    </div>
  </div>

  <button type="submit" class="m-btn m-btn-ok m-btn-block" id="btnSubmit">
    <i class="fa fa-save"></i> {{ $mode === 'edit' ? 'Simpan Perubahan' : 'Tambah Titik' }}
  </button>
  <a href="{{ route('mobile.survei.index') }}" class="m-btn m-btn-ghost m-btn-block" style="margin-top:10px">Batal</a>
</form>

@endsection

@section('js')
<script>
(function(){
  // ===== Peta marking =====
  var latInput=document.getElementById('titik_lat'), lngInput=document.getElementById('titik_lng');
  var defLat=-7.3942, defLng=109.5258, zoom=13, marker=null, map=null;

  var sLat=parseFloat(latInput.value), sLng=parseFloat(lngInput.value);
  if(isFinite(sLat)&&isFinite(sLng)&&sLat!==0){ defLat=sLat; defLng=sLng; zoom=16; }

  if(typeof L !== 'undefined'){
    map=L.map('mapTitik', { attributionControl:false }).setView([defLat,defLng],zoom);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',{maxZoom:19}).addTo(map);
    delete L.Icon.Default.prototype._getIconUrl;
    L.Icon.Default.mergeOptions({
      iconRetinaUrl:'https://unpkg.com/leaflet@1.9.4/dist/images/marker-icon-2x.png',
      iconUrl:'https://unpkg.com/leaflet@1.9.4/dist/images/marker-icon.png',
      shadowUrl:'https://unpkg.com/leaflet@1.9.4/dist/images/marker-shadow.png'
    });

    function setMarker(lat,lng){
      if(marker){ marker.setLatLng([lat,lng]); }
      else { marker=L.marker([lat,lng],{draggable:true}).addTo(map);
        marker.on('dragend', function(){ var p=marker.getLatLng(); latInput.value=p.lat.toFixed(14); lngInput.value=p.lng.toFixed(14); }); }
      latInput.value=lat.toFixed(14); lngInput.value=lng.toFixed(14);
    }
    map.on('click', function(e){ setMarker(e.latlng.lat, e.latlng.lng); });
    if(isFinite(sLat)&&isFinite(sLng)&&sLat!==0){ setMarker(sLat,sLng); }

    document.getElementById('btnGps').addEventListener('click', function(){
      if(!navigator.geolocation){ mtoast('GPS tidak didukung','err'); return; }
      mtoast('Mengambil lokasi GPS...');
      navigator.geolocation.getCurrentPosition(function(pos){
        var lat=pos.coords.latitude, lng=pos.coords.longitude;
        setMarker(lat,lng); map.setView([lat,lng],17);
        mtoast('Lokasi ditandai','ok');
      }, function(){ mtoast('Gagal mendapatkan lokasi','err'); }, {enableHighAccuracy:true, timeout:12000});
    });

    document.getElementById('btnCari').addEventListener('click', function(){
      var nama=document.getElementById('nama_lokasi').value;
      if(!nama){ mtoast('Isi nama lokasi dulu','err'); return; }
      var url='https://nominatim.openstreetmap.org/search?q='+encodeURIComponent(nama+', Banjarnegara, Jawa Tengah, Indonesia')+'&format=json&limit=1&countrycodes=id';
      fetch(url,{headers:{'User-Agent':'SIAP-Parkir'}}).then(function(r){return r.json();}).then(function(d){
        if(d&&d.length){ var lat=parseFloat(d[0].lat),lng=parseFloat(d[0].lon); setMarker(lat,lng); map.setView([lat,lng],16); mtoast('Lokasi ditemukan','ok'); }
        else mtoast('Lokasi tidak ditemukan','err');
      }).catch(function(){ mtoast('Gagal mencari lokasi','err'); });
    });

    [latInput,lngInput].forEach(function(inp){
      inp.addEventListener('change', function(){
        var lat=parseFloat(latInput.value), lng=parseFloat(lngInput.value);
        if(isFinite(lat)&&isFinite(lng)){ setMarker(lat,lng); map.setView([lat,lng],16); }
      });
    });
    setTimeout(function(){ map.invalidateSize(); }, 300);
  }

  // ===== Toggle jenis parkir luar =====
  function toggleJenis(){ document.getElementById('rowJenisLuar').style.display = document.getElementById('jenis_fasilitas').value==='luar' ? '' : 'none'; }
  document.getElementById('jenis_fasilitas').addEventListener('change', toggleJenis); toggleJenis();

  // ===== Hitung luas =====
  function hitung(){ var p=parseFloat(document.getElementById('panjang_lokasi').value)||0, l=parseFloat(document.getElementById('lebar_lokasi').value)||0; document.getElementById('luas_lokasi').value=(p*l).toFixed(2); }
  document.getElementById('panjang_lokasi').addEventListener('input', hitung);
  document.getElementById('lebar_lokasi').addEventListener('input', hitung);

  // ===== Dropdown desa =====
  var savedDesa="{{ old('id_desa', $titik->id_desa ?? '') }}";
  function loadDesa(idKec){ var sel=document.getElementById('id_desa'); sel.innerHTML='<option value="">-- Pilih --</option>'; if(!idKec) return;
    fetch("{{ url('m/survei/desa_json') }}/"+idKec).then(function(r){return r.json();}).then(function(data){ data.forEach(function(d){ var o=document.createElement('option'); o.value=d.id; o.text=d.nama; sel.appendChild(o); }); if(savedDesa){ sel.value=savedDesa; } }).catch(function(){}); }
  document.getElementById('id_kecamatan').addEventListener('change', function(){ loadDesa(this.value); });
  var initKec=document.getElementById('id_kecamatan').value; if(initKec){ loadDesa(initKec); }

  // ===== Kamera =====
  var stream=null, shotBlob=null, galleryFile=null;
  var video=document.getElementById('camVideo'), preview=document.getElementById('camPreview'), empty=document.getElementById('camEmpty'), canvas=document.getElementById('camCanvas');
  var btnOpen=document.getElementById('btnCamOpen'), btnShot=document.getElementById('btnCamShot'), fileFoto=document.getElementById('fileFoto');
  function show(el,on){ el.style.display=on?'block':'none'; }
  btnOpen.addEventListener('click', function(){
    if(!navigator.mediaDevices||!navigator.mediaDevices.getUserMedia){ mtoast('Kamera tidak didukung / butuh HTTPS','err'); return; }
    navigator.mediaDevices.getUserMedia({video:{facingMode:'environment'},audio:false}).then(function(s){ stream=s; video.srcObject=s; show(empty,false); show(video,true); show(preview,false); show(btnShot,true); show(btnOpen,false); }).catch(function(){ mtoast('Akses kamera ditolak','err'); });
  });
  btnShot.addEventListener('click', function(){
    var w=video.videoWidth,h=video.videoHeight; if(!w){ mtoast('Kamera belum siap','err'); return; }
    canvas.width=w; canvas.height=h; canvas.getContext('2d').drawImage(video,0,0,w,h);
    canvas.toBlob(function(b){ shotBlob=b; galleryFile=null; preview.src=URL.createObjectURL(b); show(video,false); show(preview,true); show(btnShot,false); show(btnOpen,true); if(stream){stream.getTracks().forEach(function(t){t.stop();});stream=null;} },'image/jpeg',0.9);
  });
  fileFoto.addEventListener('change', function(){ if(this.files&&this.files[0]){ galleryFile=this.files[0]; shotBlob=null; preview.src=URL.createObjectURL(galleryFile); show(empty,false); show(video,false); show(preview,true); } });

  // ===== Submit =====
  document.getElementById('formTitik').addEventListener('submit', function(e){
    e.preventDefault();
    var form=this;
    var fields={};
    new FormData(form).forEach(function(v,k){ if(k!=='foto_lokasi') fields[k]=v; });
    fields['_token']='{{ csrf_token() }}';

    var photoPromise = galleryFile ? window.MobileSync.fileEntry(galleryFile,'foto_lokasi') : window.MobileSync.fileEntry(shotBlob ? new File([shotBlob],'foto.jpg',{type:'image/jpeg'}) : null, 'foto_lokasi');

    if(!navigator.onLine){
      photoPromise.then(function(fe){ return window.MobileSync.add({ url: form.action, fields: fields, files: fe?[fe]:[] }); })
        .then(function(){ mtoast('Disimpan offline. Akan tersinkron saat online.','ok'); form.reset(); preview.src=''; show(preview,false); show(empty,true); });
      return;
    }

    var fd=new FormData();
    Object.keys(fields).forEach(function(k){ fd.append(k, fields[k]); });
    if(galleryFile){ fd.append('foto_lokasi', galleryFile); }
    else if(shotBlob){ fd.append('foto_lokasi', shotBlob, 'foto.jpg'); }

    var btn=document.getElementById('btnSubmit'); btn.disabled=true; btn.innerHTML='<i class="fa fa-spinner fa-spin"></i> Menyimpan...';
    fetch(form.action, { method:'POST', body:fd, credentials:'same-origin', headers:{'X-Requested-With':'XMLHttpRequest'} })
      .then(function(r){ return r.json(); })
      .then(function(res){ mtoast(res.message||'Tersimpan','ok'); setTimeout(function(){ window.location.href="{{ route('mobile.survei.index') }}"; }, 900); })
      .catch(function(){ mtoast('Gagal menyimpan','err'); })
      .finally(function(){ btn.disabled=false; btn.innerHTML='<i class="fa fa-save"></i> {{ $mode === "edit" ? "Simpan Perubahan" : "Tambah Titik" }}'; });
  });
})();
</script>
@endsection
