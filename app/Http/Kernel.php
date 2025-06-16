<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;


class Kernel extends HttpKernel
{
    protected $middleware = [
        // ...
    ];

    protected $middlewareGroups = [
        'web' => [
            // ...
        ],

        'api' => [
            // ...
        ],
    ];

    protected $routeMiddleware = [
    'auth' => \App\Http\Middleware\Authenticate::class,
    // 'role' => \App\Http\Middleware\Role::class,
    // 'role' => \App\Http\Middleware\CheckRoleUser::class,
];

}
