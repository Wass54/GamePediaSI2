<?php
declare(strict_types=1);

namespace game\models;

use Illuminate\Database\Eloquent\Model;

class Game2character extends Model{
    protected $table = 'game2character';
    protected $primaryKey = 'id';
    public $timestamps = false;
    
}