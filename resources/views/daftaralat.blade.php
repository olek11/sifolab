@extends('layouts.landing.app')
@section('content')
    <h1 class="text-center text-3xl font-bold py-6 bg-gray-100"><strong>Daftar Alat Laboratorium</strong></h1>
    <section id="featured-services" class="featured-services section py-5">
        <div class="container">
            <div class="row">
                <!-- Sidebar (Left Column) -->
                <div class="col">
                    @if ($alats->isNotEmpty())
                        <div class="flex-container">
                            @foreach ($alats as $alat)
                                <div class="flex-item" data-aos="fade-up" data-aos-delay="100">
                                    <div class="service-item position-relative w-100 text-center p-4 bg-light border rounded">
                                        <div class="icon mb-3">
                                            @if ($alat->gambar_alat)
                                                <img src="{{ asset('storage/' . $alat->gambar_alat) }}" alt="Gambar Alat" class="img-fluid" style="max-width: 100px;">
                                            @else
                                                <span class="badge badge-secondary">Tidak ada gambar</span>
                                            @endif
                                        </div>
                                        <h4 class="mb-2"><strong>{{ $alat->nama_alat ?? 'Tidak ada' }}</strong></h4>
                                        <h6 class="mb-2 text-start">No. Inventaris : {{ $alat->no_inventaris ?? 'Tidak ada' }}</h6>
                                        <h6 class="mb-2 text-start">Jumlah Alat : {{ $alat->jumlah_alat ?? 'Tidak ada' }}</h6>
                                        <h6 class="mb-2 text-start">Kondisi Alat : {{ $alat->kondisi_alat ?? 'Tidak ada' }}</h6>
                                        <h6 class="mb-2 text-start">Merk/Type : {{ $alat->merk_type ?? 'Tidak ada' }}</h6>
                                        <h6 class="mb-2 text-start">Keterangan : {{ $alat->deskripsi ?? 'Tidak ada' }}</h6>

                                        <a href="{{ route('login') }}" class="btn btn-outline-success btn-sm mt-2">Ajukan Peminjaman</a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-center text-gray-500 text-lg">Belum ada alat yang tersedia saat ini.</p>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection
