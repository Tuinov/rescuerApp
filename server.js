var http = require('http').server();
var io = require('socket.io')(http);
var Redis = require('ioredis');

var redis = new Redis();
redis.subscribe('news-action');
redis.on('message', function(channel, message){

    message = JSON.parse(message);
    io.emit(channel + ':' + message.event, message.data)
});

http.listen(3000, function() {
    console.log('Listening on port: 3000');
});