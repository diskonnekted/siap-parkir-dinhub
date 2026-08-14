@extends('layouts.admin')

@section('content')
<div class="content-wrapper"> 
  <div class="content-header sty-one" style="display:none;"></div>
  
  <div class="content"> 
    <div class="info-box">
      <style>
        .skb-hero{position:relative;border-radius:16px;padding:16px 16px 14px;background:radial-gradient(900px 380px at 10% 0%,rgba(34,211,238,.45),transparent 60%),radial-gradient(800px 340px at 90% 30%,rgba(99,102,241,.40),transparent 55%),linear-gradient(135deg,#0b1220 0%,#0f1b2d 55%,#0b1220 100%);overflow:hidden;box-shadow:0 18px 45px rgba(0,0,0,.16);margin-bottom:14px}
        .skb-hero h4{color:#fff;margin:0;font-weight:800;letter-spacing:.2px}
        .skb-hero .skb-sub{color:rgba(255,255,255,.75);margin-top:6px}
        .skb-pill{display:inline-flex;align-items:center;gap:8px;background:rgba(255,255,255,.10);border:1px solid rgba(255,255,255,.18);color:#fff;padding:8px 10px;border-radius:999px;font-size:12px}
        .skb-actions{margin-top:12px;display:flex;flex-wrap:wrap;gap:10px}
        .skb-table-wrap{border-radius:16px;overflow:hidden;border:1px solid rgba(15,23,42,.08);box-shadow:0 14px 34px rgba(15,23,42,.06);background:#fff}
        .skb-table-wrap .table{margin-bottom:0}
        .skb-table-wrap thead th{background:linear-gradient(135deg,rgba(2,132,199,.10),rgba(99,102,241,.10));border-bottom:1px solid rgba(15,23,42,.08)}
        .skb-table-wrap tbody tr:hover{background:rgba(2,132,199,.04)}
        .skb-actions-td .btn{border-radius:10px}
      </style>

      <div class="skb-hero">
        <div class="row">
          <div class="col-md-8">
            <h4>Cetak SK Badan</h4>
            <div class="skb-sub">Kelola data SK badan dan cetak dokumen.</div>
            <div class="skb-actions">
              <span class="skb-pill"><i class="fa fa-print"></i> Total: {{ $res->count() }}</span>
              <span class="skb-pill"><i class="fa fa-building"></i> Badan</span>
            </div>
          </div>
          <div class="col-md-4 text-md-right" style="margin-top:10px;">
            <a href="#" class="btn btn-light btn-sm"><i class="fa fa-plus"></i> Tambah</a>
          </div>
        </div>
      </div>

      @if(session('message'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          {{ session('message') }}
        </div>
      @endif

      <div class="skb-table-wrap">
        <div class="table-responsive">
          <table id="datatable" class="table table-striped table-hover">
            <thead>
              <tr>
                <th>Tahun</th>
                <th>Nama Pengelola</th>
                <th>Nama Lokasi</th>
                <th>No. SK</th>
                <th>Cetak</th>
                <th width="160px">Action</th>
              </tr>
            </thead>
            <tbody>
              @forelse($res as $row)
                <tr>
                  <td>{{ $row->tahun_pengelolaan }}</td>
                  <td>{{ $row->nama_badan }}</td>
                  <td>{{ $row->nama_lokasi }}</td>
                  <td>{{ $row->no_sk }}</td>
                  <td><b>{!! $row->printed == 1 ? "<i class='icon-check'></i>" : "<i class='icon-close'></i>" !!}</b></td>
                  <td class="skb-actions-td">
                    <a href="{{ route('admin.cetak.badan_read', $row->id_sk_badan) }}" class="btn btn-warning btn-sm" title="detail"><i class="fa fa-eye"></i></a>
                    <a href="#" class="btn btn-warning btn-sm" title="update"><i class="fa fa-pencil"></i></a>
                    <a href="{{ route('admin.cetak.badan_delete', $row->id_sk_badan) }}" class="btn btn-danger btn-sm" title="delete" onclick="return confirm('Apakah Anda yakin akan menghapus data ini?')"><i class="fa fa-trash"></i></a>
                    <a href="#" class="btn btn-success btn-sm" title="print" target="_blank"><i class="fa fa-print"></i></a>
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="6">Data belum ada</td>
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
