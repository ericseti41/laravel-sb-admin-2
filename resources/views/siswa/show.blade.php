@extends('layouts.admin')

@section('main-content')

    <div class="container-fluid mb-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <h1  class="h3 mb-4 text-gray-800">Detail Siswa</h1>
                            <table class="table">  
                                                                                
                                <tr>                                                         
                                    <td style="width: 15%">NIK</td>
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
                                    <td>NAMA IBU KANDUNG</td>
                                    <td>:</td>                                                                                    
                                    <td>{{ $siswa->ibu }}</td>
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
                            </table>
                            <hr>
                            <div class="col-12">
                                <div class="float-right">
                                    <a href="{{ route('siswa.index') }}" class="btn btn-sm btn-dark">TUTUP</a>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
