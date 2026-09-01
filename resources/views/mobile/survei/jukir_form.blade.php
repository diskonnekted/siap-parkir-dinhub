@extends('layouts.mobile')

@section('title', $mode === 'edit' ? 'Edit Jukir' : 'Jukir Baru')

@section('content')

<form id="formJukir" action="{{ $action }}" method="post" enctype="multipart/form-data">
  @csrf
  @if($mode === 'edit')
    <input type="hidden" name="id_juru_parkir" value="{{ $jukir->id_juru_parkir }}">
  @endif

  {{-- Foto jukir --}}
  <div class="m-card">
    <h3><i class="fa fa-camera"></i> Foto Jukir</h3>
    <div class="sub" style="margin-bottom:12px">Ambil foto langsung atau pilih dari galeri.</div>

    <div class="cam-box" style="aspect-ratio:1/1">
      <div class="cam-empty" id="camEmpty">
        @if($mode === 'edit' && $jukir->foto)
          <img src="{{ asset(ltrim($jukir->foto, './')) }}" style="width:100%;height:100%;object-fit:cover">
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
        <input type="file" id="fileFoto" accept="image/*" capture="user" style="display:none">
      </label>
    </div>
    <input type="hidden" id="fotoTerpilih" value="0">
  </div>

  {{-- Identitas --}}
  <div class="m-card">
    <h3><i class="fa fa-id-card"></i> Identitas</h3>
    <div style="height:10px"></div>

    <div class="m-field">
      <label class="m-label">Nama Lengkap *</label>
      <input type="text" name="nama" class="m-input" required value="{{ old('nama', $jukir->nama ?? '') }}" placeholder="Nama juru parkir">
    </div>

    <div class="m-field">
      <label class="m-label">NIK *</label>
      <input type="text" name="nik" class="m-input" required value="{{ old('nik', $jukir->nik ?? '') }}" placeholder="Nomor Induk Kependudukan" inputmode="numeric">
    </div>

    <div class="m-row2">
      <div class="m-field">
        <label class="m-label">Tempat Lahir</label>
        <input type="text" name="tempat_lahir" class="m-input" value="{{ old('tempat_lahir', $jukir->tempat_lahir ?? '') }}">
      </div>
      <div class="m-field">
        <label class="m-label">Tanggal Lahir</label>
        <input type="date" name="tanggal_lahir" class="m-input" value="{{ old('tanggal_lahir', $jukir->tanggal_lahir ?? '') }}">
      </div>
    </div>

    <div class="m-row2">
      <div class="m-field">
        <label class="m-label">Jenis Kelamin</label>
        <select name="jk" class="m-select">
          <option value="L" {{ old('jk', $jukir->jk ?? '') == 'L' ? 'selected' : '' }}>Laki-laki</option>
          <option value="P" {{ old('jk', $jukir->jk ?? '') == 'P' ? 'selected' : '' }}>Perempuan</option>
        </select>
      </div>
      <div class="m-field">
        <label class="m-label">Agama</label>
        <select name="agama" class="m-select">
          @foreach(['Islam','Kristen','Katolik','Hindu','Budha','Konghucu'] as $ag)
            <option value="{{ $ag }}" {{ old('agama', $jukir->agama ?? '') == $ag ? 'selected' : '' }}>{{ $ag }}</option>
          @endforeach
        </select>
      </div>
    </div>

    <div class="m-field">
      <label class="m-label">No. Telepon</label>
      <input type="text" name="no_telp" class="m-input" value="{{ old('no_telp', $jukir->no_telp ?? '') }}" inputmode="tel" placeholder="08xx">
    </div>
  </div>

  {{-- Alamat domisili --}}
  <div class="m-card">
    <h3><i class="fa fa-home"></i> Alamat Domisili</h3>
    <div style="height:10px"></div>

    <div class="m-row2">
      <div class="m-field">
        <label class="m-label">Kecamatan</label>
        <select name="domisili_id_kecamatan" id="id_kecamatan" class="m-select">
          <option value="">-- Pilih --</option>
          @foreach($kecamatan as $k)
            <option value="{{ $k->id }}" {{ old('domisili_id_kecamatan', $jukir->domisili_id_kecamatan ?? '') == $k->id ? 'selected' : '' }}>{{ trim($k->nama) }}</option>
          @endforeach
        </select>
      </div>
      <div class="m-field">
        <label class="m-label">Desa</label>
        <select name="domisili_id_desa" id="id_desa" class="m-select">
          <option value="">-- Pilih --</option>
        </select>
      </div>
    </div>

    <div class="m-field">
      <label class="m-label">Alamat</label>
      <textarea name="domisili_alamat" class="m-textarea" rows="2">{{ old('domisili_alamat', $jukir->domisili_alamat ?? '') }}</textarea>
    </div>

    <div class="m-row2">
      <div class="m-field">
        <label class="m-label">RT</label>
        <input type="text" name="domisili_rt" class="m-input" value="{{ old('domisili_rt', $jukir->domisili_rt ?? '') }}" inputmode="numeric">
      </div>
      <div class="m-field">
        <label class="m-label">RW</label>
        <input type="text" name="domisili_rw" class="m-input" value="{{ old('domisili_rw', $jukir->domisili_rw ?? '') }}" inputmode="numeric">
      </div>
    </div>
  </div>

  <button type="submit" class="m-btn m-btn-ok m-btn-block" id="btnSubmit">
    <i class="fa fa-save"></i> {{ $mode === 'edit' ? 'Simpan Perubahan' : 'Tambah Jukir' }}
  </button>
  <a href="{{ route('mobile.survei.index') }}" class="m-btn m-btn-ghost m-btn-block" style="margin-top:10px">Batal</a>
</form>

@endsection

@section('js')
<script>
(function(){
  // ===== Kamera =====
  var stream=null, shotBlob=null, galleryFile=null;
  var video=document.getElementById('camVideo');
  var preview=document.getElementById('camPreview');
  var empty=document.getElementById('camEmpty');
  var canvas=document.getElementById('camCanvas');
  var btnOpen=document.getElementById('btnCamOpen');
  var btnShot=document.getElementById('btnCamShot');
  var fileFoto=document.getElementById('fileFoto');
  var flagFoto=document.getElementById('fotoTerpilih');
  function show(el,on){ el.style.display=on?'block':'none'; }

  btnOpen.addEventListener('click', function(){
    if(!navigator.mediaDevices||!navigator.mediaDevices.getUserMedia){ mtoast('Kamera tidak didukung / butuh HTTPS','err'); return; }
    navigator.mediaDevices.getUserMedia({video:{facingMode:'user'},audio:false})
      .then(function(s){ stream=s; video.srcObject=s; show(empty,false); show(video,true); show(preview,false); show(btnShot,true); show(btnOpen,false); })
      .catch(function(){ mtoast('Akses kamera ditolak','err'); });
  });
  btnShot.addEventListener('click', function(){
    var w=video.videoWidth,h=video.videoHeight; if(!w){ mtoast('Kamera belum siap','err'); return; }
    canvas.width=w; canvas.height=h; canvas.getContext('2d').drawImage(video,0,0,w,h);
    canvas.toBlob(function(b){ shotBlob=b; galleryFile=null; flagFoto.value='1';
      preview.src=URL.createObjectURL(b); show(video,false); show(preview,true); show(btnShot,false); show(btnOpen,true);
      if(stream){stream.getTracks().forEach(function(t){t.stop();});stream=null;}
    },'image/jpeg',0.9);
  });
  fileFoto.addEventListener('change', function(){
    if(this.files && this.files[0]){ galleryFile=this.files[0]; shotBlob=null; flagFoto.value='1';
      preview.src=URL.createObjectURL(galleryFile); show(empty,false); show(video,false); show(preview,true); }
  });

  // ===== Dropdown desa berjenjang =====
  var savedDesa = "{{ old('domisili_id_desa', $jukir->domisili_id_desa ?? '') }}";
  function loadDesa(idKec){
    var sel=document.getElementById('id_desa');
    sel.innerHTML='<option value="">-- Pilih --</option>';
    if(!idKec) return;
    fetch("{{ url('m/survei/desa_json') }}/" + idKec).then(function(r){return r.json();})
      .then(function(data){ data.forEach(function(d){ var o=document.createElement('option'); o.value=d.id; o.text=d.nama; sel.appendChild(o); }); if(savedDesa){ sel.value=savedDesa; } })
      .catch(function(){});
  }
  document.getElementById('id_kecamatan').addEventListener('change', function(){ loadDesa(this.value); });
  var initKec=document.getElementById('id_kecamatan').value; if(initKec){ loadDesa(initKec); }

  // ===== Submit (online -> fetch; offline -> antrean IndexedDB) =====
  document.getElementById('formJukir').addEventListener('submit', function(e){
    e.preventDefault();
    var form=this;
    var fields={};
    new FormData(form).forEach(function(v,k){ if(k!=='foto') fields[k]=v; });
    fields['_token']='{{ csrf_token() }}';

    var photoPromise = galleryFile
      ? window.MobileSync.fileEntry(galleryFile,'foto')
      : window.MobileSync.fileEntry(shotBlob ? new File([shotBlob],'foto.jpg',{type:'image/jpeg'}) : null, 'foto');

    if(!navigator.onLine){
      photoPromise.then(function(fe){
        return window.MobileSync.add({ url: form.action, fields: fields, files: fe?[fe]:[] });
      }).then(function(){ mtoast('Disimpan offline. Akan tersinkron saat online.','ok'); form.reset(); flagFoto.value='0'; preview.src=''; show(preview,false); show(empty,true); });
      return;
    }

    var fd=new FormData();
    Object.keys(fields).forEach(function(k){ fd.append(k, fields[k]); });
    if(galleryFile){ fd.append('foto', galleryFile); }
    else if(shotBlob){ fd.append('foto', shotBlob, 'foto.jpg'); }

    var btn=document.getElementById('btnSubmit'); btn.disabled=true; btn.innerHTML='<i class="fa fa-spinner fa-spin"></i> Menyimpan...';
    fetch(form.action, { method:'POST', body:fd, credentials:'same-origin', headers:{'X-Requested-With':'XMLHttpRequest'} })
      .then(function(r){ return r.json(); })
      .then(function(res){ mtoast(res.message||'Tersimpan','ok'); setTimeout(function(){ window.location.href="{{ route('mobile.survei.index') }}"; }, 900); })
      .catch(function(){ mtoast('Gagal menyimpan','err'); })
      .finally(function(){ btn.disabled=false; btn.innerHTML='<i class="fa fa-save"></i> {{ $mode === "edit" ? "Simpan Perubahan" : "Tambah Jukir" }}'; });
  });
})();
</script>
@endsection
