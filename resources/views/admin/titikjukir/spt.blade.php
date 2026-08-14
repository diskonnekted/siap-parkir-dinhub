@extends('layouts.admin')

@section('content')
  <div class="content-wrapper"> 
    <div class="content-header sty-one">
      <h1>Titik Juru Parkir</h1>
      <ol class="breadcrumb">
        <li><a href="{{ route('admin.home') }}">Home</a></li>
        <li><i class="fa fa-angle-right"></i> <a href="{{ route('admin.titikjukir.index') }}">Titik Juru Parkir</a></li>
        <li><i class="fa fa-angle-right"></i> Cetak SPT</li>
      </ol>
    </div>
    
    <div class="content"> 
       <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header bg-blue">
                <h5 class="m-b-0">Cetak SPT</h5>
              </div>
              <div class="card-body">
                <form action="{{ $action }}" method="post" enctype="multipart/form-data">
                  @csrf
                  <div class="form-body">
                    <div class="form-group row">
                      <label class="control-label text-right col-md-3">No. SPT @error('no_spt') <span class="text-danger">{{ $message }}</span> @enderror</label>
                      <div class="col-md-9">
                        <input type="text" class="form-control" name="no_spt" value="{{ $no_spt }}" >
                      </div>
                    </div>
                    
                    <div class="form-group row">
                      <label class="control-label text-right col-md-3">TMT SPT Awal @error('tmt_spt_awal') <span class="text-danger">{{ $message }}</span> @enderror</label>
                      <div class="col-md-9">
                        <input type="text" class="form-control" name="tmt_spt_awal" id="tgl" value="{{ $tmt_spt_awal }}" >
                      </div>
                    </div>
                    
                    <div class="form-group row">
                      <label class="control-label text-right col-md-3">TMT SPT Akhir @error('tmt_spt_akhir') <span class="text-danger">{{ $message }}</span> @enderror</label>
                      <div class="col-md-9">
                        <input type="text" class="form-control" name="tmt_spt_akhir" id="tgl1" value="{{ $tmt_spt_akhir }}" >
                      </div>
                    </div>
                    
                    <div class="form-group row">
                      <label class="control-label text-right col-md-3">Tanggal SPT @error('tgl_spt') <span class="text-danger">{{ $message }}</span> @enderror</label>
                      <div class="col-md-9">
                        <input type="text" class="form-control" name="tgl_spt" id="tgl2" value="{{ $tgl_spt }}" >
                      </div>
                    </div>
                    
                    <div class="form-group row">
                      <label class="control-label text-right col-md-3">Setoran Per Bulan @error('setoran_perbulan') <span class="text-danger">{{ $message }}</span> @enderror</label>
                      <div class="col-md-9">
                        <input type="text" class="form-control" name="setoran_perbulan" value="{{ $setoran_perbulan }}" >
                      </div>
                    </div>
                     
                    <div class="form-actions">
                      <div class="row">
                        <div class="col-md-12">
                          <div class="row">
                            <div class="offset-sm-3 col-md-9">
                              <input type="hidden" name="id_titik_jukir" value="{{ $id_titik_jukir }}">
                              <button type="submit" class="btn btn-success">{{ $button }}</button>
                              <a href="{{ route('admin.titikjukir.index') }}" class="btn btn-inverse">Batal</a>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>        
                </form>
              </div>
            </div>
          </div>
        </div>
    </div>
  </div>

  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
  <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@3.2.12/dist/leaflet-routing-machine.css" />
  <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
  <script src="https://unpkg.com/leaflet-routing-machine@3.2.12/dist/leaflet-routing-machine.js"></script>
  <script type="text/javascript">
  document.addEventListener("DOMContentLoaded", function() {
      // Setup datetimepicker for input dates
      $('#tgl, #tgl1, #tgl2').datetimepicker({
          format: 'YYYY-MM-DD'
      });
  });
  </script>
@endsection
