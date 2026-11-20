@extends('layouts.master')
@section('title', 'LIVA | Create an Account')

@section('hero')
    @include('partials.hero', ['isHome' => false])
@endsection

@section('breadcrumb')
    @include('partials.breadcrumb', [
        'title' => 'Register',
        'subtitle' => 'Create Account'
    ])
@endsection

@section('content')
    <section class="auth-section spad">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-5 col-md-8">
                    <div class="card border-0 shadow-sm p-4 p-md-5" style="border-radius: 12px; background: #fff;">
                        <div class="text-center mb-4">
                            <img src="{{ asset('img/favicon.svg') }}" alt="LIVA" style="height: 48px; width: 48px; border-radius: 8px; margin-bottom: 12px;">
                            <h3 style="font-family: 'Cormorant Garamond', Georgia, serif; font-weight: 700; color: #1F2421;">Join LIVA Botanical</h3>
                            <p class="text-muted" style="font-size: 14px;">Unlock personalized skincare rituals &amp; exclusive member perks</p>
                        </div>

                        <form action="{{ route('register.submit') }}" method="POST">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="name" style="font-weight: 600; font-size: 13px; color: #333;">Full Name</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-light border-right-0"><i class="fa fa-user text-muted"></i></span>
                                    </div>
                                    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" placeholder="Sophia Miller" required autofocus style="height: 46px;">
                                </div>
                                @error('name')
                                    <span class="text-danger" style="font-size: 12px;">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="email" style="font-weight: 600; font-size: 13px; color: #333;">Email Address</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-light border-right-0"><i class="fa fa-envelope text-muted"></i></span>
                                    </div>
                                    <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="name@example.com" required style="height: 46px;">
                                </div>
                                @error('email')
                                    <span class="text-danger" style="font-size: 12px;">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="password" style="font-weight: 600; font-size: 13px; color: #333;">Password (min. 8 characters)</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-light border-right-0"><i class="fa fa-lock text-muted"></i></span>
                                    </div>
                                    <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" placeholder="••••••••" required style="height: 46px;">
                                </div>
                                @error('password')
                                    <span class="text-danger" style="font-size: 12px;">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group mb-4">
                                <label for="password_confirmation" style="font-weight: 600; font-size: 13px; color: #333;">Confirm Password</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-light border-right-0"><i class="fa fa-lock text-muted"></i></span>
                                    </div>
                                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="••••••••" required style="height: 46px;">
                                </div>
                            </div>

                            <button type="submit" class="site-btn w-100 py-3" style="letter-spacing: 1px; font-weight: 700;">
                                CREATE ACCOUNT
                            </button>
                        </form>

                        <div class="text-center mt-4 pt-3 border-top">
                            <span class="text-muted" style="font-size: 14px;">Already have an account?</span>
                            <a href="{{ route('login') }}" style="color: #7fad39; font-weight: 700; margin-left: 5px;">Sign in here</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
