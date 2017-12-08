//var socket = require('express');
var express = require('express');
var http = require('http');
var https = require('http');
var socket = require('socket.io');
var logger = require('winston');


logger.remove(logger.transports.Console);
logger.add(logger.transports.Console,{colorize: true, timestamp:true});
logger.info('SocketIO > Listening on port');

var app = express();
var http_server = http.createServer(app).listen(3001);

function emitNewProcess(server)
{
	var io = socket.listen(server);
	io.sockets.on('connection', function(socket) {
		console.log('a user connected');
		
		
		socket.on('NewProcess', function(data) {
			io.emit("NewProcess",data);
			console.log(data);
			
		});
		
		socket.on('NewAccount', function(data) {
				io.emit("NewAccount",data);
				console.log(data);
		});
		
		socket.on('NewCompany', function(data) {
				io.emit("NewCompany",data);
				console.log(data);
		});
		
		socket.on('NewRole', function(data) {
				io.emit("NewRole",data);
				console.log(data);
		});
		
		
		socket.on('disconnect', function() {
			console.log('user disconnected');
			
		});

	});

}

emitNewProcess(http_server);





