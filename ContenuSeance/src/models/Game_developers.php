<?php
declare(strict_types=1);

namespace game\models;

use Illuminate\Database\Eloquent\Model;

class Game_developers extends Model{
    protected $table = 'game_developers';
    protected $primaryKey = 'id';
    public $timestamps = false;
    
}