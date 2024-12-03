<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    
    protected $routeMiddleware = [
        'check.status' => \App\Http\Middleware\CheckStatus::class,
        'admin' => \App\Http\Middleware\Admin::class,
    ];
}