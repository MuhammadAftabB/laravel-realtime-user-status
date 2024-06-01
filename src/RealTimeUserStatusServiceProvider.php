namespace MuhammadAftab\RealTimeUserStatus;

use Illuminate\Support\ServiceProvider;

class RealTimeUserStatusServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/realtime-user-status.php', 'realtime-user-status');

        // Load helpers
        require_once __DIR__.'/Helpers/RealTimeUserStatusHelper.php';
    }

    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/realtime-user-status.php' => config_path('realtime-user-status.php'),
            __DIR__.'/../resources/js' => public_path('vendor/realtime-user-status/js'),
        ], 'realtime-user-status');

        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

        $this->app['router']->aliasMiddleware('update-user-status', \MuhammadAftab\RealTimeUserStatus\Http\Middleware\UpdateUserStatus::class);
        $this->app['router']->aliasMiddleware('log-user-activity', \MuhammadAftab\RealTimeUserStatus\Http\Middleware\LogUserActivity::class);
    }
}
