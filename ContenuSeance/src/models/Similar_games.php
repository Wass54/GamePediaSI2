<?php
declare(strict_types=1);

namespace game\models;

use Illuminate\Database\Eloquent\Model;

class Similar_games extends Model{
    protected $table = 'similar_games';
    protected $primaryKey = 'id';
    public $timestamps = false;
    
}