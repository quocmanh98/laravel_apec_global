<?php

namespace App\Http\Middleware;

use Closure;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class VerifyInstallation
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     *
     * @throws \Symfony\Component\HttpKernel\Exception\HttpException
     */
    public function handle($request, Closure $next)
    {
        $path = '';
        if (! file_exists(base_path('.env')) && ! $request->is('install*')) {
            return redirect()->route('install.welcome');
        }

        if (file_exists(base_path('.env')) && $request->is('install*') && ! $request->is('install/final')) {
            throw new NotFoundHttpException;
        }

        return $next($request);
    }
}
