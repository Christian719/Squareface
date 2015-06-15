/* SERVER */
var io = require('socket.io').listen(8090); // this is the port for the comunication of each socket with the server

io.sockets.on('connection', function (socket) { // this function start the server
    
    socket.emit('welcomeMessage', {  //emit a message when a new socket connect with the server
        message: 'Hello How Are you?'     
    });
    
    socket.on('showme',function(data){ // emit a message to all sockets connected on the server
       io.sockets.emit('showme',{      // if the message require emit a aditional data
           username:data.username
       });
    });
    
});