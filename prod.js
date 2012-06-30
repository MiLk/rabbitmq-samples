var amqp = require('amqp');

var connection = amqp.createConnection({ host: 'localhost', login : 'myuser', password: 'mypasswd', vhost:'/myapp' });

var count = 1;

// Wait for connection to become established.
connection.on('ready', function () {
  var sendMessage = function(connection, payload) {
    var encoded_payload = JSON.stringify(payload);  
    connection.publish('myapp-1', encoded_payload);
  }

  setInterval( function() {    
    var test_message = "Hello World !";
    sendMessage(connection, test_message)  
    count += 1;
  }, 2000) 
});

connection.on('error',function(err) {
    console.log(err);
});

