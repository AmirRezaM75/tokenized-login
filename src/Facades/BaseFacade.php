<?php


namespace AmirRezaM75\TokenizedLogin\Facades;


use Illuminate\Support\Facades\Facade;

abstract class BaseFacade extends Facade
{
    public static function proxy($class)
    {
        app()->singleton(static::getFacadeAccessor(), $class);
    }

    protected static function getFacadeAccessor()
    {
        return static::class;
    }
}
