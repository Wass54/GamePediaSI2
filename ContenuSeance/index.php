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



$fakerFr = Faker\Factory::create('fr_FR');
$fakerIt = Faker\Factory::create('it_IT');
$fakerEs = Faker\Factory::create('es_ES');
$fakerEn = Faker\Factory::create();
for($i=0;$i<25000;$i++){

    switch (rand(0,10)){

    $u = new User();

        case 1:
            echo "français :" . "<br>";
            echo $fakerFr->firstName() . "<br>";
            echo $fakerFr->lastName() . "<br>";
            echo $fakerFr->address() . "<br>";
            echo $fakerFr->email() . "<br>";
            echo $fakerEn->date() . "<br>";
            echo $fakerFr->text() . "<br>";
            break;
        case 2:
            echo "Italien :" . "<br>";
            echo $fakerIt->firstName() . "<br>";
            echo $fakerIt->lastName() . "<br>";
            echo $fakerIt->address() . "<br>";
            echo $fakerIt->email() . "<br>";
            echo $fakerIt->text() . "<br>";
            break;
        case 3:
            echo "Espagnol :" . "<br>";
            echo $fakerEs->firstName() . "<br>";
            echo $fakerEs->lastName() . "<br>";
            echo $fakerEs->address() . "<br>";
            echo $fakerEs->email() . "<br>";
            echo $fakerEs->text() . "<br>";
            break;
        default:
            echo "Englais :" . "<br>";
            echo $fakerEn->firstName() . "<br>";
            echo $fakerEn->lastName() . "<br>";
            echo $fakerEn->address() . "<br>";
            echo $fakerEn->email() . "<br>";
            echo $fakerEn->text() . "<br>";
            break;
    }

    echo "______________________ " . $i . "______________________ <br>";
}
