<?php

include_once(__DIR__.'/autoload.php');

use PhpAmqpLib\Connection\AMQPConnection;
use PhpAmqpLib\Message\AMQPMessage;

//$queue = 'hyc-'.((rand() % 5) + 1);
$queue = 'hyc-1';

$conn = new AMQPConnection('localhost', 5672, 'myuser', 'mypasswd','/myapp');
$ch = $conn->channel();

/*
    name: $queue
    passive: false
    durable: true // the queue will survive server restarts
    exclusive: false // the queue can be accessed in other channels
    auto_delete: false //the queue won't be deleted once the channel is closed.
*/
$ch->queue_declare($queue, false, true, false, false);

$callback = function($msg) {
  echo $msg->body . "\r\n";
};

$ch->basic_consume($queue,'',false,true,false,false,$callback);

while(count($ch->callbacks)) {
    $ch->wait();
}

$ch->close();
$conn->close();

