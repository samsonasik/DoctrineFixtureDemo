<?php

chdir(__DIR__);

$loader = null;
if (file_exists('../vendor/autoload.php')) {
    $loader = include '../vendor/autoload.php';
} else {
    throw new RuntimeException('vendor/autoload.php could not be found. Did you run `php composer.phar install`?');
}

$loader->add('DoctrineFixtureDemotest', __DIR__);
\DoctrineFixtureDemotest\FixtureManager::start();
