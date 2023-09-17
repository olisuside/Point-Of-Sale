@extends('layouts.auth')

@section('title', 'Login')

@section('contents')

    <div class="card mt-2">
        <div class="card-content">
            <div class="card-body">
                <h3 class="" style="text-align: center">Reset Password</h3>
                @if ($errors->any())
                    <div class="alert alert-danger">Whoops! Something went wrong

                        <ul class="">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif

                {{-- <p class="card-text my-3" style="text-align: center">asd</p> --}}


                <form method="POST" action="{{ route('password.update') }}">
                    @csrf

                    <div class="form-body">
                        <div class="row">
                            <input type="hidden" name="token" value="{{ $request->route('token') }}">
                            <div class="col-md-3">
                                <label class="col-form-label">Email</label>
                            </div>
                            <div class="col-md-9 form-group">
                                <input id="email" class="form-control" type="email" name="email"
                                    :value="old('email', $request - > email)" required autofocus autocomplete="username">
                            </div>


                            <div class="col-md-3">
                                <label class="col-form-label">Password Baru</label>
                            </div>
                            <div class="col-md-9 form-group">
                                <div class="input-group">
                                    <input class="form-control" id="password" class="block mt-1 w-full" type="password"
                                        name="password" required autocomplete="new-password" >
                                    <a class="btn icon btn-secondary" onclick="myFunction('password')">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <label class="col-form-label">Konfirmasi Password</label>
                            </div>
                            <div class="col-md-9 form-group">
                                <div class="input-group">
                                    <input class="form-control" id="password_confirmation" class="block mt-1 w-full" type="password"
                                        name="password_confirmation" required autocomplete="new-password" >
                                    <a class="btn icon btn-secondary" onclick="myFunction('password_confirmation')">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-actions col-sm-12 d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary me-1 mb-1 mt-2">
                            Reset Password
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script>
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
