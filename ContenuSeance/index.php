<?php
require_once 'vendor\autoload.php';

use game\requetes\RequestManager;
use game\models\Game;
use game\models\User;
use game\models\Comment;
use Illuminate\Database\Capsule\Manager as DB;



$container = new Slim\Container(['settings' => ['displayErrorDetails' => true]]);
$app = new Slim\App($container);


$db = new DB();
$db->addConnection(parse_ini_file(__DIR__.'/src/conf/conf.ini'));
$db->setAsGlobal();
$db->bootEloquent();
DB::enableQueryLog();

$rm = new RequestManager();


/*
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


$faker = Faker\Factory::create();

$games = Game::count();
$users = User::count();

for($i=0;$i<250000;$i++){

    $c = new Comment();
	
    $title;
    $content;
    $created_at;
    $updated_at;
    $postedBy;
    $game;

    $game = rand(1,$games);

    $title = $faker->title();
    $content = $faker->text();
    $created_at = $faker->date($faker->date());
    $updated_at = $faker->date($faker->date());
    $postedBy = rand(1,$users);
    
    echo $title . "<br>";
    echo $content . "<br>";
    echo $created_at . "<br>";
    echo $updated_at . "<br>";
    echo $postedBy . "<br>";
    echo $game . "<br>";

    $c->title = $title;
    $c->content = $content;
    $c->created_at = $created_at;
    $c->updated_at = $updated_at;
    $c->postedBy = $postedBy;
    $c->game = $game;

    $c->save();

    echo "______________________ " . $i . "______________________ <br>";
}