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
            <a href="{{ route('admin.alat') }}" class="btn btn-sm btn-success">
                <i class="fas fa-arrow-left mr-2"></i>
                Kembali
            </a>
        </div>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.alat.update', $alat->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row mb-2">
                <div class="col-xl-6 mb-2">
                    <label class="form-label">
                        <span class="text-danger">*</span>
                        Nama Alat:
                    </label>
                    <input type="text" name="nama_alat" class="form-control @error('nama_alat') is-invalid @enderror" value="{{ old('nama_alat', $alat->nama_alat) }}">
                    @error('nama_alat')
                        <small class="text-danger">
                            {{ $message }}
                        </small>
                    @enderror
                </div>
                <div class="col-xl-6 mb-2">
                    <label class="form-label">
                        <span class="text-danger">*</span>
                        No. Inventaris:
                    </label>
                    <input type="text" name="no_inventaris" class="form-control @error('no_inventaris') is-invalid @enderror" value="{{ old('no_inventaris', $alat->no_inventaris) }}">
                    @error('no_inventaris')
                        <small class="text-danger">
                            {{ $message }}
                        </small>
                    @enderror
                </div>
                <div class="col-xl-6 mb-2">
                    <label class="form-label">
                        <span class="text-danger">*</span>
                        Jumlah Alat:
                    </label>
                    <input type="number" name="jumlah_alat" class="form-control @error('jumlah_alat') is-invalid @enderror" value="{{ old('jumlah_alat', $alat->jumlah_alat) }}">
                    @error('jumlah_alat')
                        <small class="text-danger">
                            {{ $message }}
                        </small>
                    @enderror
                </div>
                <div class="col-xl-6 mb-2">
                    <label class="form-label">
                        Kondisi Alat:
                    </label>
                    <select name="kondisi_alat" class="form-control @error('kondisi_alat') is-invalid @enderror">
                        <option value="" disabled>--Pilih Kondisi--</option>
                        <option value="Baik" {{ old('kondisi_alat', $alat->kondisi_alat) == 'Baik' ? 'selected' : '' }}>Baik</option>
                        <option value="Rusak Ringan" {{ old('kondisi_alat', $alat->kondisi_alat) == 'Rusak Ringan' ? 'selected' : '' }}>Rusak Ringan</option>
                        <option value="Rusak Berat" {{ old('kondisi_alat', $alat->kondisi_alat) == 'Rusak Berat' ? 'selected' : '' }}>Rusak Berat</option>
                    </select>
                    @error('kondisi_alat')
                        <small class="text-danger">
                            {{ $message }}
                        </small>
                    @enderror
                </div>
                <div class="col-xl-6 mb-2">
                    <label class="form-label">
                        Merek/Type:
                    </label>
                    <input type="text" name="merk_type" class="form-control @error('merk_type') is-invalid @enderror" value="{{ old('merk_type', $alat->merk_type) }}">
                    @error('merk_type')
                        <small class="text-danger">
                            {{ $message }}
                        </small>
                    @enderror
                </div>
                <div class="col-xl-6 mb-2">
                    <label class="form-label">
                        Tahun Perolehan:
                    </label>
                    <input type="number" name="tahun_perolehan" class="form-control @error('tahun_perolehan') is-invalid @enderror" value="{{ old('tahun_perolehan', $alat->tahun_perolehan) }}" min="1900" max="2099" step="1">
                    @error('tahun_perolehan')
                        <small class="text-danger">
                            {{ $message }}
                        </small>
                    @enderror
                </div>
                <div class="col-xl-6 mb-2">
                    <label class="form-label">
                        Penguasaan:
                    </label>
                    <input type="text" name="penguasaan" class="form-control @error('penguasaan') is-invalid @enderror" value="{{ old('penguasaan', $alat->penguasaan) }}">
                    @error('penguasaan')
                        <small class="text-danger">
                            {{ $message }}
                        </small>
                    @enderror
                </div>
                <div class="col-xl-6 mb-2">
                    <label class="form-label">
                        Gambar Alat:
                    </label>
                    <input type="file" name="gambar_alat" class="form-control @error('gambar_alat') is-invalid @enderror">
                    @error('gambar_alat')
                        <small class="text-danger">
                            {{ $message }}
                        </small>
                    @enderror
                </div>
                <div class="col-xl-12 mb-2">
                    <label class="form-label">
                        Keterangan:
                    </label>
                    <textarea name="keterangan" class="form-control @error('keterangan') is-invalid @enderror">{{ old('keterangan', $alat->keterangan) }}</textarea>
                    @error('keterangan')
                        <small class="text-danger">
                            {{ $message }}
                        </small>
                    @enderror
                </div>
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

