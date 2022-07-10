@extends('layouts.app')

@section('content')
    <div class="container position-sticky z-index-sticky top-0">
        <nav
            class="navbar navbar-expand-lg blur border-radius-xl top-0 z-index-3 shadow position-absolute my-3 py-2 start-0 end-0 mx-4">
            <div class="container-fluid ps-2 pe-0">
                <a class="navbar-brand  font-weight-bolder ms-lg-0 ms-3" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler shadow-none ms-2" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon mt-2"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->

                        @if (Route::has('login'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">
                                    <i class="fas fa-key opacity-6 text-dark me-1"></i>{{ __('Login') }}
                                </a>
                            </li>
                        @endif

                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">
                                    <i class="fas fa-user-circle opacity-6 text-dark me-1"></i>{{ __('Register') }}
                                </a>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>
    </div>
    <main class="main-content  mt-0">
        <section>
            <div class="page-header min-vh-100">
                <div class="container">
                    <div class="col-xl-4 col-lg-5 col-md-7d-flex justify-content-center mx-auto ">
                        <div class="card card-plain">
                            <div class="card-header">
                                <h4 class="font-weight-bolder text-center">{{ __('Register') }}</h4>
                            </div>
                            <div class="card-body">
                                <form method="POST" action="{{ route('register') }}">
                                    @csrf
                                    <div class="input-group input-group-outline my-3">
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                               name="name" value="{{ old('name') }}" placeholder="Name" required autocomplete="name" autofocus>
                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="input-group input-group-outline mb-3">
                                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                                               name="email" value="{{ old('email') }}" placeholder="Email" required autocomplete="email">
                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="input-group input-group-outline mb-3">
                                        <input type="password" class="form-control @error('password') is-invalid @enderror"
                                               name="password" placeholder="Password" required autocomplete="password">
                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="input-group input-group-outline mb-3">
                                        <input type="password" class="form-control" name="password_confirmation"
                                               placeholder="Confirm Password" required autocomplete="password">
                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="text-center">
                                        <button type="submit"
                                                class="btn btn-lg bg-gradient-primary btn-lg w-100 mt-4 mb-0">
                                            {{ __('Register') }}
                                        </button>
                                    </div>
                                </form>
                            </div>
                            <div class="card-footer text-center pt-0 px-lg-2 px-1">
                                <p class="mb-2 text-sm mx-auto">
                                    Already have an account?
                                    <a href="{{ route('login') }}"
                                       class="text-primary text-gradient font-weight-bold">Sign in</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
