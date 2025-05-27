<?php

namespace App\Http\Middleware;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Models\LoginSession;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AlreadyLoginMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $email = $request->cookie("X-LOGIN-TOKEN");

        $userHasSessionModel = null;

        if ($email === null) {
            return $next($request);
        }

        if ($email !== null) {
            $userHasSessionModel = LoginSession::select()
                ->where("email", "=", $email)
                ->first();
        }

        if ($userHasSessionModel === null) {
            return redirect()->action([AuthController::class, "loginForm"])->cookie("X-LOGIN-TOKEN", "", -1);
        }

        return back();
    }
}
