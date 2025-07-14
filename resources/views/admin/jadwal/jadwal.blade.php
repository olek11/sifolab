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
                <a href="{{ route('admin.jadwal.create') }}" class="btn btn-sm btn-primary">
                    <i class="fas fa-plus mr-2"></i>
                    Tambah Data
                </a>
            </div>
            <div>
                <a href="{{ route('admin.jadwal.export.excel') }}" class="btn btn-sm btn-success">
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
                        <tr class="text-center" mb-2>
                            <th>No</th>
                            <th>Jenis Kegiatan</th>
                            <th>Judul/Mata Kuliah</th>
                            <th>Mulai</th>
                            <th>Selesai</th>
                            <th>Jam Masuk</th>
                            <th>Jam Selesai</th>
                            <th>Penanggung Jawab</th>
                            <th>Asisten Penanggung Jawab</th>
                            <th>Action</th>
                            <th>
                                <i class="fas fa-cog"></i>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($jadwals as $item)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td class="text-center">{{ $item->jenis_kegiatan }}</td> <!-- Perbaiki nama kolom -->
                                <td class="text-center">{{ $item->judul_kegiatan }}</td>
                                <td class="text-center">{{ \Carbon\Carbon::parse($item->hari_tanggal_mulai)->isoFormat('dddd, D MMMM YYYY') }}</td>
                                <td class="text-center">{{ \Carbon\Carbon::parse($item->hari_tanggal_selesai)->isoFormat('dddd, D MMMM YYYY') }}</td>
                                <td class="text-center">{{ \Carbon\Carbon::parse($item->jam_mulai)->isoFormat('HH:mm') }} WIB</td>
                                <td class="text-center">{{ \Carbon\Carbon::parse($item->jam_selesai)->isoFormat('HH:mm') }} WIB</td>
                                <td class="text-center">{{ $item->penanggung_jawab }}</td>
                                <td class="text-center">{{ $item->asisten_penanggung_jawab ?? 'N/A' }}</td> <!-- Perbaiki nama kolom -->
                                <td class="text-center">
                                    @if (!$item->status || $item->status === 'pending')
                                        <form action="{{ route('admin.jadwal.approve', $item->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-success mb-1">
                                                <i class="fas fa-check"></i>
                                            </button>
                                        </form>
                                        <form action="{{ route('admin.jadwal.reject', $item->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-secondary mb-1">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </form>
                                    @else
                                        <span class="badge badge-{{ $item->status === 'approved' ? 'success' : 'danger' }}">
                                            {{ ucfirst($item->status) }}
                                        </span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('admin.jadwal.edit',$item->id) }}" class="btn btn-sm btn-warning mb-1">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button class="btn btn-sm btn-danger mb-1" data-toggle="modal" data-target="#deleteModal{{ $item->id }}">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                    @include('admin.jadwal.modal', ['item' => $item])
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

