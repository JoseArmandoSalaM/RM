@extends('layouts.app')

@section('content')

<style>
.rounded-input {
    border-radius: 20px; /* Bordes redondeados */
    border: 1px solid #d1e3f8; /* Borde suave, opcional */
}
</style>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card shadow-lg">
                <div class="card-body">
                    <div class="text-center mb-4">
                        <img src="{{ asset('logoremen.jpg') }}" alt="Logo" class="img-fluid">
                    </div>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="email" class="form-label">{{ __('Correo electrónico:') }}</label>
                            <input id="email" type="email" class="form-control  rounded-input @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">{{ __('Contraseña:') }}</label>
                            <input id="password" type="password" class="form-control  rounded-input @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label class="form-check-label" for="remember">
                                    {{ __('Recuérdame') }}
                                </label>
                            </div>
                        </div>

                        <div class="mb-3 text-center">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Iniciar sesión') }}
                        </button>
                    </div>

                    @if (Route::has('password.request'))
                        <div class="text-center mb-3">
                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                {{ __('¿Olvidaste tu contraseña?') }}
                            </a>
                        </div>
                    @endif

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
