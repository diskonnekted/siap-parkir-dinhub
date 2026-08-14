@extends('layouts.admin')

@section('content')
<div class="content-wrapper"> 
  <div class="content-header sty-one">
    <h1>Pengelola</h1>
    <ol class="breadcrumb">
      <li><a href="{{ route('admin.home') }}">Home</a></li>
      <li><i class="fa fa-angle-right"></i> Pengelola</li>
      <li><i class="fa fa-angle-right"></i> Badan</li>
    </ol>
  </div>
  
  <div class="content"> 
     <div class="row">
        <div class="col-12">
          <div class="card">
               <div class="card-header bg-blue">
                <h5 class="m-b-0">Detail Pengelola Badan</h5>
              </div>
            <div class="card-body">
              
             <h6 class="sub-title">Identitas Badan Pengelola</h6>  
                      <div class="row m-b-10">
                         <div class="text-right col-md-3"><strong>Nama Badan :</strong></div>
                         <div class="col-md-9">{{ $row->nama_badan }}</div>
                      </div>
                    <div class="row m-b-10">
                         <div class="text-right col-md-3"><strong>Provinsi :</strong></div>
                         <div class="col-md-9">{{ $row->prov }}</div>
                      </div>
                      <div class="row m-b-10">
                          <div class="text-right col-md-3"><strong>Kabupaten :</strong></div>
                          <div class="col-md-9">{{ $row->kab }}</div>
                      </div>
                      <div class="row m-b-10">
                         <div class="text-right col-md-3"><strong>Kecamatan :</strong></div>
                          <div class="col-md-9">{{ $row->kec }}</div>
                      </div>
                      <div class="row m-b-10">
                          <div class="text-right col-md-3"><strong>Kelurahan/Desa :</strong></div>
                          <div class="col-md-9">{{ $row->desa }}</div>
                      </div>
                      <div class="row m-b-10">
                          <div class="text-right col-md-3"><strong>Alamat :</strong></div>
                         <div class="col-md-9">{{ $row->alamat }}</div>
                      </div>
                      <div class="row m-b-10">
                         <div class="text-right col-md-3"></div>
                          <div class="col-md-9">RT {{ $row->rt }} RW {{ $row->rw }}</div>
                      </div>
                      <div class="row m-b-10">
                          <div class="text-right col-md-3"><strong>No. Telp :</strong></div>
                         <div class="col-md-9">{{ $row->no_telp }}</div>
                      </div>
                      <div class="row m-b-10">
                          <div class="text-right col-md-3"><strong>Email :</strong></div>
                          <div class="col-md-9">{{ $row->email }}</div>
                      </div>
                      <div class="row m-b-10">
                          <div class="text-right col-md-3"><strong>NIB :</strong></div>
                         <div class="col-md-9">{{ $row->nib }}</div>
                      </div>
                      <div class="row m-b-10">
                          <div class="text-right col-md-3"><strong>Foto NIB :</strong></div>
                          <div class="col-md-9">
                              @if($row->foto_nib)
                                <a href="{{ asset($row->foto_nib) }}" target="_blank">
                                <img src="{{ asset($row->foto_nib) }}" width="80px" height="80px" style="border-radius:8px; object-fit:cover; border:1px solid #ddd;">
                                </a>
                              @else
                                -
                              @endif
                          </div>
                      </div>
                      <hr>
              <h6 class="sub-title">Akta Pendirian</h6>  
                      <div class="row m-b-10">
                          <div class="text-right col-md-3"><strong>Nomor Akta :</strong></div>
                          <div class="col-md-9">{{ $row->no_akta }}</div>
                      </div>
                      <div class="row m-b-10">
                          <div class="text-right col-md-3"><strong>Tanggal Akta :</strong></div>
                          <div class="col-md-9">{{ parse_tgl($row->tgl_akta) }}</div>
                      </div>
                      <div class="row m-b-10">
                         <div class="text-right col-md-3"><strong>Nama Notaris :</strong></div>
                         <div class="col-md-9">{{ $row->nama_notaris }}</div>
                      </div>
                      <div class="row m-b-10">
                          <div class="text-right col-md-3"><strong>Nomor Surat Keterangan Terdaftar :</strong></div>
                         <div class="col-md-9">{{ $row->no_suket_kemenkumham }}</div>
                      </div>
                      <div class="row m-b-10">
                          <div class="text-right col-md-3"><strong>Foto Surat Keterangan :</strong></div>
                          <div class="col-md-9">
                              @if($row->foto_suket)
                                <a href="{{ asset($row->foto_suket) }}" target="_blank">
                                <img src="{{ asset($row->foto_suket) }}" width="80px" height="80px" style="border-radius:8px; object-fit:cover; border:1px solid #ddd;">
                                </a>
                              @else
                                -
                              @endif
                          </div>
                      </div>
                      <hr>
              <h6 class="sub-title">Perubahan Akta</h6>  
                      <div class="row m-b-10">
                          <div class="text-right col-md-3"><strong>Nomor Akta :</strong></div>
                         <div class="col-md-9">{{ $row->perubahan_no_akta }}</div>
                      </div>
                      <div class="row m-b-10">
                          <div class="text-right col-md-3"><strong>Tanggal Akta :</strong></div>
                         <div class="col-md-9">{{ parse_tgl($row->perubahan_tgl_akta) }}</div>
                      </div>
                      <div class="row m-b-10">
                        <div class="text-right col-md-3"><strong>Nama Notaris :</strong></div>
                         <div class="col-md-9">{{ $row->perubahan_nama_notaris }}</div>
                      </div>
                      <hr>
              <h6 class="sub-title">Data Pengurus</h6>  
                      <div class="row m-b-10">
                        <div class="text-right col-md-3"><strong>Nama :</strong></div>
                         <div class="col-md-9">{{ $row->pengurus_nama }}</div>
                      </div>
                      <div class="row m-b-10">
                          <div class="text-right col-md-3"><strong>NIK :</strong></div>
                          <div class="col-md-9">{{ $row->pengurus_nik }}</div>
                      </div>
                      <div class="row m-b-10">
                         <div class="text-right col-md-3"><strong>Jabatan :</strong></div>
                         <div class="col-md-9">{{ $row->pengurus_jabatan }}</div>
                      </div>
                      <div class="row m-b-10">
                          <div class="text-right col-md-3"><strong>Foto :</strong></div>
                          <div class="col-md-9">
                              @if($row->pengurus_foto)
                                <a href="{{ asset($row->pengurus_foto) }}" target="_blank">
                                <img src="{{ asset($row->pengurus_foto) }}" width="80px" height="80px" style="border-radius:8px; object-fit:cover; border:1px solid #ddd;">
                                </a>
                              @else
                                -
                              @endif
                          </div>
                      </div>
                      <div class="row m-b-10">
                          <div class="text-right col-md-3"><strong>Foto KTP :</strong></div>
                          <div class="col-md-9">
                              @if($row->pengurus_ktp)
                                <a href="{{ asset($row->pengurus_ktp) }}" target="_blank">
                                <img src="{{ asset($row->pengurus_ktp) }}" width="80px" height="80px" style="border-radius:8px; object-fit:cover; border:1px solid #ddd;">
                                </a>
                              @else
                                -
                              @endif
                          </div>
                      </div>
                       <div class="row m-b-10">
                          <div class="text-right col-md-3"><strong>NPWP :</strong></div>
                          <div class="col-md-9">{{ $row->npwp }}</div>
                      </div>
                      <div class="row m-b-10">
                         <div class="text-right col-md-3"><strong>Foto NPWP :</strong></div>
                          <div class="col-md-9">
                              @if($row->foto_npwp)
                                <a href="{{ asset($row->foto_npwp) }}" target="_blank">
                                <img src="{{ asset($row->foto_npwp) }}" width="80px" height="80px" style="border-radius:8px; object-fit:cover; border:1px solid #ddd;">
                                </a>
                              @else
                                -
                              @endif
                          </div>
                      </div>
                      <div class="row m-b-10">
                         <div class="text-right col-md-3"><strong>Foto Kantor :</strong></div>
                          <div class="col-md-9">
                              @if($row->foto_kantor)
                                <a href="{{ asset($row->foto_kantor) }}" target="_blank">
                                <img src="{{ asset($row->foto_kantor) }}" width="80px" height="80px" style="border-radius:8px; object-fit:cover; border:1px solid #ddd;">
                                </a>
                              @else
                                -
                              @endif
                          </div>
                      </div>
                       <div class="row m-t-20">
                          <div class="text-right col-md-3"></div>
                          <div class="col-md-9">
                            <a href="{{ route('admin.pengelola.badan') }}" class="btn btn-primary btn-sm"><i class="fa fa-arrow-left"></i> Kembali</a>
                          </div>
                      </div>
            </div>
          </div>
        </div>
      </div>
  </div>
</div>
@endsection
