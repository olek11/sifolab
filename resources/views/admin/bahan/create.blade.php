@extends('layouts.app')
@section('content')
    <h1 class="h3 mb-4 text-gray-800">
        <i class="fas fa-plus mr-2"></i>
        {{ $title }}
    </h1>
 <!-- DataTales Example -->
    <div class="card">
        <div class="card-header d-flex flex-wrap bg-primary">
            <div class="mb-1 mr-2">
                <a href="{{ route('admin.bahan') }}" class="btn btn-sm btn-success">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Kembali
                </a>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.bahan.store')}}" method="POST">
                @csrf
                <div class="row mb-2">
                    <div class="col-xl-6 mb-2">
                        <label class="from-label">
                            <span class="text-danger">*</span>
                            Nama :
                        </label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                        value="{{ old('name') }}">
                        @error('name')
                            <small class="text-danger">
                               {{ $message }}
                            </small>
                        @enderror
                    </div>
                    <div class="col-xl-6 mb-2">
                        <label class="from-label">
                            <span class="text-danger">*</span>
                            Jumlah Bahan :
                        </label>
                        <input type="number" name="jumlah_bahan" class="form-control @error('jumlah_bahan') is-invalid @enderror"
                        value="{{ old('jumlah_bahan') }}">
                        @error('jumlah_bahan')
                            <small class="text-danger">
                               {{ $message }}
                            </small>
                        @enderror
                    </div>
                    <div class="col-xl-6 mb-2">
                        <label class="from-label">
                            <span class="text-danger">*</span>
                            Satuan :
                        </label>
                        <input type="text" name="satuan" class="form-control @error('satuan') is-invalid @enderror"
                        value="{{ old('satuan') }}">
                        @error('satuan')
                            <small class="text-danger">
                                {{ $message }}
                            </small>
                        @enderror
                    </div>
                    <div class="col-xl-6 mb-2">
                        <label class="from-label">
                            Deskripsi :
                        </label>
                        <textarea name="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror"
                        rows="3">{{ old('deskripsi') }}</textarea>
                        @error('deskripsi')
                            <small class="text-danger">
                                {{ $message }}
                            </small>
                        @enderror
                    </div>
                    <div>
                        <button type="submit" class="btn btn-sm btn-primary">
                            <i class="fas fa-save mr-2"></i>
                                Simpan
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

