rabbitmq-samples
================

Samples for RabbitMQ

There are several different scripts :
* PHP Producer
* PHP Consumer
* Node.js Producer
* Node.js Consumer

## Create your application vhost :

First, create a vhost for your application :
    rabbitmqctl add_vhost /myapp
    rabbitmqctl add_user myuser mypasswd
    rabbitmqctl set_permissions -p /myapp myuser ".*" ".*" ".*"

## Requirements

To use the PHP scripts you need [php-amqlib](https://github.com/videlalvaro/php-amqplib/).
To use the Node.js scripts you need install [node-amqp](https://github.com/postwait/node-amqp) by runing the command : `npm install amqp`.

## About PHP Producer

It produce message in a random queue between myapp-1 to myapp-5.
If you want produce in a single queue just comment the line and uncomment the other beside.
Run with : `php prod.php message`

## About PHP Consumer

It read message from only one queue.
But if you comment the line about the queue name and uncomment the other beside, the queue change between myapp-1 to myapp-5 at each run.
Run with : `php cons.php`

## About Node.js Consumer

It read message only from the first queue, you need duplicate script and rename the queue to read message from other queues.
Run with : `node cons.js`

## About Node.js Producer

It produce message in only one queue.
Run with : `node prod.js`

