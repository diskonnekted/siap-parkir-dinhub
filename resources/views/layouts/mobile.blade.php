<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>@yield('title', 'Survei Lapangan') &middot; SIAP Mobile</title>
<meta name="description" content="SIAP Dinhub Banjarnegara - Survei Lapangan Juru Parkir">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, viewport-fit=cover">
<meta name="theme-color" content="#0b1220">
<meta name="mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
<meta name="apple-mobile-web-app-title" content="SIAP Survei">

<link rel="manifest" href="{{ asset('assets/pwa/manifest.webmanifest') }}">
<link rel="icon" href="{{ asset('images/favicon.png') }}">
<link rel="apple-touch-icon" href="{{ asset('assets/pub/img/logo.png') }}">

<!-- Bootstrap (lokal, di-cache SW) -->
<link rel="stylesheet" href="{{ asset('template/bootstrap/css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('template/css/font-awesome/css/font-awesome.min.css') }}">
<link href="https://fonts.googleapis.com/css?family=Poppins:400,500,600,700" rel="stylesheet">

<!-- Leaflet -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<style>
  :root{
    --bg:#0b1220; --card:#111a2e; --card2:#0f1930; --line:rgba(148,163,184,.14);
    --txt:#e6edf7; --muted:#93a3bd; --accent:#2f7bff; --accent2:#22c1a3;
    --danger:#ff5d5d; --warn:#ffb020; --ok:#23c483;
  }
  *{box-sizing:border-box}
  html,body{margin:0;padding:0;background:#070d18;color:var(--txt);
    font-family:'Poppins',system-ui,-apple-system,Segoe UI,Roboto,Arial,sans-serif;
    -webkit-tap-highlight-color:transparent}
  body{padding-bottom:76px}

  .m-shell{max-width:640px;margin:0 auto;min-height:100vh;display:flex;flex-direction:column}

  /* Top bar */
  .m-top{position:sticky;top:0;z-index:50;background:rgba(7,13,24,.9);backdrop-filter:blur(10px);
    border-bottom:1px solid var(--line);padding:calc(env(safe-area-inset-top)) 14px 10px}
  .m-top-in{display:flex;align-items:center;gap:10px}
  .m-logo{width:34px;height:34px;border-radius:9px;background:linear-gradient(135deg,#2f7bff,#22c1a3);
    display:flex;align-items:center;justify-content:center;color:#fff;font-weight:700;flex:0 0 auto}
  .m-title{line-height:1.1}
  .m-title b{display:block;font-size:15px}
  .m-title span{font-size:11px;color:var(--muted)}
  .m-net{margin-left:auto;display:flex;align-items:center;gap:6px;font-size:11px;color:var(--muted)}
  .dot{width:9px;height:9px;border-radius:50%;background:var(--ok);box-shadow:0 0 0 3px rgba(35,196,131,.15)}
  .dot.off{background:var(--danger);box-shadow:0 0 0 3px rgba(255,93,93,.15)}

  .m-content{flex:1;padding:14px}

  /* Cards */
  .m-card{background:linear-gradient(180deg,var(--card),var(--card2));border:1px solid var(--line);
    border-radius:16px;padding:14px;margin-bottom:14px}
  .m-card h3{margin:0 0 4px;font-size:15px}
  .m-card .sub{color:var(--muted);font-size:12px}

  .m-chip{display:inline-flex;align-items:center;gap:6px;font-size:11px;padding:4px 10px;border-radius:999px;
    border:1px solid var(--line);background:rgba(148,163,184,.08);color:var(--muted)}
  .m-chip.ok{color:var(--ok);border-color:rgba(35,196,131,.35);background:rgba(35,196,131,.1)}
  .m-chip.warn{color:var(--warn);border-color:rgba(255,176,32,.35);background:rgba(255,176,32,.1)}

  /* Buttons */
  .m-btn{display:inline-flex;align-items:center;justify-content:center;gap:8px;border:0;border-radius:12px;
    padding:12px 14px;font-family:inherit;font-size:14px;font-weight:600;cursor:pointer;text-decoration:none;
    transition:.15s transform,.15s opacity}
  .m-btn:active{transform:scale(.97)}
  .m-btn-pri{background:linear-gradient(135deg,#2f7bff,#1f5fe0);color:#fff}
  .m-btn-ok{background:linear-gradient(135deg,#22c1a3,#17a08a);color:#fff}
  .m-btn-ghost{background:rgba(148,163,184,.1);color:var(--txt);border:1px solid var(--line)}
  .m-btn-danger{background:rgba(255,93,93,.12);color:var(--danger);border:1px solid rgba(255,93,93,.3)}
  .m-btn-block{width:100%}
  .m-btn:disabled{opacity:.55}

  /* Form */
  .m-label{display:block;font-size:12px;color:var(--muted);margin:0 0 6px;font-weight:500}
  .m-input,.m-select,.m-textarea{width:100%;background:#0b1526;border:1px solid var(--line);color:var(--txt);
    border-radius:12px;padding:12px 14px;font-family:inherit;font-size:15px;outline:none}
  .m-input:focus,.m-select:focus,.m-textarea:focus{border-color:var(--accent)}
  .m-field{margin-bottom:14px}
  .m-row2{display:grid;grid-template-columns:1fr 1fr;gap:10px}
  .m-help{font-size:11px;color:var(--muted);margin-top:5px}

  /* Camera capture */
  .cam-box{position:relative;background:#000;border-radius:14px;overflow:hidden;aspect-ratio:3/4;margin-bottom:10px}
  .cam-box video,.cam-box img{width:100%;height:100%;object-fit:cover;display:block}
  .cam-actions{display:flex;gap:10px}
  .cam-empty{position:absolute;inset:0;display:flex;flex-direction:column;gap:8px;align-items:center;
    justify-content:center;color:var(--muted);font-size:12px;background:#0b1526}

  /* Map */
  .map-box{height:280px;border-radius:14px;border:1px solid var(--line);overflow:hidden}
  .map-tall{height:340px}

  /* List */
  .m-item{display:flex;gap:12px;align-items:center;padding:12px;border:1px solid var(--line);
    border-radius:14px;background:var(--card);margin-bottom:10px;text-decoration:none;color:var(--txt)}
  .m-item .avatar{width:46px;height:46px;border-radius:12px;background:rgba(148,163,184,.12);object-fit:cover;flex:0 0 auto}
  .m-item .meta{min-width:0;flex:1}
  .m-item .meta b{display:block;font-size:14px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis}
  .m-item .meta span{display:block;font-size:11px;color:var(--muted);white-space:nowrap;overflow:hidden;text-overflow:ellipsis}
  .m-item .fa{color:var(--muted)}

  /* Bottom nav */
  .m-nav{position:fixed;left:0;right:0;bottom:0;z-index:60;background:rgba(7,13,24,.94);backdrop-filter:blur(12px);
    border-top:1px solid var(--line)}
  .m-nav-in{max-width:640px;margin:0 auto;display:flex;padding-bottom:calc(env(safe-area-inset-bottom))}
  .m-nav a{flex:1;text-align:center;padding:10px 4px calc(10px);color:var(--muted);text-decoration:none;font-size:10px}
  .m-nav a i{display:block;font-size:19px;margin-bottom:3px}
  .m-nav a.active{color:var(--accent)}
  .m-nav .badge{position:relative}
  .m-nav .badge em{position:absolute;top:2px;right:26%;font-style:normal;background:var(--danger);color:#fff;
    font-size:9px;min-width:15px;height:15px;border-radius:8px;line-height:15px;padding:0 4px}

  /* Toast */
  .m-toast{position:fixed;left:50%;bottom:88px;transform:translateX(-50%) translateY(20px);background:#0b1526;
    border:1px solid var(--line);color:var(--txt);padding:12px 16px;border-radius:12px;font-size:13px;z-index:100;
    opacity:0;pointer-events:none;transition:.25s;max-width:86%;box-shadow:0 10px 30px rgba(0,0,0,.5)}
  .m-toast.show{opacity:1;transform:translateX(-50%) translateY(0)}
  .m-toast.ok{border-color:rgba(35,196,131,.4)}
  .m-toast.err{border-color:rgba(255,93,93,.4)}

  .m-empty{text-align:center;padding:40px 20px;color:var(--muted)}
  .m-empty .fa{font-size:40px;opacity:.4;margin-bottom:12px;display:block}

  .sync-banner{background:rgba(255,176,32,.1);border:1px solid rgba(255,176,32,.3);color:var(--warn);
    border-radius:12px;padding:10px 12px;font-size:12px;display:flex;align-items:center;gap:8px;margin-bottom:14px}
</style>
@yield('css')
</head>
<body>
<div class="m-shell">

  <div class="m-top">
    <div class="m-top-in">
      <div class="m-logo"><i class="fa fa-map-marker"></i></div>
      <div class="m-title">
        <b>@yield('title', 'Survei Lapangan')</b>
        <span>SIAP Dinhub Banjarnegara</span>
      </div>
      <div class="m-net">
        <span id="netLabel">Online</span>
        <span class="dot" id="netDot"></span>
      </div>
    </div>
  </div>

  <div class="m-content">
    <div id="syncBanner" class="sync-banner" style="display:none">
      <i class="fa fa-cloud-upload"></i>
      <span id="syncText">Ada <b id="syncCount">0</b> data menunggu sinkronisasi.</span>
    </div>
    @yield('content')
  </div>

</div>

<!-- Bottom navigation -->
<nav class="m-nav">
  <div class="m-nav-in">
    <a href="{{ route('mobile.survei.index') }}" class="{{ request()->routeIs('mobile.survei.index') ? 'active' : '' }}">
      <i class="fa fa-list"></i>Daftar
    </a>
    <a href="{{ route('mobile.survei.peta') }}" class="{{ request()->routeIs('mobile.survei.peta') ? 'active' : '' }}">
      <i class="fa fa-map"></i>Peta
    </a>
    <a href="{{ route('mobile.survei.titik_add') }}" class="{{ request()->routeIs('mobile.survei.titik_add') ? 'active' : '' }}">
      <i class="fa fa-map-marker"></i>Titik Baru
    </a>
    <a href="{{ route('mobile.survei.jukir_add') }}" class="{{ request()->routeIs('mobile.survei.jukir_add') ? 'active' : '' }}">
      <i class="fa fa-user-plus"></i>Jukir Baru
    </a>
    <a href="#" id="navSync" class="badge">
      <i class="fa fa-refresh"></i>Sinkron<em id="navSyncCount" style="display:none">0</em>
    </a>
  </div>
</nav>

<div class="m-toast" id="mToast"></div>

<script src="{{ asset('template/js/jquery.min.js') }}"></script>
<script>
// ===== PWA Service Worker =====
if ('serviceWorker' in navigator) {
  window.addEventListener('load', function(){
    navigator.serviceWorker.register("{{ asset('assets/pwa/sw-mobile.js') }}").catch(function(e){ console.warn('SW gagal', e); });
  });
}

// ===== Online / Offline indicator =====
function refreshNet(){
  var on = navigator.onLine;
  document.getElementById('netLabel').textContent = on ? 'Online' : 'Offline';
  document.getElementById('netDot').classList.toggle('off', !on);
  if (on && window.MobileSync) { window.MobileSync.flush(); }
}
window.addEventListener('online', refreshNet);
window.addEventListener('offline', refreshNet);

// ===== Toast =====
var toastTimer;
function mtoast(msg, type){
  var t = document.getElementById('mToast');
  t.textContent = msg;
  t.className = 'm-toast show ' + (type || '');
  clearTimeout(toastTimer);
  toastTimer = setTimeout(function(){ t.classList.remove('show'); }, 3200);
}

// ===== Offline outbox (IndexedDB) =====
window.MobileSync = (function(){
  var DB='siap_mobile', STORE='outbox', dbp=null;
  function db(){ 
    if(dbp) return dbp;
    dbp = new Promise(function(res, rej){
      var rq = indexedDB.open(DB,1);
      rq.onupgradeneeded = function(e){ e.target.result.createObjectStore(STORE,{keyPath:'id',autoIncrement:true}); };
      rq.onsuccess = function(e){ res(e.target.result); };
      rq.onerror = function(){ rej(rq.error); };
    });
    return dbp;
  }
  function add(payload){
    return db().then(function(d){ return new Promise(function(res,rej){
      var tx=d.transaction(STORE,'readwrite'); tx.objectStore(STORE).add(payload);
      tx.oncomplete=res; tx.onerror=function(){rej(tx.error);};
    });}).then(refreshBadge);
  }
  function all(){ return db().then(function(d){ return new Promise(function(res,rej){
    var out=[], c=d.transaction(STORE).objectStore(STORE).openCursor();
    c.onsuccess=function(e){ var cur=e.target.result; if(cur){out.push(cur.value);cur.continue();} else res(out); };
    c.onerror=function(){rej(c.error);};
  });});}
  function remove(id){ return db().then(function(d){ return new Promise(function(res,rej){
    var tx=d.transaction(STORE,'readwrite'); tx.objectStore(STORE).delete(id);
    tx.oncomplete=res; tx.onerror=function(){rej(tx.error);};
  });});}
  function count(){ return all().then(function(a){return a.length;}); }

  function refreshBadge(){
    return count().then(function(n){
      var banner=document.getElementById('syncBanner');
      var cnt=document.getElementById('syncCount');
      var navC=document.getElementById('navSyncCount');
      if(cnt) cnt.textContent=n;
      if(navC){ navC.textContent=n; navC.style.display=n>0?'inline-block':'none'; }
      if(banner) banner.style.display = n>0 ? 'flex':'none';
    });
  }

  // Kirim ulang antrean saat online
  function flush(){
    if(!navigator.onLine) return Promise.resolve();
    return all().then(function(items){
      var chain=Promise.resolve();
      items.forEach(function(it){
        chain=chain.then(function(){
          var fd=new FormData();
          Object.keys(it.fields||{}).forEach(function(k){ fd.append(k,it.fields[k]); });
          if(it.files){ it.files.forEach(function(f){ if(f && f.blob) fd.append(f.name, f.blob, f.filename||'photo.jpg'); }); }
          return fetch(it.url, {method:'POST', body:fd, credentials:'same-origin',
            headers:{'X-Requested-With':'XMLHttpRequest'}})
            .then(function(r){ if(r.ok){ return remove(it.id); } })
            .catch(function(){});
        });
      });
      return chain.then(refreshBadge);
    });
  }

  // Konversi File -> Blob agar bisa disimpan di IndexedDB
  function fileEntry(file, name){
    return new Promise(function(res){
      if(!file){ return res(null); }
      var r=new FileReader();
      r.onload=function(){ res({name:name, blob:new Blob([r.result],{type:file.type||'image/jpeg'}), filename:file.name||'photo.jpg'}); };
      r.readAsArrayBuffer(file);
    });
  }

  return { add:add, flush:flush, refreshBadge:refreshBadge, fileEntry:fileEntry, count:count };
})();

document.getElementById('navSync').addEventListener('click', function(e){
  e.preventDefault();
  mtoast('Menyinkronkan data...');
  window.MobileSync.flush().then(function(){ mtoast('Sinkronisasi selesai','ok'); });
});

// Init
document.addEventListener('DOMContentLoaded', function(){
  refreshNet();
  window.MobileSync.refreshBadge();
});
</script>
@yield('js')
</body>
</html>
