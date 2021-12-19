const express = require('express');
const app = express();
var Redis = require('ioredis');
var redis = new Redis();


let users =[];
const server = require('http').createServer(app)

const io = require('socket.io')(server, {
    cors: {'origin' : "*"}
});
const myClientList = {};
redis.subscribe('bid', function() {
    console.log('subscribed to bid channel');
});
redis.on('message', function(channel, message) {
    message = JSON.parse(message);
    socket.emit('connected',`Client connected ${socket.id}`);
   
});
io.on('connection',(socket)=>{
    console.log(`Client connected ${socket.id}`);
    socket.emit('connected',`Client connected ${socket.id}`);
     myClientList[socket.id] = socket;   

    socket.on('sendChatToServers',(message)=>{
        console.log(message);
        socket.broadcast.emit('sendChatToClient',message);
    })
    socket.on('join-user',(data)=>{
        let user ={'user':data,socketId:socket.id } 
        users.push(user);
        console.log(users,users.length)
        socket.emit('user-info',users);
    })
    socket.on("test-channel:App\\Events\\TestEvent",(data)=>{
        console.log('bid')
    })

    socket.on('sendChatToRoom',(id)=>{
        socket.broadcast.emit('sendChatToClient',message);
        socket.broadcast.to(id).emit('sendChatToRoom'+id, 'this is the message to all');


    })

    socket.on('disconnect',(socket)=>{
        const index = users.find(el=>{el.socketId})
        users.splice(index, 1);
        console.log('disconnect')
    })
})


server.listen(6050 , ()=>{
    console.log('server is running')
})