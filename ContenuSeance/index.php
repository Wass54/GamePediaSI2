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
$app->get("/api/games[/]", Controller::class.":allGames")->setName("games");
$app->get("/api/comments/{id}[/]", Controller::class.":comment")->setName("comment");
$app->get("/api/games/{id}/comments[/]", Controller::class.":listCommentsForGame")->setName("comments");
$app->post('/api/games/{id}/comments[/]',Controller::class.":postComment")->setName("postComment");
$app->get("/api/games/{id}[/]", Controller::class.":gameByIdDetailled")->setName("detailled");
$app->get('/api/characters/{id}[/]', Controller::class.":characterById")->setName("character");
$app->get("/api/games/{id}/characters[/]", Controller::class.":listCharactersForGame")->setName("charactersForGame");
$app->get("/api/links[/]", Controller::class.":collectionLinks")->setName("collectionLinks");



$app->run();



