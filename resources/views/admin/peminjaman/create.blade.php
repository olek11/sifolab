@extends('layouts.app')

@section('content')
    <h1 class="h3 mb-4 text-gray-800">
        <i class="fas fa-plus mr-2"></i>
        {{ $title }}
    </h1>
    <div class="card">
        <div class="card-header d-flex flex-wrap bg-primary">
            <div class="mb-1 mr-2">
                <a href="{{ route('admin.peminjaman') }}" class="btn btn-sm btn-success">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Kembali
                </a>
            </div>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ route('admin.peminjaman.store') }}" method="POST" class="needs-validation" novalidate>
                @csrf
                <div class="row mb-2">
                    <div class="col-xl-6 mb-2">
                        <label class="form-label">
                            <span class="text-danger">*</span> Nama Peminjam :
                        </label>
                        <input type="text" name="nama_peminjam" class="form-control @error('nama_peminjam') is-invalid @enderror"
                               value="{{ old('nama_peminjam') }}" required>
                        @error('nama_peminjam')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-xl-6 mb-2">
                        <label class="form-label">
                            <span class="text-danger">*</span> No. Identitas :
                        </label>
                        <input type="number" name="nim_nip_nidn" class="form-control @error('nim_nip_nidn') is-invalid @enderror"
                               value="{{ old('nim_nip_nidn') }}" required>
                        @error('nim_nip_nidn')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-xl-6 mb-2">
                        <label class="form-label">
                            <span class="text-danger">*</span> Jurusan :
                        </label>
                        <input type="text" name="jurusan" class="form-control @error('jurusan') is-invalid @enderror"
                               value="{{ old('jurusan') }}" required>
                        @error('jurusan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-xl-6 mb-2">
                        <label class="form-label">
                            <span class="text-danger">*</span> No. HP :
                        </label>
                        <input type="number" name="no_hp" class="form-control @error('no_hp') is-invalid @enderror"
                               value="{{ old('no_hp') }}" required>
                        @error('no_hp')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-xl-6 mb-2">
                        <label class="form-label">
                            <span class="text-danger">*</span>
                            Nama Alat :
                        </label>
                        <select name="nama_alat" class="form-control @error('nama_alat') is-invalid @enderror" required>
                            <option value="">Pilih Alat</option>
                            @foreach ($alats as $item)
                                <option value="{{ $item->id }}">{{ $item->nama_alat }} ({{ $item->no_inventaris }})</option>
                            @endforeach
                        </select>
                        @error('nama_alat')
                            <small class="text-danger">
                                {{ $message }}
                            </small>
                        @enderror
                    </div>
                    <div class="col-xl-6 mb-2">
                        <label class="form-label">
                            <span class="text-danger">*</span> Jumlah :
                        </label>
                        <input type="number" name="jumlah" class="form-control @error('jumlah') is-invalid @enderror"
                            value="{{ old('jumlah') }}" min="1" required>
                        @error('jumlah')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-xl-6 mb-2">
                        <label class="form-label">
                            <span class="text-danger">*</span> Tanggal Peminjaman :
                        </label>
                        <input type="date" name="peminjaman" class="form-control @error('peminjaman') is-invalid @enderror"
                               value="{{ old('peminjaman') }}" required>
                        @error('peminjaman')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-xl-6 mb-2">
                        <label class="form-label">
                            <span class="text-danger">*</span> Tanggal Pengembalian :
                        </label>
                        <input type="date" name="pengembalian" class="form-control @error('pengembalian') is-invalid @enderror"
                               value="{{ old('pengembalian') }}" required>
                        @error('pengembalian')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-xl-6 mb-2">
                        <label class="form-label">
                            <span class="text-danger">*</span> Keterangan :
                        </label>
                        <input type="text" name="keterangan" class="form-control @error('keterangan') is-invalid @enderror"
                               value="{{ old('keterangan') }}" required>
                        @error('keterangan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-xl-6 mb-2">
                        <label for="paraf_peminjam" class="form-label">Paraf Peminjam</label>
                        <input type="file" name="paraf_peminjam" class="form-control @error('paraf_peminjam') is-invalid @enderror" accept="image/*" required>
                        @error('paraf_peminjam')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-xl-6 mb-2">
                        <label for="paraf_petugas" class="form-label">Paraf Petugas</label>
                        <input type="file" name="paraf_petugas" class="form-control @error('paraf_petugas') is-invalid @enderror" accept="image/*" required>
                        @error('paraf_petugas')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-sm btn-primary">
                            <i class="fas fa-save mr-2"></i> Simpan
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
