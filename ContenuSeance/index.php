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

//Partie 1
//$app->get("/api/games/{id}", Controller::class.":gameById")->setName("gameById");

// $app->get("/api/games/{page}", Controller::class.":gameByPage")->setName("gameByPage");
$app->get("/api/games", Controller::class.":allGames")->setName("allGames");
$app->get("/api/games/{id}/comments[/]", Controller::class.":listCommentsForGame")->setName("comments");
$app->get("/api/games/{id}", Controller::class.":gameByIdDetailled")->setName("detailled");

$app->run();



