<?php


namespace AmirRezaM75\TokenizedLogin\Repositories\Stubs;


class TokenRepositoryStub
{
    public function generate()
    {
        return 123456;
    }

    public function save(int $token, $userId)
    {
        //
    }

    public function send($token, $user)
    {
        //
    }
}
