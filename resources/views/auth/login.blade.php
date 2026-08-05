@extends('layouts.app')

@section('content')
@php
    $activeLoginType = old('login_type', 'system');
@endphp

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Ingresar</div>

                <div class="card-body">
                    <ul class="nav nav-tabs mb-4" id="loginTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link {{ $activeLoginType === 'system' ? 'active' : '' }}" id="system-tab" data-bs-toggle="tab" data-bs-target="#system-login" type="button" role="tab" aria-controls="system-login" aria-selected="{{ $activeLoginType === 'system' ? 'true' : 'false' }}">
                                Usuarios del sistema
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link {{ $activeLoginType === 'patient' ? 'active' : '' }}" id="patient-tab" data-bs-toggle="tab" data-bs-target="#patient-login" type="button" role="tab" aria-controls="patient-login" aria-selected="{{ $activeLoginType === 'patient' ? 'true' : 'false' }}">
                                Pacientes
                            </button>
                        </li>
                    </ul>

                    <div class="tab-content" id="loginTabsContent">
                        <div class="tab-pane fade {{ $activeLoginType === 'system' ? 'show active' : '' }}" id="system-login" role="tabpanel" aria-labelledby="system-tab">
                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                <input type="hidden" name="login_type" value="system">

                                <div class="row mb-3">
                                    <label for="system-login-field" class="col-md-4 col-form-label text-md-end">Email</label>

                                    <div class="col-md-6">
                                        <input id="system-login-field" type="email" class="form-control @error('login') {{ $activeLoginType === 'system' ? 'is-invalid' : '' }} @enderror" name="login" value="{{ $activeLoginType === 'system' ? old('login') : '' }}" required autocomplete="email" autofocus>

                                        @if ($activeLoginType === 'system')
                                            @error('login')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        @endif
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="system-password" class="col-md-4 col-form-label text-md-end">Contraseña</label>

                                    <div class="col-md-6">
                                        <input id="system-password" type="password" class="form-control @error('password') {{ $activeLoginType === 'system' ? 'is-invalid' : '' }} @enderror" name="password" required autocomplete="current-password">

                                        @if ($activeLoginType === 'system')
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        @endif
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-6 offset-md-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="remember" id="system-remember" {{ old('remember') && $activeLoginType === 'system' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="system-remember">Recordarme</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-0">
                                    <div class="col-md-8 offset-md-4">
                                        <button type="submit" class="btn btn-primary">Ingresar como usuario</button>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="tab-pane fade {{ $activeLoginType === 'patient' ? 'show active' : '' }}" id="patient-login" role="tabpanel" aria-labelledby="patient-tab">
                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                <input type="hidden" name="login_type" value="patient">

                                <div class="row mb-3">
                                    <label for="patient-login-field" class="col-md-4 col-form-label text-md-end">DNI</label>

                                    <div class="col-md-6">
                                        <input id="patient-login-field" type="text" class="form-control @error('login') {{ $activeLoginType === 'patient' ? 'is-invalid' : '' }} @enderror" name="login" value="{{ $activeLoginType === 'patient' ? old('login') : '' }}" required autocomplete="username">

                                        @if ($activeLoginType === 'patient')
                                            @error('login')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        @endif
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="patient-password" class="col-md-4 col-form-label text-md-end">Contraseña</label>

                                    <div class="col-md-6">
                                        <input id="patient-password" type="password" class="form-control @error('password') {{ $activeLoginType === 'patient' ? 'is-invalid' : '' }} @enderror" name="password" required autocomplete="current-password">

                                        @if ($activeLoginType === 'patient')
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        @endif
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-6 offset-md-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="remember" id="patient-remember" {{ old('remember') && $activeLoginType === 'patient' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="patient-remember">Recordarme</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-0">
                                    <div class="col-md-8 offset-md-4">
                                        <button type="submit" class="btn btn-primary">Ingresar como paciente</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    @if (Route::has('password.request'))
                        <div class="text-center mt-4">
                            <a class="btn btn-link" href="{{ route('password.request') }}">¿Olvidaste tu contraseña?</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
