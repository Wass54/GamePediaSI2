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
        return $this->belongsToMany(Character::class, Game2character::class, "game_id", "character_id");
    }

    public function companies(){
        return $this->belongsToMany('Company', 'Game_developers', 'game_id', 'comp_id');
    }
}