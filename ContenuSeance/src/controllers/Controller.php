<?php

namespace game\controller;

use game\models\Comment;
use game\models\Game;

class Controller
{

    public function gameById($rq, $rs, $args){
        $id = $args['id'];
        $rs = $rs->withHeader('Content-Type', 'application/json');

        $game = Game::find($id);

        $array = array('id' => $id, 'name' => $game->name, 'alias' => $game->alias, 'deck' => $game->deck,
            'description' => $game->description, 'original_release_date' => $game->original_release_date);

        $rs = $rs->withJson($array);
        return $rs;
    }


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


/*
    public function gameByPage($rq, $rs, $args){
        $rs = $rs->withHeader('Content-Type', 'application/json');
        
    }
*/

}