<?php
namespace game\requetes;

use game\models\Character;
use game\models\Company;
use game\models\Game;
use game\models\Game_rating;
use game\models\Genre;
use game\models\Platform;

class RequestManager
{

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
        $games = Game::where('name', 'like', 'Mario%')->get();
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
        $companys = Company::where("name", "like", "%Sony%")->get();
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
}