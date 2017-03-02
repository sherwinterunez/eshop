

//const TIMEOUT = 10000;
const TIMEOUT = 1000;

const PORT = 8080;
const ADDRESS = '0.0.0.0';

var PHPFPM = require('./node_modules/node-phpfpm');

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
    documentRoot: '/srv/www/sms101.dev/',
});

/*console.log(phpfpm);

phpfpm.run('sms3.php', function(err, output, phpErrors)
{
    if (err == 99) console.error('PHPFPM server error');
    console.log(output);
    if (phpErrors) console.error(phpErrors);
});*/

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

var runPortCheck = false;

var portCheckRunning = false;

var lastSim = false;

function portCheck() {

  if(portCheckRunning) return false;

  if(processCount>0) {
    setTimeout(function(){
      portCheck();
    }, 500);
    return false;              
  }

  if(terminateFlag) {
    process.exit(1);
  }

  portCheckRunning = true;

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
      
      //console.log(output);

      //setTimeout(doInit, (60*1000*2));

      //setTimeout(function(){
      //  retrieveSMS(dev);
      //}, 10000);

      runPortCheck = false;

      portCheckRunning = false;

      if(obj) {

        //var sims = ['/dev/ttyUSB0','/dev/ttyUSB1'];

        sims = obj.ports;

        lastSim = sims[sims.length-1];

        for(var i in sims) {

         //console.log('sim: '+sims[i]);

          simInit(sims[i]);
        }

      } else {
        setTimeout(function(){
          portCheck();
        }, TIMEOUT);
      }

      if (phpErrors) console.error(phpErrors);
  });

}

function simInit(dev) {

    processCount++;

    phpfpm.run('siminit.php?dev='+dev, function(err, output, phpErrors)
    {
        if (err == 99) console.error('PHPFPM server error');
        
        console.log(output);

        //setTimeout(doInit, (60*1000*2));

        //processCount--;

        setTimeout(function(){
          retrieveSMS(dev);
        }, TIMEOUT);
        
        if (phpErrors) console.error(phpErrors);
    });

}

function retrieveSMS(dev) {

    //processCount++;

    phpfpm.run('retrieve2.php?dev='+dev, function(err, output, phpErrors)
    {
        if (err == 99) console.error('PHPFPM server error');
        
        console.log(output);

        //setTimeout(doInit, (60*1000*2));

        //processCount--;

        setTimeout(function(){
          processCommands(dev);
          //processOutbox(dev);
        }, TIMEOUT);
        
        if (phpErrors) console.error(phpErrors);
    });

}

function processCommands(dev) {

    //processCount++;

    phpfpm.run('process4.php?dev='+dev, function(err, output, phpErrors)
    {
        if (err == 99) console.error('PHPFPM server error');
        
        console.log(output);

        //setTimeout(doInit, (60*1000*2));

        //processCount--;

        setTimeout(function(){
          processOutbox(dev);
        }, TIMEOUT);
        
        if (phpErrors) console.error(phpErrors);
    });

}

function processOutbox(dev) {

    //processCount++;

    phpfpm.run('processoutbox2.php?dev='+dev, function(err, output, phpErrors)
    {
        if (err == 99) console.error('PHPFPM server error');
        
        console.log(output);

        processCount--;

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
          simInit(dev);
        }
        
        if (phpErrors) console.error(phpErrors);
    });

}

function systemPaused() {

  if(pauseFlag) {

    console.log('System is paused.');

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

    }
    if(sims.length) {
      lastSim = sims[sims.length-1];

      for(var i in sims) {

       //console.log('sim: '+sims[i]);

        simInit(sims[i]);
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

