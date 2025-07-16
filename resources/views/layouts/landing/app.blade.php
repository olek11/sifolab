@include('layouts.landing.header')

<body class="index-page">
    <header id="header" class="header d-flex align-items-center sticky-top">
        <div class="container-fluid container-xl position-relative d-flex align-items-center">
            <a href="{{ route('home')}}" class="logo d-flex align-items-center me-auto">
                <img src="{{ secure_asset('public/landing/img/logo.png')}}" alt="logo">
                <h1 class="sitename">SIFOLAB</h1>
            </a>
            <nav id="navmenu" class="navmenu">
                <ul>
                    <li><a href="{{ route('home')}}" class="active">Home</a></li>
                    <li><a href="{{ route('daftaralat') }}">Daftar Alat</a></li>
                    <li><a href="{{ route('sop') }}">SOP Laboratorium</a></li>
                    <li><a href="#portfolio">Portfolio</a></li>
                    <li><a href="#team">Team</a></li>
                    <li><a href="#contact">Contact</a></li>
                </ul>
                <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
            </nav>
            <nav class="mx-3 flex flex-1 justify-start">
                @auth
                    <a class="btn-getstarted" href="{{ route('DashboardUser') }}">Dashboard</a>
                @else
                    <a class="btn-getstarted" href="{{ route('login') }}">Login</a>
                @endauth
            </nav>
        </div>
    </header>

    <main class="main">
        @yield('content')
    </main>

    <footer id="footer" class="footer">
        <div class="container footer-top">
            <div class="row gy-4">
                <div class="col-lg-4 col-md-6 footer-about">
                    <a href="index.html" class="d-flex align-items-center">
                        <span class="sitename">Laboratorium | developer</span>
                    </a>
                    <div class="footer-contact pt-3">
                        <p>Fakultas Perikanan dan Ilmu Kelautan</p>
                        <p>Univesitas Teuku Umar</p>
                        <p>Jl. Alue Peunyareng | Meulaboh, Aceh Barat</p>
                        <p class="mt-3"><strong>Phone:</strong> <span>081360178635</span></p>
                        <p><strong>Email:</strong> <span>iyan.misbah@utu.ac.com</span></p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12">
                    <h4>Follow Us</h4>
                    <p>Ayo dukung kami melalui sosial media agar lebih dikenal oleh masyarakat luar</p>
                    <div class="social-links d-flex">
                        <a href=""><i class="bi bi-twitter-x"></i></a>
                        <a href=""><i class="bi bi-facebook"></i></a>
                        <a href=""><i class="bi bi-instagram"></i></a>
                        <a href=""><i class="bi bi-linkedin"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="container copyright text-center mt-4">
            <p>© <span>Copyright</span> <strong class="px-1 sitename">Iyan Almisbah</strong> <span>All Rights Reserved</span></p>
            <div class="credits">
                Designed by <a href="https://labsitek.co.id/">Laboratorium Sistek dan Lingkungan Akuakultur</a> Distributed by <a href="https://themewagon.com">SIFOLAB</a>
            </div>
        </div>
    </footer>

    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Preloader -->
    <div id="preloader"></div>

    <!-- Vendor JS Files -->
    <script src="https://cdn.jsdelivr.net/npm/[email protected]/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/[email protected]/dist/php-email-form/validate.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/[email protected]/dist/aos.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/[email protected]/dist/js/glightbox.min.js"></script>
    <script src="https://unpkg.com/purecounterjs@1/dist/purecounter_vanilla.js"></script>
    <script src="https://unpkg.com/imagesloaded@5/imagesloaded.pkgd.min.js"></script>
    <script src="https://unpkg.com/isotope-layout@3/dist/isotope.pkgd.min.js"></script>
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

    <!-- Main JS File -->
    <script src="{{ secure_asset('public/landing/assets/js/main.js')}}"></script>
</body>
</html>
