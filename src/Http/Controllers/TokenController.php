<?php


namespace AmirRezaM75\TokenizedLogin\Http\Controllers;


use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use AmirRezaM75\TokenizedLogin\Facades\AuthRepositoryFacade;
use AmirRezaM75\TokenizedLogin\Facades\ResponderFacade;
use AmirRezaM75\TokenizedLogin\Facades\TokenRepositoryFacade;
use AmirRezaM75\TokenizedLogin\Facades\UserRepositoryFacade;

class TokenController
{
    public function request(Request $request)
    {
        $this->validateEmail($request);

        if (AuthRepositoryFacade::check())
            return ResponderFacade::userIsLogged();

        $user = UserRepositoryFacade::getUserByEmail($request->get('email'));

        if (! $user)
            return ResponderFacade::userNotFound();

        if (UserRepositoryFacade::isBanned($user->id))
            return ResponderFacade::blockedUser();

        $token = TokenRepositoryFacade::generate();

        TokenRepositoryFacade::save($token, $user->id);

        TokenRepositoryFacade::send($token, $user);

        return ResponderFacade::tokenIsSent();
    }

    public function login(Request $request)
    {
        $userId = TokenRepositoryFacade::get($request->get('token'));

        if (! $userId) {
            return ResponderFacade::tokenIsInvalid();
        }

        AuthRepositoryFacade::login($userId);

        return ResponderFacade::loggedIn();
    }

    private function validateEmail(Request $request)
    {
        $validator = Validator::make($request->all(), ['email' => 'required|email']);

        if ($validator->fails())
            ResponderFacade::emailNotValid()->throwResponse();
    }


    public function test()
    {
        User::unguard();
        TokenRepositoryFacade::send(753043, new User(['id' => 1, 'email' => 'amir@hotmail.com']));
    }
}
