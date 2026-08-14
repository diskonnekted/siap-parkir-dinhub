@extends('layouts.admin')

@section('content')
<div class="content-wrapper"> 
  <div class="content-header sty-one">
    <h1>Pengelola</h1>
    <ol class="breadcrumb">
      <li><a href="{{ route('admin.home') }}">Home</a></li>
      <li><i class="fa fa-angle-right"></i> Pengelola</li>
      <li><i class="fa fa-angle-right"></i> Juru Parkir</li>
    </ol>
  </div>
  
  <div class="content"> 
     <div class="row">
        <div class="col-12">
          <div class="card">
              <div class="card-header bg-blue">
                <h5 class="m-b-0">Detail Juru Parkir</h5>
              </div>
            <div class="card-body">
               <h6 class="sub-title">Badan Pengelola</h6>  
                      <div class="row m-b-10">
                          <div class="text-right col-md-3"><strong>Nama Badan :</strong></div>
                          <div class="col-md-9">{{ $row1->nama_badan }}</div>
                      </div>
                      <hr>
              
              <h6 class="sub-title">Identitas Pribadi</h6>  
                      <div class="row m-b-10">
                          <div class="text-right col-md-3"><strong>NIK :</strong></div>
                          <div class="col-md-9">{{ $row1->nik }}</div>
                      </div>
                      <div class="row m-b-10">
                          <div class="text-right col-md-3"><strong>Nama :</strong></div>
                          <div class="col-md-9">{{ $row1->nama }}</div>
                      </div>   
                      <div class="row m-b-10">
                          <div class="text-right col-md-3"><strong>Tempat Lahir :</strong></div>
                          <div class="col-md-9">{{ $row1->tempat_lahir }}</div>
                      </div>  
                      <div class="row m-b-10">
                          <div class="text-right col-md-3"><strong>Tanggal Lahir :</strong></div>
                          <div class="col-md-9">{{ parse_tgl($row1->tanggal_lahir) }}</div>
                      </div>                   
                      <div class="row m-b-10">
                          <div class="text-right col-md-3"><strong>Jenis Kelamin :</strong></div>
                          <div class="col-md-9">{{ $row1->jk == 'L' ? 'Laki-laki' : 'Perempuan' }}</div>
                      </div>
                      <div class="row m-b-10">
                          <div class="text-right col-md-3"><strong>Agama :</strong></div>
                          <div class="col-md-9">{{ $row1->agama }}</div>
                      </div>
                      <div class="row m-b-10">
                          <div class="text-right col-md-3"><strong>Kewarganegaraan :</strong></div>
                          <div class="col-md-9">{{ $row1->kewarganegaraan }}</div>
                      </div>
                      <hr>
                 <h6 class="sub-title">Alamat KTP</h6>  
                      <div class="row m-b-10">
                          <div class="text-right col-md-3"><strong>Provinsi :</strong></div>
                          <div class="col-md-9">{{ $row1->prov }}</div>
                      </div>
                      <div class="row m-b-10">
                          <div class="text-right col-md-3"><strong>Kabupaten :</strong></div>
                         <div class="col-md-9">{{ $row1->kab }}</div>
                      </div>
                      <div class="row m-b-10">
                          <div class="text-right col-md-3"><strong>Kecamatan :</strong></div>
                         <div class="col-md-9">{{ $row1->kec }}</div>
                      </div>
                      <div class="row m-b-10">
                          <div class="text-right col-md-3"><strong>Kelurahan/Desa :</strong></div>
                         <div class="col-md-9">{{ $row1->desa }}</div>
                      </div>
                      <div class="row m-b-10">
                          <div class="text-right col-md-3"><strong>Alamat :</strong></div>
                         <div class="col-md-9">{{ $row1->alamat }}</div>
                      </div>
                      <div class="row m-b-10">
                          <div class="text-right col-md-3"></div>
                         <div class="col-md-9">RT {{ $row1->rt }} RW {{ $row1->rw }}</div>
                      </div>
                      <hr>
                <h6 class="sub-title">Alamat Domisili</h6>  
                      <div class="row m-b-10">
                          <div class="text-right col-md-3"><strong>Provinsi :</strong></div>
                          <div class="col-md-9">{{ $row2->prov }}</div>
                      </div>
                      <div class="row m-b-10">
                          <div class="text-right col-md-3"><strong>Kabupaten :</strong></div>
                          <div class="col-md-9">{{ $row2->kab }}</div>
                      </div>
                      <div class="row m-b-10">
                          <div class="text-right col-md-3"><strong>Kecamatan :</strong></div>
                          <div class="col-md-9">{{ $row2->kec }}</div>
                      </div>
                      <div class="row m-b-10">
                          <div class="text-right col-md-3"><strong>Kelurahan/Desa :</strong></div>
                          <div class="col-md-9">{{ $row2->desa }}</div>
                      </div>
                      <div class="row m-b-10">
                          <div class="text-right col-md-3"><strong>Alamat :</strong></div>
                          <div class="col-md-9">{{ $row2->alamat }}</div>
                      </div>
                      <div class="row m-b-10">
                          <div class="text-right col-md-3"></div>
                         <div class="col-md-9">RT {{ $row2->rt }} RW {{ $row2->rw }}</div>
                      </div>
                      <div class="row m-b-10">
                         <div class="text-right col-md-3"><strong>No. Telp :</strong></div>
                          <div class="col-md-9">{{ $row2->no_telp }}</div>
                      </div>
                      <div class="row m-b-10">
                          <div class="text-right col-md-3"><strong>Foto :</strong></div>
                          <div class="col-md-9">
                              @if($row2->foto)
                                <a href="{{ asset(ltrim($row2->foto, './')) }}" target="_blank">
                                <img src="{{ asset(ltrim($row2->foto, './')) }}" width="80px" height="80px" style="border-radius:8px; object-fit:cover; border:1px solid #ddd;">
                                </a>
                              @else
                                -
                              @endif
                          </div>
                      </div>
                      <div class="row m-b-10">
                         <div class="text-right col-md-3"><strong>Foto KTP :</strong></div>
                          <div class="col-md-9">
                              @if($row2->foto_ktp)
                                <a href="{{ asset(ltrim($row2->foto_ktp, './')) }}" target="_blank">
                                <img src="{{ asset(ltrim($row2->foto_ktp, './')) }}" width="80px" height="80px" style="border-radius:8px; object-fit:cover; border:1px solid #ddd;">
                                </a>
                              @else
                                -
                              @endif
                          </div>
                      </div>
                       <div class="row m-t-20">
                          <div class="text-right col-md-3"></div>
                          <div class="col-md-9"> 
                            <a href="{{ route('admin.pengelola.jukir') }}" class="btn btn-primary btn-sm"><i class="fa fa-arrow-left"></i> Kembali</a>
                          </div>
                      </div>
            </div>
          </div>
        </div>
      </div>
  </div>
</div>
@endsection
