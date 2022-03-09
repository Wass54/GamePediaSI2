<?php
declare(strict_types=1);

namespace game\models;

use Illuminate\Database\Eloquent\Model;

class Game_developers extends Model{
    protected $table = 'game_developers';
    protected $primaryKey = ['game_id','comp_id'];
    public $timestamps = false;
    
}