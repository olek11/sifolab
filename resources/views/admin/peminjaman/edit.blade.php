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
                <a href="{{ route('admin.peminjaman') }}" class="btn btn-sm btn-success">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Kembali
                </a>
            </div>
        </div>
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if (isset($peminjaman))
                <form action="{{ route('admin.peminjaman.update', $peminjaman->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT') <!-- Gunakan PUT untuk update -->
                    <div class="row mb-2">
                        <div class="col-xl-6 mb-2">
                            <label class="form-label">
                                <span class="text-danger">*</span> Nama Peminjaman :
                            </label>
                            <input type="text" name="nama_peminjam" class="form-control @error('nama_peminjam') is-invalid @enderror"
                                value="{{ old('nama_peminjam', $peminjaman->nama_peminjam) }}" required>
                            @error('nama_peminjam')
                                <small class="text-danger">{{ $errors->first('nama_peminjam') }}</small>
                            @enderror
                        </div>
                        <div class="col-xl-6 mb-2">
                            <label class="form-label">
                                <span class="text-danger">*</span> No. Identitas :
                            </label>
                            <input type="text" name="nim_nip_nidn" class="form-control @error('nim_nip_nidn') is-invalid @enderror"
                                value="{{ old('nim_nip_nidn', $peminjaman->nim_nip_nidn) }}" required>
                            @error('nim_nip_nidn')
                                <small class="text-danger">{{ $errors->first('nim_nip_nidn') }}</small>
                            @enderror
                        </div>
                        <div class="col-xl-6 mb-2">
                            <label class="form-label">
                                <span class="text-danger">*</span> Jurusan :
                            </label>
                            <input type="text" name="jurusan" class="form-control @error('jurusan') is-invalid @enderror"
                                value="{{ old('jurusan', $peminjaman->jurusan) }}" required>
                            @error('jurusan')
                                <small class="text-danger">{{ $errors->first('jurusan') }}</small>
                            @enderror
                        </div>
                        <div class="col-xl-6 mb-2">
                            <label class="form-label">
                                <span class="text-danger">*</span> No. HP :
                            </label>
                            <input type="text" name="no_hp" class="form-control @error('no_hp') is-invalid @enderror"
                                value="{{ old('no_hp', $peminjaman->no_hp) }}" required>
                            @error('no_hp')
                                <small class="text-danger">{{ $errors->first('no_hp') }}</small>
                            @enderror
                        </div>
                        <div class="col-xl-6 mb-2">
                            <label class="form-label">
                                <span class="text-danger">*</span> Nama Alat :
                            </label>
                            <select name="nama_alat" id="nama_alat" class="form-control" @error('nama_alat') is-invalid @enderror required>
                                @foreach ($alats as $alat)
                                    <option value="{{ $alat->id }}" {{ $peminjaman->nama_alat == $alat->id ? 'selected' : '' }}>
                                        {{ $alat->nama_alat }} ({{ $alat->no_inventaris }})
                                    </option>
                                @endforeach
                            </select>
                            @error('nama_alat')
                                <small class="text-danger">{{ $errors->first('nama_alat') }}</small>
                            @enderror
                        </div>
                        <div class="col-xl-6 mb-2">
                            <label class="form-label">
                                <span class="text-danger">*</span> Jumlah :
                            </label>
                            <input type="number" name="jumlah" class="form-control @error('jumlah') is-invalid @enderror"
                                value="{{ old('jumlah', $peminjaman->jumlah) }}" required>
                            @error('jumlah')
                                <small class="text-danger">{{ $errors->first('jumlah') }}</small>
                            @enderror
                        </div>
                        <div class="col-xl-6 mb-2">
                            <label class="form-label">
                                <span class="text-danger">*</span> Tanggal Peminjaman :
                            </label>
                            <input type="date" name="peminjaman" class="form-control @error('peminjaman') is-invalid @enderror"
                                value="{{ old('peminjaman', $peminjaman->peminjaman) }}" required>
                            @error('peminjaman')
                                <small class="text-danger">{{ $errors->first('peminjaman') }}</small>
                            @enderror
                        </div>
                        <div class="col-xl-6 mb-2">
                            <label class="form-label">
                                <span class="text-danger">*</span> Tanggal Pengembalian :
                            </label>
                            <input type="date" name="pengembalian" class="form-control @error('pengembalian') is-invalid @enderror"
                                value="{{ old('pengembalian', $peminjaman->pengembalian) }}" required>
                            @error('pengembalian')
                                <small class="text-danger">{{ $errors->first('pengembalian') }}</small>
                            @enderror
                        </div>
                        <div class="col-xl-6 mb-2">
                            <label class="form-label">
                                <span class="text-danger">*</span> Keterangan :
                            </label>
                            <input type="text" name="keterangan" class="form-control @error('keterangan') is-invalid @enderror"
                                value="{{ old('keterangan', $peminjaman->keterangan) }}" required>
                            @error('keterangan')
                                <small class="text-danger">{{ $errors->first('keterangan') }}</small>
                            @enderror
                        </div>
                        <div class="col-xl-6 mb-2">
                            <label class="form-label">
                                <span class="text-danger">*</span> Paraf Peminjam :
                            </label>
                                <input type="file" name="paraf_peminjam" id="paraf_peminjam" class="form-control">
                                    @if ($peminjaman->paraf_peminjam)
                                        <small>Paraf saat ini: <a href="{{ asset('storage/' . $peminjaman->paraf_peminjam) }}" target="_blank">Lihat</a></small>
                                    @endif
                            @error('paraf_peminjam')
                                <small class="text-danger">{{ $errors->first('paraf_peminjam') }}</small>
                            @enderror
                        </div>
                        <div class="col-xl-6 mb-2">
                            <label class="form-label">
                                <span class="text-danger">*</span> Paraf Petugas :
                            </label>
                                <input type="file" name="paraf_petugas" id="paraf_petugas" class="form-control">
                                    @if ($peminjaman->paraf_petugas)
                                        <small>Paraf saat ini: <a href="{{ asset('storage/' . $peminjaman->paraf_petugas) }}" target="_blank">Lihat</a></small>
                                    @endif
                            @error('paraf_petugas')
                                <small class="text-danger">{{ $errors->first('paraf_petugas') }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="text-right mb-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save mr-2"></i>
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            @else
                <div class="alert alert-danger">
                    Data peminjaman tidak ditemukan.
                </div>
            @endif
        </div>
    </div>
@endsection
