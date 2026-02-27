<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Models\LoginHistory;

class AutoLogout
{
    public function handle($request, Closure $next)
    {
        $timeout = 10 * 60; // 🔥 10 minutes

        if (Auth::check()) {

            $lastSeen = Auth::user()->last_seen;

            if ($lastSeen && now()->diffInSeconds($lastSeen) > $timeout) {

                // logout history update
                LoginHistory::where('user_id', Auth::id())
                    ->whereNull('logout_at')
                    ->latest()
                    ->first()?->update([
                            'logout_at' => now()
                        ]);

                Auth::logout();
                session()->invalidate();
                session()->regenerateToken();

                return redirect('/login')
                    ->with('message', 'Session expired due to 10 minutes inactivity.');
            }
        }

        return $next($request);
    }
}