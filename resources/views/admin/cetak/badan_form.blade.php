@extends('layouts.admin')

@section('content')
<div class="content-wrapper"> 
  <div class="content-header sty-one">
    <h1>Cetak SK Badan</h1>
    <ol class="breadcrumb">
      <li><a href="{{ route('admin.home') }}">Home</a></li>
      <li><i class="fa fa-angle-right"></i> Cetak SK Badan</li>
      <li><i class="fa fa-angle-right"></i> Form</li>
    </ol>
  </div>
  
  <div class="content"> 
     <div class="row">
        <div class="col-12">
          <div class="card">
              <div class="card-header bg-blue">
                <h5 class="m-b-0">Form SK Badan</h5>
              </div>
            <div class="card-body">
              <form action="{{ $action }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-lg-4">
                        <fieldset class="form-group">
                        <label>Tahun Pengelolaan @error('tahun_pengelolaan') <span class="text-danger">({{ $message }})</span> @enderror</label>
                        <input type="text" class="form-control" name="tahun_pengelolaan" value="{{ $tahun_pengelolaan }}" required readonly>
                        </fieldset>
                    </div>
                    <div class="col-lg-4">
                        <fieldset class="form-group">
                        <label>Pengelola Badan @error('id_pengelola_badan') <span class="text-danger">({{ $message }})</span> @enderror</label>
                        <select class="form-control" name="id_pengelola_badan" required>
                            <option value="">Pilih Pengelola Badan</option>
                            @foreach($arr_badan as $b)
                              <option value="{{ $b->id_pengelola_badan }}" {{ $id_pengelola_badan == $b->id_pengelola_badan ? 'selected' : '' }}>
                                  {{ $b->nama_badan }} - {{ $b->desa }}
                              </option>
                            @endforeach
                        </select>
                        </fieldset>
                    </div>
                    <div class="col-lg-4">
                        <fieldset class="form-group">
                        <label>Jenis Lokasi @error('jenis_lokasi') <span class="text-danger">({{ $message }})</span> @enderror</label>
                        <select class="form-control" name="jenis_lokasi" required>
                            <option value="Tepi Jalan Umum" {{ $jenis_lokasi == 'Tepi Jalan Umum' ? 'selected' : '' }}>Tepi Jalan Umum</option>
                            <option value="Tempat Khusus Parkir" {{ $jenis_lokasi == 'Tempat Khusus Parkir' ? 'selected' : '' }}>Tempat Khusus Parkir</option>
                        </select>
                        </fieldset>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-4">
                        <fieldset class="form-group">
                        <label>Nama Lokasi / Jalan @error('nama_lokasi') <span class="text-danger">({{ $message }})</span> @enderror</label>
                        <input type="text" class="form-control" name="nama_lokasi" value="{{ $nama_lokasi }}" placeholder="Contoh: Area Parkir Pasar..." required>
                        </fieldset>
                    </div>
                    <div class="col-lg-4">
                        <fieldset class="form-group">
                        <label>Zona @error('zona') <span class="text-danger">({{ $message }})</span> @enderror</label>
                        <select class="form-control" name="zona" required>
                            <option value="Zona A" {{ $zona == 'Zona A' ? 'selected' : '' }}>Zona A</option>
                            <option value="Zona B" {{ $zona == 'Zona B' ? 'selected' : '' }}>Zona B</option>
                            <option value="Zona C" {{ $zona == 'Zona C' ? 'selected' : '' }}>Zona C</option>
                        </select>
                        </fieldset>
                    </div>
                    <div class="col-lg-4">
                        <fieldset class="form-group">
                        <label>Nomor SK @error('no_sk') <span class="text-danger">({{ $message }})</span> @enderror</label>
                        <input type="text" class="form-control" name="no_sk" value="{{ $no_sk }}" placeholder="Format: 551/..." required>
                        </fieldset>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-4">
                        <fieldset class="form-group">
                        <label>Hari Terbit SK @error('hari_sk') <span class="text-danger">({{ $message }})</span> @enderror</label>
                        <select class="form-control" name="hari_sk" required>
                            @foreach(['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'] as $hari)
                              <option value="{{ $hari }}" {{ $hari_sk == $hari ? 'selected' : '' }}>{{ $hari }}</option>
                            @endforeach
                        </select>
                        </fieldset>
                    </div>
                    <div class="col-lg-4">
                        <fieldset class="form-group">
                        <label>Tanggal Terbit SK @error('tgl_sk') <span class="text-danger">({{ $message }})</span> @enderror</label>
                        <input type="date" class="form-control" name="tgl_sk" value="{{ $tgl_sk }}" required>
                        </fieldset>
                    </div>
                    <div class="col-lg-2">
                        <fieldset class="form-group">
                        <label>Retribusi Perbulan @error('retribusi_perbulan') <span class="text-danger">({{ $message }})</span> @enderror</label>
                        <input type="number" class="form-control" name="retribusi_perbulan" value="{{ $retribusi_perbulan }}" placeholder="Angka rupiah" required>
                        </fieldset>
                    </div>
                    <div class="col-lg-2">
                        <fieldset class="form-group">
                        <label>Retribusi Pertahun @error('retribusi_pertahun') <span class="text-danger">({{ $message }})</span> @enderror</label>
                        <input type="number" class="form-control" name="retribusi_pertahun" value="{{ $retribusi_pertahun }}" placeholder="Angka rupiah" required>
                        </fieldset>
                    </div>
                </div>
                
                <div class="row m-t-20">
                    <div class="col-lg-12">
                        <input type="hidden" name="id_sk_badan" value="{{ $id_sk_badan }}">
                        <button type="submit" class="btn btn-success">{{ $button }}</button>
                        <a href="{{ route('admin.cetak.badan') }}" class="btn btn-inverse">Batal</a>
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
