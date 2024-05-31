namespace MuhammadAftab\RealTimeUserStatus\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UserOnlineStatusChanged implements ShouldBroadcast
{
use Dispatchable, InteractsWithSockets, SerializesModels;

public $user;

public function __construct($user)
{
$this->user = $user;
}

public function broadcastOn()
{
return new Channel('online-users');
}
}
