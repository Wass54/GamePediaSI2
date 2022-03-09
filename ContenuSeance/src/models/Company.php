<?php
declare(strict_types=1);

namespace game\models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model{
    protected $table = 'company';
    protected $primaryKey = 'id';
    public $timestamps = false;
    



    
    public function games(){
        return $this->belongsToMany('Game', 'Game_developers', 'comp_id', 'game_id');
    }
}


