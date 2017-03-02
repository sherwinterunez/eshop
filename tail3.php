<!DOCTYPE html>
<html>
<head>
  <title>tail.js</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <script src="/templates/default/js/jquery-1.11.3.min.js"></script>
  <script src="http://<?php echo $_SERVER['SERVER_ADDR']; ?>:8080/socket.io/socket.io.js"></script>

  <style>
    body
      { color: #1a2c37;
        font-family: 'Helvetica', sans-serif; font-size: 86%;
        padding: 0; 
        margin: 0;
      }
    #info
      { font-size: 120%;
        font-weight: bold; }
    #tail
      { 
        width: 99%;
        height: auto;
        padding: 0;
        margin: 0 auto;
        overflow: hidden;
        position: relative;
        overflow-y: auto; }
  </style>

</head>
<body>
  <pre id="info"></pre>
  <pre id="tail"></pre>

  <script>

  var Application = function() {
    
   //var socket  = new io.Socket('http://127.0.0.1', {port: 8080});
    //var socket = io.connect('http://sms101.remote:8080/');
    var socket = io.connect('http://<?php echo $_SERVER['SERVER_ADDR']; ?>:8080/');

    var lines = 0;

    socket.on('connect', function() {
      console.log('Connected to:', socket.host);
    });
    
    socket.on('message', function(message) {
      console.log('Received message:', message);
      //if (message.filename) {
      //  $('#info').html( '$ tail -f ' + message.filename );
      //};
      if (message.tail) {
        $('#tail').html( $('#tail').html() + message.tail );
        lines++
        $('#tail').scrollTop(lines*100)
      }
    });
    
    return {
      socket : socket
    };
  };
 
  $(function() { var app = Application(); });

  </script>

</body>
</html>
