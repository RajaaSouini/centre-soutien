<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{

   protected $except = [
    '/inscriptions',
    '/admin/login',
    '/admin/logout',
    '/admin/*',
    '/eleve/register',
    '/eleve/login',
    '/eleve/logout',
];
}
