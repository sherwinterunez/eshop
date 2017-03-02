/*
*
* Author: Sherwin R. Terunez
* Contact: sherwinterunez@yahoo.com
*
* Description:
*
* NodeJS Log Server
*
* December 7, 2016
*
*/

// log receiver

const SERVER_IP = '192.168.1.80';

var io     = require('./node_modules/socket.io-client');
var spawn = require('child_process').spawn;
var http = require('http');

var server = http.createServer(function (req, res) {

  res.writeHead(200, {'Content-Type': 'text/html'});

  res.end('end.\n');

});

var portfinder = require('portfinder');

portfinder.getPort(function (err, port) {
  server.listen(port, '127.0.0.1', function () {
      //console.log('Server running at http://%s:%d/', '127.0.0.1', port);
      //console.log('Press CTRL+C to exit');
  });
});

var app = function() {

  var socket = io.connect('http://'+SERVER_IP+':8080/',{
    'reconnection': true,
    'reconnectionDelay': 10,
    'reconnectionAttempts': 999999
  });

  var lines = 0;

  socket.emit('call', '/var/log/php-fpm/www-error.log', function(resp, data) {
      //console.log('server sent resp code ' + resp, data);
  });

  //tell socket.io to never give up :)
  socket.on('error', function(){
    console.log('socket error');
    //socket.connect();
  });

  socket.on('disconnect', function(){
    console.log('socket disconnect');
    //socket.connect();
    setTimeout( app, 5000 );
  });

  socket.on('connect', function() {
    //console.log('Connected to:', socket.host);
  });

  socket.on('message', function(message) {
    //console.log('Received message:', message);
    //if (message.filename) {
    //  $('#info').html( '$ tail -f ' + message.filename );
    //};
    if (message.tail) {
      //$('#tail').html( $('#tail').html() + message.tail );
      //lines++
      //$('#tail').scrollTop(lines*100)
      console.log(message.tail);
    }
  });

};

app();
