<?php
declare(strict_types=1);

namespace game\models;

use Illuminate\Database\Eloquent\Model;

class Game_rating extends Model{
    protected $table = 'game_rating';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function rating_board(){
        return $this->belongsTo(Rating_board::class);
    }

    public function games(){
        return $this->belongsToMany(Game::class, Game2rating::class, "rating_id", "game_id");
    }
    
}