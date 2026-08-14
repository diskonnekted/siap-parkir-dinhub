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
