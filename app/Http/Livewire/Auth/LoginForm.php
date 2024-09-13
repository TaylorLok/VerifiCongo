<?php

namespace App\Http\Livewire\Auth;

use App\Http\Requests\Auth\LoginRequest;
use Livewire\Component;
use App\Services\UserService;
use Illuminate\Support\Facades\Auth;

class LoginForm extends Component
{
    public $email = '';
    public $password = '';
    public $remember = false;

    protected UserService $userService;

    public function __construct($id = null, UserService $userService)
    {
        parent::__construct($id);
        $this->userService = $userService;
    }

    protected function rules()
    {
        return (new LoginRequest())->rules();
    }

    public function login()
    {
        $this->validate();

        $credentials = [
            'email' => $this->email,
            'password' => $this->password,
        ];

        if ($this->userService->loginUser(new LoginRequest($credentials))) 
        {
            session()->regenerate();

            return redirect()->intended(route('dashboard'));
        }

        $this->addError('email', __('auth.failed'));
    }

    public function render()
    {
        return view('livewire.auth.login-form');
    }
}
