<?php
namespace game\requetes;

use game\models\Character;
use game\models\Company;
use game\models\Game;
use game\models\Platform;

class RequestManager
{

    /* ------------------------ TP1  ---------------------------- */
    function listGamesWithMario(){
        foreach (Game::where("name", "like", "%Mario%")->get() as $game){
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
            echo($game->id . " " . $game->name . "<br>" . $game->deck . "<br><br>");
        }
    }

    /* ---------------------------------------- TP2 -------------------------------------- */
    function displayCharacter12342(){
        $jeu = Game::where("id", '=', 12342)->first();;
        foreach($jeu->characters as $personnage){
            echo("Nom du personnage: " . $personnage->name . "<br>". "Deck du personnage: " . $personnage->deck . "<br><br>");
        }
    }

    function characterWithMarioGameName(){
        $games = Game::where('name', 'like', 'Mario%')->get();
        foreach ($games as $game){
            foreach ($game->characters as $personnage) {
                echo($personnage->id . " " . $personnage->name . "<br>");
            }
        }
    }

    function initialRatingWithGameNameContainsMario(){
        $games = Game::where('name','like','%mario%')->get();
        foreach ($games as $game){
            $ratings = $game->ratings;
            foreach ($ratings as $rating) {
                echo($game->name . "<br>Rating : " . $rating->name . "<br>" . "RatingBoard : " . $rating->rating_board->name . "<br><br>");
            }
        }

    }
}