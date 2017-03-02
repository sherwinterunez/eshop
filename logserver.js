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

// log server

const TIMEOUT = 1000;

const PORT = 8090;
const ADDRESS = '0.0.0.0';

var PHPFPM = require('./node_modules/node-phpfpm');

var io     = require('./node_modules/socket.io');
var spawn = require('child_process').spawn;
var http = require('http');

var server = http.createServer(function (req, res) {

  res.writeHead(200, {'Content-Type': 'text/html'});

  res.end('end.\n');

});

server.listen(PORT, ADDRESS, function () {
    console.log('Server running at http://%s:%d/', ADDRESS, PORT);
    console.log('Press CTRL+C to exit');
});

var io = io.listen(server);

io.on('connection', function(client){

  console.log(client);

  client.on('call', function(msg, fn) {

    client.myfilename = msg;

    console.log('call',msg);

    fn(0,'sherwin!');

    var tail = spawn("tail", ["-f", client.myfilename]);
    client.send( { filename : client.myfilename } );

    tail.stdout.on("data", function (data) {
      //console.log(data.toString('utf-8'))
      client.send( { tail : data.toString('utf-8') } )
    });

  });

});
