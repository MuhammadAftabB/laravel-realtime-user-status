<?php

namespace MuhammadAftab\RealTimeUserStatus\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use MuhammadAftab\RealTimeUserStatus\Models\UserActivityLog;

class LogUserActivity
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            $user = Auth::user();
            UserActivityLog::create([
                'user_id' => $user->id,
                'activity' => 'Visited ' . $request->path()
            ]);
        }

        return $next($request);
    }
}
