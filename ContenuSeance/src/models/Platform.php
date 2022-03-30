<?php
declare(strict_types=1);

namespace game\models;

use Illuminate\Database\Eloquent\Model;

class Platform extends Model{
    protected $table = 'platform';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function games(){
        return $this->belongsToMany(Game::class, 'game2platform', 'platform_id','game_id');
    }
    
}