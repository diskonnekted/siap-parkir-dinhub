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
                <h5 class="m-b-0">Form Juru Parkir</h5>
              </div>
            <div class="card-body">
               <form action="{{ $action }}" method="post" enctype="multipart/form-data">
                 @csrf
                 <h6 class="sub-title">Identitas Pribadi</h6>  
                      <div class="form-group row">
                          <label class="control-label text-right col-md-3">NIK @error('nik') <span class="text-danger">*</span> @enderror</label>
                          <div class="col-md-9">
                              <input type="text" class="form-control" name="nik" placeholder="NIK" value="{{ $nik }}" required>
                          </div>
                      </div>
                      <div class="form-group row">
                          <label class="control-label text-right col-md-3">Nama @error('nama') <span class="text-danger">*</span> @enderror</label>
                          <div class="col-md-9">
                              <input type="text" class="form-control" name="nama" placeholder="Nama" value="{{ $nama }}" required>
                          </div>
                      </div>   
                      <div class="form-group row">
                          <label class="control-label text-right col-md-3">Tempat Lahir</label>
                          <div class="col-md-9">
                              <input type="text" class="form-control" name="tempat_lahir" placeholder="Tempat Lahir" value="{{ $tempat_lahir }}">
                          </div>
                      </div>  
                      <div class="form-group row">
                          <label class="control-label text-right col-md-3">Tanggal Lahir</label>
                          <div class="col-md-9">
                               <input type="date" class="form-control" name="tanggal_lahir" id="tgllhr" placeholder="Tanggal Lahir" value="{{ $tanggal_lahir }}">
                          </div>
                      </div>                   
                      <div class="form-group row">
                          <label class="control-label text-right col-md-3">Jenis Kelamin</label>
                          <div class="col-md-9">
                              <select name="jk" class="form-control">
                                @foreach($arr_jk as $k => $v)
                                  <option value="{{ $k }}" {{ $jk == $k ? 'selected' : '' }}>{{ $v }}</option>
                                @endforeach
                              </select>
                          </div>
                      </div>
                      <div class="form-group row">
                          <label class="control-label text-right col-md-3">Agama</label>
                          <div class="col-md-9">
                              <select name="agama" class="form-control">
                                @foreach($arr_agama as $k => $v)
                                  <option value="{{ $k }}" {{ $agama == $k ? 'selected' : '' }}>{{ $v }}</option>
                                @endforeach
                              </select>
                          </div>
                      </div>
                      <div class="form-group row">
                          <label class="control-label text-right col-md-3">Kewarganegaraan</label>
                          <div class="col-md-9">
                              <select name="kewarganegaraan" class="form-control">
                                @foreach($arr_wn as $k => $v)
                                  <option value="{{ $k }}" {{ $kewarganegaraan == $k ? 'selected' : '' }}>{{ $v }}</option>
                                @endforeach
                              </select>
                          </div>
                      </div>
                      <br>
                 <h6 class="sub-title">Alamat KTP</h6>  
                      <div class="form-group row">
                          <label class="control-label text-right col-md-3">Provinsi</label>
                          <div class="col-md-9">
                              <select name="id_provinsi" class="form-control select2" id="provinsi">
                                @foreach($arr_prov as $k => $v)
                                  <option value="{{ $k }}" {{ $id_provinsi == $k ? 'selected' : '' }}>{{ $v }}</option>
                                @endforeach
                              </select>
                          </div>
                      </div>
                      <div class="form-group row">
                          <label class="control-label text-right col-md-3">Kabupaten</label>
                          <div class="col-md-9">
                              <select name="id_kabupaten" class="form-control select2" id="kabupaten">
                                @foreach($arr_kab as $k => $v)
                                  <option value="{{ $k }}" {{ $id_kabupaten == $k ? 'selected' : '' }}>{{ $v }}</option>
                                @endforeach
                              </select>
                          </div>
                      </div>
                      <div class="form-group row">
                          <label class="control-label text-right col-md-3">Kecamatan</label>
                          <div class="col-md-9">
                              <select name="id_kecamatan" class="form-control select2" id="kecamatan">
                                @foreach($arr_kec as $k => $v)
                                  <option value="{{ $k }}" {{ $id_kecamatan == $k ? 'selected' : '' }}>{{ $v }}</option>
                                @endforeach
                              </select>
                          </div>
                      </div>
                      <div class="form-group row">
                          <label class="control-label text-right col-md-3">Kelurahan/Desa</label>
                          <div class="col-md-9">
                              <select name="id_desa" class="form-control select2" id="desa">
                                @foreach($arr_desa as $k => $v)
                                  <option value="{{ $k }}" {{ $id_desa == $k ? 'selected' : '' }}>{{ $v }}</option>
                                @endforeach
                              </select>
                          </div>
                      </div>
                      <div class="form-group row">
                          <label class="control-label text-right col-md-3">Alamat</label>
                          <div class="col-md-9">
                              <textarea class="form-control" placeholder="Alamat Lengkap" name="alamat">{{ $alamat }}</textarea>
                          </div>
                      </div>
                      <div class="form-group row">
                          <label class="control-label text-right col-md-3">RT/RW</label>
                          <div class="col-md-9">
                              RT <input type="text" class="form-control" style="width:100px; display:inline-block;" name="rt" value="{{ $rt }}">
                              RW <input type="text" class="form-control" style="width:100px; display:inline-block;" name="rw" value="{{ $rw }}">
                          </div>
                      </div>
                 <h6 class="sub-title">Alamat Domisili</h6>  
                      <div class="form-group row">
                          <label class="control-label text-right col-md-3">Provinsi</label>
                          <div class="col-md-9">
                              <select name="domisili_id_provinsi" class="form-control select2" id="provinsi1">
                                @foreach($arr_prov as $k => $v)
                                  <option value="{{ $k }}" {{ $domisili_id_provinsi == $k ? 'selected' : '' }}>{{ $v }}</option>
                                @endforeach
                              </select>
                          </div>
                      </div>
                      <div class="form-group row">
                          <label class="control-label text-right col-md-3">Kabupaten</label>
                          <div class="col-md-9">
                              <select name="domisili_id_kabupaten" class="form-control select2" id="kabupaten1">
                                @foreach($arr_kab as $k => $v)
                                  <option value="{{ $k }}" {{ $domisili_id_kabupaten == $k ? 'selected' : '' }}>{{ $v }}</option>
                                @endforeach
                              </select>
                          </div>
                      </div>
                      <div class="form-group row">
                          <label class="control-label text-right col-md-3">Kecamatan</label>
                          <div class="col-md-9">
                              <select name="domisili_id_kecamatan" class="form-control select2" id="kecamatan1">
                                @foreach($arr_kec as $k => $v)
                                  <option value="{{ $k }}" {{ $domisili_id_kecamatan == $k ? 'selected' : '' }}>{{ $v }}</option>
                                @endforeach
                              </select>
                          </div>
                      </div>
                      <div class="form-group row">
                          <label class="control-label text-right col-md-3">Kelurahan/Desa</label>
                          <div class="col-md-9">
                               <select name="domisili_id_desa" class="form-control select2" id="desa1">
                                @foreach($arr_desa as $k => $v)
                                  <option value="{{ $k }}" {{ $domisili_id_desa == $k ? 'selected' : '' }}>{{ $v }}</option>
                                @endforeach
                              </select>
                          </div>
                      </div>
                      <div class="form-group row">
                          <label class="control-label text-right col-md-3">Alamat</label>
                          <div class="col-md-9">
                               <textarea class="form-control" placeholder="Alamat Lengkap" name="domisili_alamat">{{ $domisili_alamat }}</textarea>
                          </div>
                      </div>
                      <div class="form-group row">
                          <label class="control-label text-right col-md-3">RT/RW</label>
                         <div class="col-md-9">
                          RT <input type="text" class="form-control" style="width:100px; display:inline-block;" name="domisili_rt" value="{{ $domisili_rt }}">
                          RW <input type="text" class="form-control" style="width:100px; display:inline-block;" name="domisili_rw" value="{{ $domisili_rw }}">
                         </div>
                      </div>
                      <div class="form-group row">
                          <label class="control-label text-right col-md-3">No. Telp</label>
                          <div class="col-md-9">
                               <input type="text" class="form-control" name="no_telp" placeholder="No. Telp" value="{{ $no_telp }}">
                          </div>
                      </div>
                      <div class="form-group row">
                          <label class="control-label text-right col-md-3">Foto</label>
                          <div class="col-md-9">
                              <input type="file" class="form-control" name="foto" placeholder="Foto">
                              @if($foto)
                                <a href="{{ asset($foto) }}" target="_blank" class="btn btn-outline-info btn-sm m-t-10">{{ $foto }}</a>
                              @endif
                          </div>
                      </div>
                      <div class="form-group row">
                          <label class="control-label text-right col-md-3">Foto KTP</label>
                          <div class="col-md-9">
                              <input type="file" class="form-control" name="foto_ktp" placeholder="Foto KTP">
                              @if($foto_ktp)
                                <a href="{{ asset($foto_ktp) }}" target="_blank" class="btn btn-outline-info btn-sm m-t-10">{{ $foto_ktp }}</a>
                              @endif
                          </div>
                      </div>
                      <div class="form-actions">
                        <div class="row">
                          <div class="col-md-12">
                            <div class="row">
                              <div class="offset-sm-3 col-md-9">
                                <input type="hidden" name="id_juru_parkir" value="{{ $id_juru_parkir }}">
                                <button type="submit" class="btn btn-success">{{ $button }}</button>
                                <a href="{{ route('admin.pengelola.jukir') }}" class="btn btn-inverse">Batal</a>
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
@endsection
