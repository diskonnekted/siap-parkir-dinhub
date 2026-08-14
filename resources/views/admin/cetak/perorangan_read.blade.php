@extends('layouts.admin')

@section('content')
<div class="content-wrapper"> 
  <div class="content-header sty-one">
    <h1>Cetak SK</h1>
    <ol class="breadcrumb">
      <li><a href="{{ route('admin.home') }}">Home</a></li>
      <li><i class="fa fa-angle-right"></i> Cetak SK</li>
      <li><i class="fa fa-angle-right"></i> Perorangan</li>
    </ol>
  </div>
  
  <div class="content"> 
     <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header bg-blue">
            <h5 class="m-b-0">Detail Cetak SK Pengelola Perorangan</h5>
            </div>
            <div class="card-body">
                <div class="row m-b-10">
                  <div class="text-right col-md-3"><strong>Tahun Pengelolaan :</strong></div>
                  <div class="col-md-9">{{ $row->tahun_pengelolaan }}</div>
                </div>
                <div class="row m-b-10">
                  <div class="text-right col-md-3"><strong>Nama Pengelola :</strong></div>
                  <div class="col-md-9">{{ $row->nama }}</div>
                </div>
                <div class="row m-b-10">
                  <div class="text-right col-md-3"><strong>Jenis Lokasi :</strong></div>
                  <div class="col-md-9">{{ $row->jenis_lokasi }}</div>
                </div>
                <div class="row m-b-10">
                  <div class="text-right col-md-3"><strong>Nama Lokasi :</strong></div>
                  <div class="col-md-9">{{ $row->nama_lokasi }}</div>
                </div>
                 <div class="row m-b-10">
                  <div class="text-right col-md-3"><strong>Zona :</strong></div>
                  <div class="col-md-9">{{ $row->zona }}</div>
                </div>
                 <div class="row m-b-10">
                  <div class="text-right col-md-3"><strong>No. SK :</strong></div>
                  <div class="col-md-9">{{ $row->no_sk }}</div>
                </div>
                 <div class="row m-b-10">
                  <div class="text-right col-md-3"><strong>Hari :</strong></div>
                  <div class="col-md-9">{{ $row->hari_sk }}</div>
                </div>
                 <div class="row m-b-10">
                  <div class="text-right col-md-3"><strong>Tanggal :</strong></div>
                  <div class="col-md-9">{{ parse_tgl($row->tgl_sk) }}</div>
                </div>
                 <div class="row m-b-10">
                  <div class="text-right col-md-3"><strong>Retribusi Perbulan :</strong></div>
                  <div class="col-md-9">{{ $row->retribusi_perbulan }}</div>
                </div>
                 <div class="row m-b-10">
                  <div class="text-right col-md-3"><strong>Retribusi Pertahun :</strong></div>
                  <div class="col-md-9">{{ $row->retribusi_pertahun }}</div>
                </div>
                
                 <div class="row m-t-20">
                  <div class="text-right col-md-3"></div>
                  <div class="col-md-9">
                    <a href="{{ route('admin.cetak.perorangan') }}" class="btn btn-primary btn-sm"><i class="fa fa-arrow-left"></i> Kembali</a>
                  </div>
                </div>
            </div>
          </div>
        </div>
      </div>
  </div>
</div>
@endsection
