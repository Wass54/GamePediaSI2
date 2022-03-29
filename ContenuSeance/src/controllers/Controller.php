<?php

namespace game\controller;

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
        $game = Game::all();
        $compteur = 0;
        foreach($game as $g){
            if($compteur <= 200){
                $array = array('id' => $g->id, 'name' => $g->name, 'alias' => $g->alias, 'deck' => $g->deck,
                'description' => $g->description);
                $json = json_encode($array);
                $rs = $rs->withJson($json);
                $compteur++;
                return $rs;
            }
        }
    }


/*
    public function gameByPage($rq, $rs, $args){
        $rs = $rs->withHeader('Content-Type', 'application/json');
        
    }*/


}