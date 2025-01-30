@extends('layouts.app')
@section('title', 'Login')
@section('content')
    <div class="d-flex justify-content-center align-items-center vh-100">
        <div class="card p-4 shadow-lg" style="width: 450px;">
            <h3 class="text-center mb-3">Login Now</h3>

            @include('components.messages')

            <form action="{{ route('log_in') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                        name="email" placeholder="Enter your email" value="{{ old('email') }}" required>
                    @error('email')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
                        name="password" placeholder="Enter your password" required>
                    @error('password')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="remember" name="remember">
                    <label class="form-check-label" for="remember">Remember Me</label>
                </div>

                <button type="submit" class="btn btn-success w-100">Login</button>

                <div class="text-center mt-2">
                    <p>Don't have an account? <a href="{{ route('register') }}"
                            class="text-decoration-none text-success">Register here</a></p>
                </div>
            </form>
        </div>
    </div>
@endsection
