<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Register - Pengaduan Masyarakat</title>
    <link rel="stylesheet" href="{{ asset('assets/css/main/app.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/main/app-dark.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/pages/auth.css') }}" />
    <link rel="shortcut icon" href="{{ asset('/img/logo_kabupaten.png') }}" type="image/x-icon"/>
    <link rel="shortcut icon" href="{{ asset('/img/logo_kabupaten.png') }}" type="image/png" />
</head>

<body>
    <style>
        /* width */
        ::-webkit-scrollbar {
            width: 10px;
        }

        /* Track */
        ::-webkit-scrollbar-track {
            box-shadow: inset 0 0 2px grey;
            border-radius: 8px;
        }

        /* Handle */
        ::-webkit-scrollbar-thumb {
            background: rgb(117, 115, 115);
            border-radius: 8px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: rgb(42, 41, 41)
        }
    </style>
    <script src="assets/js/initTheme.js"></script>
    <div id="auth">
        <div class="row">
            <div class="col-lg-6 col-12">
                <div id="auth-left">
                    <h3 class="auth-title">Daftar</h3>
                    <form action="{{ route('store.register') }}" method="post">
                        @csrf
                        <div class="form-group position-relative has-icon-left mb-3">
                            <input type="number" class="form-control @error('nik')is-invalid @enderror"
                                placeholder="NIK"
                                oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                                maxlength="16" name="nik" />
                            <div class="form-control-icon">
                                <i class="bi bi-person"></i>
                            </div>
                            @error('nik')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        
                        <div class="form-group position-relative has-icon-left mb-3">
                            <input type="text"
                                class="form-control @error('nama')
                            is-invalid
                            @enderror"
                                placeholder="Nama Lengkap" name="nama" />
                            <div class="form-control-icon">
                                <i class="bi bi-person"></i>
                            </div>
                            @error('nama')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group position-relative has-icon-left mb-3">
                            <input type="text"
                                class="form-control @error('username')
                            is-invalid
                            @enderror"
                                placeholder="Username" name="username" />
                            <div class="form-control-icon">
                                <i class="bi bi-person"></i>
                            </div>
                            @error('username')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        
                        <div class="form-group position-relative has-icon-left mb-3">
                            <input type="password"
                                class="form-control @error('password')
                            is-invalid
                            @enderror"
                                placeholder="Password" name="password" />
                            <div class="form-control-icon">
                                <i class="bi bi-shield-lock"></i>
                            </div>
                            @error('password')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        
                        <div class="form-group position-relative has-icon-left mb-3">
                            <input type="number"
                                oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                                maxlength="13" class="form-control @error('telp')is-invalid @enderror" placeholder="Nomor Telepon" name="telp" />
                            <div class="form-control-icon">
                                <i class="bi bi-telephone"></i>
                            </div>
                            @error('telp')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group position-relative has-icon-left mb-3">
                            <select class="form-select" name="jenis_kelamin">
                                <option selected disabled>Pilih Jenis Kelamin</option>
                                <option value="laki-laki">Laki-laki</option>
                                <option value="perempuan">Perempuan</option>
                            </select>
                            @error('jenis_kelamin')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group position-relative has-icon-left mb-3">
                            <textarea class="form-control" name="alamat" rows="3" @error('alamat')is-invalid @enderror placeholder="Alamat Lengkap"></textarea>
                            {{-- <input type="textarea" class="form-control @error('nama')is-invalid @enderror" placeholder="Alamat Lengkap" name="alamat" /> --}}
                            <div class="form-control-icon">
                                <i class="bi bi-house-door"></i>
                            </div>
                            @error('alamat')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <button class="btn btn-primary btn-block shadow-lg">
                            Simpan
                        </button>
                    </form>
                    <div class="text-center mt-3 text-lg fs-6">
                        <p class="text-gray-600">
                            Sudah punya akun?
                            <a href="{{ route('login') }}" class="font-bold">Login</a>.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 d-none d-lg-block">
                <div id="auth-right">
                    <div class="col-12 d-flex justify-content-center">
                        <img class="image-login" src="{{ '../img/register-asset.png' }}" width="500px">
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
