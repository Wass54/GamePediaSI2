<?php
declare(strict_types=1);

namespace game\models;

use Illuminate\Database\Eloquent\Model;

class Game_publishers extends Model{
    protected $table = 'game_publishers';
    protected $primaryKey = 'id';
    public $timestamps = false;
    
}