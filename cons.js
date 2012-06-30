var amqp = require('amqp');

var connection = amqp.createConnection({ host: 'localhost', login : 'myuser', password: 'mypasswd', vhost:'/myapp' });

// Wait for connection to become established.
connection.on('ready', function () {
  connection.queue('myapp-1', 
    {durable: true, autoDelete: false},
    function(q){
      // Catch all messages
      q.bind('#');

      // Receive messages
      q.subscribe(function (message) {
        // Print messages to stdout
        console.log(JSON.parse(message.data));
      });
      q.on('error', function(err) { console.log(err); });
  });
});

connection.on('error',function(err) {
    console.log(err);
});

