<?php

namespace App\Repositories;

use App\Contracts\UserInterface;
use App\Models\User;

class UserRepository implements UserInterface
{
    public function register(RegisterRequest $request): User
    {
        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'cellphone' => $request->cellphone,
            'password' => bcrypt($request->password),
        ]);

        // Generate and set email verification token
        $verificationToken = Str::random(60);
        $user->email_verification_token = $verificationToken;
        $user->save();

        // Send verification email
        $user->sendEmailVerificationNotification();
        // TODO: Implement email sending logic

        return $user;
    }

    public function findByEmail(string $email): ?User
    {
        return User::where('email', $email)->first();
    }

    public function login(LoginRequest $request): bool
    {
        $credentials = $request->only('email', 'password');
        
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            
            if ($user->email_verified_at === null) {
                Auth::logout();
                return false;
            }
            
            return true;
        }
        
        return false;
    }

    public function emailVerification(EmailVerificationRequest $request): void
    {
        $user = User::where('email_verification_token', $request->token)->first();

        if (!$user) {
            throw new \Exception('Invalid verification token.');
        }

        $user->email_verified_at = now();
        $user->email_verification_token = null;
        $user->save();
    }

    public function logout(): void
    {
        Auth::logout();
        
        session()->invalidate();
        session()->regenerateToken();
    }
}