<?php

namespace MuhammadAftab\RealTimeUserStatus\Helpers;

use App\Models\User;
use MuhammadAftab\RealTimeUserStatus\Models\UserActivityLog;

class RealTimeUserStatusHelper
{
    public static function getOnlineUsers()
    {
        return User::where('is_online', true)->get();
    }

    public static function getUserActivityLogs()
    {
        return UserActivityLog::with('user')->latest()->get();
    }
}
