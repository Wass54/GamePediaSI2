<?php
declare(strict_types=1);

namespace game\models;

use Illuminate\Database\Eloquent\Model;

class Game2genre extends Model{
    protected $table = 'game2genre';
    protected $primaryKey = 'id';
    public $timestamps = false;
    
}