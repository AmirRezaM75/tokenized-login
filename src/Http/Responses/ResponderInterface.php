<?php


namespace AmirRezaM75\TokenizedLogin\Http\Responses;


interface ResponderInterface
{
    public function blockedUser();

    public function tokenIsSent();

    public function userNotFound();

    public function emailNotValid();

    public function userIsLogged();

    public function loggedIn();

    public function tokenIsInvalid();
}
