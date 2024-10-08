@extends('layouts.app')

@section('main-content')

<div class="container">
    <div class="justify-content-center">
        <div class="p-5">
@if (session('success'))
<div class="alert alert-success border-left-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

@if (session('status'))
    <div class="alert alert-success border-left-success" role="alert">
        {{ session('status') }}
    </div>
@endif
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card border-0 shadow-sm rounded">
                <div class="card-body">
                    <h1 class="h3 mb-4 text-gray-800">{{ __('Data Siswa') }}</h1>
                    <div class="table-responsive">
                    <table class="table table-bordered">
                        <tbody>
                            @forelse ($siswas as $siswa)

                            <table class="table">  
                                                                                
                                <tr>                                                         
                                    <td style="width: 25%">NIK</td>
                                    <td style="width: 1%">:</td>                                                                                    
                                    <td>{{ $siswa->nik }}</td>
                                </tr>
                                <tr>                                                         
                                    <td style="width: 15%">NIS</td>
                                    <td style="width: 1%">:</td>                                                                                    
                                    <td>{{ $siswa->nis }}</td>
                                </tr>
                                <tr>                                                         
                                    <td style="width: 15%">NISN</td>
                                    <td style="width: 1%">:</td>                                                                                    
                                    <td>{{ $siswa->nisn }}</td>
                                </tr>
                                <tr>                                                         
                                    <td>NAMA SISWA</td>
                                    <td>:</td>                                                                                    
                                    <td>{{ $siswa->nama }}</td>
                                </tr>
                                <tr>                                                         
                                    <td>TEMPAT LAHIR</td>
                                    <td>:</td>                                                                                    
                                    <td>{{ $siswa->tempat_lahir }}</td>
                                </tr>
                                <tr>                                                         
                                    <td>TANGGAL LAHIR</td>
                                    <td>:</td>                                                                                    
                                    <td>{{ $siswa->tgl_lahir}}</td>
                                </tr>
                                <tr>                                                         
                                    <td>ASAL SEKOLAH</td>
                                    <td>:</td>                                                                                    
                                    <td>{{ $siswa->sekolah }}</td>
                                </tr>
                                <tr>                                                         
                                    <td>FILE IJAZAH</td>
                                    <td>:</td>                                                                                    
                                    <td><a href="{{ asset('/storage/dokumen/'.$siswa->file) }}" class="btn btn-sm btn-warning">Lihat Dokumen</a></td>
                                </tr>
                            
                                @empty
                                <div class="alert alert-danger">
                                    Data tidak ditemukan.
                                </div>
                            @endforelse

                            </table>
                            <hr>
                        </tbody>
                    </table>
                    <div class="col-12">
                        <div class="float-left">
                            <a href="{{ url('/') }}" class="btn btn-sm btn-dark">KEMBALI</a>
                        </div>
                    </div>
                    </div>



                </div>
            </div>
        </div>
    </div>
</div>
        </div>
    </div>
</div>
@endsection