@extends('layouts.admin')

@section('content')
<div class="content-wrapper"> 
  <div class="content-header sty-one" style="display:none;"></div>
  
  <div class="content"> 
    <div class="info-box">
      <style>
        .pejabat-hero{position:relative;border-radius:16px;padding:16px 16px 14px;background:radial-gradient(900px 380px at 10% 0%,rgba(34,211,238,.45),transparent 60%),radial-gradient(800px 340px at 90% 30%,rgba(99,102,241,.40),transparent 55%),linear-gradient(135deg,#0b1220 0%,#0f1b2d 55%,#0b1220 100%);overflow:hidden;box-shadow:0 18px 45px rgba(0,0,0,.16);margin-bottom:14px}
        .pejabat-hero h4{color:#fff;margin:0;font-weight:800;letter-spacing:.2px}
        .pejabat-hero .pejabat-sub{color:rgba(255,255,255,.75);margin-top:6px}
        .pejabat-pill{display:inline-flex;align-items:center;gap:8px;background:rgba(255,255,255,.10);border:1px solid rgba(255,255,255,.18);color:#fff;padding:8px 10px;border-radius:999px;font-size:12px}
        .pejabat-actions{margin-top:12px;display:flex;flex-wrap:wrap;gap:10px}
        .pejabat-table-wrap{border-radius:16px;overflow:hidden;border:1px solid rgba(15,23,42,.08);box-shadow:0 14px 34px rgba(15,23,42,.06);background:#fff}
        .pejabat-table-wrap .table{margin-bottom:0}
        .pejabat-table-wrap thead th{background:linear-gradient(135deg,rgba(2,132,199,.10),rgba(99,102,241,.10));border-bottom:1px solid rgba(15,23,42,.08)}
        .pejabat-table-wrap tbody tr:hover{background:rgba(2,132,199,.04)}
        .pejabat-actions-td .btn{border-radius:10px}
      </style>

      <div class="pejabat-hero">
        <div class="row">
          <div class="col-md-8">
            <h4>Data Pejabat</h4>
            <div class="pejabat-sub">Kelola pejabat yang berwenang menandatangani SK.</div>
            <div class="pejabat-actions">
              <span class="pejabat-pill"><i class="fa fa-user-circle"></i> Total: {{ $res->count() }}</span>
              <span class="pejabat-pill"><i class="fa fa-check"></i> Aktivasi</span>
            </div>
          </div>
          <div class="col-md-4 text-md-right" style="margin-top:10px;">
            <a href="{{ route('admin.pejabat.add') }}" class="btn btn-light btn-sm"><i class="fa fa-plus"></i> Tambah Pejabat</a>
          </div>
        </div>
      </div>

      @if(session('message'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          {{ session('message') }}
        </div>
      @endif

      <div class="pejabat-table-wrap">
        <div class="table-responsive">
          <table id="datatable" class="table table-striped table-hover">
            <thead>
              <tr>
                <th>No</th>
                <th>Tahun</th>
                <th>Nama</th>
                <th>NIP</th>
                <th>Active</th>
                <th width="160px">Action</th>
              </tr>
            </thead>
            <tbody>
              @php $no = 1; @endphp
              @foreach($res as $row)
                <tr>
                  <td>{{ $no }}</td>
                  <td>{{ $row->tahun_pengelolaan }}</td>
                  <td>{{ $row->nama_pejabat }}</td>
                  <td>{{ $row->nip_pejabat }}</td>
                  <td><b>{!! $row->actived == 1 ? "<i class='icon-check'></i>" : "<i class='icon-close'></i>" !!}</b></td>                
                  <td class="pejabat-actions-td">
                    <a href="{{ route('admin.pejabat.read', $row->id_pejabat) }}" class="btn btn-warning btn-sm" title="read"><i class="fa fa-eye"></i></a>
                    <a href="{{ route('admin.pejabat.update', $row->id_pejabat) }}" class="btn btn-warning btn-sm" title="update"><i class="fa fa-pencil"></i></a>
                    <a href="{{ route('admin.pejabat.delete', $row->id_pejabat) }}" class="btn btn-danger btn-sm" title="delete" onclick="return confirm('Apakah Anda yakin akan menghapus data ini?')"><i class="fa fa-trash"></i></a>
                    @if($row->actived == 1)
                      <a href="{{ route('admin.pejabat.unactive', $row->id_pejabat) }}" class="btn btn-danger btn-sm" title="batal active" onclick="return confirm('Apakah Anda yakin akan membatalkan aktivasi?')"><i class="fa fa-times"></i></a>
                    @else
                      <a href="{{ route('admin.pejabat.active', $row->id_pejabat) }}" class="btn btn-success btn-sm" title="active" onclick="return confirm('Apakah Anda yakin akan mengaktivasi?')"><i class="fa fa-check"></i></a>
                    @endif
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
