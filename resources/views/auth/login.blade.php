<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>SIFOLAB - Login</title>

        <!-- Custom fonts for this template-->
        <link href="{{ asset('sbadmin2/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
        <link
            href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
            rel="stylesheet">

        <!-- Custom styles for this template-->
        <link href="{{ asset('sbadmin2/css/sb-admin-2.min.css')}}" rel="stylesheet">

        <link href="{{ asset('css/custom.css') }}" rel="stylesheet">



    </head>
    <!-- Session Status -->
    <body class="mb-4 mt-4" :status="session('status')">
        <div class="container">
            <!-- Outer Row -->
            <div class="row justify-content-center">
                <div class="col-xl-6 col-lg-6 col-md-9">
                    <div class="card o-hidden border-0 shadow-lg my-5">
                        <div class="card-body p-0">
                            <!-- Nested Row within Card Body -->
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="p-5">
                                        <div class="text-center">
                                            <h1 class="h4 text-gray-900 mb-4"><strong> Selamat Datang Kembali...!</strong></h1>
                                            <img src="{{ asset('images/logo.png') }}" alt="Logo" style="max-width: 100px; margin-bottom: 10px;">
                                        </div>
                                        <form class="user" method="POST" action="{{ route('login') }}">
                                            @csrf
                                            <div class="form-group">
                                                <input type="email" class="form-control form-control-user @error('email')
                                                is-invalid @enderror"
                                                    aria-describedby="emailHelp"
                                                    placeholder="Masukkan Email"
                                                    name="email" value="{{ old('email')}}">
                                                @error('email')
                                                    <small class="text-danger">
                                                        {{ $message }}
                                                    </small>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <input type="password" class="form-control form-control-user @error('password')
                                                is-invalid @enderror"
                                                    placeholder="Masukkan Password"
                                                    name="password">
                                                @error('password')
                                                    <small class="text-danger">
                                                        {{ $message }}
                                                    </small>
                                                @enderror
                                            </div>
                                            <button type="submit"
                                                class="btn btn-primary btn-user btn-block">
                                                Login
                                            </button>
                                            {{-- yang dikomen untuk login via ..... --}}
                                            {{-- <hr> --}}
                                            {{-- <a href="#" class="btn btn-google btn-user btn-block">
                                                <i class="fab fa-google fa-fw"></i> Login with Google
                                            </a> --}}
                                            {{-- <a href="#" class="btn btn-facebook btn-user btn-block">
                                                <i class="fab fa-facebook-f fa-fw"></i> Login with Facebook
                                            </a> --}}
                                            {{-- yang dicomen selesai --}}
                                        </form>
                                        <div class="text-center">
                                            <hr>
                                                <small>
                                                    Kembali Ke Beranda ?
                                                    <a href="{{ route('home') }}"> Klik Disini </a>
                                                </small>
                                        </div>
                                        <div class="text-center">
                                            <small>
                                                Belum Punya Akun?
                                                <a href="{{ route('register') }}">Klik Disini</a>
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
                                        {{-- <form method="POST" action="{{ route('login') }}">
                                            @csrf
                                            <!-- Email Address -->
                                            <div>
                                                <x-input-label for="email" :value="__('Email')" />
                                                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                            </div>

                                            <!-- Password -->
                                            <div class="mt-4">
                                                <x-input-label for="password" :value="__('Password')" />

                                                <x-text-input id="password" class="block mt-1 w-full"
                                                                type="password"
                                                                name="password"
                                                                required autocomplete="current-password" />

                                                <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                            </div>

                                            <!-- Remember Me -->
                                            <div class="block mt-4">
                                                <label for="remember_me" class="inline-flex items-center">
                                                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                                                    <span class="ms-2 text-sm text-gray-600">Remember me</span>
                                                </label>
                                            </div>

                                            <div class="flex items-center justify-end mt-4">
                                                @if (Route::has('password.request'))
                                                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                                                        Forgot your password?
                                                    </a>
                                                @endif

                                                <x-primary-button class="ms-3">
                                                    Log in
                                                </x-primary-button>
                                            </div>
                                        </form> --}}


        <!-- Bootstrap core JavaScript-->
        <script src="{{ asset('sbadmin2/vendor/jquery/jquery.min.js')}}"></script>
        <script src="{{ asset('sbadmin2/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

        <!-- Core plugin JavaScript-->
        <script src="{{ asset('sbadmin2/vendor/jquery-easing/jquery.easing.min.js')}}"></script>

        <!-- Custom scripts for all pages-->
        <script src="{{ asset('sbadmin2/js/sb-admin-2.min.js')}}"></script>

        <!-- {{-- script untuk sweetalrt2 --}} -->
            <script src="{{ asset('sweetalert2/dist/sweetalert2.all.min.js') }}"></script>

            @session('success')
                <script>
                    Swal.fire({
                        title: "Selamat Anda Berhasil!",
                        text: "{{ session ('success') }}",
                        icon: "success",
                    });
                </script>
            @endsession
            @session('error')
                <script>
                    Swal.fire({
                        title: "Maaf Anda Gagal!",
                        text: "{{ session ('error') }}",
                        icon: "error",
                    });
                </script>
            @endsession
    </body>
</html>
