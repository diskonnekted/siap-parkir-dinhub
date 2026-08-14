@extends('layouts.admin')

@section('content')
<div class="content-wrapper">
  <!-- Content Header -->
  <div class="content-header sty-one">
    <h1>Detail Titik Parkir</h1>
    <ol class="breadcrumb">
      <li><a href="{{ route('admin.home') }}">Home</a></li>
      <li><i class="fa fa-angle-right"></i> Titik Parkir</li>
      <li><i class="fa fa-angle-right"></i> Detail</li>
    </ol>
  </div>

  <!-- Main Content (UI/UX Promax Layout) -->
  <div class="content">
    <style>
      .detail-card {
          border-radius: 16px;
          border: 1px solid rgba(15, 23, 42, 0.08);
          box-shadow: 0 10px 30px rgba(15, 23, 42, 0.04);
          background: #fff;
          margin-bottom: 24px;
          overflow: hidden;
      }
      .detail-header {
          padding: 20px 24px;
          background: linear-gradient(135deg, rgba(2, 132, 199, 0.08), rgba(99, 102, 241, 0.08));
          border-bottom: 1px solid rgba(15, 23, 42, 0.08);
      }
      .detail-title {
          font-weight: 800;
          color: #0f172a;
          margin: 0;
          font-size: 18px;
          letter-spacing: -0.2px;
      }
      .detail-body {
          padding: 24px;
      }
      .info-grid {
          display: grid;
          grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
          gap: 20px;
      }
      .info-item {
          padding: 16px;
          border-radius: 12px;
          background: #f8fafc;
          border: 1px solid rgba(15, 23, 42, 0.04);
          transition: transform 0.2s ease;
      }
      .info-item:hover {
          transform: translateY(-2px);
          background: #f1f5f9;
      }
      .info-label {
          font-size: 11px;
          text-transform: uppercase;
          font-weight: 700;
          color: #64748b;
          letter-spacing: 0.5px;
          margin-bottom: 6px;
      }
      .info-value {
          font-size: 15px;
          font-weight: 700;
          color: #0f172a;
          margin: 0;
      }
      .info-icon {
          color: #0284c7;
          font-size: 18px;
          margin-right: 8px;
      }
      .photo-frame {
          position: relative;
          border-radius: 14px;
          overflow: hidden;
          border: 1px solid #e2e8f0;
          box-shadow: 0 4px 12px rgba(0,0,0,0.05);
          aspect-ratio: 16/9;
          background: #f1f5f9;
          display: flex;
          align-items: center;
          justify-content: center;
      }
      .photo-frame img {
          width: 100%;
          height: 100%;
          object-fit: cover;
          transition: transform 0.3s ease;
      }
      .photo-frame:hover img {
          transform: scale(1.05);
      }
      .capacity-badge {
          display: inline-flex;
          align-items: center;
          padding: 8px 12px;
          border-radius: 10px;
          font-size: 13px;
          font-weight: 700;
          gap: 6px;
      }
      .badge-motor {
          background: rgba(14, 165, 233, 0.1);
          color: #0284c7;
      }
      .badge-mobil {
          background: rgba(16, 185, 129, 0.1);
          color: #10b981;
      }
      .tag-badge {
          display: inline-flex;
          padding: 6px 12px;
          border-radius: 99px;
          font-size: 12px;
          font-weight: 700;
      }
    </style>

    <div class="row">
      <!-- Left Column: Primary Details -->
      <div class="col-lg-7">
        <div class="detail-card">
          <div class="detail-header d-flex justify-content-between align-items-center">
            <h4 class="detail-title"><i class="fa fa-info-circle text-primary"></i> Spesifikasi Lokasi</h4>
            <span class="tag-badge bg-primary text-white">
              {{ $row->jenis_fasilitas=='dalam'?'Dalam Ruang Jalan':'Luar Ruang Jalan' }}
            </span>
          </div>
          <div class="detail-body">
            <!-- Header Info -->
            <div class="mb-4">
              <h3 class="fw-extrabold text-black m-b-5">{{ $row->nama_lokasi }}</h3>
              <p class="text-muted mb-0"><i class="fa fa-road text-primary"></i> Ruas Jalan: <strong>{{ $row->nama_ruas }}</strong></p>
            </div>

            <hr class="m-t-20 m-b-20" style="border-top: 1px solid rgba(0,0,0,0.08);">

            <!-- Grid Items -->
            <div class="info-grid mb-4">
              <div class="info-item">
                <div class="info-label">Jenis Parkir Luar</div>
                <div class="info-value">
                  @if($row->jenis_parkir_luar=='tkp')
                    Tempat Khusus Parkir
                  @elseif($row->jenis_parkir_luar=='tpk')
                    Tempat Parkir Khusus
                  @else
                    -
                  @endif
                </div>
              </div>
              <div class="info-item">
                <div class="info-label">Wilayah (Kecamatan)</div>
                <div class="info-value"><i class="fa fa-map-o info-icon"></i> {{ $row->kec }}</div>
              </div>
              <div class="info-item">
                <div class="info-label">Kelurahan / Desa</div>
                <div class="info-value">{{ $row->desa }}</div>
              </div>
              <div class="info-item">
                <div class="info-label">Dimensi Lebar</div>
                <div class="info-value"><i class="fa fa-arrows-h info-icon"></i> {{ $row->lebar_lokasi }} m</div>
              </div>
              <div class="info-item">
                <div class="info-label">Dimensi Panjang</div>
                <div class="info-value"><i class="fa fa-arrows-v info-icon"></i> {{ $row->panjang_lokasi }} m</div>
              </div>
              <div class="info-item">
                <div class="info-label">Total Luas Area</div>
                <div class="info-value"><i class="fa fa-square-o info-icon"></i> {{ $row->luas_lokasi }} m<sup>2</sup></div>
              </div>
            </div>

            <!-- Capacity Badges -->
            <div class="p-3 rounded-4 border mb-3" style="background: #fafafa; border-style: dashed !important;">
              <h6 class="info-label mb-3">Kapasitas Satuan Ruang Parkir (SRP)</h6>
              <div class="d-flex gap-3 flex-wrap">
                <div class="capacity-badge badge-motor">
                  <i class="fa fa-motorcycle"></i> Motor: <strong>{{ $row->srp_motor }} SRP</strong>
                </div>
                <div class="capacity-badge badge-mobil">
                  <i class="fa fa-car"></i> Mobil: <strong>{{ $row->srp_mobil }} SRP</strong>
                </div>
              </div>
            </div>

            <!-- Coordinate Info -->
            <div class="mt-4">
              <div class="info-label">Koordinat Lokasi (Latitude, Longitude)</div>
              <div class="p-2 border rounded-3 bg-light text-monospace small">
                <i class="fa fa-crosshairs text-danger me-1"></i> {{ $row->titik_lat }}, {{ $row->titik_lng }}
              </div>
            </div>

            <div class="mt-4 text-left">
              <a href="{{ route('admin.titik.index') }}" class="btn btn-primary btn-sm"><i class="fa fa-arrow-left"></i> Kembali ke Daftar</a>
            </div>
          </div>
        </div>
      </div>

      <!-- Right Column: Map & Photo -->
      <div class="col-lg-5">
        <!-- Leaflet Map Card -->
        <div class="detail-card">
          <div class="detail-header">
            <h4 class="detail-title"><i class="fa fa-map text-success"></i> Posisi Peta</h4>
          </div>
          <div class="detail-body p-0">
            <div id="map" style="height: 320px; width: 100%;"></div>
          </div>
        </div>

        <!-- Photo Card -->
        <div class="detail-card">
          <div class="detail-header">
            <h4 class="detail-title"><i class="fa fa-camera text-warning"></i> Foto Lokasi</h4>
          </div>
          <div class="detail-body">
            @if($row->foto_lokasi)
              <div class="photo-frame">
                <a href="{{ asset(ltrim($row->foto_lokasi, './')) }}" target="_blank" class="w-100 h-100">
                  <img src="{{ asset(ltrim($row->foto_lokasi, './')) }}" alt="Foto Lokasi">
                </a>
              </div>
            @else
              <div class="text-center py-4 text-muted border rounded-4 bg-light">
                <i class="fa fa-picture-o fa-2x mb-2 text-slate-300"></i>
                <p class="mb-0 small">Belum ada foto lokasi terunggah</p>
              </div>
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>

  <script type="text/javascript">
  (function() {
      var fromLat = {{ !empty($row->from_lat) ? $row->from_lat : -7.3932652 }};
      var fromLng = {{ !empty($row->from_lng) ? $row->from_lng : 109.7097441 }};
      var toLat = {{ !empty($row->to_lat) ? $row->to_lat : -7.3932652 }};
      var toLng = {{ !empty($row->to_lng) ? $row->to_lng : 109.7097441 }};
      var titikLat = {{ !empty($row->titik_lat) ? $row->titik_lat : -7.3932652 }};
      var titikLng = {{ !empty($row->titik_lng) ? $row->titik_lng : 109.7097441 }};

      // Reset map container if already initialized
      var container = L.DomUtil.get('map');
      if (container !== null) {
          container._leaflet_id = null;
      }

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

      var routingControl = L.Routing.control({
          waypoints: [L.latLng(fromLat, fromLng), L.latLng(toLat, toLng)],
          lineOptions: {styles: [{color: 'blue', opacity: 0.6, weight: 4}]},
          createMarker: function() { return null; },
          addWaypoints: false, 
          routeWhileDragging: false, 
          show: false,
          fitSelectedRoutes: false
      }).addTo(map);

      routingControl.on('routingerror', function(e) {
          console.warn('Routing error caught: ', e.error);
          // Fallback to straight dashed line if OSRM fails
          L.polyline([[fromLat, fromLng], [toLat, toLng]], {color: 'blue', opacity: 0.5, weight: 3, dashArray: '5, 10'}).addTo(map);
      });

      // Recalculate map size after PJAX DOM update transitions
      setTimeout(function() {
          map.invalidateSize();
      }, 250);
  })();
  </script>
</div>
@endsection
