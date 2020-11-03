<?php


namespace AmirRezaM75\TokenizedLogin\Facades;


use AmirRezaM75\TokenizedLogin\Http\Responses\AndroidResponder;
use AmirRezaM75\TokenizedLogin\Http\Responses\VueResponder;

class ResponderFacade extends BaseFacade
{
    protected static function getFacadeAccessor()
    {
        return request('client') === 'android' ? AndroidResponder::class : VueResponder::class;
    }
}
