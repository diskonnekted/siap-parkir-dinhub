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
              <h5 class="m-b-0">Form Users</h5>
              </div>
            <div class="card-body">
              <form action="{{ $action }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-lg-4">
                        <fieldset class="form-group">
                        <label>Username @error('username') <span class="text-danger">({{ $message }})</span> @enderror</label>
                        <input type="text" class="form-control" name="username" value="{{ $username }}" required>
                        </fieldset>
                    </div>
                    <div class="col-lg-4">
                        <fieldset class="form-group">
                        <label>Email @error('email') <span class="text-danger">({{ $message }})</span> @enderror</label>
                        <input type="email" class="form-control" name="email" value="{{ $email }}" required>
                        </fieldset>
                    </div>
                     <div class="col-lg-4">
                        <fieldset class="form-group">
                        <label>Nama @error('nama') <span class="text-danger">({{ $message }})</span> @enderror</label>
                        <input type="text" class="form-control" name="nama" value="{{ $nama }}" required>
                        </fieldset>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4">
                        <fieldset class="form-group">
                        <label>Password @error('password') <span class="text-danger">({{ $message }})</span> @enderror</label>
                        <input type="password" class="form-control" name="password" {{ $button == 'Tambah' ? 'required' : '' }}>
                        </fieldset>
                    </div>
                    <div class="col-lg-4">
                        <fieldset class="form-group">
                        <label>Konfirmasi Password @error('passwordconf') <span class="text-danger">({{ $message }})</span> @enderror</label>
                        <input type="password" class="form-control" name="passwordconf" {{ $button == 'Tambah' ? 'required' : '' }}>
                        </fieldset>
                    </div>
                </div>
                
                <div class="row m-t-20">
                    <div class="col-lg-12">
                        <input type="hidden" name="id_users" value="{{ $id_users }}">
                        <button type="submit" class="btn btn-success">{{ $button }}</button>
                        <a href="{{ route('admin.users.index') }}" class="btn btn-inverse">Batal</a>
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
