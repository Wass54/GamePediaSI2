<?php
declare(strict_types=1);

namespace game\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Game extends Model{
    protected $table = 'game';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function characters(): BelongsToMany
    {
        return $this->belongsToMany(Character::class, 'Game2character', "game_id", "character_id");
    }

    public function platform(){

        return $this->belongsToMany(Platform::class, 'Game2platform', 'game_id', 'platform_id');

    }

    public function ratings()
    {
        return $this->belongsToMany(Game_rating::class, 'game2rating', "game_id", "rating_id");
    }

    public function companies(){
        return $this->belongsToMany(Company::class, 'Game_developers', 'game_id', 'comp_id');
    }

    public function genres(){
        return  $this->belongsToMany(Genre::class, 'game2genre', 'game_id', 'genre_id');
    }

    public function rating_board(){
        return $this->ratings()->belongsTo()(Rating_board::class, 'rating_board_id');
    }

    public function hasFirstAppearanceOf(){
        return $this->hasMany(Character::class,'first_appeared_in_game_id');
    }

    public function comments(){
        return $this->hasMany(Comment::class, 'game');
    }
}