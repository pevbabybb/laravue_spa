// var io = require('socket.io')(6001)
const io = require("socket.io")(6001, {
    cors: {
      origin: "http://localhost:81",
      methods: ["GET", "POST"],
      allowedHeaders: ["my-custom-header"],
      credentials: true
    }
  });
  

console.log('Connected to port 6001')
io.on('error',function(socket){
    console.log('error')
})
io.on('connection',function(socket) {
    console.log('co nguoi vua ket noi' + socket.id)
})

var Redis = require('ioredis')
var redis = new Redis(1001)
redis.psubscribe("*",function(error,count)
{
    //
})
redis.on('pmessage',function(partner,channel,message){
    console.log(partner)
    console.log(channel)
    console.log(message)

    message = JSON.parse(message)
    io.emit(channel + ":" + message.event, message.data.task)
    console.log('Sent')
})

