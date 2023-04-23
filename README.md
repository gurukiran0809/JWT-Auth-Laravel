<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Approach

If you pick `Tymon JWTAuth` as your jwt solution in your project, when you try to refresh your token, the package will blacklist your exchanged token (assume your blacklist feature is enabled). So when your client faces a concurrency use case,  your request might be rejected because that request is sent before your app renews jwt token returned by server. This package caches the refreshed jwt token in a short period to ensure your client side can get correct response even if your request carries an old token in a concurrency case.

### Attempt To Authenticate And Return Token

``` php
// This will attempt to authenticate the user using the credentials passed and returns a JWT Auth Token for subsequent requests.
$token = Auth::attempt(['email' => 'guru@gmail.com', 'password' => 'guru4321']);

### Authenticate Once By Credentials

``` php
if(Auth::once(['email' => 'user@domain.com', 'password' => '123456'])) {
    // Do something with the authenticated user
}
```

### Validate Credentials

``` php
if(Auth::validate(['email' => 'user@domain.com', 'password' => '123456'])) {
    // Credentials are valid
}
```

### Check User is Authenticated

``` php
if(Auth::check()) {
    // User is authenticated
}
```

### Logout Authenticated User

``` php
Auth::logout(); // This will invalidate the current token and unset user/token values.

### Refresh Expired Token

Though it's recommended you refresh using the middlewares provided with the package,
but if you'd like, You can also do it manually with this method.

Refresh expired token passed in request:

``` php
$token = Auth::refresh();
```

Refresh passed expired token:

``` php
Auth::setToken('ExpiredToken')->refresh();
```

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).


