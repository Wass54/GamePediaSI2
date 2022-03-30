<?php

namespace game\controller;

use game\models\Comment;
use game\models\Game;

class Controller
{

    //----------------------------------------------Partie 1----------------------------------------------
    public function gameById($rq, $rs, $args){
        $id = $args['id'];
        $rs = $rs->withHeader('Content-Type', 'application/json');

        $game = Game::find($id);

        $array = array('id' => $id, 'name' => $game->name, 'alias' => $game->alias, 'deck' => $game->deck,
            'description' => $game->description, 'original_release_date' => $game->original_release_date);

        $rs = $rs->withJson($array);
        return $rs;
    }

    //----------------------------------------------Partie 2----------------------------------------------
    public function allGames($rq, $rs, $args){
        $rs = $rs->withHeader('Content-Type', 'application/json');
        $game = Game::take(200)->get();
        $array = array();

        foreach($game as $g){
                array_push($array, array('id' => $g->id, 'name' => $g->name, 'alias' => $g->alias, 'deck' => $g->deck,
                'description' => $g->description));
        }
        
        $array2 = array();
        $array2['games'] = $array;
        $rs = $rs->withJson($array2);
        return $rs;

    }

    //----------------------------------------------Partie 3----------------------------------------------
    public function gameByPage($rq, $rs, $args){
        $page = $args['page'];
        $rs = $rs->withHeader('Content-Type', 'application/json');

        $game = Game::skip(200*($page-1))->take(200)->get();
        $array = array();

        foreach($game as $g){
                array_push($array, array('id' => $g->id, 'name' => $g->name, 'alias' => $g->alias, 'deck' => $g->deck,
                'description' => $g->description));
        }
        $href1 = array();
        array_push($href1,array('href'=>"/api/games?page=".$page-1));
        
        $href2 = array();
        array_push($href2,array('href'=>"/api/games?page=".$page+1));
        
        $links = array();
        if($page==1){
            array_push($links,array('next'=>$href2));
        }else{
            $longueur = Game::count();
            if(($longueur/200)==$page){
                array_push($links,array('prev'=>$href1));
            }else{
                array_push($links,array('prev'=>$href1));
                array_push($links,array('next'=>$href2));
            }
        }

        $array2 = array();
        $array2['games'] = $array;
        $array2['links'] = $links;
        $rs = $rs->withJson($array2);
        return $rs;
    }

    //----------------------------------------------Partie 5----------------------------------------------
    public function listCommentsForGame($rq, $rs, $args){
        $rs = $rs->withHeader('Content-Type', 'application/json');
        $id = $args['id'];
        $game = Game::find($id);
        $commentaires = $game->comments;
        $array = array();

        foreach ($commentaires as $commentaire){
            array_push($array, array("id" => $commentaire->id, "title" => $commentaire->title, "content" => $commentaire->content,
                "createdAt" => $commentaire->createdAt, "postedBy" => $commentaire->postedBy));
        }

        $ret = array();
        $ret['comments'] = $array;
        $rs = $rs->withJson($ret);
        return $rs;
    }

    //----------------------------------------------Partie 6----------------------------------------------
    public function gameByIdDetailled($rq, $rs, $args){
        $id = $args['id'];
        $rs = $rs->withHeader('Content-Type', 'application/json');

        $game = Game::find($id);
        $arrayPrincipal = array();
        $arrayGame = array('game' => array('id' => $id, 'name' => $game->name, 'alias' => $game->alias, 'deck' => $game->deck,
                           'description' => $game->description, 'original_release_date' => $game->original_release_date));
        //array_push($arrayPrincipal, $arrayGame);

        $arrayLinks = array('links' => array('comments' => "/api/games/".$game->id."/comments" , 'characters' => "/api/games/".$game->id."/characters"));
        //array_push($arrayPrincipal, $arrayLinks);
        
        //--------------------------------------------------------------------------------------------//

        $plateforme = Platforme::find($game->platform->platform_id); 
        $arrayPlateforme = array();

        foreach($plateforme as $p){
            array_push($arrayPlateforme, array('idPlateform' => $p->id, 'namePlatform' => $p->name, 'aliasPlatform' => $p->alias, 'abbreviationPlatform' => $p->abbreviation));
        }

        $gamePlateformeTab = array();
        $gamePlateformeTab['gamePlateforme'] = $arrayPlateforme;
        array_push($arrayGame, $gamePlateformeTab);
        array_push($arrayPrincipal, $arrayGame);
        array_push($arrayPrincipal, $arrayLinks);


        $rs = $rs->withJson($arrayPrincipal);
        return $rs;


    }

}