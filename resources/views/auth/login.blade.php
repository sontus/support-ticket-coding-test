@extends('layouts.guest')
@section('title', 'Login')

@section('content')
    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="{{ url('/') }}" class="h1">Ticket System</a>
            </div>
            <div class="card-body">
                <p class="login-box-msg">Sign in to start your session</p>

                <form action="{{ route('login') }}" method="POST">
                    @csrf
                    <!-- Email Address -->
                    <div class="input-group mb-3">
                        <x-text-input id="email"  type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="Email"/>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>

                    </div>
                    <!-- Password -->
                    <div class="input-group mb-3">
                        <x-text-input id="password" class="block" type="password" name="password" required autocomplete="current-password" placeholder="Password"/>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- Remember Me -->
                        <div class="col-8">
                            <div class="icheck-primary">
                                <input id="remember_me" type="checkbox" class="" name="remember">
                                <label for="remember_me">
                                    {{ __('Remember me') }}
                                </label>
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-4">
                            <x-primary-button class="btn-block">
                                {{ __('Log in') }}
                            </x-primary-button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
                <p class="mb-1">
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}"> {{ __('Forgot your password?') }}</a>
                    @endif
                </p>
                <p class="mb-0">
                    <a href="{{ route('register') }}" class="text-center">Register a new membership</a>
                </p>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.login-box -->
@endsection
