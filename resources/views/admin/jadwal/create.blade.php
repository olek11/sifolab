@extends('layouts.app')

@section('content')
    <h1 class="h3 mb-4 text-gray-800">
        <i class="fas fa-plus mr-2"></i>
        {{ $title }}
    </h1>
    <div class="card">
        <div class="card-header d-flex flex-wrap bg-primary">
            <div class="mb-1 mr-2">
                <a href="{{ route('admin.jadwal') }}" class="btn btn-sm btn-success">
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
            <form action="{{ route('admin.jadwal.store') }}" method="POST" class="needs-validation" novalidate>
                @csrf
                <div class="row mb-2">
                    <div class="col-xl-6 mb-2">
                        <label class="form-label">
                            <span class="text-danger">*</span> Jenis Kegiatan :
                        </label>
                        <input type="text" name="jenis_kegiatan" class="form-control @error('jenis_kegiatan') is-invalid @enderror"
                               value="{{ old('jenis_kegiatan') }}" required>
                        @error('jenis_kegiatan')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-xl-6 mb-2">
                        <label class="form-label">
                            <span class="text-danger">*</span> Judul/Mata Kuliah :
                        </label>
                        <input type="text" name="judul_kegiatan" class="form-control @error('judul_kegiatan') is-invalid @enderror"
                               value="{{ old('judul_kegiatan') }}" required>
                        @error('judul_kegiatan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-xl-6 mb-2">
                        <label class="form-label">
                            <span class="text-danger">*</span> Hari/Tanggal Mulai :
                        </label>
                        <input type="date" name="hari_tanggal_mulai" class="form-control @error('hari_tanggal_mulai') is-invalid @enderror"
                               value="{{ old('hari_tanggal_mulai') }}" required>
                        @error('hari_tanggal_mulai')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-xl-6 mb-2">
                        <label class="form-label">
                            <span class="text-danger">*</span> Hari/Tanggal Selesai :
                        </label>
                        <input type="date" name="hari_tanggal_selesai" class="form-control @error('hari_tanggal_selesai') is-invalid @enderror"
                               value="{{ old('hari_tanggal_selesai') }}" required>
                        @error('hari_tanggal_selesai')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-xl-6 mb-2">
                        <label class="form-label">
                            <span class="text-danger">*</span> Jam Mulai :
                        </label>
                        <input type="time" name="jam_mulai" class="form-control @error('jam_mulai') is-invalid @enderror"
                               value="{{ old('jam_mulai') }}" required>
                        @error('jam_mulai')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-xl-6 mb-2">
                        <label class="form-label">
                            <span class="text-danger">*</span> Jam Selesai :
                        </label>
                        <input type="time" name="jam_selesai" class="form-control @error('jam_selesai') is-invalid @enderror"
                               value="{{ old('jam_selesai') }}" required>
                        @error('jam_selesai')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-xl-6 mb-2">
                        <label class="form-label">
                            <span class="text-danger">*</span> Penanggung Jawab :
                        </label>
                        <input type="text" name="penanggung_jawab" class="form-control @error('penanggung_jawab') is-invalid @enderror"
                               value="{{ old('penanggung_jawab') }}" required>
                        @error('penanggung_jawab')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-xl-6 mb-2">
                        <label class="form-label">Asisten Penanggung Jawab :</label>
                        <input type="text" name="asisten_penanggung_jawab" class="form-control @error('asisten_penanggung_jawab') is-invalid @enderror"
                               value="{{ old('asisten_penanggung_jawab') }}">
                        @error('asisten_penanggung_jawab')
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
