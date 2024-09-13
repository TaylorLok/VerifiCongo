<?php

namespace App\Http\Livewire\Auth;

use Livewire\Component;
use App\Services\UserService;
use App\Http\Requests\EmailVerificationRequest;
use Illuminate\Support\Facades\Auth;

class EmailVerificationNotice extends Component
{

    public function __construct(protected UserService $userService)
    {
    }

    public function verifyEmail()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $request = new EmailVerificationRequest([
            'id' => Auth::id(),
            'hash' => request()->route('hash'),
        ]);

        try 
        {
            $this->userService->verifyUserEmail($request);
            return redirect()->intended('/dashboard?verified=1');
        } 
        catch (\Exception $e) 
        {
            session()->flash('error', 'Email verification failed. Please try again.');
            return redirect()->back();
        }
    }

    public function resend()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        if (Auth::user()->hasVerifiedEmail()) {
            return redirect()->intended('/dashboard');
        }

        try 
        {
            Auth::user()->sendEmailVerificationNotification();
            $this->emit('resent');
            session()->flash('message', 'Verification link sent!');
        } 
        catch (\Exception $e) 
        {
            session()->flash('error', 'Failed to send verification email. Please try again.');
        }
    }

    public function render()
    {
        return view('livewire.auth.email-verification-notice')
            ->layout('layouts.auth');
    }
}