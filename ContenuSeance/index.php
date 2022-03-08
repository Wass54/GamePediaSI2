<?php
require_once 'vendor\autoload.php';

$container = new Slim\Container(['settings' => ['displayErrorDetails' => true]]);
$app = new Slim\App($container);
