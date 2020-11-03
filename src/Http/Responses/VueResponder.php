<?php


namespace AmirRezaM75\TokenizedLogin\Http\Responses;



use Illuminate\Http\Response;

class VueResponder implements ResponderInterface
{
    public function blockedUser()
    {
        return response()->json(['error' => 'You are banned'], Response::HTTP_BAD_REQUEST);
    }

    public function tokenIsSent()
    {
        return response()->json(['message' => 'Token was sent'], Response::HTTP_OK);
    }

    public function userNotFound()
    {
        return response()->json(['error' => 'User not found'], Response::HTTP_BAD_REQUEST);
    }

    public function emailNotValid()
    {
        return response()->json(['error' => 'Email is not valid'], Response::HTTP_BAD_REQUEST);
    }

    public function userIsLogged()
    {
        return response()->json(['error' => 'You are already logged in'], Response::HTTP_BAD_REQUEST);
    }

    public function loggedIn()
    {
        return response()->json(['message' => 'You are logged in'], Response::HTTP_OK);
    }

    public function tokenIsInvalid()
    {
        return response()->json(['error' => 'Seems that you entered a wrong token'], Response::HTTP_BAD_REQUEST);
    }
}
