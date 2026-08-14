@extends('layouts.admin')

@section('content')
<div class="content-wrapper"> 
  <div class="content-header sty-one">
    <h1>Pejabat</h1>
    <ol class="breadcrumb">
      <li><a href="{{ route('admin.home') }}">Home</a></li>
      <li><i class="fa fa-angle-right"></i> Pejabat</li>
    </ol>
  </div>
  
  <div class="content"> 
     <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header bg-blue">
            <h5 class="m-b-0">Detail Pejabat</h5>
            </div>
            <div class="card-body">
                  <div class="row m-b-10">
                      <div class="text-right col-md-3"><strong>Tahun Pengelolaan :</strong></div>
                      <div class="col-md-9">{{ $row->tahun_pengelolaan }}</div>
                  </div>   
                  <div class="row m-b-10">
                      <div class="text-right col-md-3"><strong>Nama :</strong></div>
                      <div class="col-md-9">{{ $row->nama_pejabat }}</div>
                  </div>  
                  <div class="row m-b-10">
                      <div class="text-right col-md-3"><strong>NIP :</strong></div>
                      <div class="col-md-9">{{ $row->nip_pejabat }}</div>
                  </div> 
                   <div class="row m-b-10">
                      <div class="text-right col-md-3"><strong>Pangkat :</strong></div>
                      <div class="col-md-9">{{ $row->pangkat_pejabat }}</div>
                  </div> 
                  <div class="row m-b-10">
                      <div class="text-right col-md-3"><strong>Active :</strong></div>
                      <div class="col-md-9">{!! $row->actived == 1 ? "<i class='icon-check'></i>" : "<i class='icon-close'></i>" !!}</div>
                  </div> 
                  
                   <div class="row m-t-20">
                      <div class="text-right col-md-3"></div>
                      <div class="col-md-9">
                        <a href="{{ route('admin.pejabat.index') }}" class="btn btn-primary btn-sm"><i class="fa fa-arrow-left"></i> Kembali</a>
                      </div>
                  </div>
            </div>
          </div>
        </div>
      </div>
  </div>
</div>
@endsection
