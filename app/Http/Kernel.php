<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    
    protected $routeMiddleware = [
        'can' => \Illuminate\Auth\Middleware\Authorize::class,
        'check.status' => \App\Http\Middleware\CheckStatus::class,
        'admin' => \App\Http\Middleware\Admin::class,
    ];
}