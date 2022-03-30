<?php

namespace game\controller;

use game\models\Character;
use game\models\Comment;
use game\models\Game;
use Slim\Container;

class Controller
{
    protected $container;

    function __construct(Container $c){
        $this->container = $c;
    }

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


        array_push($href1,array('href'=>$this->container->router->pathFor('games',['id'=>$game->id])."?page=".$page-1));

        $href2 = array();
        array_push($href2,array('href'=>$this->container->router->pathFor('games',['id'=>$game->id])."?page=".$page+1));

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
        array_push($arrayPrincipal, $arrayGame);

        $arrayLinks = array('links' => array('comments' => $this->container->router->pathFor('comments',['id'=>$game->id])),
                                            'characters' => $this->container->router->pathFor('charactersForGame',['id'=>$game->id]));
        array_push($arrayPrincipal, $arrayLinks);

        $rs = $rs->withJson($arrayPrincipal);
        return $rs;
    }

    //----------------------------------------------Partie 7----------------------------------------------
    public function characterById($rq, $rs, $args){
        $id = $args['id'];
        $rs = $rs->withHeader('Content-Type', 'application/json');

        $character = Character::find($id);

        $array = array('id' => $id, 'name' => $character->name);

        $rs = $rs->withJson($array);
        return $rs;
    }

    public function listCharactersForGame($rq, $rs, $args){
        $id = $args['id'];
        $rs = $rs->withHeader('Content-Type', 'application/json');

        $game = Game::find($id);
        $arrayCharacters = array();

        $characters = $game->characters;
        foreach ($characters as $character){
            $arrayCharacter = array('character' =>
                                    array('id' => $character->id,
                                    'name' => $character->name,
                                    'links' => array('self' => array('href' =>
                                            $this->container->router->pathFor('character',['id'=>$character->id])))
                ));
            array_push($arrayCharacters,$arrayCharacter);
        }

        $arrayPrincipal = array();
        $arrayPrincipal['characters'] = $arrayCharacters;
        return $rs->withJson($arrayPrincipal);
    }
}
