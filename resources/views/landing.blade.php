@extends('layouts.landing.app')

@section('content')
    <!-- Hero Section -->
    <section id="hero" class="hero section">
        <div class="container">
            <div class="row gy-4">
                <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center" data-aos="fade-up">
                    <h1>WELCOME TO SIFOLAB</h1>
                    <p>Sistem Informasi Laboratorium Fakultas Perikanan dan Ilmu Kelautan Universitas Teuku Umar</p>
                    <div class="d-flex" style="margin-bottom: 10px">
                        <a href="{{ route('login') }}" class="btn-get-started mr-3">Login</a>
                        <a class="btn-get-started" style="margin-left: 7px" href="{{ route('register') }}">Register</a>
                    </div>
                </div>
                <div class="col-lg-6 order-1 order-lg-2 hero-img" data-aos="zoom-out" data-aos-delay="100">
                    <img src="{{ asset('landing/assets/img/hero-img.png')}}" class="img-fluid animated" alt="">
                </div>
            </div>
        </div>
    </section><!-- /Hero Section -->

    <!-- Featured Services Section -->
    <section id="featured-services" class="featured-services section py-5">
        <div class="container">
            <div class="row gy-4">
                <!-- Panel 1: SOP Laboratorium -->
                <div class="col-12 col-md-6 col-lg-3 d-flex" data-aos="fade-up" data-aos-delay="100">
                    <div class="service-item position-relative w-100 text-center p-4 bg-light border rounded">
                        <div class="icon mb-3">
                            <i class="bi bi-activity" style="font-size: 2rem; color: #28a745;"></i>
                        </div>
                        <h4 class="mb-2"><a href="{{ route('login') }}" class="stretched-link text-dark">SOP Laboratorium</a></h4>
                        <p class="text-muted">
                            yang terdiri dari SOP praktikum, pemakaian alat, pemakaian ruangan dan lainnya
                        </p>
                        <a href="{{ route('login') }}" class="btn btn-outline-success btn-sm mt-2">Klik Disini</a>
                    </div>
                </div><!-- End Service Item -->

                <!-- Panel 2: Daftar Alat Laboratorium -->
                <div class="col-12 col-md-6 col-lg-3 d-flex" data-aos="fade-up" data-aos-delay="200">
                    <div class="service-item position-relative w-100 text-center p-4 bg-light border rounded">
                        <div class="icon mb-3">
                            <i class="bi bi-bounding-box-circles" style="font-size: 2rem; color: #28a745;"></i>
                        </div>
                        <h4 class="mb-2"><a href="{{ route('daftaralat') }}" class="stretched-link text-dark">Daftar Alat Laboratorium</a></h4>
                        <p class="text-muted">
                            yang terdiri dari berbagai beberapa alat untuk analisis kualitas air, mikrobiologi dan proksimat lengkap
                        </p>
                        <a href="{{ route('daftaralat') }}" class="btn btn-outline-success btn-sm mt-2">Klik Disini</a>
                    </div>
                </div><!-- End Service Item -->

                <!-- Panel 3: Jadwal -->
                <div class="col-12 col-md-6 col-lg-3 d-flex" data-aos="fade-up" data-aos-delay="300">
                    <div class="service-item position-relative w-100 text-center p-4 bg-light border rounded">
                        <div class="icon mb-3">
                            <i class="bi bi-calendar4-week" style="font-size: 2rem; color: #28a745;"></i>
                        </div>
                        <h4 class="mb-2"><a href="#" class="stretched-link text-dark">Jadwal</a></h4>
                        <p class="text-muted">
                            yang terdiri dari data jadwal pemakaian ruangan laboratorium
                        </p>
                    </div>
                </div><!-- End Service Item -->

                <!-- Panel 4: Daftar Peminjaman Alat -->
                <div class="col-12 col-md-6 col-lg-3 d-flex" data-aos="fade-up" data-aos-delay="400">
                    <div class="service-item position-relative w-100 text-center p-4 bg-light border rounded">
                        <div class="icon mb-3">
                            <i class="bi bi-calendar4-week" style="font-size: 2rem; color: #28a745;"></i>
                        </div>
                        <h4 class="mb-2"><a href="#" class="stretched-link text-dark">Daftar Peminjaman Alat</a></h4>
                        <p class="text-muted">
                            yang terdiri dari data alat laboratorium yang sedang digunakan atau sedang dipinjam
                        </p>
                    </div>
                </div><!-- End Service Item -->
            </div>
        </div>
    </section><!-- /Featured Services Section -->
@endsection
