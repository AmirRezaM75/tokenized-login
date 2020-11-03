<?php


namespace AmirRezaM75\TokenizedLogin\Repositories;

use Illuminate\Support\Facades\Auth;

class AuthRepository
{
    public function check()
    {
        return Auth::check();
    }

    public function login($userId)
    {
        return auth()->loginUsingId($userId);
    }
}
