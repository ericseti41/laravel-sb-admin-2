@extends('layouts.admin')

@section('main-content')
<div class="container-fluid mb-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card border-0 shadow-sm rounded">
                <div class="card-body">
                    <form action="{{ route('users.update' , $users->id) }}" method="POST" enctype="multipart/form-data">
                        <h1  class="h3 mb-4 text-gray-800">Tambah Data Operator</h1>
                    <hr>
                    
                        @csrf
                        @method('PUT')
                        <div class="row">
                        <div class="col-12">

                        <div class="form-group mb-3">
                            <label class="font-weight-bold">NAMA</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name' ,$users->name) }}" placeholder="Masukkan Nama Operator">
                        
                            <!-- error message untuk title -->
                            @error('nama')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label class="font-weight-bold">EMAIL</label>
                            <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email',$users->email) }}" placeholder="Masukkan Username">
                        
                            <!-- error message untuk title -->
                            @error('email')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label class="font-weight-bold">ASAL SEKOLAH</label>
                            <select class="choices form-control form-select @error('jenis_dokumen') is-invalid @enderror" name="npsn" id="npsn">
                                <option value="{{ old('npsn', $users->npsn) }}">{{ old('nama_sekolah', $users->nama_sekolah) }}</option>
                                @foreach($sekolahs as $sekolah)
                                <option value="{{ old('npsn', $sekolah->npsn) }}">{{ $sekolah->nama_sekolah }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="font-weight-bold">PASSWORD</label>
                            <input type="password" class="form-control form-control-user" name="password" placeholder="{{ __('Password') }}">
                        </div>

                        <div class="form-group">
                            <label class="font-weight-bold">KONFIRMASI PASSWORD</label>
                            <input type="password" class="form-control form-control-user" name="password_confirmation" placeholder="{{ __('Confirm Password') }}">
                        </div>

                    <div class="col-12">
                        <div class="float-right">
                            <button type="submit" class="btn btn-md btn-primary me-3">SIMPAN</button>
                            <button type="reset" class="btn btn-md btn-warning">RESET</button>
                        </div>
                    </div>

                    </form> 
                </div>
            </div>
        </div>
    </div>
</div>
@endsection