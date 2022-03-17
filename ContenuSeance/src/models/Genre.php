<?php
declare(strict_types=1);

namespace game\models;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model{
    protected $table = 'genre';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function games(){
        return  $this->belongsToMany(Game::class, 'game2genre', 'genre_id', 'game_id');
    }
    
}