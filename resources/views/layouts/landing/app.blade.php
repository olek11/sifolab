<body class="index-page">
    @include('layouts.landing.header')

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

    <!-- Vendor JS Files via CDN -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.3/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script src="https://unpkg.com/glightbox/dist/js/glightbox.min.js"></script>
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script src="https://unpkg.com/purecounterjs@1/dist/purecounter_vanilla.js"></script>
    <script src="https://unpkg.com/imagesloaded@5/imagesloaded.pkgd.min.js"></script>
    <script src="https://unpkg.com/isotope-layout@3/dist/isotope.pkgd.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/[email protected]/dist/php-email-form/validate.js"></script>

    <!-- Main JS File -->
    <script src="{{ secure_asset('landing/assets/js/main.js') }}"></script>
</body>
</html>
