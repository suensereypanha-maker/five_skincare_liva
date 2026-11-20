<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\View\View;

class AuthController extends Controller
{
    /**
     * Show the login form.
     */
    public function showLoginForm(): View|RedirectResponse
    {
        if (Auth::check()) {
            return redirect()->route('home');
        }

        return view('auth.login');
    }

    /**
     * Handle user login.
     */
    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $remember = $request->boolean('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();

            return redirect()->intended(route('home'))->with('success', 'Welcome back, '.Auth::user()->name.'!');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    /**
     * Show the registration form.
     */
    public function showRegisterForm(): View|RedirectResponse
    {
        if (Auth::check()) {
            return redirect()->route('home');
        }

        return view('auth.register');
    }

    /**
     * Handle user registration.
     */
    public function register(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->route('home')->with('success', "Welcome to LIVA Botanical, {$user->name}!");
    }

    /**
     * Handle user logout.
     */
    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home')->with('info', 'You have been logged out.');
    }

    /**
     * Redirect to social provider or authenticate demo social account.
     */
    public function redirectToProvider(string $provider): RedirectResponse
    {
        if (! in_array($provider, ['google', 'facebook'])) {
            return redirect()->route('login')->withErrors(['email' => 'Unsupported social login provider.']);
        }

        $providerName = ucfirst($provider);
        $user = User::firstOrCreate(
            ['email' => "demo.{$provider}@livaskincare.com"],
            [
                'name' => "{$providerName} Customer",
                'password' => Hash::make(Str::random(24)),
            ]
        );

        Auth::login($user);
        request()->session()->regenerate();

        return redirect()->route('home')->with('success', "Signed in successfully with {$providerName}!");
    }

    /**
     * Handle social provider callback.
     */
    public function handleProviderCallback(string $provider): RedirectResponse
    {
        return $this->redirectToProvider($provider);
    }

    /**
     * Switch application language in session.
     */
    public function switchLanguage(string $locale): RedirectResponse
    {
        if (in_array($locale, ['en', 'km'])) {
            session(['locale' => $locale]);
        }

        return back();
    }
}
