<?php

require_once(__DIR__ . '/php-amqplib/vendor/symfony/Symfony/Component/ClassLoader/UniversalClassLoader.php');

use Symfony\Component\ClassLoader\UniversalClassLoader;

$loader = new UniversalClassLoader();
$loader->registerNamespaces(array(
            'PhpAmqpLib' => __DIR__ . '/php-amqplib',
        ));

$loader->register();

