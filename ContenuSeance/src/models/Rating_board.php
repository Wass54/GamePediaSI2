<?php
declare(strict_types=1);

namespace game\models;

use Illuminate\Database\Eloquent\Model;

class Rating_board extends Model{
    protected $table = 'rating_board';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function game_ratings(){
        return $this->hasMany(Game_rating::class);
    }
    
}