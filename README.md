# Laravel Real-Time User Status

A Laravel package for tracking and displaying real-time user online status.

## Installation

1. **Require the package via Composer:**
   ```bash
   composer require muhammadaftabb/laravel-realtime-user-status
Publish the package assets and configuration:

bash
Copy code
php artisan vendor:publish --provider="MuhammadAftab\RealTimeUserStatus\RealTimeUserStatusServiceProvider" --tag=realtime-user-status
Run the migrations:

bash
Copy code
php artisan migrate
Configure Pusher:
Add your Pusher credentials to your .env file:

env
Copy code
PUSHER_APP_ID=your-pusher-app-id
PUSHER_APP_KEY=your-pusher-app-key
PUSHER_APP_SECRET=your-pusher-app-secret
PUSHER_APP_CLUSTER=your-pusher-app-cluster
Include the JavaScript file in your layout:
Add the following script tag to your main layout file (e.g., resources/views/layouts/app.blade.php):

html
Copy code
<script src="{{ asset('vendor/realtime-user-status/js/realtime-user-status.js') }}" defer></script>
Add Middleware:
Include the middleware in the web middleware group in app/Http/Kernel.php:

php
Copy code
protected $middlewareGroups = [
    'web' => [
        // other middleware...
        \MuhammadAftab\RealTimeUserStatus\Http\Middleware\UpdateUserStatus::class,
        \MuhammadAftab\RealTimeUserStatus\Http\Middleware\LogUserActivity::class,
    ],
];
Usage
Use the helper functions in your Blade views to display online users and their last activity.

Display Online Users
blade
Copy code
<h1>Online Users</h1>
@foreach(\MuhammadAftab\RealTimeUserStatus\Helpers\RealTimeUserStatusHelper::getOnlineUsers() as $user)
    <div id="user-{{ $user->id }}">
        {{ $user->name }} - 
        @if($user->is_online)
            {{ config('realtime-user-status.online_status.online') }}
        @else
            {{ str_replace(':time', $user->last_activity->diffForHumans(), config('realtime-user-status.online_status.offline')) }}
        @endif
    </div>
@endforeach
Display User Activity Log
blade
Copy code
<h1>User Activity Log</h1>
@foreach(\MuhammadAftab\RealTimeUserStatus\Helpers\RealTimeUserStatusHelper::getUserActivityLogs() as $log)
    <div>
        {{ $log->created_at->diffForHumans() }} - {{ $log->user->name }}: {{ $log->activity }}
    </div>
@endforeach
Configuration
The package configuration file is located at config/realtime-user-status.php. You can customize the online and offline status messages there.

php
Copy code
return [
    'pusher' => [
        'app_id' => env('PUSHER_APP_ID'),
        'app_key' => env('PUSHER_APP_KEY'),
        'app_secret' => env('PUSHER_APP_SECRET'),
        'app_cluster' => env('PUSHER_APP_CLUSTER'),
    ],
    'online_status' => [
        'online' => 'Online',
        'offline' => 'Last seen :time ago'
    ]
];
License
This package is open-sourced software licensed under the MIT license.
