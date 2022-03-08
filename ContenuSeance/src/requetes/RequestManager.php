<?php
namespace game\requetes;

use game\models\Company;
use game\models\Game;
use game\models\Platform;

class RequestManager
{

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
}