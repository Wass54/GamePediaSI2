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

        $json = json_encode($array);
        $rs = $rs->withJson($json);
        return $rs;
    }


    public function gameByGames($rs, $rs, $args){
        $id = $rq->getQueryParam("id");
        $rs = $rs->withHeader('Content-Type', 'application/json');
        $rs 

    }

}