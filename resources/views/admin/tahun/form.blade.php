@extends('layouts.admin')

@section('content')
<div class="content-wrapper"> 
  <div class="content-header sty-one">
    <h1>Tahun Pengelolaan</h1>
    <ol class="breadcrumb">
      <li><a href="{{ route('admin.home') }}">Home</a></li>
      <li><i class="fa fa-angle-right"></i> Tahun Pengelolaan</li>
    </ol>
  </div>
  
  <div class="content"> 
     <div class="row">
        <div class="col-12">
          <div class="card">
              <div class="card-header bg-blue">
              <h5 class="m-b-0">Form Tahun Pengelolaan</h5>
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
                        <input type="hidden" name="id_tahun_pengelolaan" value="{{ $id_tahun_pengelolaan }}">
                        <button type="submit" class="btn btn-success">{{ $button }}</button>
                        <a href="{{ route('admin.tahun.index') }}" class="btn btn-inverse">Batal</a>
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
