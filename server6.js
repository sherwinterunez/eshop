

//const TIMEOUT = 10000;
const TIMEOUT = 10;

const PORT = 8080;
const ADDRESS = '0.0.0.0';

var PHPFPM = require('./node_modules/node-phpfpm');

var io     = require('./node_modules/socket.io');
var spawn = require('child_process').spawn;
var http = require('http');

//var PHPFPM = require('/usr/local/etc/node_modules/node-phpfpm');

//var serialport = require('serialport');

//var SerialPort = serialport.SerialPort;

//var parsers = serialport.parsers;

//var SerialPort = require('serialport').SerialPort;

//var parsers = serialport.parsers;

/*var port = new SerialPort('/dev/cu.usbserial',{
  baudrate: 115200,
  parser: parsers.readline('\r\n'),
});*/

//var PHPFPM = require('./nodejs/node-phpfpm');

var phpfpm = new PHPFPM(
{
    host: '127.0.0.1',
    port: 9000,
    //documentRoot: __dirname + '/',
    //documentRoot: '/WEBDEV/sms101.dev/',
    //documentRoot: '/srv/www/sms102.dev/',
    documentRoot: '/srv/www/eshop.dev/',
});

/*console.log(phpfpm);

phpfpm.run('sms3.php', function(err, output, phpErrors)
{
    if (err == 99) console.error('PHPFPM server error');
    console.log(output);
    if (phpErrors) console.error(phpErrors);
});*/

var debug = true;

var runPortCheck = false;

var portCheckRunning = false;

var lastSim = false;

var processCount = 0;

var terminateFlag = false;

var pauseFlag = false;

var sims = false;

var ctr = 1;

var http = require('http');

var server = http.createServer(function (req, res) {
  res.writeHead(200, {'Content-Type': 'text/html'});
  //res.end('Hello World\n');
  //console.log(req);
  //console.log(res);

  //console.log('req.method => '+req.method);

  //console.log('req.url => '+req.url);

  /*if(req.url==='/test') {
    //doTest();
    setTimeout(function(){
      doTest(ctr++);
    }, 10);

    res.end('/test.\n');

    return true;
  }*/

  if(req.url==='/terminate') {
    terminateFlag = true;
    runPortCheck = true;
    res.end('terminating.\n');

    return true;
  }

  if(req.url==='/process') {
    res.end('processCount: '+processCount+'\n');
    return true;
  }

  if(req.url==='/processcount') {
    res.end(''+processCount+'');
    return true;
  }

  if(req.url==='/portcheck') {
    runPortCheck = true;
    pauseFlag = false;
    res.end('checking port.\n');

    return true;
  }

  if(req.url==='/pause') {
    pauseFlag = true;
    res.end('paused.\n');

    return true;
  }

  if(req.url==='/resume') {
    pauseFlag = false;
    res.end('resumed.\n');

    return true;
  }

  if(req.url==='/status') {

    if(portCheckRunning) {
      res.end('scanning');
    } else
    if(pauseFlag) {
      res.end('paused');
    } else {
      res.end('running');
    }

    return true;
  }

  res.end('end.\n');

});

/*port.on('open', function () {
  port.write("AT\r\n", function(err, bytesWritten) {
    if (err) {
      return console.log('Error: ', err.message);
    }
    console.log(bytesWritten, 'bytes written');
  });
});

port.on('data', function (data) {
  console.log('Data: ' + data);
});*/

server.listen(PORT, ADDRESS, function () {
    console.log('Server running at http://%s:%d/', ADDRESS, PORT);
    console.log('Press CTRL+C to exit');

    doInit();
});

var io = io.listen(server);

io.on('connection', function(client){

  //console.log(client);

  client.on('call', function(msg, fn) {

    client.myfilename = msg;

    //console.log('call',msg);

    //fn(0,'sherwin!');

    var tail = spawn("tail", ["-f", client.myfilename]);
    client.send( { filename : client.myfilename } );

    tail.stdout.on("data", function (data) {
      //console.log(data.toString('utf-8'))
      client.send( { tail : data.toString('utf-8') } )
    });

  });

});

/*
var filename = '/var/log/messages';

var io = io.listen(server);

io.on('connection', function(client){
  //console.log('Client connected');
  var tail = spawn("tail", ["-f", filename]);
  client.send( { filename : filename } );

  tail.stdout.on("data", function (data) {
    //console.log(data.toString('utf-8'))
    client.send( { tail : data.toString('utf-8') } )
  });

});
*/

/*var ctr=0;

setInterval(function(){
  console.log('setInterval: '+ctr);
  ctr++;

  phpfpm.run('sms3.php?q=check', function(err, output, phpErrors)
  {
      if (err == 99) console.error('PHPFPM server error');

      console.log(output);

      if (phpErrors) console.error(phpErrors);
  });

},60000);*/

/*function doCheck() {

  phpfpm.run('sms3.php?q=check', function(err, output, phpErrors)
  {
      if (err == 99) console.error('PHPFPM server error');

      console.log(output);

      setTimeout(doCheck, 10);

      if (phpErrors) console.error(phpErrors);
  });

}*/

function doInit() {

  console.log('doInit started.');

  portCheck();

}

function portCheck() {

  if(portCheckRunning) return false;

  //if(processCount>0) {
  //  setTimeout(function(){
  //    portCheck();
  //  }, 500);
  //  return false;
  //}

  if(terminateFlag) {
    process.exit(1);
  }

  portCheckRunning = true;

  console.log("portcheck.php running...");

  phpfpm.run('portcheck.php', function(err, output, phpErrors)
  {
      if (err == 99) console.error('PHPFPM server error');

      var obj = false;

      try {

        var obj = JSON.parse(output);

        //console.log(obj);

      } catch(e) {
        console.log(e);
      }

      console.log("portcheck.php done.");

      //console.log(output);

      //setTimeout(doInit, (60*1000*2));

      //setTimeout(function(){
      //  retrieveSMS(dev);
      //}, 10000);

      runPortCheck = false;

      portCheckRunning = false;

      if(obj&&obj.devices&&obj.devices.length>0) {

        //var sims = ['/dev/ttyUSB0','/dev/ttyUSB1'];

        sims = obj.devices;

        lastSim = sims[sims.length-1].port;

        //for(var i in sims) {

         //console.log('sim: '+sims[i]);

          //simInit(sims[i].port,sims[i].sim,sims[i].ip);
        //}

        setTimeout(function(){
          simInit(sims,0);
        }, TIMEOUT);

      } else {
        setTimeout(function(){
          portCheck();
        }, TIMEOUT);
      }

      if (phpErrors) console.error(phpErrors);
  });

}

function simInit(sims,pos) {
  //console.log({sims:sims,pos:pos,length:sims.length});
  //console.log({test:sims[pos]});

  //if(typeof(pos)==='undefined') {
  //  return false;
  //}

  if(!sims[pos]) {
    //console.log('simInit error.');
    setTimeout(function(){
      //retrieveSMS(dev,sim,ip);
      checkSignal(sims,0);
    }, TIMEOUT);

    return;
  }

  processCount++;

  var dev = sims[pos].port;
  var sim = sims[pos].sim;
  var ip = sims[pos].ip;

  if(debug) console.log("siminit.php "+dev+" "+sim+" "+ip+" running...");

  phpfpm.run('siminit.php?dev='+dev+'&sim='+sim+'&ip='+ip, function(err, output, phpErrors)
  {
      if (err == 99) console.error('PHPFPM server error');

      if(debug) console.log("siminit.php "+dev+" "+sim+" "+ip+" done.");

      //console.log(output);

      //setTimeout(doInit, (60*1000*2));

      //processCount--;

      setTimeout(function(){
        simInit(sims,pos+1);
      }, TIMEOUT);

      if (phpErrors) console.error(phpErrors);
  });

}

function checkSignal(sims,pos) {

  if(!sims[pos]) {
    //console.log('simInit error.');
    setTimeout(function(){
      //retrieveSMS(dev,sim,ip);
      retrieveSMS(sims,0);
    }, TIMEOUT);

    return;
  }

  var dev = sims[pos].port;
  var sim = sims[pos].sim;
  var ip = sims[pos].ip;

  if(debug) console.log("checksignal.php "+dev+" "+sim+" "+ip+" running...");

  phpfpm.run('checksignal.php?dev='+dev+'&sim='+sim+'&ip='+ip, function(err, output, phpErrors)
  {
      if (err == 99) console.error('PHPFPM server error');

      if(debug) console.log("checksignal.php "+dev+" "+sim+" "+ip+" done.");

      //console.log(output);

      //setTimeout(doInit, (60*1000*2));

      //processCount--;

      setTimeout(function(){
        checkSignal(sims,pos+1)
      }, TIMEOUT);

      if (phpErrors) console.error(phpErrors);
  });

}

function retrieveSMS(sims,pos) {

  if(!sims[pos]) {
    //console.log('simInit error.');
    setTimeout(function(){
      //retrieveSMS(dev,sim,ip);
      processCommands(sims,0);
    }, TIMEOUT);

    return;
  }

  var dev = sims[pos].port;
  var sim = sims[pos].sim;
  var ip = sims[pos].ip;

  //processCount++;

  //console.log("retrieve2.php "+dev+" "+sim+" "+ip+" running...");
  if(debug) console.log("retrieve4.php "+dev+" "+sim+" "+ip+" running...");

  //phpfpm.run('retrieve2.php?dev='+dev+'&sim='+sim+'&ip='+ip, function(err, output, phpErrors)
  phpfpm.run('retrieve4.php?dev='+dev+'&sim='+sim+'&ip='+ip, function(err, output, phpErrors)
  {
      if (err == 99) console.error('PHPFPM server error');

      if(debug) console.log("retrieve4.php "+dev+" "+sim+" "+ip+" done.");

      //console.log(output);

      //setTimeout(doInit, (60*1000*2));

      //processCount--;

      setTimeout(function(){
        retrieveSMS(sims,pos+1);
      }, TIMEOUT);

      if (phpErrors) console.error(phpErrors);
  });

}

function processCommands(sims,pos) {

  if(!sims[pos]) {
    //console.log('simInit error.');
    setTimeout(function(){
      //retrieveSMS(dev,sim,ip);
      processOutbox(sims,0);
    }, TIMEOUT);

    return;
  }

  var dev = sims[pos].port;
  var sim = sims[pos].sim;
  var ip = sims[pos].ip;

  //processCount++;

  if(debug) console.log("process4.php "+dev+" "+sim+" "+ip+" running...");

  phpfpm.run('process4.php?dev='+dev+'&sim='+sim+'&ip='+ip, function(err, output, phpErrors)
  {
      if (err == 99) console.error('PHPFPM server error');

      if(debug) console.log("process4.php "+dev+" "+sim+" "+ip+" done.");

      //console.log(output);

      //setTimeout(doInit, (60*1000*2));

      //processCount--;

      setTimeout(function(){
        processCommands(sims,pos+1);
      }, TIMEOUT);

      if (phpErrors) console.error(phpErrors);
  });

}

function processOutbox(sims,pos) {

  if(!sims[pos]) {
    //console.log('simInit error.');
    setTimeout(function(){
      //retrieveSMS(dev,sim,ip);
      checkError(sims,0);
    }, TIMEOUT);

    return;
  }

  var dev = sims[pos].port;
  var sim = sims[pos].sim;
  var ip = sims[pos].ip;

  //processCount++;

  if(debug) console.log("processoutbox2.php "+dev+" "+sim+" "+ip+" running...");

  phpfpm.run('processoutbox2.php?dev='+dev+'&sim='+sim+'&ip='+ip, function(err, output, phpErrors)
  {
      if (err == 99) console.error('PHPFPM server error');

      if(debug) console.log("processoutbox2.php "+dev+" "+sim+" "+ip+" done.");

      //console.log(output);

      setTimeout(function(){
        processOutbox(sims,pos+1);
      }, TIMEOUT);

      if (phpErrors) console.error(phpErrors);
  });

}

function checkError(sims,pos) {

  if(!sims[pos]) {
    //console.log('simInit error.');
    setTimeout(function(){
      //retrieveSMS(dev,sim,ip);
      simInit(sims,0);
    }, TIMEOUT);

    return;
  }

  var dev = sims[pos].port;
  var sim = sims[pos].sim;
  var ip = sims[pos].ip;

  //processCount++;

  if(debug) console.log("checkerror.php "+dev+" "+sim+" "+ip+" running...");

  phpfpm.run('checkerror.php?dev='+dev+'&sim='+sim+'&ip='+ip, function(err, output, phpErrors)
  {
      if (err == 99) console.error('PHPFPM server error');

      if(debug) console.log("checkerror.php "+dev+" "+sim+" "+ip+" done.");

      //console.log(output);

      if(output.match(/STATUS_SIMERROR/)) {
        console.log("checkerror.php / STATUS_SIMERROR / "+dev+" "+sim+" "+ip);
        runPortCheck = true;
      } else
      if(output.match(/STATUS_AT_ERROR/)) {
        console.log("checkerror.php / STATUS_AT_ERROR / "+dev+" "+sim+" "+ip);
        //runPortCheck = true;
      }

      if(processCount>0) {
        processCount--;
      }

      if(pauseFlag) {

        if(lastSim===dev) {

          setTimeout(function(){
            //simInit(dev);
            systemPaused();
          }, TIMEOUT);

        }

      } else
      if(runPortCheck) {

        if(lastSim===dev) {

          setTimeout(function(){
            //simInit(dev);
            portCheck();
          }, TIMEOUT);

        }

      } else {

        setTimeout(function(){
          //simInit(dev);
          checkError(sims,pos+1);
        }, TIMEOUT);

      }

      if (phpErrors) console.error(phpErrors);
  });

}

function systemPaused() {

  if(pauseFlag) {

    console.log('System is paused.');

    if(terminateFlag) {
      process.exit(1);
    }

    setTimeout(function(){
      //simInit(dev);
      systemPaused();
    }, TIMEOUT);

  } else {

    if(runPortCheck) {

        setTimeout(function(){
          //simInit(dev);
          portCheck();
        }, TIMEOUT);

    } else
    if(sims.length) {
      lastSim = sims[sims.length-1].port;

      for(var i in sims) {

       //console.log('sim: '+sims[i]);

        simInit(sims[i].port,sims[i].sim,sims[i].ip);
      }
    }

    /*setTimeout(function(){
      //simInit(dev);
      portCheck();
    }, TIMEOUT);  */

  }

}


function doTest(ctr) {

    //ctr++;

    phpfpm.run('test102.php?ctr='+ctr, function(err, output, phpErrors)
    {
        if (err == 99) console.error('PHPFPM server error');

        console.log(output);

        try {
          var ret = JSON.parse(output);

          //console.log(ret);

          console.log('ctr => '+ret.ctr);
          console.log('timer => '+ret.timer);

        } catch(e) {
          console.log(e);
        }

        if (phpErrors) console.error(phpErrors);
    });

}

//doCheck();
