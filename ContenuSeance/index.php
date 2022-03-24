<?php
require_once 'vendor\autoload.php';

use game\requetes\RequestManager;
<<<<<<< Updated upstream
=======
use models\Game;
use game\models\User;
>>>>>>> Stashed changes
use Illuminate\Database\Capsule\Manager as DB;



$container = new Slim\Container(['settings' => ['displayErrorDetails' => true]]);
$app = new Slim\App($container);


$db = new DB();
$db->addConnection(parse_ini_file(__DIR__.'/src/conf/conf.ini'));
$db->setAsGlobal();
$db->bootEloquent();
DB::enableQueryLog();

//$rm = new RequestManager();




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




$fakerFr = Faker\Factory::create('fr_FR');
$fakerIt = Faker\Factory::create('it_IT');
$fakerEs = Faker\Factory::create('es_ES');
$fakerEn = Faker\Factory::create();
for($i=0;$i<25000;$i++){

    $u = new User();


    $firstName;
    $lastName;
    $address;
    $email;
    $phone;
    $date;



    switch (rand(0,10)){
        case 1:
            echo "français :" . "<br>";
            $firstName = $fakerFr->firstName();
            $lastName = $fakerFr->lastName();
            $address = $fakerFr->address();
            $email = $fakerFr->email();
            $phone = $fakerFr->phoneNumber();
            $date = $fakerFr->date();

            break;
        case 2:
            echo "Italien :" . "<br>";
            $firstName = $fakerIt->firstName();
            $lastName = $fakerIt->lastName();
            $address = $fakerIt->address();
            $email = $fakerIt->email();
            $phone = $fakerIt->phoneNumber();
            $date = $fakerIt->date();

            break;
        case 3:
            echo "Espagnol :" . "<br>";
            $firstName = $fakerEs->firstName();
            $lastName = $fakerEs->lastName();
            $address = $fakerEs->address();
            $email = $fakerEs->email();
            $phone = $fakerEs->phoneNumber();
            $date = $fakerEs->date();

            break;
        default:
            echo "Englais :" . "<br>";
            $firstName = $fakerEn->firstName();
            $lastName = $fakerEn->lastName();
            $address = $fakerEn->address();
            $email = $fakerEn->email();
            $phone = $fakerEn->phoneNumber();
            $date = $fakerEn->date();
            break;
    }

    echo $firstName . "<br>";
    echo $lastName . "<br>";
    echo $address . "<br>";
    echo $email . "<br>";
    echo $phone . "<br>";
    echo $date . "<br>";


    $u->firstName = $firstName;
    $u->lastName = $lastName;
    $u->address = $address;
    $u->email = $email;
    $u->phoneNumber = $phone;
    $u->dateOfBirth = date($date);

    $u->save();

    echo "______________________ " . $i . "______________________ <br>";
}
