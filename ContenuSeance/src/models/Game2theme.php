<?php
declare(strict_types=1);

namespace game\models;

use Illuminate\Database\Eloquent\Model;

class Game2theme extends Model{
    protected $table = 'game2theme';
    protected $primaryKey = 'id';
    public $timestamps = false;
    
}