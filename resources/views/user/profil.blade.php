@extends('layouts.app')

@section('title', 'Pengaturan User')

@section('contents')
    <section class="row">
        <div class="col-12 col-lg-12">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h4>Profil User</h4>
                            
                        </div>

                        <div class="card-body">
                            @if ($message = Session::get('success'))
                                <div class="alert alert-success alert-dismissible show fade">
                                    {{ $message }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif
                            @if ($message = Session::get('error'))
                                <div class="alert alert-danger alert-dismissible show fade">
                                    {{ $message }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif
                            <form action="{{ route('user.update_profil') }}" method="post" class="form-profil"
                                data-toggle="validator" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-4">
                                        <label>Nama</label>
                                    </div>

                                    <div class="col-md-8 form-group">
                                        <input type="text" name="name" id="name" placeholder="Nama User"
                                            class="form-control" value="{{ $profil->name }}" oninput="onlyText(this)">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label>Foto</label>
                                    </div>

                                    <div class="col-md-8 form-group">
                                        <input type="file" name="foto" id="foto" placeholder="foto"
                                            class="form-control">
                                        <br>
                                        <div class="tampil-foto">
                                            <img src="{{ url($profil->foto ?? '/') }}" width="200">
                                        </div>
                                    </div>


                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <label>Password Lama</label>
                                    </div>

                                    <div class="col-md-8 form-group">
                                        <div class="input-group">
                                            <input type="password" name="old_password" id="old_password"
                                                placeholder="Password" class="form-control" minlength="6">
                                            <a class="btn icon btn-secondary" onclick="myFunction('old_password')">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label>Password Baru</label>
                                    </div>

                                    <div class="col-md-8 form-group">
                                        <div class="input-group">
                                            <input type="password" name="password" id="password" placeholder="Password"
                                                class="form-control" minlength="6">
                                            <a class="btn icon btn-secondary" onclick="myFunction('password')">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label>Konfirmasi Password</label>
                                    </div>

                                    <div class="col-md-8 form-group">
                                        <div class="input-group">
                                            <input type="password" name="password_confirmation" id="password_confirmation"
                                                placeholder="Password" class="form-control" data-match='#password'>
                                            <a class="btn icon btn-secondary" onclick="myFunction('password_confirmation')">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary me-1 mb-1">
                                        <i class="bx bx-check d-block d-sm-none"></i>
                                        <span class="d-none d-sm-block submit-text">Submit</span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </section>

@endsection
@push('scripts')
    <script>
        $(function() {
            $('#old_password').on('keyup', function() {
                if ($(this).val() != "") $('#password, #password_confirmation').attr('required', true);
                else $('#password, #password_confirmation').attr('required', false);
            });

            $('.form-profil').validator().on('submit', function(e) {
                if (!e.preventDefault()) {
                    $.ajax({
                            url: $('.form-profil').attr('action'),
                            type: $('.form-profil').attr('method'),
                            data: new FormData($('.form-profil')[0]),
                            async: false,
                            processData: false,
                            contentType: false
                        })
                        .done(response => {
                            $('[name=name]').val(response.name);
                            $('.tampil-foto').html(
                                `<img src="{{ url('/') }}${response.foto}" width="200">`);
                            $('.img-profil').attr('src', `{{ url('/') }}/${response.foto}`);

                            $('.alert').fadeIn();
                            setTimeout(() => {
                                $('.alert').fadeOut();
                            }, 3000);
                        })
                        .fail(errors => {
                            if (errors.status == 422) {
                                alert(errors.responseJSON);
                            } else {
                                alert('Tidak dapat menyimpan data');
                            }
                            return;
                        });
                }
            });
        });

        function myFunction(inputId) {
            var x = document.getElementById(inputId);
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        };
    </script>
@endpush
