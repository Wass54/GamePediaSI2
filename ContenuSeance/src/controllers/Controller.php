<?php

namespace game\controller;

use game\models\Character;
use game\models\Comment;
use game\models\Game;
use game\models\Platform;
use game\models\User;
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
    public function gamesByPage($rq, $rs, $args){
        $page = $rq->getQueryParam('page');
        if(!isset($page)) $page = 1;
        $rs = $rs->withHeader('Content-Type', 'application/json');

        $games = Game::skip(200*($page-1))->take(200)->get();
        $array = array();

        foreach($games as $g){
                array_push($array, array('id' => $g->id, 'name' => $g->name, 'alias' => $g->alias, 'deck' => $g->deck,
                'description' => $g->description));
        }
        $href1 = array();


        array_push($href1,array('href'=> $this->container->router->pathFor('games') . ("?page=" . ($page - 1))));

        $href2 = array();
        array_push($href2,array('href'=> $this->container->router->pathFor('games') . ("?page=" . ($page + 1))));

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

    //----------------------------------------------Partie 4----------------------------------------------

    public function collectionLinks($rq, $rs, $args){
        $rs = $rs->withHeader('Content-Type', 'application/json');
        $game = Game::take(200)->get();
        $array = array();
        foreach($game as $g){
                $nombreID = $g->id;
                array_push($array, array('game' => array('id' => $g->id, 'name' => $g->name, 'alias' => $g->alias, 'deck' => $g->deck, 'description' => $g->description)));
                array_push($array, array('links' => array('self' => array('href' => $this->container->router->pathFor('games').$nombreID))));
        }

        $array2 = array();
        $array2['games'] = $array;
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

        $game = Game::where('id', '=', $id)->with('platforms')->first();
        //$game = Game::find($id);
        $arrayPrincipal = array();
        $arrayGame = array('id' => $id, 'name' => $game->name, 'alias' => $game->alias, 'deck' => $game->deck,
        'description' => $game->description, 'original_release_date' => $game->original_release_date, 'Platforme' => $game->platforms);

        $arrayLinks = array('links' => array('comments' => $this->container->router->pathFor('comments',['id'=>$game->id]),
                                             'characters' => $this->container->router->pathFor('charactersForGame',['id'=>$game->id])));


        array_push($arrayPrincipal, $arrayGame);
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

    //----------------------------------------------Partie 8----------------------------------------------
    public function comment($rq,$rs,$args){
        $rs = $rs->withHeader('Content-Type', 'application/json');
        $comment = Comment::find($args['id']);
        $arrayComment = array('id' => $comment->id, 'title' => $comment->title, 'content' => $comment->content, 'postedBy' => $comment->postedBy);
        return $rs->withJson($arrayComment);
    }

    public function postComment($rq, $rs, $args){
        $rs = $rs->withHeader('Content-Type', 'application/json');

        $formulaire = $rq->getParsedBody();

        $comment = new Comment();
        $comment->title = $formulaire['title'];
        $comment->game = $args['id'];
        $comment->created_at = date('d-m-y h:i:s');
        $comment->updated_at = date('d-m-y h:i:s');
        $comment->content = $formulaire['content'];

        $email = $formulaire['email'];
        $user = User::firstwhere('email', $email);
        $comment->postedBy = $user->id;
        $comment->save();

        $arrayComment = array("id" => $comment->id, "title" => $comment->title, "content" => $comment->content,
            "createdAt" => $comment->created_at, "postedBy" => $comment->postedBy);

        $rs = $rs->withHeader('Location', $this->container->router->pathFor('comment', ['id' => $comment->id]));
        $rs = $rs->withStatus(201);
        return $rs->withJson($arrayComment);
    }
}
