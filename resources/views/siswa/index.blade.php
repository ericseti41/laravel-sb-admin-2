@extends('layouts.admin')

@section('main-content')


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
                    <hr>
                    <a href="{{ route('siswa.create') }}" class="btn btn-md btn-success mb-3"><i class="fa fa-plus"></i> Tambah Data Siswa</a>
                    <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">NO</th>
                                <th scope="col">NAMA</th>
                                <th scope="col">NIK</th>
                                <th scope="col">SEKOLAH</th>
                                <th scope="col">IJAZAH</th>
                                <th scope="col" style="width: 10%">ACTIONS</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($siswas as $siswa)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $siswa->nama }}</td>
                                    <td>{{ $siswa->nik }}</td>
                                    <td>{{ $siswa->sekolah }}</td>
                                    <td><a href="{{ asset('/storage/dokumen/'.$siswa->file) }}" class="btn btn-sm btn-warning">Lihat Dokumen</a></td>
                                    <td class="text-center">
                                        <form onsubmit="return confirm('Apakah Anda Yakin Menghapus Dokumen ini ?');" action="{{ route('siswa.destroy', $siswa->id) }}" method="POST">
                                            <a href="{{ route('siswa.show', $siswa->id) }}" class="btn btn-sm btn-dark"><i class="fas fa-fw fa-eye"></i></a>
                                            <a href="{{ route('siswa.edit', $siswa->id) }}" class="btn btn-sm btn-primary"><i class="fas fa-fw fa-pencil"></i></a>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-fw fa-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <div class="alert alert-danger">
                                    Belum Ada Dokumen.
                                </div>
                            @endforelse
                        </tbody>
                    </table>
                    </div>
                    {{ $siswas->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
