<?php

namespace App\Http\Middleware;

use App\Http\Controllers\AuthController;
use App\Models\LoginSession;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class NotYetLoginMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        $loginToken = $request->cookie("X-LOGIN-TOKEN");

        $loginSession = null;
        $sessionExpiredAtInUnixEpoch = null;

        if ($loginToken != null) {
            
            /**
             * @var LoginSession
             */
            $loginSession = LoginSession::select()
                ->where("email", "=", $loginToken)
                ->first();
        }

        if ($loginSession != null) {

            /**
             * @var float
             */
            $sessionExpiredAtInUnixEpoch = $loginSession->getExpiredAtMillis();
        }

        /**
         * @var float
         */
        $currentLongMillis = Carbon::now()->valueOf();

        if ($loginSession != null && $sessionExpiredAtInUnixEpoch < $currentLongMillis) {
            $loginSession->forceDelete();
            return redirect()->action([AuthController::class, "loginForm"])->cookie("X-SIPR-TOKEN", "", -1);
        }

        if ($loginSession === null) {
            return redirect()->action([AuthController::class, "loginForm"])->cookie("X-SIPR-TOKEN", "", -1);
        }

        return $next($request);
    }
}
