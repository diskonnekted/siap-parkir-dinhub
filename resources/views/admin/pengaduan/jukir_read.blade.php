@extends('layouts.admin')

@section('content')
<div class="content-wrapper"> 
  <div class="content-header sty-one">
    <h1>Pengaduan untuk Juru Parkir</h1>
    <ol class="breadcrumb">
      <li><a href="{{ route('admin.home') }}">Home</a></li>
      <li><i class="fa fa-angle-right"></i> Pengaduan Juru Parkir</li>
    </ol>
  </div>
  
  <div class="content"> 
     <div class="row">
        <div class="col-12">
          <div class="card">
              <div class="card-header bg-blue">
                <h5 class="m-b-0">Detail Pengaduan Juru Parkir</h5>
              </div>
            <div class="card-body">
                  <div class="row m-b-10">
                      <div class="text-right col-md-3"><strong>Nama Juru Parkir :</strong></div>
                      <div class="col-md-9">{{ $row->nama_jukir }}</div>
                  </div>
                   <div class="row m-b-10">
                      <div class="text-right col-md-3"><strong>Lokasi Parkir :</strong></div>
                      <div class="col-md-9">{{ $row->nama_lokasi }}</div>
                  </div>
                  <div class="row m-b-10">
                      <div class="text-right col-md-3"><strong>Nama Pelapor :</strong></div>
                      <div class="col-md-9">{{ $row->nama }}</div>
                  </div>     
                  <div class="row m-b-10">
                      <div class="text-right col-md-3"><strong>NIK :</strong></div>
                      <div class="col-md-9">{{ $row->nik }}</div>
                  </div>
                  <div class="row m-b-10">
                      <div class="text-right col-md-3"><strong>Alamat :</strong></div>
                      <div class="col-md-9">{{ $row->alamat }}</div>
                  </div>  
                  <div class="row m-b-10">
                      <div class="text-right col-md-3"><strong>No. HP :</strong></div>
                      <div class="col-md-9">{{ $row->nohp }}</div>
                  </div> 
                  <div class="row m-b-10">
                      <div class="text-right col-md-3"><strong>Plat Nomor :</strong></div>
                      <div class="col-md-9">{{ $row->plat_nomor }}</div>
                  </div> 
                  <div class="row m-b-10">
                      <div class="text-right col-md-3"><strong>Keterangan :</strong></div>
                      <div class="col-md-9">{{ $row->keterangan }}</div>
                  </div>
                  <div class="row m-b-10">
                     <div class="text-right col-md-3"><strong>Tanggal Pengaduan :</strong></div>
                      <div class="col-md-9">{{ parse_tanggal($row->post_time) }}</div>
                  </div>
                  <div class="row m-b-10">
                      <div class="text-right col-md-3"><strong>Tanggal Respon :</strong></div>
                      <div class="col-md-9">{{ !empty($row->respon_time) ? parse_tanggal($row->respon_time) : '-' }}</div>
                  </div>
                  <div class="row m-b-10">
                      <div class="text-right col-md-3"><strong>Status Respon :</strong></div>
                      <div class="col-md-9">
                          @if($row->respon == 'belum')
                              Belum Ditangani
                          @elseif($row->respon == 'sedang')
                              Sedang Ditangani
                          @elseif($row->respon == 'sudah')
                              Sudah Ditangani
                          @else
                              Baru
                          @endif
                      </div>
                  </div>
                  <div class="row m-b-10">
                      <div class="text-right col-md-3"><strong>Respon Keterangan :</strong></div>
                      <div class="col-md-9">{{ $row->respon_keterangan ?? '-' }}</div>
                  </div>
                  <div class="row m-b-10">
                      <div class="text-right col-md-3"><strong>Respon User :</strong></div>
                      <div class="col-md-9">{{ $row->respon_user ?? '-' }}</div>
                  </div>
                   <div class="row m-t-20">
                      <div class="text-right col-md-3"></div>
                      <div class="col-md-9">
                        <a href="{{ route('admin.pengaduan_jukir.index') }}" class="btn btn-primary btn-sm"><i class="fa fa-arrow-left"></i> Kembali</a>
                      </div>
                  </div>
            </div>
          </div>
        </div>
      </div>
  </div>
</div>
@endsection
