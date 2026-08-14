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
              <h5 class="m-b-0">Form Pejabat</h5>
              </div>
            <div class="card-body">
              <form action="{{ $action }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-lg-12">
                        <fieldset class="form-group">
                        <label>Tahun Pengelolaan @error('tahun_pengelolaan') <span class="text-danger">({{ $message }})</span> @enderror</label>
                        <input type="text" class="form-control" name="tahun_pengelolaan" value="{{ $tahun_pengelolaan }}" required>
                        </fieldset>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <fieldset class="form-group">
                        <label>Nama Pejabat @error('nama_pejabat') <span class="text-danger">({{ $message }})</span> @enderror</label>
                        <input type="text" class="form-control" name="nama_pejabat" value="{{ $nama_pejabat }}" required>
                        </fieldset>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <fieldset class="form-group">
                        <label>NIP Pejabat @error('nip_pejabat') <span class="text-danger">({{ $message }})</span> @enderror</label>
                        <input type="text" class="form-control" name="nip_pejabat" value="{{ $nip_pejabat }}">
                        </fieldset>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <fieldset class="form-group">
                        <label>Pangkat Pejabat @error('pangkat_pejabat') <span class="text-danger">({{ $message }})</span> @enderror</label>
                        <input type="text" class="form-control" name="pangkat_pejabat" value="{{ $pangkat_pejabat }}">
                        </fieldset>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <input type="hidden" name="id_pejabat" value="{{ $id_pejabat }}">
                        <button type="submit" class="btn btn-success">{{ $button }}</button>
                        <a href="{{ route('admin.pejabat.index') }}" class="btn btn-inverse">Batal</a>
                    </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
  </div>
</div>
@endsection
