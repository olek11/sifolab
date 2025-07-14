@extends('layouts.app')
@section('content')
    <h1 class="h3 mb-4 text-gray-800">
        {{-- pada fas fa-user untukmengganti icon --}}
        <i class="fas fa-fw fa-table mr-2"></i>
        {{ $title }}
    </h1>

 <!-- DataTales Example -->
    <div class="card">
        <div class="card-header d-flex flex-wrap justify-content-sm-center
        justify-content-xl-between">
            <div class="mb-1 mr-2">
                <a href="{{ route('admin.alat.create') }}" class="btn btn-sm btn-primary">
                    <i class="fas fa-plus mr-2"></i>
                    Tambah Data
                </a>
            </div>
            <div>
                <a href="{{ route('admin.alat.export.excel') }}" class="btn btn-sm btn-success">
                    <i class="fas fa-file-excel mr-2"></i>
                    Excel
                </a>
                <a href="#" class="btn btn-sm btn-danger">
                    <i class="fas fa-file-pdf mr-2"></i>
                    PDF
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive-md"> <!-- Responsif mulai dari medium (≥768px) -->
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead class="bg-primary text-white">
                        <tr class="text-center">
                            <th class="text-center">No</th>
                            <th class="text-center">Nama Alat</th>
                            <th class="text-center">Tahun Perolehan</th>
                            <th class="text-center">Merek</th>
                            <th class="text-center">No. Inventaris</th>
                            <th class="text-center">Jumlah</th>
                            <th class="text-center">Kondisi</th>
                            <th class="text-center">Penguasaan</th>
                            <th class="text-center">Gambar</th>
                            <th class="text-center">Keterangan</th>
                            <th class="text-center">
                                <i class="fas fa-cog"></i>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($alats as $item)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>{{ $item->nama_alat }}</td>
                                <td>{{ $item->tahun_perolehan ?? '-' }}</td>
                                <td>{{ $item->merk_type ?? '-' }}</td>
                                <td>{{ $item->no_inventaris ?? '-' }}</td>
                                <td class="text-center">{{ $item->jumlah_alat }}</td>
                                <td class="text-center">
                                    @if ($item->kondisi_alat == 'Baik')
                                        <span class="badge badge-success">
                                            {{ $item->kondisi_alat }}
                                        </span>
                                    @elseif ($item->kondisi_alat == 'Rusak Ringan')
                                        <span class="badge badge-warning">
                                            {{ $item->kondisi_alat }}
                                        </span>
                                    @else
                                        <span class="badge badge-danger">
                                            {{ $item->kondisi_alat ?? 'Tidak Diketahui' }}
                                        </span>
                                    @endif
                                </td>
                                <td class="text-center">{{ $item->penggunaan ?? '-' }}</td>
                                <td class="text-center">
                                    @if ($item->gambar_alat)
                                        <img src="{{ asset('storage/' . $item->gambar_alat) }}" alt="Gambar Alat"
                                             class="img-fluid" style="max-width: 100px;">
                                    @else
                                        <span class="badge badge-secondary">Tidak ada gambar</span>
                                    @endif
                                </td>
                                <td class="text-center">{{ $item->keterangan ?? '-' }}</td>
                                <td class="text-center">
                                    <a href="{{ route('admin.alat.edit',$item->id) }}" class="btn btn-sm btn-warning mb-1">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button class="btn btn-sm btn-danger mb-1" data-toggle="modal" data-target="#deleteModal{{ $item->id }}">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                    @include('admin.alat.modal', ['item' => $item])
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
