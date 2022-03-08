<?php
declare(strict_types=1);

namespace game\models;

use Illuminate\Database\Eloquent\Model;

class Friends extends Model{
    protected $table = 'friends';
    protected $primaryKey = 'id';
    public $timestamps = false;
    
}