import Echo from "laravel-echo";
import Pusher from "pusher-js";

window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: process.env.MIX_PUSHER_APP_KEY,
    cluster: process.env.MIX_PUSHER_APP_CLUSTER,
    encrypted: true
});

window.Echo.channel('online-users')
    .listen('UserOnlineStatusChanged', (e) => {
        let userElement = document.getElementById(`user-${e.user.id}`);
        if (userElement) {
            if (e.user.is_online) {
                userElement.innerText = `${e.user.name} - Online`;
            } else {
                let lastActivity = new Date(e.user.last_activity);
                let timeAgo = moment(lastActivity).fromNow();
                userElement.innerText = `${e.user.name} - Last seen ${timeAgo}`;
            }
        }
    });
