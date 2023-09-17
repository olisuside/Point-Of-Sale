@extends('layouts.auth')

@section('title', 'Login')

@section('contents')

    <div class="card mt-2">
        <div class="card-content">
            <div class="card-body">
                <h3 class="" style="text-align: center">Masukkan Email Anda</h3>
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

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-3">
                                <label class="col-form-label">Email</label>
                            </div>
                            <div class="col-md-9 form-group">
                                <input id="email" class="form-control" type="email" name="email"
                                    :value="old('email')" required autofocus autocomplete="username">
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
