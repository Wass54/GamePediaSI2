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
DB::enableQueryLog();

$rm = new RequestManager();




/**
$rm->listGameStartingWith("Mario");
$rm->listGameStartingWith("Sonic");
$rm->listGameStartingWith("World");

$rm->listGameContaining("Mario");
$rm->listGameContaining("Sonic");
$rm->listGameContaining("World");


$rm->listGamesWithMario();
echo '<br>';
$rm->displayCharacter12342();
echo '<br>';
//méthode afficher les noms des persos apparus pour la 1ere fois dans 1 jeu dont le nom contient Mario
//echo '<br>';
$rm->characterWithMarioGameName();
echo '<br>';
$rm->gameDevelopedBySony();
echo '<br>';

$compteur = 0;
foreach( DB::getQueryLog() as $q){
    $compteur++;
    echo "-------------- <br>";
    echo "query : " . $q['query'] ."<br>";
    echo "bindings : [";
    foreach ($q['bindings'] as $b ) {
        echo " ". $b."," ;
    }
    echo " ] <br><br>";
};
echo 'Nombre de requêtes executées : ' . $compteur;
**/

$rm->creationOf2UsersWith3CommentsGame12342();