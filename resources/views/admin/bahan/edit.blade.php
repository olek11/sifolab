@extends('layouts.app')
@section('content')
<h1 class="h3 mb-4 text-gray-800">
    <i class="fas fa-edit mr-2"></i>
    {{ $title }}
</h1>
<!-- DataTales Example -->
<div class="card">
    <div class="card-header d-flex flex-wrap bg-warning">
        <div class="mb-1 mr-2">
            <a href="{{ route('admin.bahan') }}" class="btn btn-sm btn-success">
                <i class="fas fa-arrow-left mr-2"></i>
                Kembali
            </a>
        </div>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.bahan.update', $bahan->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row mb-2">
                <div class="col-xl-6 mb-2">
                    <label class="form-label">
                        <span class="text-danger">*</span>
                        Nama Bahan:
                    </label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $bahan->name) }}">
                    @error('name')
                        <small class="text-danger">
                            {{ $message }}
                        </small>
                    @enderror
                </div>
                <div class="col-xl-6 mb-2">
                    <label class="form-label">
                        <span class="text-danger">*</span>
                        Jumlah Bahan:
                    </label>
                    <input type="number" name="jumlah_bahan" class="form-control @error('jumlah_bahan') is-invalid @enderror" value="{{ old('jumlah_bahan', $bahan->jumlah_bahan) }}">
                    @error('jumlah_bahan')
                        <small class="text-danger">
                            {{ $message }}
                        </small>
                    @enderror
                </div>
                <div class="col-xl-6 mb-2">
                    <label class="form-label">
                        <span class="text-danger">*</span>
                        Satuan:
                    </label>
                    <input type="text" name="satuan" class="form-control @error('satuan') is-invalid @enderror" value="{{ old('satuan', $bahan->satuan) }}">
                    @error('satuan')
                        <small class="text-danger">
                            {{ $message }}
                        </small>
                    @enderror
                </div>
                <div class="col-xl-6 mb-2">
                    <label class="form-label">
                        Deskripsi:
                    </label>
                    <textarea name="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror">{{ old('deskripsi', $bahan->deskripsi) }}</textarea>
                    @error('deskripsi')
                        <small class="text-danger">
                            {{ $message }}
                        </small>
                    @enderror
                </div>
            <div class="text-right  mb-2">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save mr-2"></i>
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

