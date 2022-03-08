<?php
declare(strict_types=1);

namespace game\models;

use Illuminate\Database\Eloquent\Model;

class Enemies extends Model{
    protected $table = 'enemies';
    protected $primaryKey = 'id';
    public $timestamps = false;
    
}