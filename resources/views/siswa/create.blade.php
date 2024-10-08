@extends('layouts.admin')

@section('main-content')
<div class="container-fluid mb-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card border-0 shadow-sm rounded">
                <div class="card-body">
                    <form action="{{ route('siswa.store') }}" method="POST" enctype="multipart/form-data">
                        <h1  class="h3 mb-4 text-gray-800">Tambah Data Siswa</h1>
                    <hr>
                    
                        @csrf
                        <div class="row">
                        <div class="col-12">
                        <div class="form-group mb-3">
                            <label class="font-weight-bold">NIK</label>
                            <input type="text" class="form-control @error('nik') is-invalid @enderror" name="nik" value="{{ old('nik') }}" placeholder="Masukkan NIK">
                        
                            <!-- error message untuk title -->
                            @error('nik')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label class="font-weight-bold">NIS</label>
                            <input type="text" class="form-control @error('nis') is-invalid @enderror" name="nis" value="{{ old('nis') }}" placeholder="Masukkan NIS">
                        
                            <!-- error message untuk title -->
                            @error('nis')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label class="font-weight-bold">NISN</label>
                            <input type="text" class="form-control @error('nisn') is-invalid @enderror" name="nisn" value="{{ old('nisn') }}" placeholder="Masukkan NISN">
                        
                            <!-- error message untuk title -->
                            @error('nisn')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label class="font-weight-bold">NAMA</label>
                            <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" value="{{ old('nama') }}" placeholder="Masukkan Nama Siswa">
                        
                            <!-- error message untuk title -->
                            @error('nama')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label class="font-weight-bold">TEMPAT LAHIR</label>
                            <input type="text" class="form-control @error('tempat_lahir') is-invalid @enderror" name="tempat_lahir" value="{{ old('tempat_lahir') }}" placeholder="Masukkan Tempat Lahir">
                        
                            <!-- error message untuk title -->
                            @error('tempat_lahir')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label class="font-weight-bold">TANGGAL LAHIR</label>
                            <input type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror" placeholder="dd/mm/yyyy" name="tgl_lahir">
                        
                            <!-- error message untuk title -->
                            @error('tanggal_lahir')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label class="font-weight-bold">NAMA IBU KANDUNG</label>
                            <input type="text" class="form-control @error('ibu') is-invalid @enderror" name="ibu" value="{{ old('ibu') }}" placeholder="Masukkan Nama Ibu Kandung">
                        
                            <!-- error message untuk title -->
                            @error('ibu')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        @if(\Auth::user()->email == 'admin')
                        <div class="form-group mb-3">
                            <label class="font-weight-bold">ASAL SEKOLAH</label>
                            <select class="choices form-control form-select @error('npsn') is-invalid @enderror" name="npsn" id="npsn">
                                <option value="" hidden>Pilih Asal Sekolah</option>
                                @foreach($sekolahs as $sekolah)
                                <option value="{{ old('npsn', $sekolah->npsn) }}">{{ $sekolah->nama_sekolah }}</option>
                                @endforeach
                            </select>
                            @error('npsn')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        @else
                        <div class="form-group mb-3">
                            <label class="font-weight-bold">ASAL SEKOLAH</label>
                            <select class="choices form-control form-select @error('npsn') is-invalid @enderror" name="npsn" id="npsn" disabled>
                                @foreach($siswas as $siswa)
                                <option value="{{ old('sekolah', $siswa->sekolah) }}">{{ $siswa->sekolah }}</option>
                                @endforeach
                            </select>
                                                        <!-- error message untuk image -->
                            @error('npsn')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        @endif

                        <div class="form-group mb-3">
                            <label class="font-weight-bold">UPLOAD FILE IJAZAH <code>*pdf</code></label>
                            <input type="file" accept="application/pdf" class="form-control @error('file') is-invalid @enderror" name="file">
                        
                            <!-- error message untuk image -->
                            @error('file')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
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