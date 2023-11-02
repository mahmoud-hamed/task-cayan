const http = require('http');
const server = http.createServer();
const io = require('socket.io')(server);

server.listen(3000); // Use the desired port

io.on('connection', (socket) => {
    console.log('A user connected');
    // Handle events and broadcasts here
});
