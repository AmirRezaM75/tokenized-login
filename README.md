# Tokenized Login in Laravel
> This package is only for educational purposes; You may use the original one from [Iman Ghafoori](https://github.com/imanghafoori1/laravel-tokenized-login).

This package creates an auto-expiring single-use 6 digit token, which you can send it (can be SMS, email, slack, etc ) to your users and they can login into their account with that token by just sending it back to an endpoint, which is also provided out of the box.

Exactly like alternate login method in Instagram.

You have complete control on how things will happen and you are free to swap the default implementations with your own.

# Installation
```
composer require amirrezam75/tokenized-login
```
Then publish the config file:

```
php artisan vendor:publish
```



# Basic usage:
Basically, this package introduces 2 endpoints, which you can send requests to them.

1. The first one is to generate and send the token to the user
```php
POST 'api/tokenized-login/request?email=amir@example.com'
```

2. The second one accepts the token and authoenticates the user if the token was valid.
```php
POST 'api/tokenized-login/login?email=amir@example.com'
```

Note: If you are not happy with the shape if the urls, you are free to cancel these out, and redefine them where ever you want.
you can take a look at the source code to find the controllers they refer to.

To disable the default routes you may set: ```'use_default_routes' => false,``` in the tokenized_login config file.

# Customization:
You can do a lot of customization and swap the default classes, with your own altenatives since we use the larave-smart-facade package.
Visit the config file to see what you can change.

If you want to swap the default implementations behind the facades with your own, you can do it within the `boot` method of any service provider class like this :

```php
    /**
     * The life time of tokens in seconds.
     */
    'token_ttl' => 120,

    /**
     * The rules to validate the the receiver address.
     * Usually it is an email address, but maybe a phone number.
     */
    'email_validation_rules' => ['required', 'email'],

    /**
     * Here you determine if you are ok with using the routes
     * defined within the package or you want to define them.
     */
    'use_default_routes' => true,

    /**
     * Here you can specify the middlewares to be applied on
     * the routes, which the package has provided for you.
     */
    'route_middlewares' => ['api'],

    /**
     * You can define a prefix for the urls to avoid conflicts.
     * Note: the prefix should NOT end in a slash / character.
     */
    'route_prefix_url' => '/tokenized-login',

    /**
     * Notification class used to send the token.
     * You may define your own token sender class.
     */
    'token_repository' => \AmirRezaM75\TokenizedLogin\TokenRepository::class,

    /**
     * You can extend Responses class and override
     * it's methods, to define your own responses.
     */
    'responses' => \AmirRezaM75\TokenizedLogin\Http\Responses\Responses::class,

    /**
     * You can change the way you fetch the user from your database
     * by defining a custom user provider class, and set it here.
     */
    'user_repository' => \AmirRezaM75\TokenizedLogin\UserRepository::class,

    /**
     * You may provide a middleware to throttle the
     * requesting and submission of the tokens.
     */
    'throttler_middleware' => 'throttle:3,1',

```
All the facades have a `proxy` method which you can call, but remember not to do it within the `register` method, but only in `boot`.

--------------------
