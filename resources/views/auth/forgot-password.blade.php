@extends('layouts.auth')

@section('content')
<div class="container my-4">
    <div class="row justify-content-center">
        <div class="col-sm-12 col-md-6 px-0">
            <div class="login-container">
                <div class="login-header mb-3">
                    <h3> <img src="{{asset('images/logo/main.png')}}" width="100px;" alt=""> </h3>
                    <p class="login-header-title"><b>Forgot Password?</b></p>
                    <p class="text-muted">Enter your email to reset your password.</p>
                </div>
                <div class="login-form">
                    <form action="{{route('password.email')}}" method="POST">
                        @csrf
                        <div class="form-group">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                  <span class="input-group-text" id="basic-addon1"><i class="fas fa-user"></i></span>
                                </div>
                            <input id="email" type="email" placeholder="E-mail address" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            </div>
                        </div>
                        <button type="submit" class="btn primary-btn btn-block">Reset</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-6 px-0">
            <div class="login-poster">
                {{-- <img src="" alt=""> --}}
                <h2 class="mb-3 slogon">Mark yourself as <br>Actively Job seeker</h2>
                <p class="text-white lead">We have enabled this feature targeting superheros
                    who lost their jobs during this crisis.</p>
            </div>
        </div>
    </div>
</div>
@endsection

@push('css')
<style>
.login-poster {
   background-image: url('{{asset("images/login-bg.jpg")}}');
    background-image: linear-gradient(
            to bottom,
            rgba(0, 0, 0, 0.5),
            rgba(0, 0, 0, 0.35)
        ),
        url('{{asset("images/login-bg.jpg")}}');
    background-repeat: no-repeat;
    background-size: cover;
    background-position: center;
}
</style>
@endpush