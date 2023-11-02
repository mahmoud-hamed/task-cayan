import Echo from 'laravel-echo'

window.Echo = new Echo({
    broadcaster: 'socket.io',
    host: 'http://your-server-ip:3000' // Use the IP and port where your server is running
})
