<?php

namespace App\Http\Middleware;

use App\Role;
use Closure;
use Psy\Util\Json;
use Tymon\JWTAuth\Facades\JWTAuth;

class ValidateRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     * @throws \Tymon\JWTAuth\Exceptions\JWTException
     */
    public function handle($request, Closure $next, ... $roles)
    {
        $currentUser = JWTAuth::parseToken()->toUser();

        $userRole =  $currentUser->role;

        foreach ($roles as $role) {
            // Check if user has the role This check will depend on how your roles are set up
            if ($userRole == $role)
                return $next($request);
        }

        return response()->json([
            'message' => "Unauthorized"
        ], 401);
    }
}
