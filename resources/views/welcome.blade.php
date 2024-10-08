@extends('layouts.app')

@section('main-content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-xl-10 col-lg-12 col-md-9">
            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <div class="row">
                        <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                        <div class="col-lg-6">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">{{ __('Cari Ijazah Anda') }}</h1>
                                </div>

                                @if ($errors->any())
                                    <div class="alert alert-danger border-left-danger" role="alert">
                                        <ul class="pl-4 my-2">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <form method="GET" action="{{ route('cari') }}" class="user">
                                    

                                    <div class="form-group">
                                        <input type="text" class="form-control form-control" name="nama" placeholder="{{ __('Masukan Nama') }}" value="{{ old('nama') }}" required autofocus>
                                    </div>

                                    <div class="form-group">
                                        <input type="text" class="form-control form-control" name="nik" placeholder="{{ __('Masukan NIK') }}" value="{{ old('nik') }}" required>
                                    </div>

                                    <div class="form-group">
                                        <select class="choices form-control form-select @error('jenis_dokumen') is-invalid @enderror" name="sekolah" id="sekolah">
                                            <option value="" hidden>Pilih Asal Sekolah</option>
                                            @foreach($sekolahs as $sekolah)
                                            <option value="{{ old('npsn', $sekolah->npsn) }}">{{ $sekolah->nama_sekolah }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-user btn-block">
                                            {{ __('CARI') }}
                                        </button>
                                    </div>
{{-- 
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="{{ route('login') }}">
                                            {{ __('Login Admin') }}
                                        </a>
                                    </div> --}}

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
