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
                    <h1 class="h3 mb-4 text-gray-800">{{ __('Data Operator') }}</h1>
                    <hr>
                    <a href="{{ route('users.create') }}" class="btn btn-md btn-success mb-3"><i class="fa fa-plus"></i> Tambah Operator</a>
                    <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">NO</th>
                                <th scope="col">NAMA OPERATOR</th>
                                <th scope="col">EMAIL</th>
                                <th scope="col">ASAL SEKOLAH</th>
                                <th scope="col" style="width: 10%">ACTIONS</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($users as $user)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->nama_sekolah }}</td>
                                    <td class="text-center">
                                        <form onsubmit="return confirm('Apakah Anda Yakin Menghapus Dokumen ini ?');" action="{{ route('users.destroy', $user->id) }}" method="POST">
                                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-primary"><i class="fas fa-fw fa-pencil"></i></a>
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
                    {{-- {{ $siswas->links() }} --}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
