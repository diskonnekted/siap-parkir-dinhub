@extends('layouts.admin')

@section('content')
<div class="content-wrapper"> 
  <div class="content-header sty-one" style="display:none;"></div>
  
  <div class="content"> 
    <div class="info-box">
      <style>
        .pm-hero{position:relative;border-radius:16px;padding:16px 16px 14px;background:radial-gradient(900px 380px at 10% 0%,rgba(34,211,238,.45),transparent 60%),radial-gradient(800px 340px at 90% 30%,rgba(99,102,241,.40),transparent 55%),linear-gradient(135deg,#0b1220 0%,#0f1b2d 55%,#0b1220 100%);overflow:hidden;box-shadow:0 18px 45px rgba(0,0,0,.16);margin-bottom:14px}
        .pm-hero h4{color:#fff;margin:0;font-weight:800;letter-spacing:.2px}
        .pm-hero .pm-sub{color:rgba(255,255,255,.75);margin-top:6px}
        .pm-pill{display:inline-flex;align-items:center;gap:8px;background:rgba(255,255,255,.10);border:1px solid rgba(255,255,255,.18);color:#fff;padding:8px 10px;border-radius:999px;font-size:12px}
        .pm-actions{margin-top:12px;display:flex;flex-wrap:wrap;gap:10px}
        .pm-table-wrap{border-radius:16px;overflow:hidden;border:1px solid rgba(15,23,42,.08);box-shadow:0 14px 34px rgba(15,23,42,.06);background:#fff}
        .pm-table-wrap .table{margin-bottom:0}
        .pm-table-wrap thead th{background:linear-gradient(135deg,rgba(2,132,199,.10),rgba(99,102,241,.10));border-bottom:1px solid rgba(15,23,42,.08)}
        .pm-table-wrap tbody tr:hover{background:rgba(2,132,199,.04)}
        .pm-actions-td .btn{border-radius:10px}
      </style>

      <div class="pm-hero">
        <div class="row">
          <div class="col-md-8">
            <h4>Pengaduan Masyarakat</h4>
            <div class="pm-sub">Kelola laporan dari masyarakat dan tindak lanjutnya.</div>
            <div class="pm-actions">
              <span class="pm-pill"><i class="fa fa-inbox"></i> Total: {{ $res->count() }}</span>
              <span class="pm-pill"><i class="fa fa-comment"></i> Respon</span>
            </div>
          </div>
        </div>
      </div>

      @if(session('message'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          {{ session('message') }}
        </div>
      @endif

      <div class="pm-table-wrap">
        <div class="table-responsive">
          <table id="datatable" class="table table-striped table-hover">
            <thead>
              <tr>
                <th>No</th>
                <th>Nama</th>
                <th>NIK</th>
                <th>Alamat</th>
                <th>No.HP</th>
                <th>Plat Nomor</th>
                <th>Lokasi</th>
                <th>Status</th>
                <th width="120px">Action</th>
              </tr>
            </thead>
            <tbody>
              @php $no = 1; @endphp
              @foreach($res as $row)
                <tr>
                  <td>{{ $no }}</td>
                  <td>{{ $row->nama }}</td>
                  <td>{{ $row->nik }}</td>
                  <td>{{ $row->alamat }}</td>
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
                  <td class="pm-actions-td">
                    <a href="{{ route('admin.pengaduan.read', $row->id_pengaduan) }}" class="btn btn-warning btn-sm" title="read"><i class="fa fa-eye"></i></a>
                    <a href="#" class="btn btn-warning btn-sm" title="respon"><i class="fa fa-pencil"></i></a>
                    <a href="{{ route('admin.pengaduan.delete', $row->id_pengaduan) }}" class="btn btn-danger btn-sm" title="delete" onclick="return confirm('Apakah Anda yakin akan menghapus data ini?')"><i class="fa fa-trash"></i></a>
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
