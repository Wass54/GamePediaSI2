<?php
declare(strict_types=1);

namespace game\models;

use Illuminate\Database\Eloquent\Model;

class Game2rating extends Model{
    protected $table = 'game2rating';
    protected $primaryKey = 'id';
    public $timestamps = false;
    
}