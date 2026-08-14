@extends('layouts.admin')

@section('content')
<div class="content-wrapper">
  <!-- Content Header -->
  <div class="content-header sty-one">
    <h1>Detail Ruas Jalan</h1>
    <ol class="breadcrumb">
      <li><a href="{{ route('admin.home') }}">Home</a></li>
      <li><i class="fa fa-angle-right"></i> Ruas Jalan</li>
      <li><i class="fa fa-angle-right"></i> Detail</li>
    </ol>
  </div>

  <!-- Main Content (UI/UX Promax Layout) -->
  <div class="content">
    <style>
      .jalan-card {
          border-radius: 16px;
          border: 1px solid rgba(15, 23, 42, 0.08);
          box-shadow: 0 10px 30px rgba(15, 23, 42, 0.04);
          background: #fff;
          margin-bottom: 24px;
          overflow: hidden;
      }
      .jalan-header {
          padding: 20px 24px;
          background: linear-gradient(135deg, rgba(2, 132, 199, 0.08), rgba(99, 102, 241, 0.08));
          border-bottom: 1px solid rgba(15, 23, 42, 0.08);
      }
      .jalan-title {
          font-weight: 800;
          color: #0f172a;
          margin: 0;
          font-size: 18px;
          letter-spacing: -0.2px;
      }
      .jalan-body {
          padding: 24px;
      }
      .jalan-info-box {
          padding: 16px;
          border-radius: 12px;
          background: #f8fafc;
          border: 1px solid rgba(15, 23, 42, 0.04);
          margin-bottom: 16px;
          transition: all 0.2s ease;
      }
      .jalan-info-box:hover {
          transform: translateY(-2px);
          background: #f1f5f9;
      }
      .jalan-kv-item {
          display: flex;
          justify-content: space-between;
          align-items: center;
          padding: 10px 0;
          border-bottom: 1px dashed rgba(15, 23, 42, 0.08);
      }
      .jalan-kv-item:last-child {
          border-bottom: 0;
      }
      .jalan-k-label {
          font-size: 13px;
          font-weight: 600;
          color: #64748b;
      }
      .jalan-v-val {
          font-size: 14px;
          font-weight: 700;
          color: #0f172a;
      }
      .stat-icon {
          color: #0284c7;
          margin-right: 8px;
      }
      .status-pill {
          display: inline-flex;
          padding: 6px 12px;
          border-radius: 99px;
          font-size: 12px;
          font-weight: 700;
          background: rgba(2, 132, 199, 0.1);
          color: #0284c7;
      }
      .badge-metric {
          background: rgba(16, 185, 129, 0.1);
          color: #10b981;
          padding: 4px 8px;
          border-radius: 6px;
          font-size: 12px;
          font-weight: 700;
      }
    </style>

    <div class="row">
      <!-- Left Column: Peta Ruas Jalan -->
      <div class="col-lg-6">
        <div class="jalan-card h-100">
          <div class="jalan-header">
            <h4 class="jalan-title"><i class="fa fa-map text-success"></i> Visualisasi Ruas Jalan</h4>
          </div>
          <div class="jalan-body p-0" style="position: relative; height: 520px;">
            <div id="map" style="position: absolute; inset: 0;"></div>
          </div>
        </div>
      </div>

      <!-- Right Column: Informasi Fisik & Geografis -->
      <div class="col-lg-6">
        <div class="jalan-card h-100">
          <div class="jalan-header d-flex justify-content-between align-items-center">
            <h4 class="jalan-title"><i class="fa fa-info-circle text-primary"></i> Data Teknis Ruas</h4>
            <span class="status-pill">{{ $row->status_ruas }}</span>
          </div>
          <div class="jalan-body">
            <!-- Header Nama Jalan -->
            <div class="mb-4">
              <span class="text-muted small uppercase">Nomor Ruas: <strong>{{ $row->nomor_ruas }}</strong></span>
              <h3 class="fw-extrabold text-black m-t-5 mb-0">{{ $row->nama_ruas }}</h3>
            </div>

            <!-- Group 1: Spesifikasi Fisik -->
            <div class="jalan-info-box">
              <h6 class="text-uppercase small font-weight-bold text-primary mb-3">Dimensi &amp; Skala Jalan</h6>
              <div class="jalan-kv-item">
                <span class="jalan-k-label"><i class="fa fa-arrows-h stat-icon"></i> Panjang Ruas</span>
                <span class="jalan-v-val"><span class="badge-metric">{{ $row->panjang }} m</span></span>
              </div>
              <div class="jalan-kv-item">
                <span class="jalan-k-label"><i class="fa fa-arrows-v stat-icon"></i> Lebar Ruas</span>
                <span class="jalan-v-val"><span class="badge-metric">{{ $row->lebar }} m</span></span>
              </div>
              <div class="jalan-kv-item">
                <span class="jalan-k-label"><i class="fa fa-square-o stat-icon"></i> Luas Area</span>
                <span class="jalan-v-val"><span class="badge-metric">{{ $row->luas }} m<sup>2</sup></span></span>
              </div>
            </div>

            <!-- Group 2: Batas Ruas & Titik Koordinat -->
            <div class="jalan-info-box">
              <h6 class="text-uppercase small font-weight-bold text-success mb-3">Batas Administrasi &amp; Koordinat</h6>
              <div class="jalan-kv-item">
                <span class="jalan-k-label">Titik Ruas Awal</span>
                <span class="jalan-v-val text-right" style="max-width: 60%;">{{ $row->titik_awal }}</span>
              </div>
              <div class="jalan-kv-item">
                <span class="jalan-k-label">Titik Ruas Akhir</span>
                <span class="jalan-v-val text-right" style="max-width: 60%;">{{ $row->titik_akhir }}</span>
              </div>
              <div class="jalan-kv-item">
                <span class="jalan-k-label">Koordinat Awal</span>
                <span class="jalan-v-val text-monospace text-danger small">{{ $row->from_lat }}, {{ $row->from_lng }}</span>
              </div>
              <div class="jalan-kv-item">
                <span class="jalan-k-label">Koordinat Akhir</span>
                <span class="jalan-v-val text-monospace text-danger small">{{ $row->to_lat }}, {{ $row->to_lng }}</span>
              </div>
            </div>

            <div class="mt-4 d-flex gap-2">
              <a href="{{ route('admin.jalan.index') }}" class="btn btn-primary btn-sm"><i class="fa fa-arrow-left"></i> Kembali</a>
              <a href="{{ route('admin.jalan.peta', $row->id_ruas_jalan) }}" class="btn btn-info btn-sm"><i class="fa fa-pencil"></i> Plotting Ulang Koordinat</a>
            </div>
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

      // Reset map container if already initialized
      var container = L.DomUtil.get('map');
      if (container !== null) {
          container._leaflet_id = null;
      }

      var map = L.map('map').setView([fromLat, fromLng], 14);
      L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);

      var routingControl = L.Routing.control({
          waypoints: [L.latLng(fromLat, fromLng), L.latLng(toLat, toLng)],
          lineOptions: {styles: [{color: 'blue', opacity: 0.7, weight: 5}]},
          createMarker: function(i, wp) { return L.marker(wp.latLng).bindPopup(i === 0 ? "Awal" : "Akhir"); },
          addWaypoints: false, routeWhileDragging: false, show: false, fitSelectedRoutes: false
      }).addTo(map);

      routingControl.on('routingerror', function(e) {
          console.warn('Routing error caught: ', e.error);
          L.polyline([[fromLat, fromLng], [toLat, toLng]], {color: 'blue', opacity: 0.6, weight: 4, dashArray: '5, 10'}).addTo(map);
      });

      // Recalculate map size after PJAX DOM update transitions
      setTimeout(function() {
          map.invalidateSize();
      }, 250);
  })();
  </script>
</div>
@endsection
