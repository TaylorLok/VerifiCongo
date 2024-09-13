<?php

namespace App\Contracts;

use App\Models\User;
use App\Http\Requests\EmailVerificationRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;

interface UserInterface
{
    public function register(RegisterRequest $request): User;
    public function findByEmail(string $email): ?User;
    public function login(LoginRequest $request): bool;
    public function emailVerification(EmailVerificationRequest $request): void;
    public function logout(): void;
}