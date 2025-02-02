<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * Os middleware específicos para as rotas.
     *
     * @var array
     */
    protected $routeMiddleware = [
        // Middleware para verificar se o usuário é admin
        'admin' => \App\Http\Middleware\AdminMiddleware::class,
    ];
}
