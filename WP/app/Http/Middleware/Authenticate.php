<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        // return $request->expectsJson() ? null : route('login');\
        //4種類のログイン画面にリダイレクト
        if (! $request->expectsJson()) {
            if($request->is('manager/*')){
                return route('manager.login');
            }elseif($request->is('user/*')){
                return route('login');
            }elseif($request->is('admin/*')){
                return route('admin.login');
            }
        }
        // デフォルトのリダイレクト先
        return route('/');
    }
}
