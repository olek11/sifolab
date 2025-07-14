@extends('layouts.app')
@section('contentuser')
    <h1 class="h3 mb-4 text-gray-800">
        <i class="fas fa-user mr-2"></i>
        {{ $title }}
    </h1>

<!-- DataTales Example -->
    <div class="card">
        <div class="card-header d-flex flex-wrap justify-content-sm-center
        justify-content-xl-between">
            <div class="mb-1 mr-2">
                <a href="{{ route('admin.peminjaman.create') }}" class="btn btn-sm btn-primary">
                    <i class="fas fa-plus mr-2"></i>
                    Tambah Data
                </a>
            </div>
            <div>
                <a href="#" class="btn btn-sm btn-success">
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
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%"
                cellspacing="0">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th>No</th>
                            <th>Nama Peminjam</th>
                            <th>No. Identitas</th>
                            <th>Jurusan</th>
                            <th>No. HP</th>
                            <th>Nama Alat</th>
                            <th>Jumlah</th>
                            <th>Tanggal peminjaman</th>
                            <th>Tanggal Pengembalian</th>
                            <th>Keterangan</th>
                            <th>Paraf Peminjam</th>
                            <th>Paraf Petugas</th>
                            <th>Aksi</th>
                            <th>
                                <i class="fas fa-cog"></i>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($peminjaman_alats as $peminjaman) <!-- Loop menggunakan $peminjaman_alats -->
                            <tr>
                                <td>{{ $peminjaman_alats->firstItem() + $loop->index }}</td>
                                <td>{{ $peminjaman->nama_peminjam }}</td>
                                <td>{{ $peminjaman->nim_nip_nidn }}</td>
                                <td>{{ $peminjaman->jurusan }}</td>
                                <td>{{ $peminjaman->no_hp }}</td>
                                <td>
                                    @if($peminjaman->alat)
                                        {{ $peminjaman->alat->nama_alat }} ({{ $peminjaman->alat->no_inventaris }})
                                    @else
                                        Tidak ada data alat (ID: {{ $peminjaman->nama_alat }})
                                    @endif
                                </td>
                                <td>{{ $peminjaman->jumlah }}</td>
                                <td>{{ $peminjaman->peminjaman }}</td>
                                <td>{{ $peminjaman->pengembalian }}</td>
                                <td>{{ $peminjaman->keterangan }}</td>
                                <td>{{ $peminjaman->paraf_peminjam }}</td>
                                <td>{{ $peminjaman->paraf_petugas }}</td>
                                <td class="text-center">
                                    @if (!$peminjaman->status || $peminjaman->status === 'pending')
                                        <form action="{{ route('admin.peminjaman.approve', $peminjaman->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-success mb-1">
                                                <i class="fas fa-check"></i>
                                            </button>
                                        </form>
                                        <form action="{{ route('admin.peminjaman.reject', $peminjaman->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-secondary mb-1">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </form>
                                    @else
                                        <span class="badge badge-{{ $peminjaman->status === 'approved' ? 'success' : 'danger' }}">
                                            {{ ucfirst($peminjaman->status) }}
                                        </span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('admin.peminjaman.edit', $peminjaman->id) }}" class="btn btn-sm btn-warning mb-1">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button class="btn btn-sm btn-danger mb-1" data-toggle="modal" data-target="#deleteModal{{ $peminjaman->id }}">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                    @include('admin.peminjaman.modal', ['item' => $peminjaman])
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

