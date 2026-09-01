@extends('layouts.admin')

@section('content')
<div class="content-wrapper">
  <div class="content-header sty-one" style="display:none;"></div>

  <div class="content">
    <style>
      .dash-hero{position:relative;border-radius:16px;padding:18px 18px 16px;background:radial-gradient(1200px 400px at 10% 0%,rgba(86,188,255,.55),transparent 60%),radial-gradient(900px 380px at 90% 20%,rgba(131,92,255,.45),transparent 55%),linear-gradient(135deg,#0b1220 0%,#0f1b2d 55%,#0b1220 100%);overflow:hidden;box-shadow:0 18px 45px rgba(0,0,0,.18);margin-bottom:16px}
      .dash-hero h2{color:#fff;font-weight:700;letter-spacing:.2px;margin:0}
      .dash-hero .dash-sub{color:rgba(255,255,255,.75);margin-top:6px}
      .dash-chip{display:inline-flex;align-items:center;gap:8px;background:rgba(255,255,255,.10);border:1px solid rgba(255,255,255,.18);backdrop-filter:blur(10px);-webkit-backdrop-filter:blur(10px);color:#fff;padding:8px 10px;border-radius:999px;font-size:12px}
      .dash-actions .btn{border-radius:999px}
      .dash-actions .btn + .btn{margin-left:8px}
      .dash-stat{border-radius:16px;border:1px solid rgba(0,0,0,.06);box-shadow:0 14px 30px rgba(0,0,0,.08);transition:transform .18s ease, box-shadow .18s ease, filter .18s ease;overflow:hidden;text-decoration:none;display:block}
      .dash-stat:hover{transform:translateY(-3px);box-shadow:0 18px 42px rgba(0,0,0,.12);filter:saturate(1.05)}
      .dash-stat .dash-stat-body{padding:16px}
      .dash-stat .dash-icon{width:44px;height:44px;border-radius:14px;display:flex;align-items:center;justify-content:center;background:rgba(255,255,255,.16);border:1px solid rgba(255,255,255,.22);backdrop-filter:blur(10px);-webkit-backdrop-filter:blur(10px);color:#fff}
      .dash-stat .dash-label{margin-top:10px;color:rgba(255,255,255,.78);font-size:12px;letter-spacing:.2px}
      .dash-stat .dash-value{margin:0;color:#fff;font-size:30px;font-weight:800;line-height:1}
      .dash-stat--a{background:linear-gradient(135deg,#00c6ff 0%,#0072ff 100%)}
      .dash-stat--b{background:linear-gradient(135deg,#22c55e 0%,#16a34a 100%)}
      .dash-stat--c{background:linear-gradient(135deg,#7c3aed 0%,#2563eb 100%)}
      .dash-stat--d{background:linear-gradient(135deg,#fb7185 0%,#f59e0b 100%)}
      .dash-card{border-radius:16px;border:1px solid rgba(15,23,42,.08);box-shadow:0 14px 34px rgba(15,23,42,.06)}
      .dash-card .card-header{border-top-left-radius:16px;border-top-right-radius:16px;background:linear-gradient(135deg,rgba(2,132,199,.10),rgba(99,102,241,.10));border-bottom:1px solid rgba(15,23,42,.08)}
      .dash-tabs .nav-link{border-radius:999px;padding:8px 12px;font-size:13px}
      .dash-tabs .nav-link.active{background:linear-gradient(135deg,#0ea5e9,#6366f1);color:#fff}
      .dash-badge{display:inline-flex;align-items:center;justify-content:center;min-width:22px;height:22px;padding:0 8px;border-radius:999px;font-size:12px;background:rgba(2,132,199,.12);color:#0f172a}
      .dash-badge--danger{background:rgba(239,68,68,.14)}
      .dash-grid{margin-left:-10px;margin-right:-10px}
      .dash-grid>[class*="col-"]{padding-left:10px;padding-right:10px;margin-bottom:16px}
      @media (max-width:576px){.dash-hero{padding:16px}.dash-actions{margin-top:12px}}

      /* Tombol Survei Mobile - menyolok */
      .survei-cta{position:relative;display:flex;align-items:center;gap:14px;padding:16px 18px;margin-top:14px;border-radius:16px;background:linear-gradient(135deg,#10b981 0%,#0ea5e9 60%,#6366f1 100%);color:#fff;text-decoration:none;box-shadow:0 14px 34px rgba(16,185,129,.35),0 6px 14px rgba(99,102,241,.25);overflow:hidden;transition:transform .2s ease,box-shadow .2s ease}
      .survei-cta:hover{transform:translateY(-2px);box-shadow:0 20px 44px rgba(16,185,129,.45),0 8px 20px rgba(99,102,241,.35);color:#fff;text-decoration:none}
      .survei-cta:active{transform:translateY(0)}
      .survei-cta::before{content:"";position:absolute;inset:-2px;background:linear-gradient(135deg,rgba(255,255,255,.25),transparent 50%);pointer-events:none}
      .survei-cta .survei-cta-icon{width:54px;height:54px;border-radius:14px;background:rgba(255,255,255,.18);border:1px solid rgba(255,255,255,.28);display:flex;align-items:center;justify-content:center;font-size:26px;flex:0 0 auto;backdrop-filter:blur(8px);-webkit-backdrop-filter:blur(8px)}
      .survei-cta .survei-cta-body{flex:1;min-width:0}
      .survei-cta .survei-cta-title{font-size:17px;font-weight:800;letter-spacing:.2px;line-height:1.15;display:flex;align-items:center;flex-wrap:wrap;gap:8px}
      .survei-cta .survei-cta-sub{font-size:12.5px;opacity:.92;margin-top:4px;line-height:1.3}
      .survei-cta .survei-cta-go{flex:0 0 auto;width:42px;height:42px;border-radius:50%;background:rgba(255,255,255,.22);display:flex;align-items:center;justify-content:center;font-size:18px;border:1px solid rgba(255,255,255,.3)}
      .survei-cta .badge-pwa{display:inline-flex;align-items:center;gap:5px;background:rgba(255,255,255,.95);color:#0f766e;font-size:10.5px;font-weight:800;letter-spacing:.5px;padding:3px 8px;border-radius:999px;text-transform:uppercase;box-shadow:0 2px 6px rgba(0,0,0,.12)}
      .survei-cta .badge-pwa i{color:#0ea5e9}
      .survei-cta .pulse-dot{position:absolute;top:12px;right:14px;width:10px;height:10px;border-radius:50%;background:#22d3ee;box-shadow:0 0 0 0 rgba(34,211,238,.7);animation:surveiPulse 1.8s infinite}
      @keyframes surveiPulse{0%{box-shadow:0 0 0 0 rgba(34,211,238,.7)}70%{box-shadow:0 0 0 14px rgba(34,211,238,0)}100%{box-shadow:0 0 0 0 rgba(34,211,238,0)}}

      /* Tombol Survei Mobile - versi ringkas (stat card) */
      .survei-cta-mini{display:flex;align-items:center;gap:12px;padding:14px 16px;border-radius:14px;background:linear-gradient(135deg,#10b981 0%,#0ea5e9 100%);color:#fff;text-decoration:none;box-shadow:0 10px 24px rgba(16,185,129,.3);height:100%;transition:transform .18s ease,box-shadow .18s ease}
      .survei-cta-mini:hover{transform:translateY(-2px);box-shadow:0 14px 30px rgba(16,185,129,.4);color:#fff;text-decoration:none}
      .survei-cta-mini .ic{width:40px;height:40px;border-radius:12px;background:rgba(255,255,255,.18);display:flex;align-items:center;justify-content:center;font-size:20px;flex:0 0 auto}
      .survei-cta-mini .tx{flex:1;min-width:0;line-height:1.2}
      .survei-cta-mini .tx .t{font-size:14.5px;font-weight:800}
      .survei-cta-mini .tx .s{font-size:11.5px;opacity:.9;margin-top:2px}
      .survei-cta-mini .arr{opacity:.85}
    </style>

    <div class="dash-hero m-b-20">
      <div class="row">
        <div class="col-md-8">
          <h2>Halo, {{ session('nama', 'Administrator') }}</h2>
          <div class="dash-sub">Ringkasan sistem SIAP dan aktivitas pengaduan terbaru.</div>
          <div style="margin-top:12px;display:flex;flex-wrap:wrap;gap:10px;">
            <span class="dash-chip"><i class="fa fa-calendar"></i> Tahun aktif: {{ session('tahun', date('Y')) }}</span>
            <span class="dash-chip"><i class="fa fa-inbox"></i> Pengaduan: {{ $pengaduan->count() }} + {{ $pengaduan_jukir->count() }}</span>
          </div>

          {{-- Tombol Survei Mobile (menyolok) --}}
          <a href="{{ route('mobile.survei.index') }}" class="survei-cta" target="_blank" rel="noopener">
            <span class="pulse-dot" aria-hidden="true"></span>
            <div class="survei-cta-icon"><i class="fa fa-mobile-alt"></i></div>
            <div class="survei-cta-body">
              <div class="survei-cta-title">
                <span>Buka Survei Lapangan</span>
                <span class="badge-pwa"><i class="fa fa-bolt"></i> PWA Mobile</span>
              </div>
              <div class="survei-cta-sub">Verifikasi jukir, input jukir/titik baru, dan marking titik parkir langsung dari HP — bisa offline.</div>
            </div>
            <div class="survei-cta-go"><i class="fa fa-arrow-right"></i></div>
          </a>
        </div>
        <div class="col-md-4">
          <div class="dash-actions text-md-right">
            <a href="#" class="btn btn-light btn-sm"><i class="fa fa-map-marker"></i> Titik Parkir</a>
            <a href="#" class="btn btn-outline-light btn-sm"><i class="fa fa-id-card"></i> Titik Jukir</a>
          </div>
          <div class="dash-actions text-md-right" style="margin-top:10px;">
            <a href="#" class="btn btn-outline-light btn-sm"><i class="fa fa-users"></i> Juru Parkir</a>
            <a href="#" class="btn btn-outline-light btn-sm"><i class="fa fa-print"></i> Cetak SK</a>
          </div>
        </div>
      </div>
    </div>

    <div class="row dash-grid">
      <div class="col-lg-3 col-sm-6">
        <a class="dash-stat dash-stat--a" href="#">
          <div class="dash-stat-body">
            <div class="dash-icon"><i class="ti-user"></i></div>
            <div class="dash-label">Pengelola Perorangan</div>
            <p class="dash-value">{{ $perorangan }}</p>
          </div>
        </a>
      </div>
      <div class="col-lg-3 col-sm-6">
        <a class="dash-stat dash-stat--b" href="#">
          <div class="dash-stat-body">
            <div class="dash-icon"><i class="ti-view-grid"></i></div>
            <div class="dash-label">Pengelola Badan</div>
            <p class="dash-value">{{ $badan }}</p>
          </div>
        </a>
      </div>
      <div class="col-lg-3 col-sm-6">
        <a class="dash-stat dash-stat--c" href="#">
          <div class="dash-stat-body">
            <div class="dash-icon"><i class="ti-face-smile"></i></div>
            <div class="dash-label">Juru Parkir</div>
            <p class="dash-value">{{ $jukir }}</p>
          </div>
        </a>
      </div>
      <div class="col-lg-3 col-sm-6">
        <a class="dash-stat dash-stat--d" href="#">
          <div class="dash-stat-body">
            <div class="dash-icon"><i class="ti-flag"></i></div>
            <div class="dash-label">Titik Parkir</div>
            <p class="dash-value">{{ $tikir }}</p>
          </div>
        </a>
      </div>
    </div>

    {{-- Baris pintas Mobile (Survei + Peta) --}}
    <div class="row dash-grid">
      <div class="col-lg-6 col-sm-6" style="margin-bottom:16px">
        <a class="survei-cta-mini" href="{{ route('mobile.survei.index') }}" target="_blank" rel="noopener">
          <div class="ic"><i class="fa fa-clipboard-check"></i></div>
          <div class="tx">
            <div class="t">Survei Lapangan</div>
            <div class="s">Verifikasi & input jukir/titik — bisa offline</div>
          </div>
          <div class="arr"><i class="fa fa-arrow-right"></i></div>
        </a>
      </div>
      <div class="col-lg-6 col-sm-6" style="margin-bottom:16px">
        <a class="survei-cta-mini" href="{{ route('mobile.survei.peta') }}" target="_blank" rel="noopener" style="background:linear-gradient(135deg,#0ea5e9 0%,#6366f1 100%);box-shadow:0 10px 24px rgba(14,165,233,.3)">
          <div class="ic"><i class="fa fa-map-marked-alt"></i></div>
          <div class="tx">
            <div class="t">Peta Titik Parkir</div>
            <div class="s">Lihat semua titik Banjarnegara di peta mobile</div>
          </div>
          <div class="arr"><i class="fa fa-arrow-right"></i></div>
        </a>
      </div>
    </div>

    <!-- Charts Row -->
    <div class="row dash-grid">
      <div class="col-lg-8">
        <div class="card dash-card">
          <div class="card-header bg-white">
            <h5 class="m-b-0 text-black"><i class="fa fa-line-chart text-primary"></i> Statistik Volume Parkir Kendaraan Harian</h5>
          </div>
          <div class="card-body">
            <canvas id="chartVolumeParkir" style="height: 300px; width: 100%;"></canvas>
          </div>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="card dash-card">
          <div class="card-header bg-white">
            <h5 class="m-b-0 text-black"><i class="fa fa-pie-chart text-success"></i> Distribusi Data Pengelola</h5>
          </div>
          <div class="card-body">
            <canvas id="chartPengelola" style="height: 300px; width: 100%;"></canvas>
          </div>
        </div>
      </div>
    </div>

    <!-- Script Chart.js -->
    <script>
      $(function() {
        // 1. Line Chart Volume Kendaraan Harian
        var ctxVolume = document.getElementById('chartVolumeParkir').getContext('2d');
        new Chart(ctxVolume, {
          type: 'line',
          data: {
            labels: ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'],
            datasets: [
              {
                label: 'Motor',
                data: [1200, 1900, 1500, 2100, 2400, 3100, 2800],
                borderColor: '#0ea5e9',
                backgroundColor: 'rgba(14, 165, 233, 0.1)',
                tension: 0.4,
                fill: true,
                borderWidth: 3
              },
              {
                label: 'Mobil',
                data: [400, 600, 550, 700, 900, 1200, 1100],
                borderColor: '#10b981',
                backgroundColor: 'rgba(16, 185, 129, 0.1)',
                tension: 0.4,
                fill: true,
                borderWidth: 3
              }
            ]
          },
          options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
              legend: {
                position: 'top',
              }
            },
            scales: {
              y: {
                beginAtZero: true,
                grid: {
                  color: 'rgba(0, 0, 0, 0.05)'
                }
              },
              x: {
                grid: {
                  display: false
                }
              }
            }
          }
        });

        // 2. Doughnut Chart Distribusi Pengelola & Jukir
        var ctxPengelola = document.getElementById('chartPengelola').getContext('2d');
        new Chart(ctxPengelola, {
          type: 'doughnut',
          data: {
            labels: ['Perorangan', 'Badan Usaha', 'Juru Parkir'],
            datasets: [{
              data: [{{ $perorangan }}, {{ $badan }}, {{ $jukir }}],
              backgroundColor: ['#0072ff', '#16a34a', '#7c3aed'],
              borderWidth: 0
            }]
          },
          options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
              legend: {
                position: 'bottom',
                labels: {
                  padding: 15,
                  usePointStyle: true
                }
              }
            },
            cutout: '70%'
          }
        });
      });
    </script>

    <!-- Peta Dashboard Row -->
    <div class="row dash-grid">
      <div class="col-lg-12">
        <div class="card dash-card">
          <div class="card-header bg-white">
            <div class="row align-items-center">
              <div class="col-md-6">
                <h5 class="m-b-0 text-black"><i class="fa fa-map-marker text-danger"></i> Peta Titik Parkir &amp; Juru Parkir</h5>
              </div>
              <div class="col-md-6 text-md-right">
                <div class="btn-group btn-group-sm" role="group">
                  <button type="button" class="btn btn-outline-secondary active" id="btn-layer-all"><i class="fa fa-layer-group"></i> Semua</button>
                  <button type="button" class="btn btn-outline-primary" id="btn-layer-titik"><i class="fa fa-map-pin"></i> Titik Parkir</button>
                  <button type="button" class="btn btn-outline-success" id="btn-layer-jukir"><i class="fa fa-user-circle"></i> Jukir</button>
                  <button type="button" class="btn btn-outline-warning" id="btn-layer-ruas"><i class="fa fa-road"></i> Ruas Jalan</button>
                </div>
              </div>
            </div>
          </div>
          <div class="card-body" style="padding:0;">
            <div id="map-dashboard" style="height:500px;width:100%;border-radius:0 0 16px 16px;"></div>
          </div>
        </div>
      </div>
    </div>

    <script>
    $(function() {
        var mapEl = document.getElementById('map-dashboard');
        if (!mapEl) return;

        // Fix Leaflet default icon
        delete L.Icon.Default.prototype._getIconUrl;
        L.Icon.Default.mergeOptions({
            iconRetinaUrl: 'https://unpkg.com/leaflet@1.9.4/dist/images/marker-icon-2x.png',
            iconUrl: 'https://unpkg.com/leaflet@1.9.4/dist/images/marker-icon.png',
            shadowUrl: 'https://unpkg.com/leaflet@1.9.4/dist/images/marker-shadow.png'
        });

        // Prevent double-init
        if (mapEl._leaflet_id) {
            mapEl._leaflet_id = null;
        }

        var map = L.map('map-dashboard').setView([-7.3942, 109.5258], 11);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; OpenStreetMap'
        }).addTo(map);

        // Custom icons
        var iconTitik = L.divIcon({
            html: '<div style="background:#ef4444;width:20px;height:20px;border-radius:50% 50% 50% 0;transform:rotate(-45deg);border:2px solid #fff;box-shadow:0 2px 6px rgba(0,0,0,.4)"></div>',
            iconSize: [20, 20],
            iconAnchor: [10, 20],
            popupAnchor: [0, -20],
            className: ''
        });

        var iconJukir = L.divIcon({
            html: '<div style="background:#22c55e;width:20px;height:20px;border-radius:50% 50% 50% 0;transform:rotate(-45deg);border:2px solid #fff;box-shadow:0 2px 6px rgba(0,0,0,.4)"></div>',
            iconSize: [20, 20],
            iconAnchor: [10, 20],
            popupAnchor: [0, -20],
            className: ''
        });

        var layerTitik = L.layerGroup().addTo(map);
        var layerJukir = L.layerGroup();
        var layerRuas = L.layerGroup();
        var allBounds = L.latLngBounds();

        // Load data
        fetch('{{ url("admin/peta-json") }}')
            .then(function(r) { return r.json(); })
            .then(function(data) {

                // Ruas Jalan (polylines)
                data.ruas_jalan.forEach(function(rj) {
                    if (rj.from_lat && rj.from_lng && rj.to_lat && rj.to_lng) {
                        var line = L.polyline([
                            [parseFloat(rj.from_lat), parseFloat(rj.from_lng)],
                            [parseFloat(rj.to_lat), parseFloat(rj.to_lng)]
                        ], {
                            color: '#f59e0b',
                            weight: 3,
                            opacity: 0.5
                        });
                        line.bindPopup('<b>' + rj.nama_ruas + '</b>');
                        layerRuas.addLayer(line);
                        allBounds.extend([[parseFloat(rj.from_lat), parseFloat(rj.from_lng)]]);
                        allBounds.extend([[parseFloat(rj.to_lat), parseFloat(rj.to_lng)]]);
                    }
                });

                // Titik Parkir
                data.titik_parkir.forEach(function(tp) {
                    if (!tp.titik_lat || !tp.titik_lng) return;
                    var lat = parseFloat(tp.titik_lat);
                    var lng = parseFloat(tp.titik_lng);
                    var m = L.marker([lat, lng], { icon: iconTitik });
                    var popupHtml = '<div style="min-width:180px">' +
                        '<b>' + tp.nama_lokasi + '</b><br>' +
                        '<small>Ruas: ' + (tp.nama_ruas || '-') + '</small><br>' +
                        '<small>Koord: ' + lat.toFixed(6) + ', ' + lng.toFixed(6) + '</small><br>' +
                        '<div style="margin-top:8px;display:flex;gap:6px">' +
                        '<a href="' + '{{ url("admin/titik/update") }}' + '/' + tp.id_titik_parkir + '" class="btn btn-warning btn-sm" style="font-size:11px;padding:3px 8px"><i class="fa fa-pencil"></i> Edit Titik</a>' +
                        '<a href="' + '{{ url("admin/titik/read") }}' + '/' + tp.id_titik_parkir + '" class="btn btn-info btn-sm" style="font-size:11px;padding:3px 8px"><i class="fa fa-eye"></i> Detail</a>' +
                        '</div></div>';
                    m.bindPopup(popupHtml);
                    layerTitik.addLayer(m);
                    allBounds.extend([[lat, lng]]);
                });

                // Titik Jukir
                data.titik_jukir.forEach(function(tj) {
                    if (!tj.titik_lat || !tj.titik_lng) return;
                    var lat = parseFloat(tj.titik_lat);
                    var lng = parseFloat(tj.titik_lng);
                    var m = L.marker([lat, lng], { icon: iconJukir });
                    var popupHtml = '<div style="min-width:180px">' +
                        '<b>' + (tj.nama_jukir || 'Jukir #' + tj.id_juru_parkir) + '</b><br>' +
                        '<small>Lokasi: ' + (tj.nama_lokasi || '-') + '</small><br>' +
                        '<small>No. Jukir: ' + (tj.no_juru_parkir || '-') + '</small><br>' +
                        '<div style="margin-top:8px;display:flex;gap:6px">' +
                        '<a href="' + '{{ url("admin/titikjukir/update") }}' + '/' + tj.id_titik_jukir + '" class="btn btn-success btn-sm" style="font-size:11px;padding:3px 8px"><i class="fa fa-pencil"></i> Edit Jukir</a>' +
                        '<a href="' + '{{ url("admin/titikjukir/read") }}' + '/' + tj.id_titik_jukir + '" class="btn btn-info btn-sm" style="font-size:11px;padding:3px 8px"><i class="fa fa-eye"></i> Detail</a>' +
                        '</div></div>';
                    m.bindPopup(popupHtml);
                    layerJukir.addLayer(m);
                });

                // Fit bounds
                if (allBounds.isValid()) {
                    map.fitBounds(allBounds, { padding: [30, 30] });
                }

                // Show jukir layer by default too
                layerJukir.addTo(map);
            })
            .catch(function(e) { console.error('Map data error:', e); });

        // Layer toggle buttons
        function setActiveBtn(id) {
            ['btn-layer-all','btn-layer-titik','btn-layer-jukir','btn-layer-ruas'].forEach(function(b) {
                document.getElementById(b).classList.remove('active');
            });
            document.getElementById(id).classList.add('active');
        }

        document.getElementById('btn-layer-all').addEventListener('click', function() {
            layerTitik.addTo(map);
            layerJukir.addTo(map);
            layerRuas.addTo(map);
            setActiveBtn('btn-layer-all');
        });

        document.getElementById('btn-layer-titik').addEventListener('click', function() {
            map.removeLayer(layerJukir);
            map.removeLayer(layerRuas);
            layerTitik.addTo(map);
            setActiveBtn('btn-layer-titik');
        });

        document.getElementById('btn-layer-jukir').addEventListener('click', function() {
            map.removeLayer(layerTitik);
            map.removeLayer(layerRuas);
            layerJukir.addTo(map);
            setActiveBtn('btn-layer-jukir');
        });

        document.getElementById('btn-layer-ruas').addEventListener('click', function() {
            map.removeLayer(layerTitik);
            map.removeLayer(layerJukir);
            layerRuas.addTo(map);
            setActiveBtn('btn-layer-ruas');
        });

        // Fix size after render
        setTimeout(function() { map.invalidateSize(); }, 300);
    });
    </script>

    <!-- Pengaduan Terbaru -->
    <div class="card dash-card" style="margin-top:16px;">
      <div class="card-header">
        <div class="row align-items-center">
          <div class="col-md-6">
            <h5 class="m-b-0">Pengaduan Terbaru</h5>
          </div>
          <div class="col-md-6 text-md-right">
            <div class="dash-tabs">
              <ul class="nav nav-pills justify-content-md-end" role="tablist">
                <li class="nav-item">
                  <a class="nav-link active" data-toggle="tab" href="#tab-masyarakat" role="tab">
                    Masyarakat <span class="dash-badge">{{ $pengaduan->count() }}</span>
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" data-toggle="tab" href="#tab-jukir" role="tab">
                    Juru Parkir <span class="dash-badge dash-badge--danger">{{ $pengaduan_jukir->count() }}</span>
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <div class="card-body">
        <div class="tab-content">
          <div class="tab-pane fade show active" id="tab-masyarakat" role="tabpanel">
            <div class="table-responsive">
              <table id="datatable" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>No.HP</th>
                    <th>Plat Nomor</th>
                    <th>Lokasi</th>
                    <th>Status</th>
                    <th width="120px">Action</th>
                  </tr>
                </thead>
                <tbody>
                  @php $no = 1; @endphp
                  @foreach($pengaduan as $row)
                    <tr>
                      <td>{{ $no }}</td>
                      <td>{{ $row->nama }}</td>
                      <td>{{ $row->nohp }}</td>
                      <td>{{ $row->plat_nomor }}</td>
                      <td>{{ $row->lokasi }}</td>
                      <td>
                        @if($row->respon == 'belum')
                          Belum Ditangani
                        @elseif($row->respon == 'sedang')
                          Sedang Ditangani
                        @elseif($row->respon == 'sudah')
                          Sudah Ditangani
                        @else
                          Baru
                        @endif
                      </td>
                      <td>
                        <a href="#" class="btn btn-warning btn-sm" title="read"><i class="fa fa-eye"></i></a>
                        <a href="#" class="btn btn-warning btn-sm" title="respon"><i class="fa fa-pencil"></i></a>
                        <a href="#" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin akan menghapus data ini?')"><i class="fa fa-trash"></i></a>
                      </td>
                    </tr>
                    @php $no++; @endphp
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>

          <div class="tab-pane fade" id="tab-jukir" role="tabpanel">
            <div class="table-responsive">
              <table id="datatable2" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama Jukir</th>
                    <th>Lokasi Jukir</th>
                    <th>Nama Pelapor</th>
                    <th>No.HP</th>
                    <th>Status</th>
                    <th width="120px">Action</th>
                  </tr>
                </thead>
                <tbody>
                  @php $no = 1; @endphp
                  @foreach($pengaduan_jukir as $row)
                    <tr>
                      <td>{{ $no }}</td>
                      <td>{{ $row->nama_jukir }}</td>
                      <td>{{ $row->nama_lokasi }}</td>
                      <td>{{ $row->nama }}</td>
                      <td>{{ $row->nohp }}</td>
                      <td>
                        @if($row->respon == 'belum')
                          Belum Ditangani
                        @elseif($row->respon == 'sedang')
                          Sedang Ditangani
                        @elseif($row->respon == 'sudah')
                          Sudah Ditangani
                        @else
                          Baru
                        @endif
                      </td>
                      <td>
                        <a href="#" class="btn btn-warning btn-sm" title="read"><i class="fa fa-eye"></i></a>
                        <a href="#" class="btn btn-warning btn-sm" title="respon"><i class="fa fa-pencil"></i></a>
                        <a href="#" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin akan menghapus data ini?')"><i class="fa fa-trash"></i></a>
                      </td>
                    </tr>
                    @php $no++; @endphp
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
