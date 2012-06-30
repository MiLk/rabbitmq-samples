<?php

include_once(__DIR__.'/autoload.php');
//define('AMQP_DEBUG', true);

use PhpAmqpLib\Connection\AMQPConnection;
use PhpAmqpLib\Message\AMQPMessage;

$queue = 'myapp-'.((rand() % 5) + 1);
//$queue = 'myapp-1';

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

$msg_body = implode(' ', array_slice($argv, 1));
echo $msg_body . "\r\n";
$msg = new AMQPMessage(json_encode($msg_body), array('content_type' => 'text/plain', 'delivery_mode' => 2));
$ch->basic_publish($msg, '', $queue);

$ch->close();
$conn->close();

