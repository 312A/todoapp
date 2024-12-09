@extends('layouts.auth')
@section('style')
    <style>
        html,
        body {
            height: 100%;
        }

        .form-signin {
            max-width: 330px;
            padding: 1rem;
        }

        .form-signin .form-floating:focus-within {
            z-index: 2;
        }

        .form-signin input[type="email"] {
            margin-bottom: -1px;
            border-bottom-right-radius: 0;
            border-bottom-left-radius: 0;
        }

        .form-signin input[type="password"] {
            margin-bottom: 10px;
            border-top-left-radius: 0;
            border-top-right-radius: 0;
        }

        .form-signin button {
            margin-top: 15px;
        }

        .form-sign .error-message {
            color: red;
            font-size: 0.9rem;
            margin-top: 5px;
        }
    </style>
@endsection

@section('content')
    <main class="form-signin w-100 m-auto">
        <form method="POST" action="{{ route('register.post') }}">
            @csrf
            <img class="mb-4" src="{{ asset('assets/img/l1.png') }}" alt="logo" width="72" height="57">
            <h1 class="h3 mb-3 fw-normal">Create Your Account</h1>

            {{-- Full Name --}}
            <div class="form-floating">
                <input type="text" name="fullname" class="form-control" id="floatingInput"
                    placeholder="Please Enter your Name" value="{{ old('fullname') }}">
                <label for="floatingInput">Full Name</label>
                @error('fullname')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            {{-- Email Address --}}
            <div class="form-floating">
                <input type="email" name="email" class="form-control" id="floatingEmail" placeholder="name@example.com"
                    value="{{ old('email') }}">
                <label for="floatingEmail">Email Address</label>
                <span id="emailError" class="error-message"></span>
                @error('email')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            {{-- Password --}}
            <div class="form-floating mb-3">
                <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password">
                <label for="floatingPassword">Password</label>
                @error('password')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            {{-- reCAPTCHA --}}
            @if (config('services.recaptcha.site_key'))
                <div class="g-recaptcha" data-sitekey="{{ config('services.recaptcha.site_key')}}"></div>
                @error('g-recaptcha-response')
                    <span class="text-danger mb-20">{{ $message }}</span>
                @enderror
            @endif

            {{-- Submit Button --}}
            <button class=" btn btn-primary w-100 py-2" type="submit">Register</button>

            {{-- Session Messages --}}
            @if (session()->has('success'))
                <div class="alert alert-success mt-3">
                    {{ session('success') }}
                </div>
            @endif

            @if (session()->has('error'))
                <div class="alert alert-danger mt-3">
                    {{ session('error') }}
                </div>
            @endif

            <p class="mt-5 mb-3 text-muted">&copy; 2024</p>
        </form>

        {{-- Google reCAPTCHA Script --}}
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    </main>
@endsection
