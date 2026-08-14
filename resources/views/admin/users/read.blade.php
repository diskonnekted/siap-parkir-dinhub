@extends('layouts.admin')

@section('content')
<div class="content-wrapper"> 
  <div class="content-header sty-one">
    <h1>Users</h1>
    <ol class="breadcrumb">
      <li><a href="{{ route('admin.home') }}">Home</a></li>
      <li><i class="fa fa-angle-right"></i> Users</li>
    </ol>
  </div>
  
  <div class="content"> 
     <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header bg-blue">
            <h5 class="m-b-0">Detail Users</h5>
            </div>
            <div class="card-body">
                  <div class="row m-b-10">
                      <div class="text-right col-md-3"><strong>Username :</strong></div>
                      <div class="col-md-9">{{ $row->username }}</div>
                  </div>   
                  <div class="row m-b-10">
                      <div class="text-right col-md-3"><strong>Email :</strong></div>
                      <div class="col-md-9">{{ $row->email }}</div>
                  </div>
                  <div class="row m-b-10">
                      <div class="text-right col-md-3"><strong>Nama :</strong></div>
                      <div class="col-md-9">{{ $row->nama }}</div>
                  </div>  
                  <div class="row m-b-10">
                      <div class="text-right col-md-3"><strong>Level :</strong></div>
                      <div class="col-md-9">{{ $row->level }}</div>
                  </div> 
                  <div class="row m-b-10">
                      <div class="text-right col-md-3"><strong>Active :</strong></div>
                      <div class="col-md-9">{!! $row->actived == 1 ? "<i class='icon-check'></i>" : "<i class='icon-close'></i>" !!}</div>
                  </div> 
                   <div class="row m-b-10">
                      <div class="text-right col-md-3"><strong>Last Login :</strong></div>
                      <div class="col-md-9">{{ $row->last_login }}</div>
                  </div> 
                  
                   <div class="row m-t-20">
                      <div class="text-right col-md-3"></div>
                      <div class="col-md-9">
                        <a href="{{ route('admin.users.index') }}" class="btn btn-primary btn-sm"><i class="fa fa-arrow-left"></i> Kembali</a>
                      </div>
                  </div>
            </div>
          </div>
        </div>
      </div>
  </div>
</div>
@endsection
