<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Contracts\UserInterface;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AuthController extends Controller
{
    public function __construct(protected UserInterface $userService)
    {
    }

    /**
     * Show the registration form.
     *
     * @return View
     */
    public function showRegistrationForm(): View
    {
        return view('auth.register');
    }

    /**
     * Handle user registration.
     *
     * @param RegisterRequest $request
     * @return RedirectResponse
     */
    public function register(RegisterRequest $request): RedirectResponse
    {
        $user = $this->userService->register($request);

        return redirect()->route('verification.notice')->with('message', 'Registration successful! Please check your email to verify your account.');
    }

    /**
     * Show the login form.
     *
     * @return View
     */
    public function showLoginForm(): View
    {
        return view('auth.login');
    }

    /**
     * Handle user login.
     *
     * @param LoginRequest $request
     * @return RedirectResponse
     */
    public function login(LoginRequest $request): RedirectResponse
    {
        if ($this->userService->login($request)) {
            return redirect()->intended('/')->with('message', 'Login successful.');
        }

        return back()->withErrors(['email' => 'Invalid credentials or unverified email.']);
    }

    /**
     * Show the email verification notice.
     *
     * @return View
     */
    public function showEmailVerificationNotice(): View
    {
        return view('auth.verify-email');
    }

    /**
     * Handle email verification.
     *
     * @param EmailVerificationRequest $request
     * @return RedirectResponse
     */
    public function verifyEmail(EmailVerificationRequest $request): RedirectResponse
    {
        $this->userService->emailVerification($request);

        return redirect('/')->with('message', 'Email successfully verified.');
    }

    /**
     * Resend the email verification notification.
     *
     * @return RedirectResponse
     */
    public function resendVerificationEmail(): RedirectResponse
    {
        if (auth()->user()->hasVerifiedEmail()) {
            return redirect('/');
        }

        auth()->user()->sendEmailVerificationNotification();

        return back()->with('message', 'Verification link sent!');
    }

    /**
     * Handle user logout.
     *
     * @return RedirectResponse
     */
    public function logout(): RedirectResponse
    {
        $this->userService->logout();

        return redirect()->route('login')->with('message', 'You have been logged out.');
    }
}
