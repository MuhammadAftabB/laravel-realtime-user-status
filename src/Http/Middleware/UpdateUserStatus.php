namespace MuhammadAftab\RealTimeUserStatus\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use MuhammadAftab\RealTimeUserStatus\Events\UserOnlineStatusChanged;

class UpdateUserStatus
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            $user = Auth::user();
            $user->update([
                'is_online' => true,
                'last_activity' => now()
            ]);

            broadcast(new UserOnlineStatusChanged($user));
        }

        return $next($request);
    }

    public function terminate($request, $response)
    {
        if (Auth::check()) {
            $user = Auth::user();
            $user->update(['is_online' => false]);

            broadcast(new UserOnlineStatusChanged($user));
        }
    }
}
