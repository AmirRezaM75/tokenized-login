<?php


namespace AmirRezaM75\TokenizedLogin\Repositories;


use Illuminate\Support\Facades\Notification;
use AmirRezaM75\TokenizedLogin\Notifications\SendTokenNotification;

class TokenRepository
{
    public function generate()
    {
        return random_int(100000, 1000000 - 1);
    }

    public function save(int $token, $userId)
    {
        cache()->set($token . '_tokenized-login', $userId, config('tokenized-login.token_ttl'));
    }

    public function get($token)
    {
        cache()->get($token.'_tokenized-login');
    }

    public function send($token, $user)
    {
        Notification::send($user, new SendTokenNotification($token));
    }
}
