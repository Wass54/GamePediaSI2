<?php
declare(strict_types=1);

namespace game\models;

class Game extends \Illuminate\Database\Eloquent\Model{
    protected $table = 'game';
    protected $primaryKey = 'id';
    public $timestamps = false;
    
}