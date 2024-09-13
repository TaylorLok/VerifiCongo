<?php

namespace App\Services;

use App\Repositories\UserRepository;
use App\Models\User;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\EmailVerificationRequest;

class UserService
{
    public function __construct(protected UserRepository $userRepository)
    {
    }

    public function registerUser(RegisterRequest $request): User
    {
        return $this->userRepository->register($request);
    }

    public function loginUser(LoginRequest $request): bool
    {
        return $this->userRepository->login($request);
    }

    public function verifyUserEmail(EmailVerificationRequest $request): void
    {
        $this->userRepository->emailVerification($request);
    }

    public function logoutUser(): void
    {
        $this->userRepository->logout();
    }
}
