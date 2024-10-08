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
                    <h1 class="h3 mb-4 text-gray-800">{{ __('Data Sekolah') }}</h1>
                    <hr>
                    <button type="button" class="btn btn-md btn-success mb-3" data-toggle="modal" data-target=".bd-example-modal-lg"><i class="fa fa-plus"></i> Tambah Sekolah</button>
                    <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">NO</th>
                                <th scope="col">NPSN</th>
                                <th scope="col">NAMA SEKOLAH</th>
                                <th scope="col" style="width: 15%">ACTIONS</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($sekolahs as $sekolah)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $sekolah->npsn }}</td>
                                    <td>{{ $sekolah->nama_sekolah }}</td>
                                    <td class="text-center">
                                        <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('sekolah.destroy', $sekolah->id) }}" method="POST">
                                            {{-- <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target=".bd-edit-modal-lg"><i class="fas fa-fw fa-pencil"></i></button> --}}
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-fw fa-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <div class="alert alert-danger">
                                    Belum Data Sekolah.
                                </div>
                            @endforelse
                        </tbody>
                    </table>
                    </div>
                    {{ $sekolahs->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h2 class="modal-title" id="exampleModalLabel">Tambah Nama Sekolah</h2>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
        <form action="{{ route('sekolah.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
              <label for="message-text" class="col-form-label">NPSN</label>
              <input type="text" class="form-control" id="recipient-name" placeholder="Masukan NPSN" name="npsn">
            </div>
            <div class="form-group">
              <label for="message-text" class="col-form-label">Nama Sekolah</label>
              <input type="text" class="form-control" id="recipient-name" placeholder="Masukan Nama Sekolah" name="nama_sekolah">
            </div>
            
             <div class="modal-footer">
          <input name="Submit" type="Submit" class="btn btn-primary" value="Simpan">
        </div>

          </form>
        </div>
       
      </div>
    </div>
  </div>
  <div class="modal fade bd-edit-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h2 class="modal-title" id="exampleModalLabel">Edit Nama Sekolah</h2>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
        <form action="{{ route('sekolah.update', $sekolah->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
              <label for="message-text" class="col-form-label">Nama Sekolah</label>
              <input type="text" class="form-control" id="recipient-name" placeholder="Masukan Nama Sekolah" name="nama_sekolah" value="{{ old('nama_sekolah', $sekolah->nama_sekolah) }}">
            </div>
            
             <div class="modal-footer">
          <input name="Submit" type="Submit" class="btn btn-primary" value="Simpan">
        </div>

          </form>
        </div>
       
      </div>
    </div>
  </div>
@endsection
