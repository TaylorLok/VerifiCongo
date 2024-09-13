<?php

namespace App\Http\Livewire\Auth;

use Livewire\Component;
use App\Services\UserService;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Auth;

class RegisterForm extends Component
{
    public $first_name;
    public $last_name;
    public $email;
    public $cellphone;
    public $password;
    public $password_confirmation;

    protected UserService $userService;

    // Dependency Injection in constructor
    public function __construct($id = null, UserService $userService)
    {
        parent::__construct($id);
        $this->userService = $userService;
    }

    protected function rules()
    {
        return (new RegisterRequest())->rules();
    }

    public function register()
    {
        $this->validate();
        
        $validatedData = [
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'cellphone' => $this->cellphone,
            'password' => $this->password,
            'password_confirmation' => $this->password_confirmation,
        ];

        $request = new RegisterRequest($validatedData);

        unset($validatedData['password_confirmation']);

        try 
        {
            $user = $this->userService->registerUser($request);
            Auth::login($user);
            session()->flash('success', 'You have been successfully registered!');
            return redirect()->intended('/dashboard');
        } 
        catch (\Illuminate\Database\QueryException $e) 
        {
            $errorCode = $e->errorInfo[1];
            if ($errorCode == 1062) // MySQL duplicate entry error code
            { 
                if (strpos($e->getMessage(), 'users_email_unique') !== false) 
                {
                    $this->addError('email', 'This email is already registered.');
                } 
                elseif (strpos($e->getMessage(), 'users_cellphone_unique') !== false) 
                {
                    $this->addError('cellphone', 'This cellphone number is already registered.');
                } 
                else 
                {
                    $this->addError('email', 'This user already exists.');
                }
            } 
            else 
            {
                session()->flash('error', 'An error occurred during registration. Please try again.');
            }
        } 
        catch (\Exception $e) 
        {
            session()->flash('error', 'An unexpected error occurred. Please try again.');
        }
    }

    public function render()
    {
        return view('livewire.auth.register-form')
            ->layout('layouts.auth');
    }
}