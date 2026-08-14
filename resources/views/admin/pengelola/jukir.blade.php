@extends('layouts.admin')

@section('content')
<div class="content-wrapper"> 
  <div class="content-header sty-one" style="display:none;"></div>
  
  <div class="content"> 
    <div class="info-box">
      <style>
        .jukir-hero{position:relative;border-radius:16px;padding:16px 16px 14px;background:radial-gradient(900px 380px at 10% 0%,rgba(34,211,238,.45),transparent 60%),radial-gradient(800px 340px at 90% 30%,rgba(99,102,241,.40),transparent 55%),linear-gradient(135deg,#0b1220 0%,#0f1b2d 55%,#0b1220 100%);overflow:hidden;box-shadow:0 18px 45px rgba(0,0,0,.16);margin-bottom:14px}
        .jukir-hero h4{color:#fff;margin:0;font-weight:800;letter-spacing:.2px}
        .jukir-hero .jukir-sub{color:rgba(255,255,255,.75);margin-top:6px}
        .jukir-pill{display:inline-flex;align-items:center;gap:8px;background:rgba(255,255,255,.10);border:1px solid rgba(255,255,255,.18);color:#fff;padding:8px 10px;border-radius:999px;font-size:12px}
        .jukir-hero .jukir-actions{margin-top:12px;display:flex;flex-wrap:wrap;gap:10px}
        .jukir-table-wrap{border-radius:16px;overflow:hidden;border:1px solid rgba(15,23,42,.08);box-shadow:0 14px 34px rgba(15,23,42,.06);background:#fff}
        .jukir-table-wrap .table{margin-bottom:0}
        .jukir-table-wrap thead th{background:linear-gradient(135deg,rgba(2,132,199,.10),rgba(99,102,241,.10));border-bottom:1px solid rgba(15,23,42,.08)}
        .jukir-table-wrap tbody tr:hover{background:rgba(2,132,199,.04)}
        .jukir-actions-td .btn{border-radius:10px}
      </style>

      <div class="jukir-hero">
        <div class="row">
          <div class="col-md-8">
            <h4>Data Juru Parkir</h4>
            <div class="jukir-sub">Kelola data jukir, verifikasi, dan lihat detail.</div>
            <div class="jukir-actions">
              <span class="jukir-pill"><i class="fa fa-users"></i> Total: {{ $res->count() }}</span>
              <span class="jukir-pill"><i class="fa fa-check"></i> Verifikasi</span>
            </div>
          </div>
        </div>
      </div>

      @if(session('message'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          {{ session('message') }}
        </div>
      @endif

      <div class="jukir-table-wrap">
        <div class="table-responsive">
          <table id="datatable" class="table table-striped table-hover">
            <thead>
              <tr>
                <th>Nama Badan</th>
                <th>NIK</th>
                <th>Nama</th>
                <th>Tanggal Lahir</th>
                <th>JK</th>
                <th>Domisili Desa</th>
                <th>Ver.</th>
                <th width="120px">Action</th>
              </tr>
            </thead>
            <tbody>
              @forelse($res as $row)
                <tr>
                  <td>{{ $row->nama_badan }}</td>
                  <td>{{ $row->nik }}</td>
                  <td>{{ $row->nama }}</td>
                  <td>{{ parse_tgl($row->tanggal_lahir) }}</td>
                  <td>{{ $row->jk }}</td>
                  <td>{{ $row->desa }}</td>
                  <td><b>{!! $row->verifikasi == 1 ? "<i class='icon-check'></i>" : "<i class='icon-close'></i>" !!}</b></td>
                  <td class="jukir-actions-td">
                    <a href="{{ route('admin.pengelola.detail_jukir', $row->id_juru_parkir) }}" class="btn btn-warning btn-sm" title="detail"><i class="fa fa-eye"></i></a>
                    <a href="{{ route('admin.pengelola.update_jukir', $row->id_juru_parkir) }}" class="btn btn-warning btn-sm" title="update"><i class="fa fa-pencil"></i></a>
                    @if($row->verifikasi == 1)
                      <a href="{{ route('admin.pengelola.unverifikasi_jukir', $row->id_juru_parkir) }}" class="btn btn-danger btn-sm" title="batal verifikasi" onclick="return confirm('Apakah Anda yakin akan membatalkan verifikasi?')"><i class="fa fa-times"></i></a>
                    @else
                      <a href="{{ route('admin.pengelola.verifikasi_jukir', $row->id_juru_parkir) }}" class="btn btn-danger btn-sm" title="verifikasi" onclick="return confirm('Apakah Anda yakin akan memverifikasi?')"><i class="fa fa-check"></i></a>
                    @endif
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="9">Data belum ada</td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
