@extends('layouts.admin')

@section('content')
  <div class="content-wrapper">
    <div class="content-header sty-one" style="display:none;"></div>
    
    <div class="content">
      <div class="info-box" style="background: transparent; box-shadow: none; padding: 0;">
        
        <!-- Header Breadcrumbs -->
        <div class="d-flex justify-content-between align-items-center m-b-3" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
          <div>
            <h4 style="font-weight: 800; margin: 0; color: #1e293b; letter-spacing: -0.5px;">Detail Penugasan Juru Parkir</h4>
            <p style="color: #64748b; margin: 5px 0 0 0; font-size: 13px;">Informasi lengkap penugasan juru parkir pada lokasi parkir terkait.</p>
          </div>
          <div>
            <a href="{{ route('admin.titikjukir.index') }}" class="btn btn-outline-secondary btn-sm" style="border-radius: 12px; font-weight: 600; padding: 8px 16px; border: 1px solid #cbd5e1; background: #fff; color: #475569;">
              <i class="fa fa-arrow-left"></i> Kembali
            </a>
          </div>
        </div>

        <div class="row">
          
          <!-- Column 1: Juru Parkir Profile Card -->
          <div class="col-lg-4 col-md-5 m-b-3">
            <div class="card border-0" style="border-radius: 20px; overflow: hidden; background: #fff; box-shadow: 0 10px 25px rgba(0,0,0,0.04); border: 1px solid rgba(226, 232, 240, 0.8) !important;">
              <!-- Header Gradient Pattern -->
              <div style="height: 100px; background: linear-gradient(135deg, #0ea5e9 0%, #6366f1 100%); position: relative;"></div>
              
              <!-- Avatar Container -->
              <div class="text-center" style="margin-top: -55px; position: relative; z-index: 2; padding: 0 20px;">
                @if(!empty($row->foto))
                  <img src="{{ asset(ltrim($row->foto, './')) }}" alt="Foto Jukir" style="width: 110px; height: 110px; border-radius: 50%; object-fit: cover; border: 4px solid #fff; box-shadow: 0 10px 20px rgba(0,0,0,0.12);">
                @else
                  <div style="width: 110px; height: 110px; border-radius: 50%; background: #f1f5f9; display: inline-flex; align-items: center; justify-content: center; border: 4px solid #fff; box-shadow: 0 10px 20px rgba(0,0,0,0.08);">
                    <i class="fa fa-user-circle-o text-muted" style="font-size: 55px; color: #94a3b8;"></i>
                  </div>
                @endif
                
                <h5 style="font-weight: 800; margin-top: 15px; color: #0f172a; margin-bottom: 4px;">{{ strtoupper($row->nama) }}</h5>
                <span class="badge" style="background: rgba(16, 185, 129, 0.12); color: #059669; font-weight: 700; font-size: 11px; padding: 6px 12px; border-radius: 999px;">
                  <i class="fa fa-circle" style="font-size: 8px; vertical-align: middle; margin-right: 4px;"></i> Jukir Aktif
                </span>
              </div>
              
              <!-- Profile Details -->
              <div class="card-body" style="padding: 24px;">
                <div style="background: #f8fafc; border-radius: 14px; padding: 16px; margin-bottom: 20px; border: 1px solid #f1f5f9;">
                  <div class="row m-b-2" style="margin-bottom: 10px; display: flex;">
                    <div class="col-5 text-muted" style="font-size: 12px; font-weight: 600;">NIK</div>
                    <div class="col-7" style="font-size: 13px; font-weight: 700; color: #334155;">{{ $row->nik }}</div>
                  </div>
                  <div class="row m-b-2" style="margin-bottom: 10px; display: flex;">
                    <div class="col-5 text-muted" style="font-size: 12px; font-weight: 600;">Tahun Tugas</div>
                    <div class="col-7" style="font-size: 13px; font-weight: 700; color: #334155;">{{ $row->tahun_pengelolaan }}</div>
                  </div>
                  <div class="row" style="display: flex;">
                    <div class="col-5 text-muted" style="font-size: 12px; font-weight: 600;">Jam Kerja</div>
                    <div class="col-7" style="font-size: 13px; font-weight: 700; color: #334155;">{{ $row->jam_kerja_awal ?? '-' }} s.d {{ $row->jam_kerja_akhir ?? '-' }}</div>
                  </div>
                </div>

                <!-- Print Actions -->
                <div style="display: flex; gap: 10px;">
                  <a href="{{ route('admin.titikjukir.kta', $row->id_titik_jukir) }}" target="_blank" class="btn btn-success btn-block" style="flex: 1; border-radius: 12px; font-weight: 700; padding: 10px 0; font-size: 13px; box-shadow: 0 4px 12px rgba(16, 185, 129, 0.15);">
                    <i class="fa fa-id-card"></i> Cetak KTA
                  </a>
                  <a href="{{ route('admin.titikjukir.spt', $row->id_titik_jukir) }}" target="_blank" class="btn btn-info btn-block" style="flex: 1; border-radius: 12px; font-weight: 700; padding: 10px 0; font-size: 13px; box-shadow: 0 4px 12px rgba(14, 165, 233, 0.15); margin-top: 0; color: #fff; background-color: #0ea5e9; border-color: #0ea5e9;">
                    <i class="fa fa-file-text-o"></i> Cetak SPT
                  </a>
                </div>
              </div>
            </div>
          </div>

          <!-- Column 2: Titik Parkir Details & Location Map -->
          <div class="col-lg-8 col-md-7">
            <div class="card border-0" style="border-radius: 20px; box-shadow: 0 10px 25px rgba(0,0,0,0.04); border: 1px solid rgba(226, 232, 240, 0.8) !important; background: #fff;">
              <div class="card-header bg-transparent border-0" style="padding: 20px 24px 10px 24px;">
                <h5 style="font-weight: 800; color: #0f172a; margin: 0;">Detail Lokasi &amp; Peta Penugasan</h5>
              </div>
              <div class="card-body" style="padding: 10px 24px 24px 24px;">
                
                <!-- Information Grid -->
                <div class="row m-b-3" style="margin-bottom: 20px;">
                  <div class="col-md-6 m-b-2" style="margin-bottom: 15px;">
                    <div style="background: #f8fafc; border-radius: 14px; padding: 14px; border: 1px solid #f1f5f9;">
                      <div class="text-muted" style="font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 4px;">Nama Lokasi Parkir</div>
                      <div style="font-size: 15px; font-weight: 800; color: #1e293b;">{{ $row->nama_lokasi }}</div>
                    </div>
                  </div>
                  <div class="col-md-6 m-b-2" style="margin-bottom: 15px;">
                    <div style="background: #f8fafc; border-radius: 14px; padding: 14px; border: 1px solid #f1f5f9;">
                      <div class="text-muted" style="font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 4px;">Ruas Jalan</div>
                      <div style="font-size: 15px; font-weight: 800; color: #1e293b;">{{ $row->nama_ruas }}</div>
                    </div>
                  </div>
                  <div class="col-md-6" style="margin-bottom: 15px;">
                    <div style="background: #f8fafc; border-radius: 14px; padding: 14px; border: 1px solid #f1f5f9;">
                      <div class="text-muted" style="font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 4px;">Kecamatan / Desa</div>
                      <div style="font-size: 15px; font-weight: 800; color: #1e293b;">Kec. {{ $row->kec }} / {{ $row->desa }}</div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div style="background: #f8fafc; border-radius: 14px; padding: 14px; border: 1px solid #f1f5f9;">
                      <div class="text-muted" style="font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 4px;">Setoran Bulanan (SPT)</div>
                      <div style="font-size: 15px; font-weight: 800; color: #0284c7;">
                        Rp. {{ number_format($row->setoran_perbulan ?? 0, 0, ',', '.') }} <span style="font-size: 12px; font-weight: 600; color: #64748b;">/ bulan</span>
                      </div>
                    </div>
                  </div>
                </div>

                <!-- Leaflet Map Container -->
                <div style="position: relative;">
                  <div class="text-muted" style="font-size: 12px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 8px;">Peta Koordinat &amp; Jalur Penugasan</div>
                  <div id="map" style="height: 320px; border-radius: 16px; border: 1px solid rgba(15,23,42,0.08); box-shadow: inset 0 2px 4px rgba(0,0,0,0.02); overflow: hidden;"></div>
                </div>

              </div>
            </div>
          </div>

        </div>

      </div>
    </div>
  </div>

  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
  <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@3.2.12/dist/leaflet-routing-machine.css" />
  <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
  <script src="https://unpkg.com/leaflet-routing-machine@3.2.12/dist/leaflet-routing-machine.js"></script>
  <script type="text/javascript">
  document.addEventListener("DOMContentLoaded", function() {
      var fromLat = {{ !empty($row->from_lat) ? $row->from_lat : -7.3932652 }};
      var fromLng = {{ !empty($row->from_lng) ? $row->from_lng : 109.7097441 }};
      var toLat = {{ !empty($row->to_lat) ? $row->to_lat : -7.3932652 }};
      var toLng = {{ !empty($row->to_lng) ? $row->to_lng : 109.7097441 }};
      var titikLat = {{ !empty($row->titik_lat) ? $row->titik_lat : -7.3932652 }};
      var titikLng = {{ !empty($row->titik_lng) ? $row->titik_lng : 109.7097441 }};

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

      L.Routing.control({
          waypoints: [L.latLng(fromLat, fromLng), L.latLng(toLat, toLng)],
          lineOptions: {styles: [{color: 'blue', opacity: 0.6, weight: 4}]},
          createMarker: function() { return null; },
          addWaypoints: false, 
          routeWhileDragging: false, 
          show: false,
          fitSelectedRoutes: false
      }).addTo(map);
  });
  </script>
@endsection
