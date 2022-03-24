<?php
namespace game\requetes;

use DateTime;
use game\models\Character;
use game\models\Comment;
use game\models\Company;
use game\models\Game;
use game\models\Game_rating;
use game\models\Genre;
use game\models\Platform;
use game\models\User;

class RequestManager
{

    function listAllGames(){
        $avant = microtime(true);
        Game::all();
        $apres = microtime(true);
        var_dump($apres-$avant);
    }

    /* ------------------------ TP1  ---------------------------- */
    function listGamesWithMario(){
        $avant = microtime(true);
        $games = Game::where("name", "like", "%Mario%")->get();
        $apres = microtime(true);
        var_dump($apres-$avant);

        foreach ($games as $game){
            echo($game->id . " " . $game->name ."<br>");
        }
    }

    function japanCompanies(){
        foreach (Company::where("location_country", "Japan")->get() as $company){
            echo($company->id . " " . $company->name . "<br>");
        }
    }

    function platformBaseOverTenMillions(){
        foreach (Platform::where("install_base",">=", 10000000)->get() as $platform){
            echo($platform->id . " " . $platform->name . "<br>");
        }
    }

    function listGamesByXeme(){
        foreach (Game::skip(21172)->take(442)->get() as $game){
            echo($game->id . " " . $game->name . "<br>");
        }
    }

    function listGameWithPagination($page){
        foreach (Game::skip(($page*500)-500)->take(500)->get() as $game){
            echo($game->id . " " . $game->name . "<br>" . $game->deck . "<br>");
        }
    }
    /* ---------------------------------------- TP2 -------------------------------------- */
    // Question 1
    function displayCharacter12342(){
        $jeu = Game::where("id", '=', 12342)->first();
        foreach($jeu->characters as $personnage){
            echo("Nom du personnage: " . $personnage->name . "<br>". "Deck du personnage: " . $personnage->deck . "<br><br>");
        }
    }

    // Question 2
    function characterWithMarioGameName(){
        $avant = microtime(true);
        $games = Game::where('name', 'like', 'Mario%')->with('characters')->get();
        $apres = microtime(true);
        var_dump($apres-$avant);
        foreach ($games as $game){
            foreach ($game->characters as $personnage) {
                echo($personnage->id . " " . $personnage->name . "<br>");
            }
        }
    }

    // Question 3
    function gameDevelopedBySony(){
        $companys = Company::where("name", "like", "%Sony%")->with('games')->get();
        foreach ($companys as $company){
            $games = $company->games;
            foreach ($games as $val) {
                echo($val->name . "<br>");
            }
        }
    }

    // Question 4
    function initialRatingWithGameNameContainsMario()
    {
        $games = Game::where('name', 'like', '%mario%')->get();
        foreach ($games as $game) {
            $ratings = $game->ratings;
            foreach ($ratings as $rating) {
                echo($game->name . "<br>Rating : " . $rating->name . "<br>" . "RatingBoard : " . $rating->rating_board->name . "<br><br>");
            }
        }
    }

    //Question 5
    function gameBeginsByMarioAndHasMoreThan3Characters(){
        $games = Game::where('name', 'like', 'Mario%')->has('characters', '>', 3)->get();
            foreach ($games as $game){
                echo("Nom du jeu: " . $game->name ."<br>");
            }
    }

    // Question 6
    public function gamesWithNameStartingWithMarioAndInitialRatingContainingMoreOf3(){
        $avant = microtime(true);
        $ratings = Game_rating::Where('name','like','%3+%')->get();
        foreach ($ratings as $rating){
            $games = $rating->games()->where('name','like','Mario%')->get();
        }
        $apres = microtime(true);
        var_dump($apres-$avant);
        foreach ($ratings as $rating){
            $games = $rating->games()->where('name','like','Mario%')->get();
            foreach ($games as $game){
                echo($game->name."<br>");
            }
        }
    }

    // Question 7
    function marioPublishedByCompaniesWithTheNameIncAndRangIs3PLUS(){

        $games = Game::where('name', 'like', 'Mario%')->whereHas('companies', function($query){
                $query->where('name', 'like', '%Inc.%');
            })->whereHas('ratings', function($q){

                $q->where('name', 'like', '%3+%');

            })->get();
        foreach($games as $game){
            echo("Nom du jeu: " . $game->name."<br>");
        }
        
    }


    //Question 8
    function marioPublishedByCompaniesWithTheNameIncAndRangIs3PLUSIsCERO(){

        $games = Game::where('name', 'like', 'Mario%')->whereHas('companies', function($query){
                $query->where('name', 'like', '%Inc.%');
            })->whereHas('ratings', function($q){

                $q->where('name', 'like', '%3+%');

            })->whereHas('rating_board', function($q) {

                $q->where('name', '=', 'CERO');

            })->get();
        foreach($games as $game){
            echo("Nom du jeu: " . $game->name."<br>");
        }
        
    }


    // Question 9
    public function addNewGenre() {
        $g = new Genre;
        $g->name = "TPS";

        Game::find('12')->genres()->save($g);
        Game::find('56')->genres()->save($g);
        Game::find('345')->genres()->save($g);
    }

    //----------------------------------------------TP3----------------------------------------------
    public function listGameStartingWith($valeur) {
        $avant = microtime(true);
        $games = Game::where("name", "like", $valeur . "%")->get();
        $apres = microtime(true);
        var_dump($apres-$avant);

        foreach ($games as $game){
            echo($game->id . " " . $game->name ."<br>");
        }
    }


    public function listGameContaining($valeur) {
        $avant = microtime(true);
        $games = Game::where("name", "like", "%" .$valeur . "%")->get();
        $apres = microtime(true);
        var_dump($apres-$avant);

        foreach ($games as $game){
            echo($game->id . " " . $game->name ."<br>");
        }
    }

    public function charactersWhoAppearsForTheFirstTimeInAMarioGame() {

        $characters = Character::whereHas("firstAppearsIn", function($q){
            $q->where("name","like","Mario%")->get();
        })->get();

        foreach($characters as $character) {
            echo ("nom : " . $character->name);
        }
    }

    //----------------------------------------------TP4----------------------------------------------
    public function creationOf2UsersWith3CommentsGame12342(){
        $utilisateur1 = new User();
        $commentaire1Utilisateur1 = new Comment();
        $commentaire2Utilisateur1 = new Comment();
        $commentaire3Utilisateur1 = new Comment();

        $utilisateur2 = new User();
        $commentaire1Utilisateur2 = new Comment();
        $commentaire2Utilisateur2 = new Comment();
        $commentaire3Utilisateur2 = new Comment();

        $date = new DateTime('2022-01-01T15:03:01.012345Z');
        $date->format("Y-m-d(H:M)");

        //---------------------Utilisateur 1----------------------------------------
        $utilisateur1->email = 'juventus10@gmail.com';
        $utilisateur1->lastName = 'Malleret';
        $utilisateur1->firstName = 'Maxence';
        $utilisateur1->address = 'rue des versailles';
        $utilisateur1->phoneNumber = '0652070025';
        $utilisateur1->dateOfBirth = date('1956-12-01 15:10:10');
        $utilisateur1->save();


        $commentaire1Utilisateur1->id = 1;
        $commentaire1Utilisateur1->title = 'Evaluation du jeu';
        $commentaire1Utilisateur1->content = 'Bon jeu';
        $commentaire1Utilisateur1->postedBy = 'juventus10@gmail.com';
        $commentaire1Utilisateur1->game = 12342;

        $commentaire2Utilisateur1->id = 2;
        $commentaire2Utilisateur1->title = 'Bug affichage';
        $commentaire2Utilisateur1->content = 'L affichage est mal fait';
        $commentaire2Utilisateur1->postedBy = 'juventus10@gmail.com';
        $commentaire2Utilisateur1->game = 12342;

        $commentaire3Utilisateur1->id = 3;
        $commentaire3Utilisateur1->title = 'Probleme de fps';
        $commentaire3Utilisateur1->content = 'fps très bas ';
        $commentaire3Utilisateur1->postedBy = 'juventus10@gmail.com';
        $commentaire3Utilisateur1->game = 12342;

        //---------------------Utilisateur 2----------------------------------------
        $utilisateur2->email = 'pyramide10@gmail.com';
        $utilisateur2->lastName = 'Ronaldo';
        $utilisateur2->firstName = 'Cristiano';
        $utilisateur2->address = 'rue du portugal';
        $utilisateur2->phoneNumber = '0640206543';
        $utilisateur2->dateOfBirth = date('1956-12-01 15:10:10');
        $utilisateur2->save();


        $commentaire1Utilisateur2->id = 4;
        $commentaire1Utilisateur2->title = 'Contenu';
        $commentaire1Utilisateur2->content = 'Manque de contenu';
        $commentaire1Utilisateur2->postedBy = 'pyramide10@gmail.com';
        $commentaire1Utilisateur2->game = 12342;

        $commentaire2Utilisateur2->id = 5;
        $commentaire2Utilisateur2->title = 'Communauté';
        $commentaire2Utilisateur2->content = 'Communauté toxique';
        $commentaire2Utilisateur2->postedBy = 'pyramide10@gmail.com';
        $commentaire2Utilisateur2->game = 12342;

        $commentaire3Utilisateur2->id = 6;
        $commentaire3Utilisateur2->title = 'Driver';
        $commentaire3Utilisateur2->content = 'Problème de driver';
        $commentaire3Utilisateur2->postedBy = 'pyramide10@gmail.com';
        $commentaire3Utilisateur2->game = 12342;

        $commentaire1Utilisateur1->save();
        $commentaire2Utilisateur1->save();
        $commentaire3Utilisateur1->save();
        $commentaire1Utilisateur2->save();
        $commentaire2Utilisateur2->save();
        $commentaire3Utilisateur2->save();
    }



    public function addUser() {
        
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
    }





    public function addComment() {
                

        $faker = Faker\Factory::create();

        for($i=0;$i<25000;$i++){

            $c = new Comment();

            //id	title	content	created_at	updated_at	postedBy	game	
            $title;
            $content;
            $created_at;
            $updated_at;
            $postedBy;
            $game;

            $games = Game::count();
            $users = User::count();

            $game = rand(1,$games);

            $title = $faker->title();
            $content = $faker->text();
            $created_at = $faker->date($faker->date());
            $updated_at = $faker->date($faker->date());
            $postedBy = $rand(1,$users);
            
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
    }

}