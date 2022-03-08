<?php
require_once 'vendor\autoload.php';

use game\requetes\RequestManager;
use models\Game;
use Illuminate\Database\Capsule\Manager as DB;



$container = new Slim\Container(['settings' => ['displayErrorDetails' => true]]);
$app = new Slim\App($container);

$db = new DB();
$db->addConnection(parse_ini_file(__DIR__.'/src/conf/conf.ini'));
$db->setAsGlobal();
$db->bootEloquent();

$rm = new RequestManager();
$rm->listGameWithPagination(1);