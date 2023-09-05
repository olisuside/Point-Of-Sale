@extends('layouts.auth')

@section('title', 'Login')

@section('contents')


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
        <div class="alert alert-danger">
            {{ session('status') }}
        </div>
    @endif

    <p class="card-text my-3" style="text-align: center">Silahkan Login terlebih dahulu</p>

    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="form-body">
            <div class="row">
                <div class="col-md-3">
                    <label class="col-form-label">Email</label>
                </div>
                <div class="col-md-9 form-group">
                    <input id="email" class="form-control" type="email" name="email" :value="old('email')" required
                        autofocus autocomplete="username">
                </div>


                <div class="col-md-3">
                    <label class="col-form-label">Password</label>
                </div>
                <div class="col-md-9 form-group">
                    <div class="input-group">
                        <input class="form-control" id="password" class="block mt-1 w-full" type="password" name="password"
                            required autocomplete="current-password" />
                        <a class="btn icon btn-secondary" onclick="myFunction()">
                            <i class="bi bi-eye"></i>
                        </a>
                    </div>

                </div>

                {{-- <div class="col-12 col-md-12 offset-md-0 form-group mt-2">
                    <div class="form-check">
                        <div class="checkbox">
                            <input type="checkbox" id="checkbox1" class="form-check-input" checked="">
                            <label for="checkbox1">Remember Me</label>
                        </div>
                    </div>
                </div>
                <div class=" col-12 col-md-12 offset-md-0 form-group">
                    <a href="" class="">Lupa Kata Sandi?</a>
                </div> --}}
            </div>
        </div>

        <div class="form-actions col-sm-12 d-flex justify-content-center">
            <button type="submit" class="btn btn-primary me-1 mb-1 mt-2">
                Login
            </button>
        </div>
    </form>

    {{-- </div> --}}


@endsection
