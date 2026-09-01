@extends('layouts.mobile')

@section('title', 'Detail Survei')

@section('content')

@php
  $fotoJukir = $row->foto ? asset(ltrim($row->foto, './')) : null;
  $fotoLokasi = $row->foto_lokasi ? asset(ltrim($row->foto_lokasi, './')) : null;
  $sudahVerif = (int) $row->verifikasi === 1;
@endphp

  {{-- Kartu jukir --}}
  <div class="m-card" style="text-align:center; padding-top:18px">
    @if($fotoJukir)
      <img src="{{ $fotoJukir }}" style="width:96px;height:96px;border-radius:50%;object-fit:cover;border:3px solid var(--accent)">
    @else
      <div style="width:96px;height:96px;border-radius:50%;background:rgba(148,163,184,.12);display:inline-flex;align-items:center;justify-content:center;border:3px solid var(--line)">
        <i class="fa fa-user" style="font-size:38px;color:var(--muted)"></i>
      </div>
    @endif
    <h3 style="margin-top:10px">{{ strtoupper($row->nama) }}</h3>
    <div class="sub">NIK: {{ $row->nik ?? '-' }} &middot; {{ $row->no_telp ?? '-' }}</div>
    <div style="margin-top:10px">
      <span id="verifChip" class="m-chip {{ $sudahVerif ? 'ok' : 'warn' }}">
        <i class="fa {{ $sudahVerif ? 'fa-check-circle' : 'fa-clock-o' }}"></i>
        {{ $sudahVerif ? 'Terverifikasi Lapangan' : 'Belum Diverifikasi' }}
      </span>
    </div>
  </div>

  {{-- Kamera verifikasi --}}
  <div class="m-card">
    <h3><i class="fa fa-camera"></i> Pemotretan / Verifikasi Lapangan</h3>
    <div class="sub" style="margin-bottom:12px">Ambil foto jukir di lokasi untuk memverifikasi keberadaannya.</div>

    <div class="cam-box" id="camBox">
      <div class="cam-empty" id="camEmpty">
        <i class="fa fa-camera" style="font-size:34px"></i>
        <span>Ketuk "Buka Kamera" untuk mulai</span>
      </div>
      <video id="camVideo" autoplay playsinline style="display:none"></video>
      <img id="camPreview" style="display:none" alt="">
    </div>
    <canvas id="camCanvas" style="display:none"></canvas>

    <div class="cam-actions">
      <button type="button" class="m-btn m-btn-ghost" id="btnCamOpen" style="flex:1"><i class="fa fa-camera"></i> Buka Kamera</button>
      <button type="button" class="m-btn m-btn-pri" id="btnCamShot" style="flex:1; display:none"><i class="fa fa-circle"></i> Ambil Foto</button>
      <button type="button" class="m-btn m-btn-ghost" id="btnCamRetake" style="display:none"><i class="fa fa-undo"></i></button>
    </div>

    <button type="button" class="m-btn m-btn-ok m-btn-block" id="btnVerify" style="margin-top:12px" {{ $sudahVerif ? 'disabled' : '' }}>
      <i class="fa fa-check"></i> {{ $sudahVerif ? 'Sudah Diverifikasi' : 'Verifikasi Jukir' }}
    </button>
    @if($sudahVerif)
      <button type="button" class="m-btn m-btn-danger m-btn-block" id="btnUnverify" style="margin-top:10px">
        <i class="fa fa-times"></i> Cabut Verifikasi
      </button>
    @endif
  </div>

  {{-- Info titik --}}
  <div class="m-card">
    <div style="display:flex; justify-content:space-between; align-items:flex-start; gap:10px">
      <div>
        <h3><i class="fa fa-map-marker"></i> Titik Parkir</h3>
        <div class="sub">{{ $row->nama_lokasi }}</div>
        <div class="sub">Kec. {{ $row->kec }} / {{ $row->desa }}</div>
        @if($row->nama_ruas)<div class="sub">Ruas: {{ $row->nama_ruas }}</div>@endif
      </div>
      <a href="{{ route('mobile.survei.titik_edit', $row->id_titik_parkir) }}" class="m-btn m-btn-ghost" style="padding:8px 12px; font-size:12px">
        <i class="fa fa-pencil"></i> Edit
      </a>
    </div>

    @if($fotoLokasi)
      <img src="{{ $fotoLokasi }}" style="width:100%; border-radius:12px; margin-top:12px; border:1px solid var(--line)">
    @endif

    <div id="mapDetail" class="map-box" style="margin-top:12px"></div>
    <div class="m-help" style="margin-top:8px">
      Koordinat: {{ $row->titik_lat }}, {{ $row->titik_lng }}
    </div>
  </div>

  {{-- Navigasi cepat --}}
  <div style="display:grid; grid-template-columns:1fr 1fr; gap:10px">
    <a href="{{ route('mobile.survei.jukir_edit', $row->id_juru_parkir) }}" class="m-btn m-btn-ghost">
      <i class="fa fa-user"></i> Edit Jukir
    </a>
    <a href="{{ route('mobile.survei.index') }}" class="m-btn m-btn-ghost">
      <i class="fa fa-list"></i> Kembali
    </a>
  </div>

@endsection

@section('js')
<script>
(function(){
  // ===== Peta detail =====
  var lat = parseFloat("{{ $row->titik_lat }}"), lng = parseFloat("{{ $row->titik_lng }}");
  if (isFinite(lat) && isFinite(lng) && typeof L !== 'undefined') {
    var map = L.map('mapDetail', { attributionControl:false }).setView([lat,lng], 16);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',{maxZoom:19}).addTo(map);
    L.marker([lat,lng]).addTo(map).bindPopup("{{ addslashes($row->nama_lokasi) }}").openPopup();
    setTimeout(function(){ map.invalidateSize(); }, 300);
  }

  // ===== Kamera =====
  var stream=null, shotBlob=null;
  var video=document.getElementById('camVideo');
  var preview=document.getElementById('camPreview');
  var empty=document.getElementById('camEmpty');
  var canvas=document.getElementById('camCanvas');
  var btnOpen=document.getElementById('btnCamOpen');
  var btnShot=document.getElementById('btnCamShot');
  var btnRetake=document.getElementById('btnCamRetake');

  function show(el, on){ el.style.display = on ? 'block' : 'none'; }

  btnOpen.addEventListener('click', function(){
    if(!navigator.mediaDevices || !navigator.mediaDevices.getUserMedia){
      mtoast('Kamera tidak didukung / butuh HTTPS','err'); return;
    }
    navigator.mediaDevices.getUserMedia({ video:{ facingMode:'environment' }, audio:false })
      .then(function(s){
        stream=s; video.srcObject=s;
        show(empty,false); show(video,true); show(preview,false);
        show(btnShot,true); show(btnOpen,false);
      })
      .catch(function(){ mtoast('Akses kamera ditolak','err'); });
  });

  btnShot.addEventListener('click', function(){
    var w=video.videoWidth, h=video.videoHeight;
    if(!w){ mtoast('Kamera belum siap','err'); return; }
    canvas.width=w; canvas.height=h;
    canvas.getContext('2d').drawImage(video,0,0,w,h);
    canvas.toBlob(function(b){
      shotBlob=b;
      preview.src=URL.createObjectURL(b);
      show(video,false); show(preview,true); show(btnShot,false);
      show(btnRetake,true);
      if(stream){ stream.getTracks().forEach(function(t){t.stop();}); stream=null; }
    }, 'image/jpeg', 0.9);
  });

  btnRetake.addEventListener('click', function(){
    shotBlob=null; preview.src='';
    show(preview,false); show(btnRetake,false); show(btnOpen,true); show(empty,true);
  });

  // ===== Verifikasi =====
  function postVerif(url, withPhoto, isUnverify){
    var fd=new FormData();
    fd.append('_token', '{{ csrf_token() }}');
    if(withPhoto && shotBlob){ fd.append('foto', shotBlob, 'verifikasi_{{ $row->id_juru_parkir }}_' + Date.now() + '.jpg'); }

    if(!navigator.onLine){
      // Simpan ke antrean offline
      window.MobileSync.fileEntry(shotBlob,'foto').then(function(fe){
        return window.MobileSync.add({
          url: url,
          fields: { _token: '{{ csrf_token() }}' },
          files: fe ? [fe] : []
        });
      }).then(function(){
        mtoast('Disimpan offline. Akan tersinkron saat online.','ok');
        if(isUnverify){ markUnverified(); } else { markVerified(); }
      });
      return;
    }

    fetch(url, { method:'POST', body:fd, credentials:'same-origin', headers:{'X-Requested-With':'XMLHttpRequest'} })
      .then(function(r){ return r.json(); })
      .then(function(res){ mtoast(res.message||'Berhasil','ok'); if(isUnverify){ markUnverified(); } else { markVerified(); } })
      .catch(function(){ mtoast('Gagal verifikasi','err'); });
  }

  function markVerified(){
    var chip=document.getElementById('verifChip');
    chip.className='m-chip ok';
    chip.innerHTML='<i class="fa fa-check-circle"></i> Terverifikasi Lapangan';
    var btn=document.getElementById('btnVerify');
    if(btn){ btn.disabled=true; btn.innerHTML='<i class="fa fa-check"></i> Sudah Diverifikasi'; }
  }
  function markUnverified(){
    var chip=document.getElementById('verifChip');
    chip.className='m-chip warn';
    chip.innerHTML='<i class="fa fa-clock-o"></i> Belum Diverifikasi';
    var btn=document.getElementById('btnVerify');
    if(btn){ btn.disabled=false; btn.innerHTML='<i class="fa fa-check"></i> Verifikasi Jukir'; }
  }

  var btnVerify=document.getElementById('btnVerify');
  if(btnVerify){
    btnVerify.addEventListener('click', function(){
      postVerif("{{ route('mobile.survei.verifikasi_jukir', $row->id_juru_parkir) }}", true, false);
    });
  }
  var btnUnverify=document.getElementById('btnUnverify');
  if(btnUnverify){
    btnUnverify.addEventListener('click', function(){
      if(!confirm('Cabut verifikasi jukir ini?')) return;
      postVerif("{{ route('mobile.survei.unverifikasi_jukir', $row->id_juru_parkir) }}", false, true);
    });
  }
})();
</script>
@endsection
