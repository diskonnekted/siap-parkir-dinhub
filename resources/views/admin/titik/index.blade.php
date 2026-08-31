@extends('layouts.admin')

@section('content')
<div class="content-wrapper"> 
  <div class="content-header sty-one" style="display:none;"></div>
  
  <div class="content"> 
    <div class="info-box">
      <style>
        .tp-hero{position:relative;border-radius:16px;padding:16px 16px 14px;background:radial-gradient(900px 380px at 10% 0%,rgba(34,211,238,.45),transparent 60%),radial-gradient(800px 340px at 90% 30%,rgba(99,102,241,.40),transparent 55%),linear-gradient(135deg,#0b1220 0%,#0f1b2d 55%,#0b1220 100%);overflow:hidden;box-shadow:0 18px 45px rgba(0,0,0,.16);margin-bottom:14px}
        .tp-hero h4{color:#fff;margin:0;font-weight:800;letter-spacing:.2px}
        .tp-hero .tp-sub{color:rgba(255,255,255,.75);margin-top:6px}
        .tp-pill{display:inline-flex;align-items:center;gap:8px;background:rgba(255,255,255,.10);border:1px solid rgba(255,255,255,.18);color:#fff;padding:8px 10px;border-radius:999px;font-size:12px}
        .tp-actions{margin-top:12px;display:flex;flex-wrap:wrap;gap:10px}
        .tp-table-wrap{border-radius:16px;overflow:hidden;border:1px solid rgba(15,23,42,.08);box-shadow:0 14px 34px rgba(15,23,42,.06);background:#fff}
        .tp-table-wrap .table{margin-bottom:0}
        .tp-table-wrap thead th{background:linear-gradient(135deg,rgba(2,132,199,.10),rgba(99,102,241,.10));border-bottom:1px solid rgba(15,23,42,.08)}
        .tp-table-wrap tbody tr:hover{background:rgba(2,132,199,.04)}
        .tp-actions-td .btn{border-radius:10px}
      </style>

      <div class="tp-hero">
        <div class="row">
          <div class="col-md-8">
            <h4>Titik Parkir</h4>
            <div class="tp-sub">Kelola lokasi parkir, kapasitas, dan koordinat.</div>
            <div class="tp-actions">
              <span class="tp-pill"><i class="fa fa-map-marker"></i> Total: {{ $res->count() }}</span>
              <span class="tp-pill"><i class="fa fa-road"></i> Ruas Jalan</span>
            </div>
          </div>
          <div class="col-md-4 text-md-right" style="margin-top:10px;">
            <a href="{{ route('admin.titik.add') }}" class="btn btn-light btn-sm"><i class="fa fa-plus"></i> Tambah</a>
          </div>
        </div>
      </div>

      @if(session('message'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          {{ session('message') }}
        </div>
      @endif

      <div class="tp-table-wrap">
        <div class="table-responsive">
          <table id="datatable" class="table table-striped table-hover">
            <thead>
              <tr>
                <th>No</th>
                <th>Jenis Fasilitas</th>
                <th>Nama Lokasi</th>
                <th>SRP Motor</th>
                <th>SRP Mobil</th>
                <th>Kelurahan/Desa</th>
                <th>Ruas Jalan</th>
                <th width="120px">Action</th>
              </tr>
            </thead>
            <tbody>
              @php $no = 1; @endphp
              @foreach($res as $row)
                <tr>
                  <td>{{ $no }}</td>
                  <td>{{ $row->jenis_fasilitas == 'dalam' ? 'Di Dalam Ruang Milik Jalan' : 'Di Luar Ruang Milik Jalan' }}</td>
                  <td>{{ $row->nama_lokasi }}</td>
                  <td>{{ $row->srp_motor }}</td>
                  <td>{{ $row->srp_mobil }}</td>
                  <td>{{ $row->desa }}</td>
                  <td>{{ $row->nama_ruas }}</td>                
                  <td class="tp-actions-td">
                    <a href="{{ route('admin.titik.read', $row->id_titik_parkir) }}" class="btn btn-warning btn-sm" title="read"><i class="fa fa-eye"></i></a>
                    <a href="{{ route('admin.titik.update', $row->id_titik_parkir) }}" class="btn btn-warning btn-sm" title="update"><i class="fa fa-pencil"></i></a>
                    <a href="{{ route('admin.titik.delete', $row->id_titik_parkir) }}" class="btn btn-danger btn-sm" title="delete" onclick="return confirm('Apakah Anda yakin akan menghapus data ini?')"><i class="fa fa-trash"></i></a>
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
@endsection
