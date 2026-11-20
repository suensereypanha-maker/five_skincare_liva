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
                            <h3 style="font-family: 'Cormorant Garamond', Georgia, serif; font-weight: 700; color: #1F2421;" data-i18n="join_title">Join LIVA Botanical</h3>
                            <p class="text-muted" style="font-size: 14px;" data-i18n="join_subtitle">Unlock personalized skincare rituals &amp; exclusive member perks</p>
                        </div>

                        {{-- Social Signup Buttons --}}
                        <div class="social-login-group mb-4">
                            <a href="{{ route('social.login', 'google') }}" class="btn w-100 d-flex align-items-center justify-content-center py-2 mb-2 social-btn-google" style="border: 1px solid #dadce0; border-radius: 8px; font-weight: 600; color: #3c4043; background: #fff; text-decoration: none; box-shadow: 0 1px 3px rgba(0,0,0,0.06);">
                                <svg width="18" height="18" viewBox="0 0 18 18" style="margin-right: 10px;">
                                    <path fill="#4285F4" d="M17.64 9.2c0-.637-.057-1.251-.164-1.84H9v3.481h4.844c-.209 1.125-.843 2.078-1.796 2.717v2.258h2.908c1.702-1.567 2.684-3.874 2.684-6.616z"/>
                                    <path fill="#34A853" d="M9 18c2.43 0 4.467-.806 5.956-2.184l-2.908-2.258c-.806.54-1.837.86-3.048.86-2.344 0-4.328-1.584-5.036-3.711H.957v2.332C2.438 15.983 5.482 18 9 18z"/>
                                    <path fill="#FBBC05" d="M3.964 10.707c-.18-.54-.282-1.117-.282-1.707s.102-1.167.282-1.707V4.961H.957C.347 6.175 0 7.55 0 9s.347 2.825.957 4.039l3.007-2.332z"/>
                                    <path fill="#EA4335" d="M9 3.58c1.321 0 2.508.454 3.44 1.345l2.582-2.58C13.463.891 11.426 0 9 0 5.482 0 2.438 2.017.957 4.961L3.964 7.293C4.672 5.166 6.656 3.58 9 3.58z"/>
                                </svg>
                                <span data-i18n="login_google">Continue with Google</span>
                            </a>
                            <a href="{{ route('social.login', 'facebook') }}" class="btn w-100 d-flex align-items-center justify-content-center py-2 social-btn-facebook" style="background: #1877F2; border-color: #1877F2; border-radius: 8px; font-weight: 600; color: #fff; text-decoration: none;">
                                <i class="fa fa-facebook-official" style="font-size: 18px; margin-right: 10px;"></i>
                                <span data-i18n="login_facebook">Continue with Facebook</span>
                            </a>
                        </div>

                        <div class="position-relative text-center my-3">
                            <hr style="border-top: 1px solid #e5e7eb; margin: 0;">
                            <span class="px-3 bg-white text-muted" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); font-size: 12px; text-transform: uppercase; letter-spacing: 0.5px;" data-i18n="or_email">or continue with email</span>
                        </div>

                        <form action="{{ route('register.submit') }}" method="POST">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="name" style="font-weight: 600; font-size: 13px; color: #333;" data-i18n="full_name">Full Name</label>
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
                                <label for="email" style="font-weight: 600; font-size: 13px; color: #333;" data-i18n="email_address">Email Address</label>
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
                                <label for="password" style="font-weight: 600; font-size: 13px; color: #333;" data-i18n="password">Password (min. 8 characters)</label>
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
                                <label for="password_confirmation" style="font-weight: 600; font-size: 13px; color: #333;" data-i18n="confirm_password">Confirm Password</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-light border-right-0"><i class="fa fa-lock text-muted"></i></span>
                                    </div>
                                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="••••••••" required style="height: 46px;">
                                </div>
                            </div>

                            <button type="submit" class="site-btn w-100 py-3" style="letter-spacing: 1px; font-weight: 700;" data-i18n="create_account">
                                CREATE ACCOUNT
                            </button>
                        </form>

                        <div class="text-center mt-4 pt-3 border-top">
                            <span class="text-muted" style="font-size: 14px;" data-i18n="have_account">Already have an account?</span>
                            <a href="{{ route('login') }}" style="color: #7fad39; font-weight: 700; margin-left: 5px;" data-i18n="sign_in_here">Sign in here</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
