<?php
require_once 'vendor\autoload.php';

use game\controller\Controller;
use Illuminate\Database\Capsule\Manager as DB;



$container = new Slim\Container(['settings' => ['displayErrorDetails' => true]]);
$app = new Slim\App($container);


$db = new DB();
$db->addConnection(parse_ini_file(__DIR__.'/src/conf/conf.ini'));
$db->setAsGlobal();
$db->bootEloquent();

$app->get("/api/games/{id}[/]", Controller::class.":gameById")->setName("gameById");
$app->get("/api/games[/]", Controller::class.":gameByGame")->setName("gameByGame");

$app->run();



